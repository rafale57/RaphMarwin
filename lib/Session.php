<?php
class Session
{
    private $idsession;
    private $session;
 

    public function __construct() { 
  
       // session_start();
        //$this->idsession = session_id();
    }
	
	public function startsession() {
		
		session_start();
		
	}
 
    public function __set($cle,$valeur) { 
  
        $_SESSION[$cle] = $valeur;
    }
 

    public function  __get($cle) { 

        if(isset($_SESSION[$cle])) return $_SESSION[$cle];
        else return false;
    }

    public function __isset($cle) { 
		
		$temp=false;
        if(isset($_SESSION[$cle]))
		$temp=true;

			
        else {
			$temp=false;
			header('location:index33.php');
		} 
		return $temp;
    } 

	
    public function __unset($cle) { 

        if(isset($_SESSION[$cle])) unset($_SESSION[$cle]);
    }  
 

    public function detruire() { 
  
        session_unset();
        session_destroy();
    } 

	

	
	
 
}
 
?>