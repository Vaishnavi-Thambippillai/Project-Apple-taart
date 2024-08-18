<?php
include_once("includes/db.php");

$query = $pdo->prepare("SELECT * FROM locations");
$query->execute();
$locations = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review maken</title>
    <?php include_once("includes/head.php") ?>
</head>

<body>
    <?php include_once("includes/nav.php"); ?>
    <div class="review-form-container">
            <form action="submit_review.php" method="post">
            <h1>Review schrijven</h1>
            <label for="stars">Hoeveel sterren geeft u het bedrijf?:</label>
            <div class="star-rating">
                <input type="radio" id="5-stars" name="rating" value="1" />
                <label for="5-stars" class="star">★</label>
                <input type="radio" id="4-stars" name="rating" value="2" />
                <label for="4-stars" class="star">★</label>
                <input type="radio" id="3-stars" name="rating" value="3" />
                <label for="3-stars" class="star">★</label>
                <input type="radio" id="2-stars" name="rating" value="4" />
                <label for="2-stars" class="star">★</label>
                <input type="radio" id="1-star" name="rating" value="5" />
                <label for="1-star" class="star">★</label>
            </div>

            <label for="name">Wat is uw Naam?</label>
            <input type="text" id="name" name="name" required>

            <label for="location">Waar bent u geweest?</label>
            <div class="dropdown">
                <button type="button" onclick="toggleDropdown()" class="dropbtn" id="dropdownButton">Selecteer locatie</button>
                <div id="myDropdown" class="dropdown-content">
                    <?php
                    foreach ($locations as $location) {
                        echo "<a href='#' onclick=\"selectLocation('{$location['name']}, {$location['address']}')\">{$location['name']}, {$location['address']}</a>";
                    }
                    ?>
                    <br>
                </div>
                <input type="hidden" id="selectedLocation" name="location" required>
            </div>
            <br><br>
            <label for="date">Op welke datum bent u geweest?</label>
            <input type="date" id="date" name="date" required>

            <label for="experience">Kunt u meer over uw ervaring vertellen?</label>
            <textarea id="experience" name="experience" rows="4" cols="50" required></textarea>

            <button type="submit">Verzenden</button>
        </form>
    </div>

    <?php include_once("includes/footer.php"); ?>

    <script>
        function toggleDropdown() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        function selectLocation(location) {
            document.getElementById("dropdownButton").innerText = location;
            document.getElementById("selectedLocation").value = location;
            document.getElementById("myDropdown").classList.remove("show");
        }

        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const stars = document.querySelectorAll('.star');
            const radioButtons = document.querySelectorAll('.star-rating input');

            stars.forEach((star, index) => {
                star.addEventListener('click', () => {
                    radioButtons[index].checked = true;

                    stars.forEach((s, i) => {
                        if (i <= index) {
                            s.classList.add('checked');
                        } else {
                            s.classList.remove('checked');
                        }
                    });
                });
            });
        });
    </script>
</body>

</html>