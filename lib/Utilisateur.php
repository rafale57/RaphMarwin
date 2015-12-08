<?php

class Utilisateur
{
  private $erreurs = array(),
            $id,
            $pseudo,
            $mdp,
            $mail,
            $u_nom,
            $u_prenom,
			$dateAjout,
            $dateModif,
			$cell;
  
  /**
   * Constantes relatives aux erreurs possibles rencontrées lors de l'exécution de la méthode.
   */
  const PSEUDO_INVALIDE = 1;
  const MOTDEPASSE_INVALIDE = 2;
  const MAIL_INVALIDE = 3; 
  const U_NOM_INVALIDE = 4; 
  const U_PRENOM_INVALIDE = 5;
  
  
  /**
   * Constructeur de la classe qui assigne les données spécifiées en paramètre aux attributs correspondants.
   * @param $valeurs array Les valeurs à assigner
   * @return void
   */
  public function __construct($pseudo,$mdp,$mail,$u_nom,$u_prenom,$cell)
  {
   
      $this->pseudo=$pseudo;
	   $this->mdp=$mdp;
	    $this->mail=$mail;
		$this->u_nom=$u_nom;
		$this->u_prenom=$u_prenom;
		$this->cell=$cell;
	   
    
  }
  
  /**
   * Méthode assignant les valeurs spécifiées aux attributs correspondant.
   * @param $donnees array Les données à assigner
   * @return void
   */
  
  
  /**
   * Méthode permettant de savoir si l'utilisateur est nouveau (pas forcement utile).
   * @return bool
   */
  public function isNew()
  {
    return empty($this->id);
  }
  
  /**
   * Méthode permettant de savoir si l'utilisateur est valide.
   * @return bool
   */
  public function isValid()
  {
    return !(empty($this->pseudo) || empty($this->mdp) || empty($this->mail)|| empty($this->u_nom) || empty($this->u_prenom));
  }
  
  
  // SETTERS //
  
  public function setId($id)
  {
    $this->id = (int) $id;
  }
  
  public function setPseudo($pseudo)
  {
    if (!is_string($pseudo) || empty($pseudo))
    {
      $this->erreurs[] = self::PSEUDO_INVALIDE;
    }
    else
    {
      $this->pseudo = $pseudo;
    }
  }
  
  public function setMdp($mdp)
  {
    if (!is_string($mdp) || empty($mdp))
    {
      $this->erreurs[] = self::MOTDEPASSE_INVALIDE;
    }
    else
    {
      $this->mdp = $mdp;
    }
  }
  
 
  
    public function setMail($mail)
  {
    if (!is_string($mail) || empty($mail))
    {
      $this->erreurs[] = self::MAIL_INVALIDE;
    }
    else
    {
      $this->mail = $mail;
    }
  }
  
  
    public function setU_nom($u_nom)
  {
    if (!is_string($u_nom) || empty($u_nom))
    {
      $this->erreurs[] = self::U_NOM_INVALIDE;
    }
    else
    {
      $this->u_nom = $u_nom;
    }
  }
  
  
    public function setU_prenom($u_prenom)
  {
    if (!is_string($u_prenom) || empty($u_prenom))
    {
      $this->erreurs[] = self::U_PRENOM_INVALIDE;
    }
    else
    {
      $this->u_prenom = $u_prenom;
    }
  }
  
  public function setDateAjout(DateTime $dateAjout)
  {
    $this->dateAjout = $dateAjout;
  }
  
  public function setDateModif(DateTime $dateModif)
  {
    $this->dateModif = $dateModif;
  }
 
  
  // GETTERS //
  
  public function getErreurs()
  {
    return $this->erreurs;
  }
  
  public function getId()
  {
    return $this->id;
  }
  
  public function getPseudo()
  {
    return $this->pseudo;
  }
  
  public function getMdp()
  {
    return $this->mdp;
  }
  
  public function getMail()
  {
    return $this->mail;
  }
  
  public function getU_nom()
  {
    return $this->u_nom;
  }
  
  public function getU_prenom()
  {
    return $this->u_prenom;
  }
  
  
  public function getDateAjout()
  {
    return $this->dateAjout;
  }
  
  public function getDateModif()
  {
    return $this->dateModif;
  }
  
  public function getU_cell() {
	  
	  return $this->cell;
	  
  }
  
}