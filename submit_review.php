<?php
include_once("includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rating = $_POST['rating'] ?? '';
    $name = $_POST['name'] ?? '';
    $location = $_POST['location'] ?? '';
    $date = $_POST['date'] ?? '';
    $experience = $_POST['experience'] ?? '';


    $query = $pdo->prepare("INSERT INTO reviews (rating, name, location, date, experience) VALUES (?, ?, ?, ?, ?)");
    $query->execute([$rating, $name, $location, $date, $experience]);

    header("Location: reviews.php");
    exit();
}
?>
