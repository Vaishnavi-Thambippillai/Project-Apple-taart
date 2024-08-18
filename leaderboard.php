<?php
include_once("includes/db.php");

$query = $pdo->prepare("SELECT * FROM reviews");
$query->execute();
$reviews = $query->fetchAll(PDO::FETCH_ASSOC);

$leaderboard = array();

foreach ($reviews as $review) {
    $name = $review['location'];
    $score = $review['rating'];
    $id = $review['id'];

    // Check if the restaurant is already in the leaderboard
    if (isset($leaderboard[$name])) {
        // If it exists, add the score to the existing total
        $leaderboard[$name]['score'] += $score;
    } else {
        // If it doesn't exist, add a new entry
        $leaderboard[$name] = array(
            'score' => $score,
            'id' => $id
        );
    }
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
        <div class="leaderboard">
            <?php
            arsort($leaderboard);
            $counter = 1;
            foreach ($leaderboard as $name => $data) {
                $id = $data['id'];
                $score = $data['score'];

                // Checking if name is not 0 or 1 (assuming you want to exclude these specific names)
                if ($name != 0 && $name != 1) {
                    echo "<div class='leaderboard-item'>";
                    echo "<p>$counter</p>";
                    $counter++;
                    echo "<a href='locations.php?id=$id'>";
                    echo "<img src=''>";
                    echo "<h2>" . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . "</h2>";
                    echo "<p>Score: " . htmlspecialchars($score, ENT_QUOTES, 'UTF-8') . "</p>";
                    echo "</a>";
                    echo "</div>";
                }
            }

            ?>
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