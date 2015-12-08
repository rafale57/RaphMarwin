<?php


	
	class InfosInscription {
		
	
	function ConfirmationInscription($db,$postpseudo,$postemail) {
	//on Génére aléatoirement une clé
$cle = md5(microtime(TRUE)*100000);
 
 
// Insertion de la clé dans la base de données (à adapter en INSERT si besoin)
$stmt = $db->query("UPDATE utilisateur SET cle='$cle' WHERE pseudo like '$postpseudo' ");
//$stmt->execute();


 
// Préparation du mail contenant le lien d'activation
$destinataire = $postemail;
$sujet = "Activer votre compte" ;
$entete = "From: Mail@PodcastToi.com" ;
 
// Le lien d'activation est composé du login(log) et de la clé(cle)
$message = 'Bienvenue sur PodcastToi,
 
Pour activer votre compte Podcast, veuillez cliquer sur le lien ci dessous
ou copier/coller dans votre navigateur internet.
 
http://localhost/Podcast//validation.php?pseudo='.urlencode($postpseudo).'&cle='.urlencode($cle).'
 
 
---------------
Ceci est un mail automatique, Merci de ne pas y répondre.';
 
 
$q=mail($destinataire, $sujet, $message, $entete) ; // Envoi du mail


if ($q) {
    echo ("Message envoyé !");
} else {
    echo ("Message non envoyé...");
}

	
}





		
		
		
		
 public function creecell(){
                $char = 'abcdefghijklmnopqrstuvwABCDEFGHIJKLMNOPQRSTUVWXYZxyz01456789,;:!?.$/*-+&@_+/*&?$-!';
                $cell = str_shuffle($char);
               
            return $cell;       
    }
	
	
	
   
   public function crypt($mdp){
   
 $cell = $this->creecell(); 
  $mdp1 =sha1($cell.$mdp.$cell) ; 
   //$mdp1 =sha1($mdp) ; 
   
   
  $array['mdp']=$mdp1;
     $array['cell']=$cell;
	  
   return  $array;
       }



function verifCompteValide($pseudo) {
	
	
	$login = $_POST[$pseudo];
 
// Récupération de la valeur du champ actif pour le login $login
$stmt = $dbh->prepare("SELECT actif FROM membres WHERE login like :login ");
if($stmt->execute(array(':login' => $login))  && $row = $stmt->fetch())
  {
   	$actif = $row['actif']; // $actif contiendra alors 0 ou 1
  }
 
 
// tester actif et en fonction de ca on laisse passer ou pas
// autoriser ou non le membre à se connecter
 
if($actif == '1') // Si $actif est égal à 1, on autorise la connexion
  {
   //...
   echo 'connexion OK'; // On autorise la connexion (echo ok pour l'instant)
   //...
  }
else // Sinon la connexion est refusé...
  {
   //...
  echo ' vous ne pouvez pas rentrer, pas de compte activé';// On refuse la connexion et/ou on previent que ce compte n'est pas activé
   //...
  }
 
 
	
// Fermer la connexion	

	
	
	
}

}

?>



