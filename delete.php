<?php
$servername = 'localhost';
$username = 'root';
$password = '';

//On établit la connexion
$conn = new mysqli($servername, $username, $password, 'Library');

//On vérifie la connexion
if ($conn->connect_error) {
    die('Erreur : ' . $conn->connect_error);
}

$idBook = $_GET['id'];

// Requête de suppression
$deleteBook = "DELETE FROM Books WHERE id='$idBook'";
mysqli_query($conn, $deleteBook) or die('Erreur SQL !' . $deleteBook . '<br>' . mysqli_error($conn));

header('Location: read.php');
?>