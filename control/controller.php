<?php
//print_r($_REQUEST);

include("../model/model.php");
include("../view/view.php");

$maquette= new Model();
$maVue= new Vue();
$cas=0;

if (empty($_REQUEST["cas"]))  $cas="accueil";
if (isset($_REQUEST["cas"]))  $cas=$_REQUEST["cas"];     

if (isset($_REQUEST["budget"]))     $budget     =$_REQUEST["budget"];
if (isset($_REQUEST["genre"]))      $genre      =$_REQUEST["genre"];
if (isset($_REQUEST["ide"]))        $ide        =$_REQUEST["ide"];
if (isset($_REQUEST["choix"]))      $choix      =$_REQUEST["choix"];
if (isset($_REQUEST["ville"]))      $ville      =$_REQUEST["ville"];
if (isset($_REQUEST["personne"]))   $personne   =$_REQUEST["personne"];
if (isset($_REQUEST["superficie"])) $superficie =$_REQUEST["superficie"];
if (isset($_REQUEST["prenom"]))     $prenom     =$_REQUEST["prenom"];

// quel lien nous interroge?
switch($cas)
 {
  case "accueil":
    $maVue->afficheAccueil(); 
    break;
  case 'ConsultSpe':
    $maVue->afficheConsultSpe();
    break;
  case 'Modification':
    $maVue->afficheModification();
    break;
  case "budget":
    $t=$maquette->getAllOrderBy("budget");
    $maVue->afficheTab($t,100); 
      break;
  case "personne":
    $t=$maquette->getAllOrderBy("idPersonne");
    $maVue->afficheTab($t,100); 
    break;
  case "ville":
    $t=$maquette->getAllOrderBy("ville");
    $maVue->afficheTab($t,100); 
    break;
  case "genre":
    $t=$maquette->getAllOrderBy("genre");
    $maVue->afficheTab($t,100); 
    break;
  case "superficie":
    $t=$maquette->getAllOrderBy("superficie");
    $maVue->afficheTab($t,100); 
    break;
  case "villePrecise":
    if (!empty($ville))
    {
	$t=$maquette->getAllByVille($ville);
    $maVue->afficheTab($t,100); 
    }
    break;  
  case "budgetInferieur":
    if (!empty($budget))
    {
    $t=$maquette->getAllbyBudgetinferieur($budget);
    $maVue->afficheTab($t,100);
    }
      //creation d'une nouvelle fonction getAllbyBudgetinferieur dans model est daoimmo

    break;  
  case "budgetGenre":
    if (!empty($budget)&&!empty($genre))
    {
      $t=$maquette->getAllbyBudgetGenre($budget,$genre);
      $maVue->afficheTab($t,100);
      //?=creation de la fonction getAllbybudget dans model et daoimmo
     }
    break;
  case "maxi":
      {
        $t=$maquette->getbudgetmax();
        $maVue->afficheTab($t,100);
      }
      // Budget maximum 
      break;
  case "mini":
   	 {
      $t=$maquette->getbudgetmini();
      $maVue->afficheTab($t,100);
     }
     //Budget minimum
      break;
  case "budmoy":
     {
    $t=$maquette->getBudgetmoy();
    $maVue->afficheTab($t,100);
    }
    //Buget moyen
    break;
    case "budsupmoy":
      {
        $t=$maquette->getbugetsuperieurmoy();
        $maVue->afficheTab($t,100);
      }
      // Buget surpérieur à la moyenne 
      
      break;
  case "nbbiens":
    {
      $t=$maquette->getnbbiengenre();
      $maVue->afficheTab($t,100);
    }
   //  Nombre de bien
    break;
   case "modifier":
     if (!empty($ide))
     {
	
      if ($choix=="supprimer")
       { 
       //$t=$maquette->Supp($ide);
       //$maVue->afficheMess('Suppression effectuer')
       }
      if ($choix=="modifier")
       {
        $tab=$maquette->getAllById($ide);
        $maVue->formulaireModif($tab[0]);
      }
     }
    break;
  case "insere":
      $maVue->formulaireNouveau();
    break;
  case "VoiciLesModif":
     if (!(empty($personne)||empty($ville)||empty($budget)||empty($genre)))
    {
     $t=$maquette->Modif($personne,$ville,$budget,$genre,$ide);
      $maVue->afficheMess('Modification effectuer');
   // $requete="UPDATE demande SET nom='$idPersonne',ville='$ville',budget='$budget',genre='$genre' ,superficie='$superficie'   WHERE id=$ide";
	//???????????????????
    }
	else {
           $maVue->afficheMess('Paramètre manquant');
          }
	break;	
  case "nouveau":
   
    if (!(empty($personne)||empty($ville)||empty($budget)||empty($genre)))
    {
        $t=$maquette->Insert($personne,$ville,$budget,$genre);
        $maVue->afficheMess('Insérsion effectuer');
      // $requete="INSERT INTO demande (personne,ville,budget,genre,superficie) 
      // VALUES('$personne','$ville','$budget','$genre','$superficie')";
      //??????         
        
    } 
    else 
    {
      $maVue->afficheMess('Paramètre manquant');
    }
    break;

   default:
    $t=$maquette->getAllOrderBy("idDemande");
    $maVue->afficheTab($t,100); 
 }



//----------------------------------------------

?> 
    
    

 
