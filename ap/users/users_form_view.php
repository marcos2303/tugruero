<?php include('../../view_header_app.php')?>
<?php include('../menu.php')?>
<div class="container">
	<h1 class="text-center"><label class="label label-default">Operador</label></h1>
	<form class="" enctype="multipart/form-data" action="index.php" method="POST">
		<input type="hidden" name='action' value='<?php if(isset($values['action']))echo $values['action'];?>'>
		<div class="form-group" style="display:none;">
		<label for="">Id.Usuario</label>
		<input autocomplete="off" readonly="readonly" type="text" class="form-control input-sm" id="" placeholder="" name="id_user" value="<?php if(isset($values['id_user'])) echo $values['id_user']?>">
	  </div>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
			<label for="">Placa de grúa</label>
				<div class="input-group">
					<select id="id_hoist" name="id_hoist" class="form-control input-sm" required>
					<?php foreach($values['hoist'] as $operador) 
					{
						if((isset($values['id_hoist']) && $values['id_hoist'] == $operador['id_hoist']) || !Empty($operador['id_user']))
						{
							echo '<option value="'.$operador["id"].'">'.$operador['registration_plate'].'</option>';
						}
						else
						{
							echo '<option value="'.$operador["id"].'">'.$operador['registration_plate'].'</option>';
							echo '<option value="">Seleccione..</option>';
						}
					}
					?>
					</select>
					<span class="input-group-addon" id="basic-addon2">(*)</span>
				</div>
			</div>
		</div>
	</div>
	<div class="row" <?php if($values['action'] <> "add") echo "style='display:none;'"?>>
		<div class="col-md-6">
	  <div class="form-group">
		  <label for="">Primer Nombre</label>
			<div class="input-group">
				<input type="text" name="first_name" id="registrarse-razon-social"  class="form-last-name form-control" id="form-last-name" required  oninvalid="setCustomValidity('Debe colocar su Primer Nombre para poder registrarse.')" 
