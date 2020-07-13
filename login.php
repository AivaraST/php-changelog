<?php

include_once('lib/classes/UserLogin.class.php');

$error = false;
$errorMessage = "";

if(isset($_POST['submit']) && $_POST['submit'] == 'submit') {
    $user = new UserLogin();
    try {
        $user->loginUser($_POST['username'], $_POST['password']);
    }
    catch (Exception $e) {
        $error = true;
        $errorMessage = $e->getMessage();
    }
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    
    <title>Changelog</title>
</head>
<body>
   <!--START: Heading text section area-->
    <header class="header-section">
        <div class="content-container">
            <div class="heading-text">
                <h1>Server changelog</h1>
                <div class ="heading-text-sub">
                    <span id="versionNumberHead">Admin CP</span>
                </div>
            </div>
        </div>
    </header>
   <!--END: Heading text section area-->

   <!--START: List of changes section area-->
    <section class="change-log-section">
        <div class="content-container">
            <div class="login-form">
                <form action="login.php" method="POST">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" placeholder="Enter your login username">
                    
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" placeholder="Enter your login password">
                    
                    <?php if($error) {?>
                        <span class="error-message"><?=$errorMessage?></span>
                    <?php }?>

                    <div class="login-form-buttons-block">
                        <button type="submit" name="submit" value="submit" class="login-form-button login-btn">Login</button>
                        <a href="index.php" class="login-form-button home-btn">Go back</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!--END: List of changes section area-->

    <!--START: Footer area-->
    <footer class="footer-section">
        Aivaras &#9400; 2019 (<a href="login.php">Admin</a>)
    </footer>
    <!--END: Footer area-->

    <!-- SCRIPTS -->
    <script src="https://kit.fontawesome.com/e357e65244.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script src="js/scripts.js"></script>
    <!-- SCRIPTS -->

</body>
</html>