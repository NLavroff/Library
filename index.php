<!DOCTYPE html>
<?php
session_start();

if (isset($_SESSION['login'])) {

    // var_dump($_SESSION);

    echo 'Bonjour ' . $_SESSION['login'] . '! Vous êtes connecté sur la bibliothèque ! <br>';
    echo '<a href="logout.php">Se déconnecter</a>';
} else {
    echo '<a href="login.php">Se connecter</a>';
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Library</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <h1>Liste des livres de la bibliothèque</h1> <br>

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

    // Requête pour afficher la bibliothèque entière
    $allBooks = "SELECT Books.id, title, firstname, lastname, publication FROM Books JOIN Author ON Books.author_id=Author.id";

    // Recherche par titre
    $firstSearch = false;

    // utiliser escape_string pour ignorer les caractères spéciaux
    // utiliser explode pour les recherches avec plusieurs mots
    // variables conditions pour stocker plusieurs mots dans un tableau
    if (isset($_GET['search'])) {
        $firstSearch = true;
        $search = $_GET['search'];
        $search = mysqli_real_escape_string($conn, $_GET['search']);
        $words = explode(" ", $search);

        $conditions = [];

        foreach ($words as $word) {
            $conditions[] = "title LIKE '%" . $word . "%'";
        }

        $allBooks .= " WHERE (" . implode(" OR ", $conditions) . ")";
    }

    if (isset($_GET['publication'])) {
        $publication = $_GET['publication'];

        if (!$firstSearch) {
            $allBooks .= " WHERE publication > 2000";
        } else {
            $allBooks .= " AND publication < " . $publication;
        }
    }

    $allBooks .= " ORDER BY firstname";

    //Requête d'affichage
    $result = $conn->query($allBooks);

    ?>

    <form method="GET" action="">
        <input id="search" name="search" type="search" placeholder="Rechercher un titre..." />

        <select name="publication" id="id"><br>
            <option value="1900"> Livres publiés avant 1900</option>
            <option value="1910"> Livres publiés avant 1910</option>
            <option value="1920"> Livres publiés avant 1920</option>
            <option value="1930"> Livres publiés avant 1930</option>
            <option value="1940"> Livres publiés avant 1940</option>
            <option value="1950"> Livres publiés avant 1950</option>
            <option value="1960"> Livres publiés avant 1960</option>
            <option value="1970"> Livres publiés avant 1970</option>
            <option value="1980"> Livres publiés avant 1980</option>
            <option value="1990"> Livres publiés avant 1990</option>
            <option value="2000"> Livres publiés avant 2000</option>
            <option value="2010"> Livres publiés avant 2010</option>
            <option value="2020"> Livres publiés avant 2020</option>
        </select>
        <input type="submit" value="Rechercher" />
    </form>

    <table>
        <tr>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Année de publication</th>
            <th>Editer</th>
            <th>Supprimer</th>
            <th>Ajouter au panier</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row["title"]; ?></td>
                <td><?php echo $row["firstname"] . " " . $row["lastname"]; ?></td>
                <td><?php echo $row["publication"]; ?></td>
                <td><a href='update.php?id=<?php echo $row["id"]; ?>'>Editer</a></td>
                <td><a href='delete.php?id=<?php echo $row["id"]; ?>'>Supprimer</a></td>
                <td>
                    <form method="POST" action="cart.php" name="cart">
                        <input type="hidden" name="id" value="<?php echo $row["id"]; ?>" />
                        <button type="submit">Ajouter au panier</button>
                </td>
                </form>
            </tr>
        <?php } ?>
    </table>
    <form method="POST" action="create.php" name="create">
        <input type="hidden" name="add" value="">
        <button type="submit">Ajouter un nouveau livre</button>
    </form>
</body>

</html>