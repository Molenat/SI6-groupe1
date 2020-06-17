<?php

include  'include / lib / libPage.php' ;

class  PageListeProf  extends  PageListe
{
    protected function afficherBouton ()
   {
       echo  '<a class="icon_recherche" href="rechercheProf.php"> Rechercher un professeur existant </a>' ;
       
       if ( $this->userInfo [ 'is_professeur' ])
        {
           echo  '<a class="icon_ajouter" href="ajoutModifProf.php"> Ajouter un professeur </a>' ;
        }
   }

    protected function init ()
   {
       $tableau = new  Tableau ();
       $tableau->addColonne ( new  Colonne ( "Opération" , 'professeur.num_prof' , '
           <span class = "center bouton_operation">
               <a title="voir" class="icon_voir" href="infoProf.php?id=$1"> </a>
           </span> ' ));

       if ( $this->userInfo [ 'is_professeur' ])
       {
           $tableau->addColonne ( new  Colonne ( "Opération" , 'professeur.num_prof' , '
               <span class = "center bouton_operation">
                   <a title="modifier" class="icon_modifier" /* href="ajoutModifProf.php?action=modifie&id=$1" */> </a>
                   <a title="supprimer" class="icon_supprimer"/*  href="supprimerProf.php?id=$1"> */ </a>
               </span> ' ));
       }
           
       $tableau -> addColonne ( new  Colonne ( "Professeur" , 'nom_etudiant, prenom_etudiant' , '$ 1 $ 2' ));
       $tableau -> addColonne ( new  Colonne ( "Email" , 'email' ,'$ 1 $ 2' ));
      
       
       
       

       
              
       
     
   }
}

$page = new  PageListeProf ();
$page -> run ();

?>