<?php include("../../autoload.php");?>	
<?php include("validator.php");?>	
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
		case "users_list_json":
			executeUserListJson($values);	
		break;	
		default:
			executeIndex($values);
		break;
	}
	function executeIndex($values = null)
	{
	require('users_list_view.php');
	}
	function executeNew($values = null)
	{       
                $values['status'] = '1';
		$values['action'] = 'add';
		require('users_form_view.php');
	}
	function executeSave($values = null)
	{
		
		$Users = new Users();
		$errors = validate($values);
		if(count($errors)>0)
		{	
			$values['errors'] = $errors;
			require('users_form_view.php');die;
		}else{		
			$values = $Users->saveUser($values);			
			executeEdit($values,message_created);die;
		}
	}
	function executeEdit($values = null,$msg = null)
	{
		
		$Users = new Users();
		$values = $Users->getUserById($values);
		$values['action'] = 'update';
                $values['msg'] = $msg;
		$values['errors'] = array();
		require('users_form_view.php');
	}
	function executeUpdate($values = null)
	{
		
		$Users = new Users();
		$errors = validate($values);
		if(count($errors)>0)
		{	
			$values['errors'] = $errors;
			require('users_form_view.php');die;
		}else{		
			$Users->updateUser($values);			
			executeEdit($values,message_updated);die;
		}
	}	
	function executeUserListJson($values)
	{
		$Users = new Users();
		$users_list_json = $Users ->getUsersList($values);
		$users_list_json_cuenta = $Users ->getCountUsersList($values);
		$array_json = array();
		$array_json['recordsTotal'] = $users_list_json_cuenta;
		$array_json['recordsFiltered'] = $users_list_json_cuenta;
		if(count($users_list_json)>0)
		{
			foreach ($users_list_json as $user) 
			{
				$status = $user['status'];
				if($status == 0)
				{
					$message_status = "<label class='label label-danger'>Desactivado</label>";
				}
				if($status == 1)
				{
					$message_status = "<label class='label label-success'>Activo</label>";
				}
				$id_user = $user['id_user'];
				$array_json['data'][] = array(
					"id_user" => $id_user,
					"responsible_cedula" => $user['responsible_cedula'],
					"login" => $user['login'],
					"status" => $message_status,
                                        "date_created" => $user['date_created'],
                                        "date_updated" => $user['date_updated'],
					"actions" => 
                                       '<form method="POST" action = "'.full_url.'/adm/users/index.php" >'
                                       .'<input type="hidden" name="action" value="edit">  '
                                       .'<input type="hidden" name="id_user" value="'.$id_user.'">  '
									   
                                       .'<button class="btn btn-default btn-sm" type="submit"><i class="fa fa-edit  fa-pull-left fa-border"></i></button>'
									   .'<a class="btn btn-default btn-sm" href="'.full_url.'/adm/services_operator/index.php?action=index&idGrua='.$id_user.'&id_user='.$id_user.'"><i class="fa fa-book  fa-pull-left fa-border"></i></a>  '
									   

					);	
			}	
		}else{
			$array_json['recordsTotal'] = 0;
			$array_json['recordsFiltered'] = 0;
			$array_json['data'][0] = array("id_user"=>null,"responsible_cedula"=>"","login"=>"","status"=>"","date_created"=>"","date_updated"=>"","actions"=>"");
		}

		echo json_encode($array_json);die;
		
	}