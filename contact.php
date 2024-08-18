<?php
include_once("includes/db.php");

if (!isset($_SESSION['loggedInUser'])) {
    header("Location: login.php");
    die();
}

unset($_SESSION['error']);

if (isset($_POST['onderwerp']) && isset($_POST['email']) && isset($_POST['tel'])) {
    $contactQuery = $pdo->prepare("INSERT INTO `contact` (`username`, `onderwerp`, `email`, `tel`) VALUES (:username, :onderwerp, :email, :tel);");
    $contactQuery->bindParam(':username', $user['username']);
    $contactQuery->bindParam(':onderwerp', $_POST['onderwerp']);
    $contactQuery->bindParam(':email', $_POST['email']);
    $contactQuery->bindParam(':tel', $_POST['tel']);

    try {
        $contactQuery->execute();
        $_SESSION['error'] = "We hebben je bericht ontvangen!";
    } catch (PDOException $th) {
        error_log($th);
        die();
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
    <div class="registerloginmain">
        <span>
            <h3>Neem contact met ons op:</h3>
            <p>We nemen zo snel mogelijk contact met je op.</p>
            <img src="assets/images/limburgia_den_bosch.png" alt="">

        </span>

        <?php if (isset($_SESSION['error'])) { ?>
            <div style="color: green;"><?= $_SESSION['error']; ?></div>
        <?php } ?>

        <form method="post">
            <input type="text" name="onderwerp" placeholder="Onderwerp" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="tel" name="tel" placeholder="Telefoon nummer" required>
            <button type="submit">Stuur</button>
        </form>
    </div>

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