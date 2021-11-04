<?php

session_start();

if (isset($_SESSION['login'])) {

    echo 'Bonjour ' . $_SESSION['login'] . '! Vous êtes connecté sur le panier de la bibliothèque ! <br>';
    echo '<a href="logout.php">Se déconnecter</a>';
}
else{
    header ('location: login.php');
    die();
}

$servername = 'localhost';
$username = 'root';
$password = '';

//On établit la connexion
$conn = new mysqli($servername, $username, $password, 'Library');

//On vérifie la connexion
if ($conn->connect_error) {
    die('Erreur : ' . $conn->connect_error);
}

$id = $_GET['id'];

// Requête de suppression
$deleteBook = "DELETE FROM Books WHERE id='$id'";
mysqli_query($conn, $deleteBook) or die('Erreur SQL !' . $deleteBook . '<br>' . mysqli_error($conn));

header('Location: index.php');
?>