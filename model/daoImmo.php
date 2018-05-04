<?php
include ("MyPDO.php");
//*****************************************************************************************
class DaoImmo extends MyPDO
{

	// constructeur qui appelle constructeur de la super classe qui effectue la connexion
	// avec les variables contenues dans login.php
    function __construct()
	{
	include ("login.php");
	parent::__construct('mysql:host='.$serveur.';dbname='.$mabase,$login, $motdepasse);
    } // fin constructeur
//---------------------------------------------------------------------
  function getAllOrderBy($ordre)
	{ 
	//echo "Ordre : ".$ordre."<br>";
	$strSQL = "SELECT idDemande as 'identifiant de la Demande',d.idPersonne as 'identifiant de Personne',prenom,genre,ville,budget , superficie FROM demande d, personne p WHERE p.idPersonne=d.idPersonne order by ".$ordre;
	$getAllOrderBy=$this->prepare($strSQL);
	$getAllOrderBy->execute();
	$t=$getAllOrderBy->fetchAll(PDO::FETCH_OBJ);
	return $t;
	}
//---------------------------------------------------------------------
	function getAllByVille($ville)
	{//http://php.net/manual/fr/pdostatement.execute.php
	$getAllByVille=$this->prepare("SELECT * FROM demande WHERE ville= ?");
	$getAllByVille->execute(array($ville));
	$t=$getAllByVille->fetchAll(PDO::FETCH_OBJ);
	return $t;
	//??
	
	}
//---------------------------------------------------------------------
	function getAllById($id)
	{
	$getAllById=$this->prepare("SELECT * FROM demande d, personne p WHERE d.idPersonne=p.idPersonne and idDemande = ? ");
	$getAllById->execute(array($id));
	$t=$getAllById->fetchAll(PDO::FETCH_OBJ);
	return $t;
	}
//---------------------------------------------------------------------
	function getVilleByVilleStartWith($ville)
	{
	$getVilleByVilleStartWith=$this->prepare("SELECT distinct ville FROM demande WHERE ville like ? ");
	$ville=$ville.'%';
	$retour=array();
	$getVilleByVilleStartWith->setFetchMode(PDO::FETCH_NUM);
	$getVilleByVilleStartWith->execute(array($ville));
	for ($i=0;$i<$getVilleByVilleStartWith->rowCount();$i++)
		{
		$retour=array_merge($retour,$getVilleByVilleStartWith->fetch());
		}
	return $retour;
	}
//---------------------------------------------------------------------
	function getAllbyBudgetinferieur($budget)
	{
	$getAllbyBudgetinferieur=$this->prepare("SELECT * FROM demande WHERE budget < ?");
	$getAllbyBudgetinferieur->execute(array($budget));
	$t=$getAllbyBudgetinferieur->fetchAll(PDO::FETCH_OBJ);
	return $t;
	}
//---------------------------------------------------------------------
	function getAllbyBudgetGenre($budget,$genre)
	{
	$getAllbyBudgetGenre=$this->prepare("SELECT * FROM demande WHERE budget < ? AND genre = ?");
	$getAllbyBudgetGenre->execute(array($budget,$genre));
	$t=$getAllbyBudgetGenre->fetchAll(PDO::FETCH_OBJ);
	return $t;
	}
//---------------------------------------------------------------------	
	function getBudgetmoy()
	{
		$getBudgetmoy=$this->prepare("SELECT AVG(budget) as 'Budget moyen' from demande");
		$getBudgetmoy->execute(array());
		$t=$getBudgetmoy->fetchAll(PDO::FETCH_OBJ);
		return $t;	
	}
//---------------------------------------------------------------------	
	function getbudgetmax()
	{
		$getbudgetmax = $this->prepare("SELECT MAX(budget) AS 'budget maximum' from demande");
		$getbudgetmax->execute(array());
		$t=$getbudgetmax->fetchAll(PDO::FETCH_OBJ);
		return $t;
	}

	function getbudgetmini()
	{
		$getbudgetmini=$this->prepare("SELECT MIN(budget) AS 'buget minimum' from demande");
		$getbudgetmini->execute(array());
		$t=$getbudgetmini->fetchAll(PDO::FETCH_OBJ);
		return $t;
	}

	function getbugetsuperieurmoy()
	{
		$getbugetsuperieurmoy=$this->prepare("SELECT idDemande as 'numero demande ',budget,genre,ville FROM `demande` WHERE budget > (SELECT AVG (budget)from demande )");
		$getbugetsuperieurmoy->execute(array());
		$t=$getbugetsuperieurmoy->fetchAll(PDO::FETCH_OBJ);
		return $t;
	}

	function getnbbiengenre()
	{
		$getnbbiengenre=$this->prepare("SELECT count(budget) as 'Nombre de bien 'from demande ");
		$getnbbiengenre->execute(array());
		$t=$getnbbiengenre->fetchAll(PDO::FETCH_OBJ);
		return $t;
	}
function Modif($personne,$ville,$budget,$genre,$ide)
	{
	$Modif=$this->prepare("UPDATE demande d, personne p SET p.prenom= ?, d.ville= ?, d.budget= ?, d.genre= ? WHERE p.idPersonne=d.idPersonne AND d.idDemande= ?");
	$Modif->execute(array($personne,$ville,$budget,$genre,$ide));
	// LA BONNE REQ DANS PHPMYADMIN
	// UPDATE demande d, personne p SET p.prenom='jean', d.ville= 'Saint-Joseph' , d.budget= '150000' , d.genre= 'maison' , d.superficie= '120' WHERE p.idPersonne=d.idPersonne AND idDemande = 2;
	}
	
function Insert($personne,$ville,$budget,$genre)
	{
	$Insert=$this->prepare("INSERT INTO demande (isDemande, idPersonne, genre, ville, budget, superficie) VALUES ('', '', '?', '?', '?', '?')");
	$Insert->execute(array($personne,$ville,$budget,$genre));	
	}
	
};// fin de classe
