<?php
    class Menu 
    {
        
        function getMenu($id_app = null, $id_page,$id_menu_ref = 0)
        {
			
			switch ($_SESSION['id_perms']) {
				case 3:
					$id_app = 4;

					break;
				case 4:
					$id_app = 2;

					break;

				default:
					
					break;
			}
			
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect('tugruero')->menu
                        ->select("*")
                        ->where('id_app=?',$id_app)
                        ->and('id_menuref =?',$id_menu_ref)
						->and('status=?',1)
                        ->order('orders');
			return $q;            
        }
    }