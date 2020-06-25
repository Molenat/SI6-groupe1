<?php

include 'include/lib/libPage.php';

class PageListeProf extends PageListe
{
    protected function afficherBouton()
    {
        echo '<a class="icon_rechercher" href="rechercherProf.php">Rechercher un professeur existant</a>';
        
        if($this->userInfo['is_professeur']){
            echo '<a class="icon_ajouter" href="ajoutModifProf.php">Ajouter un professeur</a>';
        }
    }

    protected function init()
    {
        $tableau = new Tableau();
        $tableau->addColonne(new Colonne("Opération", 'professeur.num_prof', '
            <span class="center bouton_operation">
                <a title="voir" class="icon_voir" href="infoProf.php?id=$1"></a>
            </span>'));

        if($this->userInfo['is_professeur'])
        {
    		$tableau->addColonne(new Colonne("Opération", 'professeur.num_prof', '
    			<span class="center bouton_operation">
    				<a title="modifier" class="icon_modifier" href="ajoutModifProf.php?action=modifie&id=$1"></a>
    				<a title="supprimer" class="icon_supprimer" href="supprimerProf.php?id=$1"></a>
    			</span>'));
        }
			
        $tableau->addColonne(new Colonne("Professeur", 'nom_prof, prenom_prof', '$1 $2'));
        $tableau->addColonne(new Colonne("Email" , 'professeur.email' ,'$1'));
        //$tableau->addColonne(new Colonne("Entreprises", array('GROUP_CONCAT(raison_sociale SEPARATOR "<br />")'), '$1', true, false));
        //$tableau->addColonne(new Colonne("Professeur", 'nom_prof, prenom_prof', '$1 $2'));
		
		//$requete = " WHERE annee_obtention IS NULL AND etudiant.en_activite = 1";
                //$requete = " WHERE etudiant.en_activite = 1";
                $requete = "";
		
		if (isset($_POST['nom']) && $_POST['nom'] != ""){
			$requete .= " AND professeur.num_prof = ".$_POST['nom'];
                }
		if (isset($_POST['prenom']) && $_POST['prenom'] != ""){
			$requete .= " AND professeur.num_prof = ".$_POST['prenom'];
                }

        $tableau_sql = new TableauSQL($tableau, $this->bdd, 
        "stage
            LEFT OUTER JOIN professeur ON professeur.num_prof = stage.num_prof"
            .$requete.
            " GROUP BY professeur.num_prof, nom_prof, prenom_prof ", 
        "nom_prof, prenom_prof");
        
        $this->setTableauSQL($tableau_sql);
    }
}

$page = new PageListeProf();
$page->run();

?>