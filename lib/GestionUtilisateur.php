<?php
abstract class GestionUtilisateur
{
 
  abstract public function add(Utilisateur $utilisateur);
 
  abstract public function count();
  

  abstract public function delete($id);
  
  
  abstract public function getList($debut = -1, $limite = -1);
  
  abstract public function getById($id);
  


  abstract public function update(Utilisateur $util);
}