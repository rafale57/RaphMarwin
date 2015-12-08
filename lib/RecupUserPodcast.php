<?php

	class RecupUserPodcast {
		
		
		 private $db;
		
  
			public function __construct(MySQLi $db){
				
				$this->db = $db;
		
				
					}
  
		
		
		
		public  function  RecupUtilisateur($object) {
				//session_start();
			$pseudo='pseudo';
			$object=strtolower($object);
		$sess= new Session();
		
			$user_session=$sess->__get($pseudo);
			echo 'type :'.gettype($user_session).'<br/>';
			$yy=var_dump($user_session);
		
			if( $object == "nom") {
				
				 try{
					$req=$this->db->query("SELECT u_nom as lenom FROM utilisateur WHERE pseudo='$user_session' ");
				$req=$req->fetch_object()->lenom;
				
				
				
				echo $req;
				
					} catch(Exception $e){
						echo "Une erreur est survenue !".$e->getMessage();
		  
	  }
				
			}else if (strtolower($object) == "prenom" || strtolower($object) == "prénom"  ) {
				
				
				
				 try{
					$req=$this->db->query("SELECT u_prenom as leprenom FROM utilisateur WHERE pseudo='$user_session' ");
					$req=$req->fetch_object()->leprenom;
					} catch(Exception $e){
						echo "Une erreur est survenue !".$e->getMessage();
		  
	  }
				
				
			} 
			return $req;
			
			
		}
		
		
		
		
		public  function  RecupPodcast($object) {
				//session_start();
			$pseudo='pseudo';
			$object=strtolower($object);
		$sess= new Session();
		
			$user_session=$sess->__get($pseudo);
			echo 'type :'.gettype($user_session).'<br/>';
			$yy=var_dump($user_session);
		
			if( $object == "url") {
				
				 try{
					$req=$this->db->query("SELECT url as lurl FROM podcast p, preference p, utilisateur u WHERE pseudo='$user_session' AND u.id_util=pref.id_util AND pref.id_genre=p.id_genre ");
				$req=$req->fetch_object()->lurl;
				
				
				
				echo $req;
				
					} catch(Exception $e){
						echo "Une erreur est survenue !".$e->getMessage();
		  
	  }
				
			}else if (strtolower($object) == "prenom" || strtolower($object) == "prénom"  ) {
				
				
				
				 try{
					$req=$this->db->query("SELECT u_prenom as leprenom FROM utilisateur WHERE pseudo='$user_session' ");
					$req=$req->fetch_object()->leprenom;
					} catch(Exception $e){
						echo "Une erreur est survenue !".$e->getMessage();
		  
	  }
				
				
			} 
			return $req;
			
			
		}
		
		
		
		
	}
	
	
	?>