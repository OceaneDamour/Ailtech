<?php
include("daoImmo.php");

//---------------------------------------------------------------------
class Model{

private	$monDao;

//---------------------------------------------------------------------
function __construct()
	{
	$this->monDao=new DaoImmo();
	}
//---------------------------------------------------------------------
function getAllOrderBy($ordre)
	{
	return $this->monDao->getAllOrderBy($ordre);
	}
//---------------------------------------------------------------------
function getAllByVille($ville)
	{
	return $this->monDao->getAllByVille($ville);
	}
//---------------------------------------------------------------------
function getAllById($id)
	{
	return $this->monDao->getAllById($id);
	}
//---------------------------------------------------------------------
function getVilleByVilleStartWith($ville)
	{
	$t=$this->monDao->getVilleByVilleStartWith($ville);
	return $t;
	}
//---------------------------------------------------------------------
function getAllbyBudgetinferieur($budget)
	{
		$t=$this->monDao->getAllbyBudgetinferieur($budget);
		return $t;
	}
//---------------------------------------------------------------------
function getAllbyBudgetGenre($budget,$genre)
	{
		return $this->monDao->getAllbyBudgetGenre($budget,$genre);
	}
//---------------------------------------------------------------------
function getBudgetmoy()
{
	return $this->monDao->getBudgetmoy();
}

function getbudgetmax()
{
	return $this->monDao->getbudgetmax();
}

function getbudgetmini()
{
	return $this->monDao->getbudgetmini();
}
function getbugetsuperieurmoy()
{
	return $this->monDao->getbugetsuperieurmoy();
}

function getnbbiengenre()
{
	 return $this->monDao->getnbbiengenre();

}
function Modif($personne,$ville,$budget,$genre,$ide)
	{
	return $this->monDao->Modif($personne,$ville,$budget,$genre,$ide);
	}
//function Supp($ide)
//	{
//	return $this->monDao->Supp($ide);
//	}

//---------------------------------------------------------------------
function Insert($personne,$ville,$budget,$genre)
	{
	return $this->monDao->Insert($personne,$ville,$budget,$genre);
	}
//---------------------------------------------------------------------

function Connexionsession()
{
return $this->monDao->Connexionsession();
}


};// fin de classe

?>
