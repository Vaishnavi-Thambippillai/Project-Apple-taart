<?php
include_once("includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $address = $_POST['address'];

    $query = $pdo->prepare("INSERT INTO locations (name, address) VALUES (:name, :address)");
    $query->bindParam(':name', $name);
    $query->bindParam(':address', $address);

    if ($query->execute()) {
        header("Location: locations.php");
        exit();
    } else {
        echo "Er is een fout opgetreden bij het toevoegen van de locatie.";
    }
}
?>
