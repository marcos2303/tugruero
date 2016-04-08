<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of UsersCompany
	 *
	 * @author marcos
	 */
	class UsersHoistCompany {
		
		public function __construct() 
		{
			
		}
		public function getUsersHoistCompanyList($values)
		{	
			$columns = array();
			$columns[0] = 'id_hoist_company';
			$columns[1] = 'id_users';
			$columns[3] = 'first_name';
			$columns[4] = 'first_last_name';
			$columns[6] = 'id_hoist';
			$columns[7] = 'status';
			$columns[8] = 'date_created';
			$columns[9] = 'date_updated';
			$column_order = $columns[0];
			$where = '1 = 1';
			$order = 'asc';
			$limit = $values['length'];
			$offset = $values['start'];
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where= ""
                                        . "or upper(users_data.first_name) like upper('%$str%' )"
										. "or upper(users_data.first_last_name) like upper('%$str%' )"
                                        . "or upper(status.name) like upper('%$str%')"
                                        . "";
			}
			if(isset($values['order'][0]['column']) and $values['order'][0]['column']!='0')
			{
				$column_order = $columns[$values['order'][0]['column']];
			}
			if(isset($values['order'][0]['dir']) and $values['order'][0]['dir']!='0')
			{
				$order = $values['order'][0]['dir'];//asc o desc
			}
			//echo $column_order;die;
                        $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->hoist_company()
			->select("users_hoist_company.id_user_hoist_company,
					users_data.id_users,
					users_data.first_name,
					users_data.first_last_name,
					users_hoist_company.id_hoist,
					users_hoist_company.status,
					DATE_FORMAT(users_hoist_company.date_created, '%d/%m/%Y %H:%i:%s') as date_created,
					DATE_FORMAT(users_hoist_company.date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->join("users_company","inner join users_company on users_company.id_company = hoist_company.id_company")
			->join("users_hoist_company","inner join users_hoist_company on users_hoist_company.id_company = hoist_company.id_company and users_hoist_company.id_user = users_company.id_user")
			->join("users_data","inner join users_data on users_data.id_users = users_company.id_user")
                        ->where("$where")
                        ->order("$column_order $order")
			->limit($limit,$offset);
                       // echo $q;
			return $q; 			
		}
		public function getCountUsersHoistCompanyList($values)
		{	
			$where = '1 = 1';
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where= ""
                                        . "or upper(users_data.first_name) like upper('%$str%' )"
										. "or upper(users_data.first_last_name) like upper('%$str%' )"
                                        . "or upper(status.name) like upper('%$str%')"
                                        . "";
			}
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->hoist_company
			->select("count(*) as cuenta")
			->join("users_company","inner join users_company on users_company.id_company = hoist_company.id_company")
			->join("users_hoist_company","inner join users_hoist_company on users_hoist_company.id_company = hoist_company.id_company and users_hoist_company.id_user = users_company.id_user")
			->join("users_data","inner join users_data on users_data.id_users = users_company.id_user")
                        ->where("$where")
                        ->fetch();
			return $q['cuenta']; 			
		}
		public function getUsersHoistCompanyById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users_company
			->select("*, DATE_FORMAT(date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->where("id=?",$values['id'])->fetch();
			return $q; 				
			
		}
		function deleteUsersHoistCompany($id){
			unset($values['action']);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users_company("id", $id)->delete();
			
			
		}		
		function saveUsersHoistCompany($values){
			unset($values['action']);
			$values['date_created'] = new NotORM_Literal("NOW()");
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users_company()->insert($values);
			$values['id'] = $ConnectionORM->getConnect()->UsersCompany()->insert_id();
			return $values;	
			
		}
		function updateUsersHoistCompany($values){
			unset($values['action'],$values['date_created']);
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$id = $values['id'];
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users_company("id", $id)->update($values);
			return $q;
			
		}
	}
	