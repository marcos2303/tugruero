<?php include('../../view_header_app.php')?>
<?php include('../menu.php')?>
<div class="container">
	<h1 class="text-center"><label class="label label-default">Datos personales</label></h1>
	<form class="form-horizontal" action="index.php" method="POST" enctype="multipart/form-data">
		<input type="hidden" name='action' value='<?php if(isset($values['action']))echo $values['action'];?>'>
		<input readonly="" type="hidden" class="form-control input-sm" id="" placeholder="" name="id_users" value="<?php if(isset($_SESSION['id_user'])) echo $_SESSION['id_user']?>">
		<input readonly="" type="hidden" class="form-control input-sm" id="" placeholder="" name="login" value="<?php if(isset($values['login'])) echo $values['login']?>">
	<div class="form-group">
		<div class="col-sm-6">
		<label for="">Cédula</label>	
			<div class="input-group">
				<?php echo $values['nationality']?> - <?php echo $values['document']?>
			</div>
		</div>
		<div class="col-sm-6">
		<label for="">Foto</label>	
			<div class="input-group">
				<?php if(isset($values['image']) and $values['image']!=''):?>
				<img src="<?php echo full_url?>/web/files/operators/<?php echo $values['image'];?>" height="80">
				<?php endif;?>
				<?php if(!isset($values['image']) or $values['image']==''):?>
				<label class="alert alert-danger">No tiene foto</label>
				<?php endif;?>
			</div>
		</div>		
	</div>
	<div class="form-group">
		<div class="col-sm-12">
		<label for="">Usuario</label>	
			<div class="input-group">
				<?php echo $values['login'];?>
			</div>
		</div>
		
	</div>
	<div class="form-group">
		<div class="col-sm-6">
		<label for="">Primer nombre</label>	
			<div class="input-group">
				<input type="text" autocomplete="off" class="form-control input-sm" id="" placeholder="" name="first_name" required maxlength="50" value="<?php if(isset($values['first_name'])) echo $values['first_name']?>">
			<span class="input-group-addon" id="basic-addon2">(*)</span>
			</div>
		</div>
		<div class="col-sm-6">
		<label for="">Segundo nombre</label>	
			<div class="input-group">
				<input type="text" class="form-control input-sm" id="" placeholder="" name="second_name"  maxlength="50" value="<?php if(isset($values['second_name'])) echo $values['second_name']?>">

			</div>
		</div>
	</div>	
	<div class="form-group">
		<div class="col-sm-6">
		<label for="">Primer apellido</label>	
			<div class="input-group">
				<input type="text" autocomplete="off" class="form-control input-sm" id="" placeholder="" name="first_last_name" maxlength="50" required  value="<?php if(isset($values['first_last_name'])) echo $values['first_last_name']?>">
			<span class="input-group-addon" id="basic-addon2">(*)</span>
			</div>
		</div>
		<div class="col-sm-6">
		<label for="">Segundo apellido</label>	
			<div class="input-group">
				<input type="text" autocomplete="off" class="form-control input-sm" id="" placeholder="" name="second_last_name"  maxlength="50"  value="<?php if(isset($values['second_last_name'])) echo $values['second_last_name']?>">
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-6">
		<label for="">Celular principal</label>	
			<div class="input-group">
				<input type="text" autocomplete="off" class="form-control input-sm" id="" placeholder="" name="phone" maxlength="11" required  value="<?php if(isset($values['phone'])) echo $values['phone']?>">
			<span class="input-group-addon" id="basic-addon2">(*)</span>
			</div>
		</div>
		<div class="col-sm-6">
		<label for="">Celular alternativo</label>	
			<div class="input-group">
				<input type="text" autocomplete="off" class="form-control input-sm" id="" placeholder="" name="phone1"  maxlength="11" value="<?php if(isset($values['phone1'])) echo $values['phone1']?>">
			
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-12">
		<label for="">Foto</label>	
			<div class="input-group">
				<input type="file" class="form-control input-sm" id="" placeholder="" name="image" value="" accept="image/x-png, image/gif, image/jpeg">
			<span class="input-group-addon" id="basic-addon2">(*)</span>
			</div>
		</div>
	</div>
	<a class="btn btn-default"  href="<?php echo full_url."/ap/index.php?action=bienvenida"?>"><i class="fa fa-arrow-left  fa-pull-left fa-border"></i> Cancelar</a>	
	 <button type="submit" class="btn btn-default"><i class="fa fa-save fa-pull-left fa-border"></i> Guardar</button>
    <?php if(isset($values['msg']) and $values['msg']!=''):?>
        <div class="alert alert-success" role="alert"><?php echo $values['msg'];?></div>
    <?php endif;?>
	</form>
		                    <div class="form-top-right">
											<h6 class="text-danger">(*) Campos obligatorios.</h6>
							</div>
</div>
<?php include('../../view_footer.php')?>