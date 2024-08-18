<?php
include_once("includes/db.php");
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
        <div class="slideshow">
            <div class="text">
                <h2>Welkom op Apple-taart!</h2>
                <p>Bij Apple-taart vind je de beste appeltaarten en locaties om ervan te genieten.
                    Ontdek onze top 3 favoriete plekken en proef de heerlijkste taarten.
                    Laat je inspireren door onze selectie en beleef de ultieme appeltaart ervaring.</p>
            <button onclick="window.location.href='#start';">Bekijk onze top 3!</button>
            </div>
            <img class="mySlides" src="assets/images/limburgia_den_bosch.png">
            <img class="mySlides" src="assets/images/appel-taart.png">
            <img class="mySlides" src="assets/images/de_bruine_boon.png">
        </div>
        <section id="start">
            <h2>Onze top 3 beste appel taarten!</h2>
            <div class="taart">
                <div onclick="window.location.href='locations.php?id=1';">
                    <img src="assets/images/len_bakkerij.png" alt="">
                    <h3>Len Bakkerij - <span>5.0</span></h3>
                </div>

                <div onclick="window.location.href='locations.php?id=2';">
                    <img src="assets/images/dudok_rotterdam.png" alt="">
                    <h3>Dudok Rotterdam - <span>4.8</span></h3>
                </div>

                <div onclick="window.location.href='locations.php?id=4';">
                    <img src="assets/images/coffee_corazon.png" alt="">
                    <h3>Coffee Corazon - <span>4.1</span></h3>
                </div>
            </div>

            <h2>Onze top 3 beste locaties!</h2>
            <div class="locaties">
                <div onclick="window.location.href='locations.php?id=1';">
                    <iframe class="iframe" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" loading="lazy" src="http://maps.google.nl/maps?f=q&amp;source=s_q&amp;hl=nl&amp;geocode=&amp;q=Kruseman+van+Eltenweg+4+1817+BC+Alkmaar&amp;z=15&amp;t=k&amp;output=embed"></iframe>
                    <h3>Len Bakkerij - <span>Alkmaar</span></h3>
                </div>

                <div onclick="window.location.href='locations.php?id=2'">
                    <iframe class="iframe" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" loading="lazy" src="http://maps.google.nl/maps?f=q&amp;source=s_q&amp;hl=nl&amp;geocode=&amp;q=Meent+88+3011+JP+Rotterdam&amp;z=15&amp;t=k&amp;output=embed"></iframe>
                    <h3>Dudok Rotterdam - <span>Rotterdam</span></h3>
                </div>

                <div onclick="window.location.href='locations.php?id=4'">
                    <iframe class="iframe" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" loading="lazy" src="http://maps.google.nl/maps?f=q&amp;source=s_q&amp;hl=nl&amp;geocode=&amp;q=Krommestraat+18+3811+CC+Amersfoort&amp;z=15&amp;t=k&amp;output=embed"></iframe>
                    <h3>Coffee Corazon - <span>Amersfoort</span></h3>
                </div>
            </div>
        </section>
    </main>

    <script src="assets/slide.js"></script>
    <?php
    include_once("includes/footer.php")
    ?>
</body>


</html>