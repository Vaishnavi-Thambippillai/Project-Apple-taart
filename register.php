<?php
// it is linked here with the connection.php
include_once("includes/db.php");

if (isset($_SESSION['loggedInUser'])) {
    header("Location: index.php");
    die();
}

unset($_SESSION['error']);
// Handling form submission for registration
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $repeatPassword = $_POST['repeat'];

    if ($password !== $repeatPassword) {
        $_SESSION['error'] = "Passwords do not match.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        // Preparing SQL query to insert new user into database
        $query = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        // Executing the query
        if ($query->execute()) {
            header("Location: login.php");
            die();
        } else {
            // Setting error message if registration fails
            $_SESSION['error'] = "Error registering user.";
        }
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
    <!-- // this is the form for the register -->
    <main class="registerloginmain">
    <img src="assets/images/expresszo.png" alt="">

        <form method="post">
            <h1>Registreren</h1>
            <?php if (isset($_SESSION['error'])) { ?>
                <div style="color: red;"><?= $_SESSION['error']; ?></div>
            <?php } ?>
            <!-- Input fields for username, password, and repeat password -->
            <input autofocus minlength="2" maxlength="25" type="text" name="username" placeholder="Gebruikersnaam" required>
            <input minlength="5" maxlength="256" type="password" name="password" placeholder="Wachtwoord" required>
            <input minlength="5" maxlength="256" type="password" name="repeat" placeholder="Herhaal wachtwoord" required>
            <!-- Register button and link to login page -->
            <button name="register" type="submit">Register</button>
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