<?php include("../autoload.php");?>	
<?php include("validator.php");?>	
<?php //include("security.php");?>						
<?php


$action = "";
if(isset($_REQUEST["action"]) and $_REQUEST["action"]!=""){
	$action = $_REQUEST["action"];
}
	
$values = trimValues($_REQUEST);;
	switch ($action) {
		case "index":
			executeIndex($values);	
		break;
		case "paso1":
			executePaso1($values);	
		break;
		case "validaFormulario1":
			executeValidaFormulario1($values);	
		break;
		case "paso2":
			executePaso2($values);	
		break;
		case "validaFormulario2":
			executeValidaFormulario2($values);	
		break;	
		case "ForgottenYourPassword":
			executeForgottenYourPassword($values);	
		break;	
		case "valideForgottenPassword":
			executeValideForgottenYourPassword($values);	
		break;
		default:
			executePaso1($values);
		break;
	}
						
	function executeIndex($values = null){
	require('paso1_view.php');
	}
	function executePaso1($values = null){
		if(isset($values['token']) and count($values['token'])>0)
			{
				$data = validarToken($values['token']);
				if(count($data)>0)
				{
					$values['bank'] = getBankList();
					
					require('paso2_view.php');
				}
				else
				{
					$values = null;
					$values['errors']['tokenErros'] = "Token invalido";
					require('paso1_view.php');
				}
			}
			else
			{
				require('paso1_view.php');
			}
	}
	function executeLogin($values)
	{
		require('index.php');
	}
	function executeValidaFormulario1($values = null)
	{
		$securimage = new Securimage();
		$captcha = $values['ct_captcha'];
		if ($securimage->check($captcha) == false) {
		  $errors['captcha_error'] = 'Incorrect security code entered<br />';
				$values['errors']['captcha'] = "Imagen incorrecta";
				executePaso1($values);die;
		}
		$errors = validaFormularioPaso1($values);
		$valido = true;
		if(count($errors)>0)
		{
			$values['errors'] = $errors;
			$valido = false;
			executePaso1($values);die;
		}

		if($valido == TRUE)
		{
			$rif=$values["Type_rif"]."-".$values["rif"];
			$correo = $values["correo"];
			$razonSocial = $values["razonSocial"];
			$registro = validarRifRazonSocial($rif);
			if(!count($registro)>0)
			{
				insertCompanyValidation($rif,$correo,$razonSocial);	
				$registro = validarRifRazonSocial($rif);
			}
			
			if(count($registro)>0)
			{

				foreach($registro as $id=> $valor)
				{
					if(stristr($valor['razon_social'], $razonSocial) === FALSE)
					{
						
						$values['errors']['razonSocialError']="La Razón Social o Nombre ingresado no es válido, por favor asegúrese de ingresar los datos correctos.";
						executePaso1($values);
						break;
					}
					if($valor["validate"] == 1)
					{
						$values['errors']['YaRegistrada']="Esta empresa ya se encuentra registrada. Ingrese a la plataforma con su Usuario y Clave en la sección anterior.";
						executePaso1($values);
					}else if($valor["status"] == 1)
					{
						$values['errors']['YaPendiente']="Ya existe un registro, está en la espera por su aprobación.";
						executePaso1($values);
					}
					else
					{
						$date = date("Y-m-d H:i:s");
						$nuevafecha = strtotime ( '+1 hour' , strtotime ( $date ) ) ;
						$nuevafecha = date ( 'Y-m-d H:i:s' , $nuevafecha );
						$id = $valor["id"];
						$token = base64_encode($razonSocial.$rif.$correo.date('d-m-y h:i:s'));
						$datos = array('token'=> $token,'id_company_validation'=>$id,'time_expire'=>$nuevafecha,'validate'=> 0,
							'mail'=> $correo,'mail_alternative' => $correo);
						$tokenCreate = addToken($datos);
						$idCreado = $tokenCreate["id"];
						$url = full_url."/ap/registrarse.php?token=".$token;
						$message = "<a href='$url'>Ingrese aquí</a>";
						$values['url'] = $url;
						$values['email'] = $correo;
						$Mail = new Mail();
						$Mail ->mail1($values);
						$values = null;
						$values['message']['tokenSend'] = "¡Muy bien! Te hemos enviado al email que nos indicaste un link de acceso a nuestra plataforma. Chequea tu Bandeja de Entrada o la bandeja de <u>Spam</u>, dale click y sigue con el Registro.";
						
						executePaso1($values);
					}
					break;
				}
			}
			else 
			{
				
				$values['errors']['EmpresaNoExiste'] = "El RIF ingresado no es válido, por favor asegúrese de ingresa el RIF correcto.";
				executePaso1($values);
			}
			die;
		}
	}
	function executePaso2($values = null)
	{
		$values['bank'] = getBankList();
		require('paso2_view.php');
	}
	function executeValidaFormulario2($values = null)
	{       
                $values = array_merge($values,$_FILES);
		$errors = validaFormularioPaso2($values,$_FILES);
                //print_r($_FILES);die;
		$valido = true;
		if(count($errors)>0)
		{
			$valido = false;
		}
		if($valido)
		{
			
			$data = validarToken($values['token']);	
			
			if(count($data)>0)
			{
				
				foreach($data as $valor)
				{
					
					
					$idEmpresa = $valor['id_company_validation'];
					$idToken = $valor['id'];
					$correo = $valor['mail'];
					$correoAlternativo = $valor['mail_alternative'];
					
					utilizarToken($values['token']);
					
					
					$DatosEmpresa = GetCompanyValidation($idEmpresa);
					
					foreach ($DatosEmpresa as $id => $value) 
					{
						$idCompanyValidation=$value["id"];
						$RegistrarEmpresa = array("rif" => $values["Type_rif"]."-".$values["rif"],
						"razon_social"=>$values["company_name"],
						"responsible_name"=>$values["first_name"]." ".$values["first_lastname"],
						"id_bank" =>$values["id_bank"],
						"tipo_cuenta" =>$values["tipo_cuenta"],
						"location" =>$values["location"],
						"zone_work" =>$values["zone_work"],
						"club_gruas" =>$values["club_gruas"],
						"num_socio" =>$values["num_socio"],
						"company_name" =>$values["company_name"],
						"num_cuenta" => $values["NumCuenta"],
						"status" => 0,
						"responsible_cedula"=>$values["nationality"]."-".$values["cedula"]);
						break;
					}
					
					$q = addCompany($RegistrarEmpresa);
					$idCompany = $q["id"];
					$values['id'] = $q["id"];
					$password = substr( md5(microtime()), 1, 8);
					
					$userData = array("login" =>$values['login'],
						"password" => hash('sha256',$values["password"]),
						"mail" => $correo,
						"mail_alternative" => $correoAlternativo,
						"date_created"=> date("Y-m-d H:i:s"),
						"date_updated" => date("Y-m-d H:i:s"));
					$user = addUser($userData);
					$idUser = $user["id"];
					
					$empresaRegistrada = array('rif' => $values['rif']
												,'razon_social' => $value['razon_social']
												,'status' => 1
												,'validate' => 0,"id"=>$idCompanyValidation);
					$userForCompany = array("id_user" => $idUser,"id_company"=>$idCompany);
					addUsersCompany($userForCompany);
					$Datauser = array("first_name" => $values["first_name"],
										"second_name" => $values["second_name"],
										"first_last_name" => $values["first_lastname"],
										"second_last_name" => $values["second_lastname"],
										"id_users" => $idUser,
										"phone" => $values["phone"],
										"gender" => $values["gender"],
										"document" =>$values["cedula"],
										"nationality" => $values["nationality"]);
					addUserData($Datauser);
					updateCompanyValidation($empresaRegistrada);
					
					$dateGrueros = array('idGrua' => $idUser,
								'Nombre' => $values['first_name'].' '.$values['second_name'],
								'Apellido' => $values["first_lastname"].' '.$values['second_lastname'],
								'Placa' => $values["placa"],
								'Modelo' => 'Gancho',
								'Color' =>'Blanca',
								'Celular' => $values['phone'],
								'Cedula' => $values['nationality'].'-'.$values["cedula"],
								'Clave' => $values['password'],
								'Condicion' => "Inactivo",
								'NumServicios' => "0",
								'TotalTrato' => "0",
								'TotalPresencia' => "0",
								'TotalVehiculo' => "0",
								'Rating' => "0");
					
					$dateGruas = array('idGrua' => $idUser,
								'Disponible' => "NO",
								'Latitud' => "",
								'Longitud' => "",
								'LastUpdate' => null,
								'Token' => null);
					
					$Aws = new Aws();
					$Aws->saveGrueros($dateGrueros);
					$Aws->saveGruas($dateGruas);
					$dataGruas = array();
			
					$carpeta = "../web/files";
					$fichero_subido = $carpeta."/";
					$cantidad = count($_FILES);
					$i = 1;
					while($i < $cantidad+1)
					{
						$nombreArchivo = $RegistrarEmpresa["rif"]."-".$i.".".pathinfo($_FILES['file_'.$i]['name'],PATHINFO_EXTENSION);
						if (move_uploaded_file($_FILES['file_'.$i]['tmp_name'], $fichero_subido.$nombreArchivo))
						{
					 
							$regisArchivo = array("name_file" =>$nombreArchivo,
													"validate" => 0,
													"status"=> 1,
													"id_company" =>$idCompany);
							addCompanyFiles($regisArchivo);
						}
						$i++;
					}
					$UserPerms = array("id_user"=>$idUser,"id_perms" => 3,"status"=>0);;
					addUserPerms($UserPerms);
					$message = "Usuario: ".$userData["login"]." Clave: ".$password;
					//$values['password'] = $password;
					$values['login'] = $userData["login"];
					$Mail = new Mail();
					$Mail ->mail2($values);
					//$Mail->send(array($correo), array(mail_from),"Asunto",$message);
					$values = null;
					$values['message'] = "Su usuario ha sido creado satisfactoriamente, se le ha enviado un correo electrónico con los datos para entrar a su cuenta. Recuerde que debe esperar la aprobación del administrador para iniciar sesión";
					$values["action"] = "login";
					 require 'paso2_message.php';die;
				}
			}
			else
			{
				
				$values = null;
				$values['errors']['token'] = 'Token invalido';
				executePaso1($values);
			}
		}
		else
		{
			$values['bank'] = getBankList();
			$values['errors'] = $errors;
			executePaso2($values);
			
			
		}
	}
	function executeForgottenYourPassword($values = null)
	{
		require 'ForgottenPassword_view.php';
	}
	function executeValideForgottenYourPassword($values = null)
	{
		$securimage = new Securimage();
		$captcha = $values['ct_captcha'];
		if ($securimage->check($captcha) == false) {
		  $errors['captcha_error'] = 'Incorrect security code entered<br />';
				$values['errors']['captcha'] = "Imagen incorrecta";
				executeForgottenYourPassword($values);die;
		}
		$errors = validaForgottenPassword($values);
		$valido = true;
		if(count($errors)>0)
		{
			$values['errors'] = $errors;
			$valido = false;
			executeForgottenYourPassword($values);die;
		}
		else
		{

			$document = $values['document'];
			$nationality = $values['nationality'];
			$InitialFirstName = $values["InitialFirstName"];
			$InitialFirstLastName = $values["InitialFirstLastName"];
			$mail = $values["mail"];
			$user = validateForgottenPassword($document,$nationality,$InitialFirstName,$InitialFirstLastName,$mail);
			if(empty($user) or count($user)==0)
			{
				
				$values = null;
				$values["errors"]["datosIncorrectos"] = "Sus datos no coinciden";
				executeForgottenYourPassword($values);die;
			}
			if(count($user)> 0):
				foreach($user as $id=> $valor)
				{

						$idUser = $valor["id_user"];

						$mail = $valor["mail"];
						forwardPassword($idUser,$mail);
						echo $idUser;
				}
			endif;			
		}	
	}
	function forwardPassword($idUser,$mail)
	{
		$password = substr( md5(microtime()), 1, 8);
		$values = array("id_user" => $idUser,"password" => hash('sha256', $password));
		updateUser($values);
		$message = "Clave: ".$password;
		$values['password'] = $password;
		$values['id_users'] = $values['id_user'];
		$Grúas = new Aws();
		$dateGrueros = array("idGrua" => $idUser,"Clave" => $password);
		$Grúas->updateGrueros($dateGrueros);
		$Mail = new Mail();
		$Mail ->mail4($values);
		//$Mail->send(array($mail), array(mail_from),"Asunto",$message);
		$values = null;
		$values['message'] = "Se ha enviado la clave a su correo electrónico.";
		$values["action"] = "login";
		 require 'login.php';
		
	}
							