<h1>Liste des livres de la blibliothèque</h1> <br>

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
    $result = $conn->query("SELECT Books.id, title, firstname, lastname, publication FROM Books JOIN Author ON Books.author_id=Author.id ORDER BY firstname");

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
                <td><a href='update.php?id=<?php echo $row["id"]; ?>'>Editer</a></td>
                <td><a href='delete.php?id=<?php echo $row["id"]; ?>'>Supprimer</a></td>
            </tr>
        <?php } ?>
    </table>
    <a href='create.php'>Ajouter un nouveau livre</a>