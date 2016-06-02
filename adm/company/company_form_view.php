<?php include('../../view_header_app.php')?>
<?php include('../menu.php')?>
<div class="container">
	<h1 class="text-center big_title">Masters</h1>
	<form class="" action="index.php" method="POST">
		<input type="hidden" name='action' value='<?php if(isset($values['action']))echo $values['action'];?>'>
	  <div class="form-group">
		<label for="">Id</label>
		<input autocomplete="off" readonly="readonly" type="text" class="form-control input-sm" id="" placeholder="" name="id" value="<?php if(isset($values['id'])) echo $values['id']?>">
	  </div>
	  <div class="form-group">
		<label for="">Rif</label>
		<input autocomplete="off" type="text" class="form-control input-sm" id="" placeholder="" name="rif" value="<?php if(isset($values['rif'])) echo $values['rif']?>">
	  </div>
	  <div class="form-group">
		<label for="">Razón social</label>
		<input autocomplete="off" type="text" class="form-control input-sm" id="" placeholder="" name="razon_social" value="<?php if(isset($values['razon_social'])) echo $values['razon_social']?>">
	  </div>
	  <div class="form-group">
		<label for="">Responsable</label>
		<input autocomplete="off" type="text" class="form-control input-sm" id="" placeholder="" name="responsible_name" value="<?php if(isset($values['responsible_name'])) echo $values['responsible_name']?>">
	  </div>
	  <div class="form-group">
		<label for="">Cédula</label>
		<input autocomplete="off" type="text" class="form-control input-sm" id="" placeholder="" name="responsible_cedula" value="<?php if(isset($values['responsible_cedula'])) echo $values['responsible_cedula']?>">
	  </div>
	  <div class="form-group">
		<label for="">Estado</label>
												<select name="zone_work" class="form-control">
													<option value="">Seleccione</option>
													<option value="AMAZONAS" <?php if(isset($values['zone_work']) and $values['zone_work']=='AMAZONAS') echo "selected='selected'";?>>AMAZONAS</option>
													<option value="ANZOATEGUI" <?php if(isset($values['zone_work']) and $values['zone_work']=='ANZOATEGUI') echo "selected='selected'";?>>ANZOATEGUI</option>
													<option value="APURE" <?php if(isset($values['zone_work']) and $values['zone_work']=='APURE') echo "selected='selected'";?>>APURE</option>
													<option value="ARAGUA" <?php if(isset($values['zone_work']) and $values['zone_work']=='ARAGUA') echo "selected='selected'";?>>ARAGUA</option>
													<option value="BARINAS" <?php if(isset($values['zone_work']) and $values['zone_work']=='BARINAS') echo "selected='selected'";?>>BARINAS</option>
													<option value="BOLIVAR" <?php if(isset($values['zone_work']) and $values['zone_work']=='BOLIVAR') echo "selected='selected'";?>>BOLIVAR</option>
													<option value="CARABOBO" <?php if(isset($values['zone_work']) and $values['zone_work']=='CARABOBO') echo "selected='selected'";?>>CARABOBO</option>
													<option value="COJEDES" <?php if(isset($values['zone_work']) and $values['zone_work']=='COJEDES') echo "selected='selected'";?>>COJEDES</option>
													<option value="DELTA AMACURO" <?php if(isset($values['zone_work']) and $values['zone_work']=='DELTA AMACURO') echo "selected='selected'";?>>DELTA AMACURO</option>
													<option value="DEPENDENCIAS FEDERALES" <?php if(isset($values['zone_work']) and $values['zone_work']=='DEPENDENCIAS FEDERALES') echo "selected='selected'";?>>DEPENDENCIAS FEDERALES</option>
													<option value="DISTRITO CAPITAL" <?php if(isset($values['zone_work']) and $values['zone_work']=='DISTRITO CAPITAL') echo "selected='selected'";?>>DISTRITO CAPITAL</option>
													<option value="FALCON" <?php if(isset($values['zone_work']) and $values['zone_work']=='FALCON') echo "selected='selected'";?>>FALCON</option>
													<option value="GUARICO" <?php if(isset($values['zone_work']) and $values['zone_work']=='GUARICO') echo "selected='selected'";?>>GUARICO</option>
													<option value="LARA" <?php if(isset($values['zone_work']) and $values['zone_work']=='LARA') echo "selected='selected'";?>>LARA</option>
													<option value="MERIDA" <?php if(isset($values['zone_work']) and $values['zone_work']=='MERIDA') echo "selected='selected'";?>>MERIDA</option>
													<option value="MIRANDA" <?php if(isset($values['zone_work']) and $values['zone_work']=='MIRANDA') echo "selected='selected'";?>>MIRANDA</option>
													<option value="MONAGAS" <?php if(isset($values['zone_work']) and $values['zone_work']=='MONAGAS') echo "selected='selected'";?>>MONAGAS</option>
													<option value="NUEVA ESPARTA" <?php if(isset($values['zone_work']) and $values['zone_work']=='NUEVA ESPARTA') echo "selected='selected'";?>>NUEVA ESPARTA</option>
													<option value="PORTUGUESA" <?php if(isset($values['zone_work']) and $values['zone_work']=='PORTUGUESA') echo "selected='selected'";?>>PORTUGUESA</option>
													<option value="SUCRE" <?php if(isset($values['zone_work']) and $values['zone_work']=='SUCRE') echo "selected='selected'";?>>SUCRE</option>
													<option value="TACHIRA" <?php if(isset($values['zone_work']) and $values['zone_work']=='TACHIRA') echo "selected='selected'";?>>TACHIRA</option>
													<option value="TRUJILLO" <?php if(isset($values['zone_work']) and $values['zone_work']=='TRUJILLO') echo "selected='selected'";?>>TRUJILLO</option>
													<option value="VARGAS" <?php if(isset($values['zone_work']) and $values['zone_work']=='VARGAS') echo "selected='selected'";?>>VARGAS</option>
													<option value="YARACUY" <?php if(isset($values['zone_work']) and $values['zone_work']=='YARACUY') echo "selected='selected'";?>>YARACUY</option>
													<option value="ZULIA" <?php if(isset($values['zone_work']) and $values['zone_work']=='ZULIA') echo "selected='selected'";?>>ZULIA</option>
												</select>
	  </div>

	  <div class="form-group">
		<label for="">Ubicación de empresa o firma personal</label>
		<input autocomplete="off" type="text" class="form-control input-sm" id="" placeholder="" name="location" value="<?php if(isset($values['location'])) echo $values['location']?>">
	  </div>
		<div class="form-group">
			<label>¿Pertenece al Club Grúas Venezuela?</label>
			<label class="radio-inline"><input type="radio" <?php if(isset($values['club_gruas']) && $values['club_gruas'] == "1") echo "checked='checked'";?> value="1"  name="club_gruas" checked onchange="">Si</label>
			<label class="radio-inline"><input type="radio" <?php if(isset($values['club_gruas']) && $values['club_gruas'] == "0") echo "checked='checked'";?> value="0" name="club_gruas" onchange="">No</label>
		</div>		
	  <div class="form-group">
		<label for="">Número de socio en el Club de Grúas Venezuela</label>
		<input autocomplete="off" type="text" class="form-control input-sm" id="" placeholder="" name="num_socio" value="<?php if(isset($values['num_socio'])) echo $values['num_socio']?>">
	  </div>	
 	  <div class="form-group">
		<label for="">Banco</label>
                <select name="id_bank">
                    <option value="">Seleccione...</option>
                    <?php if(isset($bank_list) and count($bank_list)>0):?>
                    <?php foreach ($bank_list as $bank):?>
                        <option value="<?php echo $bank['id'];?>" <?php if($bank['id']== $values['id_bank'])echo "selected='selected'" ?>><?php echo $bank['name'];?></option>
                    <?php endforeach;?>
                    <?php endif;?>
                </select>
	  </div>	
	  <div class="form-group">
		<label  for="tipo_cuenta">Tipo de cuenta</label>
			<select  name="tipo_cuenta" class="form-control" required>
				<option value="Personal" <?php if(isset($values['tipo_cuenta']) && $values['tipo_cuenta'] == "Personal") echo "selected";?>>Personal</option>
				<option value="Empresa" <?php if(isset($values['tipo_cuenta']) && $values['tipo_cuenta'] == "Empresa") echo "selected";?>>Empresa</option>
			</select>
		<label for="">Cuenta Nº</label>
		<input autocomplete="off" type="text" class="form-control input-sm" id="" placeholder="" name="num_cuenta" value="<?php if(isset($values['num_cuenta'])) echo $values['num_cuenta']?>">
	  </div>
		

	  <div class="form-group">
		<label for="">Archivos</label>
                    <?php if(isset($company_files_list) and count($company_files_list)>0):?>
                    <?php 
					$array_nombre_archivos = array();
					$array_nombre_archivos[1] = "Cédula";  
					$array_nombre_archivos[2] = "RIF jurídico o natural";
					$array_nombre_archivos[3] = "Licencia de conducir";
					$array_nombre_archivos[4] = "Carnet de circulación";
					?>
					<?php $i=1;foreach ($company_files_list as $files):?>
                        <div class="alert alert-success" role="alert">
							
                            <label><?php echo $array_nombre_archivos[$i]?></label>
							<br>
							<a target="_blank" href="<?php echo full_url?>/web/files/<?php echo $files['name_file'];?>"><i class="fa fa-eye fa-pull-left fa-border"></i> <?php echo $files['name_file'];?></a>
                        </div>
                    <?php $i++;endforeach;?>
                    <?php endif;?>
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
	  <div class="form-group">
		<label autocomplete="off" for="">Fecha creado</label>
		<input autocomplete="off"  type="text" readonly="readonly" class="form-control input-sm" id="" placeholder="" name="date_created" value="<?php if(isset($values['date_created'])) echo $values['date_created']?>">
	  </div>
	  <div class="form-group">
		<label for="">Fecha modificado</label>
		<input autocomplete="off" readonly="readonly" type="text" class="form-control input-sm" id="" placeholder="" name="date_updated" value="<?php if(isset($values['date_updated'])) echo $values['date_updated']?>">
	  </div>

		<a class="btn btn-default"  href="<?php echo full_url."/adm/company/index.php"?>"><i class="fa fa-arrow-left  fa-pull-left fa-border"></i> Regresar</a>
		<button type="submit" class="btn btn-default"><i class="fa fa-save fa-pull-left fa-border"></i> Guardar</button>
    <?php if(isset($values['msg']) and $values['msg']!=''):?>
        <script>
			$(document).ready(function(){
			$('.modal-body').html('<div class="alert alert-success" role="alert"><?php echo $values['msg'];?></div>');
			$('#myModal').modal('show');	
			});

		
		</script>
    <?php endif;?>
	</form>
</div>
<?php include('../../view_footer.php')?>