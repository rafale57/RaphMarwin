<?php
class GestionUtilisateurMYSQLI extends GestionUtilisateur
{
  /**
   * Attribut contenant l'instance représentant la BDD.
   * @type MySQLi
   */
  private $db;
  
  /**
   * Constructeur étant chargé d'enregistrer l'instance de MySQLi dans l'attribut $db.
   * @param $db MySQLi Le DAO
   * @return void
   */
  public function __construct(MySQLi $db)
  {
    $this->db = $db;
  }
  

 
  public function add(Utilisateur $util)
  {
	  
    $requete = $this->db->prepare('INSERT INTO utilisateur(pseudo,mdp,mail,u_nom,u_prenom, dateAjout, u_cell) VALUES (?, ?, ?, ?, ?, NOW(),? )');
   
    $requete->bind_param('ssssss', $util->getPseudo(), $util->getMdp(), $util->getMail(),  $util->getU_nom(),  $util->getU_prenom(), $util->getU_cell() );
    $requete->execute();



  }
  
  /**
   * @see GestionUtilisateur::count()
   */
  public function count() // peut etre ca peut servir lol
  {
    return $this->db->query('SELECT id FROM Utilisateur')->num_rows;
  }
  
  /**
   * @see GestionUtilisateur::delete()
   */
  public function delete($id)
  {
    $id = (int) $id;
    
    $requete = $this->db->prepare('DELETE FROM Utilisateur WHERE id = ?');
    
    $requete->bind_param('i',$id);
    
    $requete->execute();
  }
  
  /**
   * @see GestionUtilisateur::getList()
   */
  public function getList($debut = -1, $limite = -1)
  {
    $listeUtilisateurs = [];
    
    $sql = 'SELECT * FROM Utilisateur ORDER BY id DESC';
    
    // On vérifie l'intégrité des paramètres fournis.
    if ($debut != -1 || $limite != -1)
    {
      $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
    }
    
    $requete = $this->db->query($sql);
    
    while ($util = $requete->fetch_object('Utilisateur'))
    {
      $util->setDateAjout(new DateTime($util->getDateAjout()));
      $util->setDateModif(new DateTime($util->getDateModif()));

      $listeUtilisateurs[] = $util;
    }
    
    return $listeUtilisateurs;
  }
  

  public function getById($id)
  {
    $id = (int) $id;
    
    $requete = $this->db->prepare('SELECT * FROM Utilisateur WHERE id = ?');
    $requete->bind_param($id);
    $requete->execute();
    
    $requete->bind_result($id, $pseudo, $mdp, $mail, $u_nom, $u_prenom,$dateAjout,$dateModif);
    
    $requete->fetch();
    
    return new Utilisateur([
      'id' => $id,
      'pseudo' => $pseudo,
      'mdp' => $mdp,
      'mail' => $mail,
	  'u_nom' => $u_nom,
	  'u_prenom' => $u_prenom,
      'dateAjout' => new DateTime($dateAjout),
      'dateModif' => new DateTime($dateModif)
    ]);
  }
  
  /**
   * @see NewsManager::update()
   */
  public  function update(Utilisateur $util)
  {
    $requete = $this->db->prepare('UPDATE Utilisateur SET pseudo = ?, mdp = ?, mail = ?, u_nom=?, u_prenom=?,  dateModif = NOW() WHERE id = ?');
    
    $requete->bind_param( $util->getPseudo(), $util->getMdp(), $util->getMail(),$util->getU_nom(),$util->getU_prenom(), $util->getId());
    
    $requete->execute();
	
	
  }
  

   public function preference($preference) {
	   
	   $pref=$this->db->prepare("SELECT id_util, lib_genre FROM utilisateur, preference where utilisateur.id_util=preference.id_util AND preference.id_genre=genre.id_genre ");
	   
	   
   }
  
public function connexion($pseudo, $motdepasse)
  {
	  try{
  $cell=$this->db->query("SELECT u_cell as uncell FROM utilisateur WHERE pseudo='$pseudo' ");
  
	  } catch(Exception $e){
		  echo "Une erreur est survenue !".$e->getMessage();
		  
	  }
	  
	 
  
  $cell=$cell->fetch_object()->uncell;
  $mdp=sha1($cell.$motdepasse.$cell);

  
  //$mdp=sha1($motdepasse);

  
if($result = $this->db->query("SELECT pseudo, mdp FROM utilisateur WHERE pseudo='$pseudo' AND mdp='$mdp'")) {
       //var_dump($result);
         $nblignes = mysqli_num_rows($result);
 
         if($nblignes == 1) 
                 return true;
         else 
                 return false;
}
          
}

public function arraypref($pseudo) {

    $genre_pref=$this->recupPrefGenre($pseudo);
	    $tabpref[] = $genre_pref;
   // var_dump($tabpref);

    }


public function recupPrefGenre($pseudo) { 

$sizetable = $this->db->query("SELECT id_pod FROM preference, utilisateur, podcast WHERE pseudo='$pseudo' AND utilisateur.id_util=preference.id_util AND preference.id_genre=podcast.id_genre  ");

  //$nblignes = mysqli_num_rows($sizetable);

   return $sizetable;


}

}