<!DOCTYPE html>
<html>

<head>
    <title>Bibliothèque</title>
    <meta charset="utf-8">

</head>

<body>
    <h1>Bibliothèque</h1> <br>

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

    //Requête d'affichage
    $result = $conn->query("SELECT title, firstname, lastname, publication FROM Books JOIN Author ON Books.author_id=Author.id");

    ?>

    <table>
        <tr>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Année de publication</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row["title"]; ?></td>
                <td><?php echo $row["firstname"] . " " . $row["lastname"]; ?></td>
                <td><?php echo $row["publication"]; ?></td>
            </tr>
        <?php } ?>
    </table>

