<?php
try
{
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    $bdd = new PDO('mysql:host=localhost;dbname=publication', 'root', 'judileroi', $pdo_options);
  
    $term = $_POST['term'];
      
    $requete = $bdd->prepare('SELECT nom,prenoms FROM auteurs WHERE nom LIKE :term'); // j'effectue ma requête SQL grâce au mot-clé LIKE
    $requete->execute(array('term' => '%'.$term.'%'));
      
    $array = array(); // on créé le tableau
      
    while($donnee = $requete->fetch()) // on effectue une boucle pour obtenir les données
    {
        array_push($array, $donnee['nom'].','.$donnee['prenoms']); // et on ajoute celles-ci à notre tableau
    }
     
    echo json_encode($array); // il n'y a plus qu'à convertir en JSON
 
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
?>