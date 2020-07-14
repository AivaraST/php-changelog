<?php
require __DIR__ . '/bootstrap.php';

use App\Admin;
use App\Auth;

// Get authenticated user data
$auth = new Auth();
$user = $auth->user();

// Get change logs
$admin = new Admin();
$changes = $admin->findAll();

// Create new change log if submitted form
if(isset($_POST['submit']) && $_POST['submit'] == 'submit') {
    if(isset($_POST['version']) && isset($_POST['date']) && isset($_POST['datalist'])) {
        $admin->create($_POST['version'], $_POST['date'], $_POST['datalist']);
    }
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/styles.css">
    
    <title>Changelog</title>
</head>
<body class="admin">
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
        <div class="content-container-admin">
           <h1 class="acp-greetings-text">Hello administrator, <span class="admin-name-highlight"><?=$user['username']?></span>!</h1>
           <a href="logout.php" class="logout-btn">Logout</a>

            <div class="admin-control-body">
                <div class="admin-control-versions">
                    <ul>
                        <li class="changes-list-item">
                            <a href='main.php'>Add new changelog</a>
                        </li>
                        <li class="changes-list-item">
                        </li>
                    <?php 
                    if(!empty($changes)) {
                        foreach($changes as $change) {
                            $addSelectedClass = "";
                            echo '<li class="changes-list-item">';
                            echo "<a href='edit.php?editid={$change['id']}' $addSelectedClass>{$change['version']}</a>";
                            echo '</li>';
                        }
                    }
                    ?>
                    </ul>
                </div>
                <div class="admin-control-actions">
                    <form action="main.php" method="POST">
                        <label for="version">Version:</label>
                        <input type="text" name="version" id="version" placeholder="Enter changelog version">

                        <label for="date">Date:</label>
                        <input type="text" name="date" id="date" placeholder="Enter changelog date">

                        <label for="datalist">Changes list:</label>
                        <div class="admin-control-suggestions">
                            <button class="badge-main-btn added" type="button">Added</button>
                            <button class="badge-main-btn updated" type="button">Updated</button>
                            <button class="badge-main-btn fixed" type="button">Fixed</button>
                            <button class="badge-main-btn removed" type="button">Removed</button>
                        </div>
                        <textarea name="datalist" id="datalist" placeholder="Enter changes"></textarea>

                        <div class="admin-control-buttons">
                            <button type="submit" name="submit" value="submit" class="admin-control-form-btn update-btn">Create</button>
                        </div>

                    </form>
                </div>
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
   <script src="./assets/js/bundle.js"></script>
    <!-- SCRIPTS -->

</body>
</html>