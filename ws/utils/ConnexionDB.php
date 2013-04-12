<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ConnexionDB
 *
 * @author nono
 */
class ConnexionDB {
    private
      $Serveur     = '',
      $Bdd         = '',
      $Identifiant = '',
      $Mdp         = '',
      $Lien        = '',  
      $Debogue     = true,  
      $NbRequetes  = 0;
 
    /**
    * Constructeur de la classe
    * Connexion aux serveur de base de donnée et sélection de la base
    *
    * $Serveur     = L'hôte (ordinateur sur lequel Mysql est installé)
    * $Bdd         = Le nom de la base de données
    * $Identifiant = Le nom d'utilisateur
    * $Mdp         = Le mot de passe
    */ 
    public function __construct($Serveur = 'http://localhost:8888/', $Bdd = 'box', $Identifiant = 'root', $Mdp = 'root') 
    {
      $this->Serveur     = $Serveur;
      $this->Bdd         = $Bdd;
      $this->Identifiant = $Identifiant;
      $this->Mdp         = $Mdp;
      
      try
      {
        $this->Lien=@mysql_connect($this->Serveur, $this->Identifiant, $this->Mdp);
      }
      catch(PDOException  $e)
      {
        throw new MySQLExeption('Erreur de connexion au serveur MySql!!!');    
      }
      
 
      if(!$this->Lien && $this->Debogue) 
        throw new MySQLExeption('Erreur de connexion au serveur MySql!!!');        
 
      $Base = mysql_select_db($this->Bdd,$this->Lien);
 
      if (!$Base && $this->Debogue) 
        throw new MySQLExeption('Erreur de connexion à la base de donnees!!!');
    }
 
    /**
    * Retourne le nombre de requêtes SQL effectué par l'objet
    */     
    public function RetourneNbRequetes() 
    {
      return $this->NbRequetes;
    }
 
    /**
    * Envoie une requête SQL et récupère le résultât dans un tableau pré formaté
    *
    * $Requete = Requête SQL
    */ 
    public function TabResSQL($Requete)
    {
      $i = 0;
      $Ressource = mysql_query($Requete,$this->Lien);
      $TabResultat=array();
      if (!$Ressource and $this->Debogue) throw new MySQLExeption('Erreur de requête SQL!!!');
      while ($Ligne = mysql_fetch_assoc($Ressource))
      {
        foreach ($Ligne as $clef => $valeur) $TabResultat[$i][$clef] = utf8_encode ($valeur);
        $i++;
      }
      mysql_free_result($Ressource);
      $this->NbRequetes++;
      return $TabResultat;
    }
 
    /**
    * Retourne le dernier identifiant généré par un champ de type AUTO_INCREMENT
    *
    */ 
    public function DernierId()
    {  
        return mysql_insert_id($this->Lien);
    }
 
    /**
    * Envoie une requête SQL et retourne le nombre de table affecté
    *
    * $Requete = Requête SQL
    */ 
    public function ExecuteSQL($Requete)
    {
      $Ressource = mysql_query($Requete,$this->Lien);
      if (!$Ressource and $this->Debogue) throw new MySQLExeption('Erreur de requête SQL!!!');
      $this->NbRequetes++;
      $NbAffectee = mysql_affected_rows();
      return $NbAffectee;      
    }    
  }
  
  class MySQLExeption  extends Exception 
  {
    public function __construct($Msg) {
      parent :: __construct($Msg);
    }
 
    public function RetourneErreur() {
      $msg  = '<div><strong>' . $this->getMessage() . '</strong>';
      $msg .= ' Ligne : ' . $this->getLine() . '</div>';
      return $msg;
    }
  }
?>