<!-- CONNEXION A LA BASE DE DONNEES VIA PDO -->
<?php
try{
$bdd = new PDO('mysql:host=localhost;dbname=Blog;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
  die('Erreur: '. $e->getMessage());
}

?>
<!-- BILLET -->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <header>
      <h1>BLOG</h1>
      <h2>Billets et commentaires</h2>
    </header>

<?php
// REQUETE QUI AFFICHE TOUS LES BILLETS
$billet=$bdd->query('SELECT * FROM billets ORDER BY date_creation DESC');

while($donnees = $billet -> fetch()){
?>
    <div class="Billet">
      <h3><?php echo $donnees['titre']; ?></h6>
      <p><?php echo $donnees['contenu']; ?></p>
      <p><?php echo $donnees['date_creation']; ?></p>
      <a href="commentaire.php">Commentaires</a>
    </div>
<?php
}
$billet ->closeCursor();
?>

  </body>
</html>
