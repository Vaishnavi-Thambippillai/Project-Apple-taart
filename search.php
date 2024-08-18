<?php
// Include database connection
include_once("includes/db.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Searchbar</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <?php
    include_once("includes/nav.php");
    ?>

    <main>
        <?php
        echo "<h1> Restaurants met de naam " . $_GET['search'] .  "</h1>";

        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $searchTerm = '%' . $_GET['search'] . '%';

            try {
                $stmt = $pdo->prepare("SELECT * FROM locations WHERE name LIKE :term");
                $stmt->bindParam(':term', $searchTerm, PDO::PARAM_STR);
                $stmt->execute();
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                
                if ($results) {
                    echo "<div class='search'><div class='search-locations'>";
                    foreach ($results as $row) {
                        echo "<a href='locations.php?id=" . $row['id'] . "'>";
                        echo "<h2>" . $row['name'] . "</h2>";
                        echo "<p>Adres: " . $row['address'] . "</p>";
                        echo "</a>";
                    }
                    echo "</div></div>";
                } else {
                    echo "<p>Geen restaurants met de naam '<strong>" . htmlspecialchars($_GET['search']) . "</strong>' gevonden</p>";
                }

                 echo "<h1> Restaurants op de plek " . $_GET['search'] .  "</h1>";

                $stmt2 = $pdo->prepare("SELECT * FROM locations WHERE address LIKE :term2");
                $stmt2->bindParam(':term2', $searchTerm, PDO::PARAM_STR);
                $stmt2->execute();
                $results2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

                if ($results2) {
                    echo "<div class='search'><div class='search-locations'>";
                    foreach ($results2 as $row) {
                        echo "<a href='locations.php?id=" . $row['id'] . "'>";
                        echo "<h2>" . $row['name'] . "</h2>";
                        echo "<p>Adres: " . $row['address'] . "</p>";
                        echo "</a>";
                    }
                    echo "</div></div>";
                } else {
                    echo "<p>Geen restaurants op de plek '<strong>" . htmlspecialchars($_GET['search']) . "</strong>' gevonden</p>";
                }
            } catch (PDOException $e) {
                echo "Error: " . htmlspecialchars($e->getMessage());
            }
        }
        ?>
        </div>
    </main>
</body>

</html>