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

//On récupère l'id du livre
$id = $_GET['id'];

$qry = mysqli_query($conn, "SELECT * from Books where id='$id'");
//On créé une variable pour intégrer la value du champ
$data = mysqli_fetch_array($qry);

if (isset($_POST['Modifier'])) {
    $title = $_POST['title'];
    $publication = $_POST['publication'];

    $editBook = mysqli_query("UPDATE Author SET title='$title', publication='$publication' WHERE Books.id='$id'");
}
?>

<h1>Editer un livre</h1> <br>

<form method="POST">

    <label for="title">Titre du livre</label><br>
    <input type="text" name="title" value="<?php echo $data['title'] ?>" /><br>

    <label for="publication">Année de publication</label></br>
    <input type="text" name="publication" value="<?php echo $data['publication'] ?>" /><br>

    <label for="author">Auteur du livre</label><br>
    <select name="author_id" id="id"><br>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <option value=<?php echo $row["id"]; ?>><?php echo $row["firstname"] . " " . $row["lastname"]; ?></option>
        <?php } ?>

        <input type="submit" name="btn" value="Modifier">
        <?php
        while ($row = $result->fetch_assoc()) {
            $title = $row["title"];
            $publication = $row["publication"];
        }
