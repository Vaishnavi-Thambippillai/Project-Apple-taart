<?php
// it is linked with the connection.php here
include_once("includes/db.php");

if (isset($_SESSION['loggedInUser'])) {
    header("Location: index.php");
    die();
}

unset($_SESSION['error']);

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Preparing the SQL query to fetch user data by username    
    $query = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->execute();

    // Fetching user data
    $user = $query->fetch();

    if ($user !== false) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['loggedInUser'] = $user['userId'];
            header("Location: index.php");
            die();
        }
    }
    // Setting error message if login fails
    $_SESSION['error'] = "Username or password is invalid.";
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
    <!-- the form for the login -->
    <main class="registerloginmain">
        <img src="assets/images/dudok_rotterdam.png" alt="">
        <form method="post">

            <h1>Inloggen</h1>

            <?php if (isset($_SESSION['error'])) { ?>
                <div style="color: red;"><?= $_SESSION['error']; ?></div>
            <?php } ?>

            <input autofocus minlength="2" maxlength="25" type="text" name="username" placeholder="Gebruikersnaam" required>
            <input minlength="5" maxlength="256" type="password" name="password" placeholder="Wachtwoord" required>
            <!-- login button and link to the register page -->
            <button type="submit">Inloggen</button>

        </form>
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