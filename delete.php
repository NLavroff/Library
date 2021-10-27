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

$id = $_GET['id'];
//Requête liste des livres
$result = $conn->query("SELECT id, title FROM Books WHERE id='$id'");
$data = mysqli_fetch_array($result);
?>

<h1>Supprimer un livre</h1> <br>

<form method="POST" action="">
    <input type="hidden" name="id" value="<?php echo $id; ?>" />
    <label for="author">Titre du livre</label><br>
    <input type="text" name="title" value="<?php echo $data['title'] ?>" /><br>
    <input type="submit" name="deleteBtn" value="Supprimer">

</form>

<?php
if (isset($_POST['deleteBtn'])) {
    // Requête de suppression
    $deleteBook = "DELETE FROM Books WHERE id='$id'";
    mysqli_query($conn, $deleteBook) or die('Erreur SQL !' . $deleteBook . '<br>' . mysqli_error($conn));

    header('Location: read.php');
}
?>