oninput="setCustomValidity('')" value="<?php if(isset($values['first_name'])) echo $values['first_name']?>"/>
				 <span class="input-group-addon" id="basic-addon2">(*)</span>
			</div>
		</div>
		</div>
			<div class="col-md-6">
				<div class="form-group">
				<label for="">Segundo Nombre</label>
				<input autocomplete="off" type="text" class="form-control input-sm" id="" placeholder="" name="second_name" value="<?php if(isset($values['second_name'])) echo $values['second_name']?>" >
			  </div>
			</div>
		</div>
		<div class="row" <?php if($values['action'] <> "add") echo "style='display:none;'"?>>
			<div class="col-md-6">
				<div class="form-group">
					<label for="">Primer Apellido</label>
					<div class="input-group">
					<input type="text" name="first_last_name" id="first_last_name"  class="form-last-name form-control" id="form-last-name" required  oninvalid="setCustomValidity('Debe colocar su Primer Apellido para poder registrarse.')" 
					oninput="setCustomValidity('')" value="<?php if(isset($values['first_last_name'])) echo $values['first_last_name']?>"/>
					<span class="input-group-addon" id="basic-addon2">(*)</span>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				 <div class="form-group">
					<label for="">Segundo Apellido</label>
					<input autocomplete="off" type="text" class="form-control input-sm" id="" placeholder="" name="second_last_name" value="<?php if(isset($values['second_last_name'])) echo $values['second_last_name']?>">
				  </div>
			</div>
		</div>
		<div class="row" <?php if($values['action'] <> "add") echo "style='display:none;'"?>>
			<div class="col-md-6">
				<div class="form-group">
					<label for="">Cedula</label>
					<div class="input-group">
						<span class="input-group-btn">
						<select name="nationality" class="btn btn-secondary" required>
						<option value="V" selected>V</option>
						<option value="E">E</option>
						</select>
						</span>
						<input type="text" class="form-control" name="document" value="<?php if(isset($values['document'])) echo $values['document']?>" required  oninvalid="setCustomValidity('Debe colocar su Cédula para poder registrarse.')" 
						oninput="setCustomValidity('')" />
						</span>
						<span class="input-group-addon" id="basic-addon2">(*)</span>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="radio-inline"><input type="radio" value="M" name="gender" <?php if(isset($values['gender']) and $values['gender'] =='M' ) echo "checked=checked"?> checked>Masculino</label>
					<label class="radio-inline"><input type="radio" value="F" name="gender" <?php if(isset($values['gender']) and $values['gender'] =='F' ) echo "checked=checked"?>>Femenino</label>
				</div>
			</div>
		</div>
		<div class="row" <?php if($values['action'] <> "add") echo "style='display:none;'"?>>
			<div class="col-md-6">
				<div class="form-group">
					<label for="">Correo Electrónico</label>
					<div class="input-group">
					<input type="text" name="mail" id="first_last_name"  class="form-last-name form-control" id="form-last-name" required  oninvalid="setCustomValidity('Debe colocar su Correo Electrónico para poder registrarse.')" 
					oninput="setCustomValidity('')" value="<?php if(isset($values['mail'])) echo $values['mail']?>"/>
					<span class="input-group-addon" id="basic-addon2">(*)</span>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="">Teléfono</label>
					<div class="input-group">
					<input type="text" name="phone" id=""  class="form-last-name form-control" id="form-last-name" required  oninvalid="setCustomValidity('Debe colocar su Teléfono para poder registrarse.')" 
					oninput="setCustomValidity('')" value="<?php if(isset($values['phone'])) echo $values['phone']?>"/>
					<span class="input-group-addon" id="basic-addon2">(*)</span>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="">Login</label>
					<input autocomplete="off" type="text" readonly="readonly" class="form-control input-sm" id="" placeholder="" name="login" value="<?php if(isset($values['login'])) echo $values['login']?>">
				</div>
			</div>
			<div class="col-md-6">
				<?php if($values['action'] == 'add'):?>
				 <div class="form-group">
					 <label for="">Password</label>
					 <div class="input-group">
						<input autocomplete="off" type="password" id="" class="form-control input-sm" name="password" value="" 
							   required="" oninvalid="setCustomValidity('Debe colocar la Clave para poder continuar.')" 
							   oninput="setCustomValidity('')"
						/>
						<span class="input-group-addon" id="basic-addon2">(*)</span>
						
					 </div>
				  </div>
				<?php else:?>
				<div class="form-group">
					 <label for="">Password</label>
						<input autocomplete="off" type="password" id="" class="form-control input-sm" name="password" value="" />
				</div>
				<?php endif;?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				 <div class="form-group">
					<label autocomplete="off" for="">Fecha creado</label>
					<input autocomplete="off"  type="text" readonly="readonly" class="form-control input-sm" id="" placeholder="" name="date_created" value="<?php if(isset($values['date_created'])) echo $values['date_created']?>">
				  </div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
				<label for="">Fecha modificado</label>
				<input autocomplete="off" readonly="readonly" type="text" class="form-control input-sm" id="" placeholder="" name="date_updated" value="<?php if(isset($values['date_updated'])) echo $values['date_updated']?>">
			  </div>
			</div>
		</div>
		<div class="row" <?php if($values['action'] <> "add") echo "style='display:none;'"?>>
			<div class="col-md-6">
				<div class="form-group">
					<h6 class="label label-default" for="file_1">Suba la cédula de identidad.</h6>
					<input type="file" name="file_1" placeholder="Cedula..." class="form-google-plus form-control" <?php if($values['action'] == "add") echo "required";?>>
				</div>
				
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<h6 class="label label-default" for="file_2">Suba el certificado de salud.</h6>
					<input type="file" name="file_2" placeholder="Certificado de salud..." class="form-google-plus form-control" <?php if($values['action'] == "add") echo "required";?>>
				</div>
			</div>
		</div>
		<div class="form-group">
		  <label class="label label-danger">
			<input type="radio" name="status" id="status" value="0" <?php if(isset($values['status']) and $values['status'] =='0' ) echo "checked=checked"?>>
			Desactivar
		  </label>
		</div>
		<div class="form-group">
		  <label class="label label-success">
			<input type="radio" name="status" id="status" value="1" <?php if(isset($values['status']) and $values['status'] =='1' ) echo "checked=checked"?>>
			Activar
		  </label>
		</div>	
	  
		<a class="btn btn-default"  href="<?php echo full_url."/ap/users/index.php"?>"><i class="fa fa-arrow-left  fa-pull-left fa-border"></i> Regresar</a>
		<button type="submit" class="btn btn-default"><i class="fa fa-save fa-pull-left fa-border"></i> Guardar</button>
    <?php if(isset($values['msg']) and $values['msg']!=''):?>
        <div class="alert alert-success" role="alert"><?php echo $values['msg'];?></div>
    <?php endif;?>
	<?php if(isset($values['errors']) and count($values['errors'])>0):?>
		<?php foreach($values['errors'] as $errors):?>
			<div class="alert alert-danger" role="alert"><?php echo $errors;?></div>
		<?php endforeach;?>
	<?php endif;?>
	</form>
	
</div>
<?php include('../../view_footer.php')?>