<?php
include_once("includes/db.php");

$query = $pdo->prepare("SELECT * FROM locations");
$query->execute();
$locations = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("includes/head.php") ?>
</head>
<body>
    <?php include_once("includes/nav.php"); ?>
    <div class="location-con">
        <aside class="aside-locations">
            <h1>Appeltaart locaties</h1>
            <div class="locations">
                <?php foreach ($locations as $location) : ?>
                    <a href='locations.php?id=<?= $location['id'] ?>'>
                        <h2><?= $location['name'] ?></h2>
                        <p>Adres: <?= $location['address'] ?></p>
                    </a>
                <?php endforeach; ?>
            </div>
            <?php if (isset($_GET['id'])) : ?>
                <a href='make_review.php?id=<?= $_GET['id'] ?>'><h1>Maak een review!</h1></a>
            <?php endif; ?>
        </aside>

        <?php if (isset($_GET["id"])) : ?>
            <?php
            $id = (int)$_GET["id"]; 
            if (isset($locations[$id - 1])) {
                $restaurant = str_replace(" ", "+", $locations[$id - 1]["address"]);
                $restaurant = str_replace(",", "", $restaurant);
                echo '<iframe class="iframe" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" loading="lazy" src="http://maps.google.nl/maps?f=q&amp;source=s_q&amp;hl=nl&amp;geocode=&amp;q=' . $restaurant . '&amp;z=15&amp;t=k&amp;output=embed"></iframe>';
            } else {
                echo '<p>Locatie niet gevonden.</p>';
            }
            ?>
        <?php endif; ?>

        <form class="location-form" action="add_location.php" method="post">
            <h2>Voeg een nieuwe locatie toe</h2>
            <label for="name">Naam:</label>
            <input type="text" id="name" name="name" required>
                    
            <label for="address">Adres:</label>
            <input type="text" id="address" name="address" required>
                    
            <input type="submit" value="Toevoegen">
        </form>
    </div>
</body>
</html>
