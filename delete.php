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
//Requête liste des livres
$result = $conn->query("SELECT title FROM Books");
?>

<h1>Supprimer un livre</h1> <br>
<form method="POST" action="">
<label for="author">Titre du livre</label><br>
<select name="title" id="title"><br>
    <?php while ($row = $result->fetch_assoc()) { ?>
        <option value=<?php echo $row["title"]; ?>><?php echo $row["title"]; ?></option>
    <?php } ?>

    <input type="submit" name="deleteBtn" value="Supprimer">

    <?php
    if (isset($_POST['deleteBtn'])) {
        $title = $_POST['title'];
       
        $deleteBook = "DELETE FROM Books WHERE title='$title'";

        mysqli_query($conn, $deleteBook) or die('Erreur SQL !' . $deleteBook . '<br>' . mysqli_error($conn));
        echo "<meta http-equiv='refresh' content='0'>";
    }
    ?>