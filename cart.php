<?php 

session_start();

if (isset($_SESSION['login'])) {

    echo 'Bonjour ' . $_SESSION['login'] . '! Vous êtes connecté sur le panier de la bibliothèque ! <br>';
    echo '<a href="logout.php">Se déconnecter</a>';
}
else{
    header ('location: login.php');
}

/* Initialisation du panier */
$_SESSION['panier'] = array();
/* Subdivision du panier */
$_SESSION['panier']['id'] = array();
$_SESSION['panier']['title'] = array();

?> 

<!DOCTYPE html>
<html>

<head>
    <title>Panier</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<h1>Mon panier</h1> <br>

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

$cart = "SELECT Books.id, title, firstname, lastname, publication FROM Books JOIN Author ON Books.author_id=Author.id";
var_dump($_SESSION);
echo $_POST['id'];
var_dump($cart);
$result = $conn->query($cart);
?>
<table>
        <tr>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Année de publication</th>
           
        </tr>

        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
            <td><?php $_SESSION['panier'] = array() ?></td>
                <td><?php $_SESSION["title"]; ?></td>
                </td>
                </form>
            </tr>
        <?php } ?>
    </table>