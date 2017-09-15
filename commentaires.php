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
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Blog</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="icon" href="favicon.ico" />
        <!-- Fontawesome Link-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
      <body>
    <header>
      <h1>BLOG</h1>
      <h2>Billets et commentaires</h2>
    </header>

<?php

$billetID = $bdd -> prepare('SELECT titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y %Hh%imin%ss\') AS new_date FROM billets WHERE id = ?');
$billetID -> execute(array($_GET['billet']));

$donnees2 = $billetID -> fetch();

?>

    <div class="Billet">
      <h3><?php echo $donnees2['titre']; ?></h6>
      <p><?php echo $donnees2['contenu']; ?></p>
      <p><?php echo $donnees2['new_date']; ?></p>
    </div>

<?php
$billetID -> closeCursor();

$commentaire = $bdd -> prepare('SELECT auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y %Hh%imin%ss\') AS new_datecom FROM commentaires WHERE id_billet = ?');
$commentaire -> execute(array($_GET['billet']));

while($donnees = $commentaire -> fetch()){
echo "<p> Le ". $donnees['new_datecom']. "<br />". $donnees['auteur']. " : ". $donnees['commentaire'];
}

$commentaire -> closeCursor();

?>

<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.12.0.min.js"><\/script>')</script>
<script src="js/plugins.js"></script>
<script src="js/main.js"></script>

<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
    (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
    function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
    e=o.createElement(i);r=o.getElementsByTagName(i)[0];
    e.src='https://www.google-analytics.com/analytics.js';
    r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
    ga('create','UA-XXXXX-X','auto');ga('send','pageview');
</script>
<script src="js/bootstrap.js"></script>
</body>
</html>
