<html>

<head>
    <title>Connexion à votre session</title>
</head>

<body>
    <form method="POST" action="login.php">
        Veuillez renseigner votre identifiant :  <input name="login" type="text">
        <input type="submit" value="Connexion">
    </form>
</body>

</html>

<?php
    // On définit un login de base pour tester mon login.
    $login_valide = "nath";

    // on teste si nos variables sont définies
    if (isset($_POST['login'])) {

    	// on vérifie les informations du formulaire, à savoir si le pseudo saisi est bien un pseudo autorisé
    	if ($login_valide == $_POST['login']) {
    		// dans ce cas, tout est ok, on peut démarrer notre session

    		// on la démarre :)
    		session_start ();
    		// on enregistre les paramètres de notre visiteur comme variables de session ($login) (noter que l'on utilise pas le $ pour enregistrer ces variables)
    		$_SESSION['login'] = $_POST['login'];

    		// on redirige notre visiteur vers une page de notre section membre
    		header ('location: index.php');
    	}
    	else {
    		// Le visiteur n'a pas été reconnu comme étant membre de notre site.
    		echo 'Membre non reconnu';
    	}
    }
    ?>