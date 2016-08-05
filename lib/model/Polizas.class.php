<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of Polizass
	 *
	 * @author marcos
	 */
	class Polizas {
		
		public function __construct() 
		{
			
		}
		public function getPolizasList($values)
		{	
			$columns = array();
			$columns[0] = 'idPoliza';
			$columns[1] = 'Placa';
			$columns[2] = 'Cedula';
			$columns[3] = 'Nombre';
			$columns[4] = 'Apellido';
            $columns[5] = 'Vencimiento';
            $columns[6] = 'Seguro';
			$column_order = $columns[0];
			$where = '1 = 1';
			$order = 'asc';
			$limit = $values['length'];
			$offset = $values['start'];
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = "upper(Placa) like upper('%$str%')"
					. "OR upper(Cedula) like upper('%".$str."%')"
					. "OR upper(Nombre) like upper('%".$str."%')"
					. "OR upper(NumPoliza) like upper('%".$str."%')"
					. "OR upper(Apellido) like upper('%".$str."%')"
					. "OR upper(Seguro) like upper('%".$str."%')";
			}
			
			if(isset($values['columns'][0]['search']['value']) and $values['columns'][0]['search']['value']!='')
			{
				$where.=" AND idPoliza = ".$values['columns'][0]['search']['value']."";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][1]['search']['value']) and $values['columns'][1]['search']['value']!='')
			{
				$where.=" AND upper(Seguro) like ('%".$values['columns'][1]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}			
			if(isset($values['columns'][2]['search']['value']) and $values['columns'][2]['search']['value']!='')
			{
				$where.=" AND upper(NumPoliza) like ('%".$values['columns'][2]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}			
			if(isset($values['columns'][3]['search']['value']) and $values['columns'][3]['search']['value']!='')
			{
				$where.=" AND upper(Placa) like ('%".$values['columns'][3]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}	
			if(isset($values['columns'][4]['search']['value']) and $values['columns'][4]['search']['value']!='')
			{
				$where.=" AND upper(Cedula) like ('%".$values['columns'][4]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}	
			if(isset($values['columns'][5]['search']['value']) and $values['columns'][5]['search']['value']!='')
			{
				$where.=" AND CONCAT(upper(Nombre),' ',upper(Apellido) ) like ('%".$values['columns'][5]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}	
			if(isset($values['columns'][6]['search']['value']) and $values['columns'][6]['search']['value']!='')
			{
				$where.=" AND DATE_FORMAT(Polizas.Vencimiento, '%d/%m/%Y') = '".$values['columns'][6]['search']['value']."'";
				//echo $values['columns'][0]['search']['value'];die;
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
			$q = $ConnectionORM->getConnect('tugruero')->Polizas
			->select("*,DATE_FORMAT(Polizas.Vencimiento, '%d/%m/%Y') as Vencimiento")
			->order("$column_order $order")
			->where("$where")
			->limit($limit,$offset);
			//echo $q;die;
			return $q; 			
		}
		public function getCountPolizasList($values)
		{	
			$where = '1 = 1';
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = " ";
			}
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Polizas
			->select("count(*) as cuenta")
			->where("$where")->fetch();
			return $q['cuenta']; 			
		}
		public function getPolizasById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Polizas
			->select("*,DATE_FORMAT(Vencimiento, '%d/%m/%Y') as Vencimiento")
			->where("idPoliza=?",$values['idPoliza'])->fetch();
			return $q; 				
			
		}
		function deletePolizas($id){
			unset($values['action']);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Polizas("idPoliza", $id)->delete();
			
			
		}		
		function savePolizas($values){
			$Utilitarios = new Utilitarios();
            if(isset($values['Vencimiento']) and $values['Vencimiento']!='')
            {
				$values['Vencimiento'] = $Utilitarios->formatFechaInput($values['Vencimiento']);

            }else
            {
				$values['Vencimiento']=null;
            }
			$hora = date(gmdate('Y-m-d H:i:s', time() - (4 * 3600)));
			$array_poliza = array(
				'Placa' => $values['Placa'],
				'Cedula' => $values['Nacionalidad'].'-'.$values['Cedula'],
				'Nombre' => $values['Nombre'],
				'Apellido' => $values['Apellido'],
				'Marca' => $values['Marca'],
				'Modelo' => $values['Modelo'],
				'Tipo' => $values['Tipo'],
				'Color' => $values['Color'],
				'Año' => $values['Año'],
				'Serial' => $values['Serial'],
				'Seguro' => $values['Seguro'],
				'NumPoliza' => $values['NumPoliza'],
				'DireccionEDO' => $values['DireccionEDO'],
				'Domicilio' => $values['Domicilio'],
				'DireccionFiscal' => $values['DireccionFiscal'],
				'Vencimiento' => $values['Vencimiento'],
				'date_created' => $hora,
				'date_updated' => $hora,
				'created_by' => 1,
				'updated_by' => 1
			);
			
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Polizas()->insert($array_poliza);
			$values['idPoliza'] = $ConnectionORM->getConnect()->Polizas()->insert_id();
			return $values;	
			
		}
		function updatePolizas($values){			
			$Utilitarios = new Utilitarios();
            if(isset($values['Vencimiento']) and $values['Vencimiento']!='')
            {
				$values['Vencimiento'] = $Utilitarios->formatFechaInput($values['Vencimiento']);

            }else
            {
				$values['Vencimiento']=null;
            }			
 			$hora = date(gmdate('Y-m-d H:i:s', time() - (4 * 3600)));
			$array_poliza = array(
				'Placa' => $values['Placa'],
				'Cedula' => $values['Nacionalidad'].'-'.$values['Cedula'],
				'Nombre' => $values['Nombre'],
				'Apellido' => $values['Apellido'],
				'Marca' => $values['Marca'],
				'Modelo' => $values['Modelo'],
				'Tipo' => $values['Tipo'],
				'Color' => $values['Color'],
				'Año' => $values['Año'],
				'Serial' => $values['Serial'],
				'Seguro' => $values['Seguro'],
				'NumPoliza' => $values['NumPoliza'],
				'DireccionEDO' => $values['DireccionEDO'],
				'Domicilio' => $values['Domicilio'],
				'DireccionFiscal' => $values['DireccionFiscal'],
				'Vencimiento' => $values['Vencimiento'],
				'date_updated' => $hora,
				'created_by' => 1,
				'updated_by' => 1
			);
			$idPoliza = $values['idPoliza'];
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Polizas("idPoliza", $idPoliza)->update($array_poliza);
			return $q;
			
		}
		public function getPolizasByIdCompany($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Polizas
			->select("*")
			->join("Polizas_company","INNER JOIN Polizas_company on Polizas_company.id_Polizas = Polizas.id")
			->where("Polizas_company.id_company=?",$values['id']);
			return $q; 				
			
		}
		public function getCountUserPolizasCompanyByIdPolizas($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Polizas
			->select("count(*) as cuenta")
			->where("users_Polizas_company.id_Polizas=?",$values['idPoliza'])->fetch();
			return $q; 				
			
		}		
	}
	