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

//Requête liste des auteurs
$result = $conn->query("SELECT * FROM Author");
?>

<h1>Ajouter un livre</h1> <br>

<form method="POST" action="">

    <label for="title">Titre du livre</label><br>
    <input type="text" name="title" /><br>

    <label for="publication">Année de publication</label></br>
    <input type="text" name="publication" /><br>

    <label for="author">Auteur du livre</label><br>
    <select name="author_id" id="id"><br>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <option value=<?php echo $row["id"]; ?>><?php echo $row["firstname"] . " " . $row["lastname"]; ?></option>
        <?php } ?>

        <input type="submit" name="btn" value="Ajouter">
        <?php
        if (isset($_POST['btn'])) { // contrôle pour vérifier si la variable $_POST['btn'] est bien définie
            $title = $_POST['title'];
            $publication = $_POST['publication'];
            $id = $_POST['author_id'];

            // Requête d'insertion
            $addBook = "INSERT INTO Books (title, publication, author_id) VALUES ('$title', '$publication', '$id')";

            // Exécution de la requête
            mysqli_query($conn, $addBook) or die('Erreur SQL !' . $addBook . '<br>' . mysqli_error($conn));
        }
