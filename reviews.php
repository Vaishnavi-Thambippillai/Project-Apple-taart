<?php
include_once("includes/db.php");

$reviews = [];
$imageMap = [
    'Cafe Papeneiland 4,5' => 'assets/images/papeneiland.png',
    'Len Bakkerij 5,0' => 'assets/images/len_bakkerij.png',
    'Dudok Rotterdam 3,0' => 'assets/images/dudok_rotterdam.png',
    'Winkel43 4,5' => 'assets/images/winkel43.png',
    'Coffee Corazon 4,5' => 'assets/images/coffee_corazon.png',
    'Sweets & Antiques 4,5' => 'assets/images/sweets_antiques.png',
    'De bruine boon 3,5' => 'assets/images/de_bruine_boon.png',
    'Expresszo 4,5' => 'assets/images/expresszo.png',
    '´t Groene pandje 5,0' => 'assets/images/groene_pandje.png',
    'Restaurant Noordzee 4,0' => 'assets/images/restaurant_noordzee.png',
    'Eetcafe De Kwikkel 5,0' => 'assets/images/eetcafe_de_kwikkel.png',
    'Limburgia Den bosch 4,0' => 'assets/images/limburgia_den_bosch.png',
];

function getRandomAppeltaartImage()
{
    $appeltaartImages = [
        'assets/images/appeltaart1.png',
        'assets/images/appeltaart2.png',
        'assets/images/appeltaart3.png',
    ];
    $randomIndex = array_rand($appeltaartImages);
    return $appeltaartImages[$randomIndex];
}

if (isset($pdo)) {
    try {
        $reviewsQuery = "SELECT * FROM reviews";
        $reviewsStmt = $pdo->query($reviewsQuery);

        if ($reviewsStmt) {
            $reviews = $reviewsStmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($reviews as &$review) {
                if (isset($imageMap[$review['location']])) {
                    $review['image'] = $imageMap[$review['location']];
                } else {
                    $review['image'] = getRandomAppeltaartImage();
                }
            }
            unset($review);
        } else {
            throw new Exception("Failed to fetch reviews.");
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews</title>
    <?php include_once("includes/head.php"); ?>
</head>

<body>
    <?php include_once("includes/nav.php"); ?>

    <h1>Reviews</h1>
    <div class="unique-reviews-container">
        <?php foreach ($reviews as $review) : ?>
            <div class="unique-review-box">
                <img src="<?php echo $review['image']; ?>" alt="Restaurant Image">
                <div class="unique-review-content">
                    <strong>Rating:</strong> <?php echo $review['rating']; ?> <br>
                    <strong>Naam:</strong> <?php echo $review['name']; ?> <br>
                    <strong>Locatie:</strong> <?php echo $review['location']; ?> <br>
                    <strong>Datum:</strong> <?php echo $review['date']; ?> <br>
                    <strong>Ervaring:</strong> <?php echo $review['experience']; ?> <br>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <style>
        footer {
            position: fixed;
            bottom: 0;
        }
    </style>

    <?php include_once("includes/footer.php"); ?>
</body>

</html>