<?php
include_once("includes/db.php");

if (!isset($_SESSION['loggedInUser'])) {
    header("Location: login.php");
    die();
}

if ($user['username'] !== "admin") {
    header("Location: login.php");
    die();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("includes/head.php") ?>
</head>

<body>
    <?php
    include_once("includes/nav.php");
    ?>

    <main>
        <h3>Contact requests</h3>
        <div class="flex-container">
            <?php

            $contactQuery = $pdo->prepare("SELECT * FROM `contact` ORDER BY `contactID` DESC");

            try {

                $contactQuery->execute();
                $contacts = $contactQuery->fetchAll(PDO::FETCH_ASSOC);

                foreach ($contacts as $contact) {
                    echo "<div class='flex-card'>Username: " . htmlspecialchars($contact['username']) . "<br>";
                    echo "Onderwerp: " . htmlspecialchars($contact['onderwerp']) . "<br>";
                    echo "Email: " . htmlspecialchars($contact['email']) . "<br>";
                    echo "Telefoon nummer: " . htmlspecialchars($contact['tel']) . "</div>";
                }
            } catch (PDOException $e) {

                error_log($e->getMessage());
                die("Database query failed. Check the logs for more details.");
            }

            ?>
        </div>
    </main>

    <style>
        footer {
            position: fixed;
            bottom: 0;
        }
    </style>

    <?php
    include_once("includes/footer.php")
    ?>
</body>

</html>