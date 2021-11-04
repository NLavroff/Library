<?php

session_start();

if (isset($_SESSION['login'])) {

    echo 'Bonjour ' . $_SESSION['login'] . '! Vous êtes connecté sur le panier de la bibliothèque ! <br>';
    echo '<a href="logout.php">Se déconnecter</a>';
} else {
    header('location: login.php');
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
    if (!empty($_POST)) {
        $verifier = true;
        $id = $_POST['id'];

        if (isset($_SESSION['cartItems'])) {
            foreach ($_SESSION['cartItems'] as $item) {
                if ($id == $item['id']) {
                    echo "<br> Ce livre est déjà dans le panier : " . $item['title'] . "<br>";
                    $verifier = false;
                    break;
                }
            }
        }

        if ($verifier == true) {
            $sql = "SELECT Books.id, title, firstname, lastname, publication FROM Books JOIN Author ON Books.author_id=Author.id WHERE Books.id=" . $id;
            $result = $conn->query($sql);
            $_SESSION['cartItems'][] = $result->fetch_assoc();
        }
    }
    ?>

    <?php
        if (isset($_SESSION['cartItems'])) {?>
            <table>
            <tr>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Année de publication</th>
            </tr>
            <?php
            for ($i = 0; $i < count($_SESSION['cartItems']); $i++) { ?>
                <tr>
                    <td><?php echo $_SESSION['cartItems'][$i]["title"]; ?></td>
                    <td><?php echo $_SESSION['cartItems'][$i]["firstname"] . " " . $_SESSION['cartItems'][$i]["lastname"]; ?></td>
                    <td><?php echo $_SESSION['cartItems'][$i]["publication"]; ?></td>
                </tr>
        <?php }
        }else{echo "<br>Votre panier est vide !";} ?>
    </table>
</body>

</html>