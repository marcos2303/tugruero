<?php include("../../autoload.php");?>	
<?php include("validator.php");?>	
<?php include("../security/security.php");?>
<?php $action = "";

if(isset($_REQUEST["action"]) and $_REQUEST["action"]!=""){
	$action = $_REQUEST["action"];
}

$values = $_REQUEST;
	switch ($action) {
		case "index":
			executeIndex($values);	
		break;
		case "new":
			executeNew($values);	
		break;
		case "add":
			executeSave($values);	
		break;
		case "edit":
			executeEdit($values);	
		break;
		case "update":
			executeUpdate($values);	
		break;		
		case "company_list_json":
			executeCompanyListJson($values);	
		break;	
		default:
			executeIndex($values);
		break;
	}
	function executeIndex($values = null)
	{
	require('company_list_view.php');
	}
	function executeNew($values = null)
	{
        $Bank = new Bank();
        $bank_list = $Bank ->getBankList();
        $values['status'] = '1';
		$values['action'] = 'add';
		
		require('company_form_view.php');
	}
	function executeSave($values = null)
	{
		
		$Company = new Company();
		$values = $Company->saveCompany($values);
		executeEdit($values,message_created);die;
	}
	function executeEdit($values = null,$msg = null)
	{
		$Bank = new Bank();
                $bank_list = $Bank ->getBankList();
		$Company = new Company();
		$values = $Company->getCompanyById($values);
                $id_company = $values['id'];
                $CompanyFiles = new CompanyFiles();
                $company_files_list = $CompanyFiles ->getCompanyFilesList($id_company);
                $values['action'] = 'update';
                $values['msg'] = $msg;
		require('company_form_view.php');
	}
	function executeUpdate($values = null)
	{
		
		$Company = new Company();
		$data_company = $Company->getCompanyById($values);
		$status_anterior = $data_company['status'];
		$Company->updateCompany($values);
		$Users = new Users();
		if($values['status']==1)
		{
			
			if($status_anterior!=1)
			{
				$Users->activeUserMasterCompany($values['id']);
				$Mail = new Mail();
				$Mail ->mail3($values);	
			}

		}elseif($values['status']==0)
		{
			$Users->inactiveUserMasterCompany($values['id']);
		}				
		executeEdit($values,message_updated);die;
	}	
	function executeCompanyListJson($values)
	{
		$Company = new Company();
		$company_list_json = $Company ->getCompanyList($values);
		$company_list_json_cuenta = $Company ->getCountCompanyList($values);
		$array_json = array();
		$array_json['recordsTotal'] = $company_list_json_cuenta;
		$array_json['recordsFiltered'] = $company_list_json_cuenta;
		if(count($company_list_json)>0)
		{
			foreach ($company_list_json as $company) 
			{
				$status = $company['status'];
				if($status == 0)
				{
					$message_status = "<label class='label label-danger'>Desactivado</label>";
				}
				if($status == 1)
				{
					$message_status = "<label class='label label-success'>Activo</label>";
				}
				$id = $company['id'];
				$array_json['data'][] = array(
					"id" => $id,
					"responsible_name" => $company['responsible_name'],
					"RIF" => $company['rif'],
					"Razon_social" => $company['razon_social'],
					"status" => $message_status,
					"date_created" => $company['date_created'],
					"date_updated" => $company['date_updated'],
					"actions" => 
                                       
                                       '<form method="POST" action = "'.full_url.'/adm/company/index.php" >'
                                       .'<input type="hidden" name="action" value="edit">  '
                                       .'<input type="hidden" name="id" value="'.$id.'">  '
                                       .'<button class="btn btn-default btn-sm" type="submit"><i class="fa fa-edit  fa-pull-left fa-border"></i></button>'
                                       //.'<a href="'.full_url.'/adm/users_company/index.php?id_company='.$id.'" class="btn btn-default btn-sm"><i class="fa fa-users  fa-pull-left fa-border"></i></a>'
									   .'<a href="'.full_url.'/adm/services_administrators/index.php?id_company='.$id.'" class="btn btn-default btn-sm"><i class="fa fa-book fa-pull-left fa-border"></i></a>'
                                       .'</form>'
					);	
			}	
		}else{
			$array_json['recordsTotal'] = 0;
			$array_json['recordsFiltered'] = 0;
			$array_json['data'][0] = array("id"=>null,"responsible_name"=>"","RIF"=>"","Razon_social"=>"","status"=>"","date_created"=>"","date_updated"=>"","actions"=>"");
		}

		echo json_encode($array_json);die;
		
	}