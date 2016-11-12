<?php
        $Menu = new Menu();
        $items_padres = $Menu ->getMenu(3, 1,0);?>
        <div class=""><!--menu mobile-->
                    <nav class="navbar navbar-default">
                      <div class="container">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Cerrar/Abrir</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                          </button>
                          <a class="navbar-brand" href="<?php echo full_url;?>/adm/index.php?action=bienvenida"> <img src="<?php echo full_url;?>/web/img/logo_blanco.png" class="img-responsive" width="120"></a>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                          
                           <ul class="nav navbar-nav navbar-right">
                            <?php foreach($items_padres as $item):?>
                                <li class="dropdown">
                                  <a class="dropdown-toggle small text-capitalize" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $item['name']?> <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                      <?php $items_hijos = $Menu -> getMenu(3,1,$item['id_menu']);?>
                                      <?php foreach($items_hijos as $item2):?>
                                        <li class=""><a class="small text-capitalize" href="<?php echo full_url.$item2['url']?>" target=""><?php echo $item2['name']?></a></li>
                                      <?php endforeach;?>
                                    </ul>
                                </li>
                            <?php endforeach;?>
                                <li class=""><a class="small text-capitalize" href="<?php echo full_url?>/adm/index.php?action=logout" target=""><i class="fa fa-sign-out"></i> Cerrar sesión</a></li>
                          </ul>
                        </div><!-- /.navbar-collapse -->
                      </div><!-- /.container-fluid -->
                    </nav>          
        </div><!--fin menu mobile-->
        <div class="col-sm-4 col-sm-offset-8">
            <div class="alert alert-dismissible text-right" role="alert" style="background-color: #ccc;">
                        <label>Grueros online</label>
                        <button class="btn btn-success" type="button" onclick="showOnline('SI')">
                          Si <span class="badge">4</span>
                        </button>
                        <button class="btn btn-danger" type="button" onclick="showOnline('NO')">
                          No <span class="badge">4</span>
                        </button>
                        <button type="button" class="btn close" data-dismiss="alert" aria-label="Close"><i class="fa fa-close"></i></button>

            </div>          
        </div>
        <script>
        
        function showOnline(status)
        {

	$('#myModal .modal-title').html('hola');
	$('#myModal .modal-body ').html('Onlines');
	$('#myModal').modal('show');
	}	
        
        
        </script>