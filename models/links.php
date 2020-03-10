<?php 

class Pagine{
	
	public static function linkPagineModel($links){


		if(    $links == "login"
            || $links == "utenti"
            || $links == "update"
            || $links == "logout"){

			$module =  "views/modules/".$links.".php";
		
		}

		else if($links == "index"){

			$module =  "views/modules/registration.php";
		}

        else if($links == "ok"){

            $module =  "views/modules/registration.php";
        }

        else if($links == "errore"){

            $module =  "views/modules/login.php";
        }
        
         else if($links == "captchafail"){

            $module =  "views/modules/login.php";
        }

        else if($links == "edit"){

            $module =  "views/modules/utenti.php";
        }

		else{
			$module =  "views/modules/registration.php";
		}

		
		return $module;

	}

}

