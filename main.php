<?php
// Include required libs;
include_once('app/classes/ChangeLogsPreview.class.php');
include_once('app/classes/ChangeLogEdit.class.php');

// Start user login session;
session_start();
$id = $_SESSION['id'];
$username = $_SESSION['username'];

// Get all changelogs for edit;
$changeLogs = new ChangeLogsPreview();

// Get selected editable id;
$editid = -1;
$editVersionCurrent;
$editDateCurrent;
$editChangeslistCurrent;

if(isset($_GET['editid'])) {
    $editid = $_GET['editid'];
    $selectedchange = new ChangeLogEdit($editid);

    // If user has selected some change log and pressed update button;
    if(isset($_POST['submit']) && $_POST['submit'] == 'submit') {
        $selectedchange->updateChanges($_POST['version'], $_POST['date'], $_POST['datalist']);
    }

    // If user has selected some change show them data in inputs about that changelog;
    $editVersionCurrent = $selectedchange->getVersion();
    $editDateCurrent = $selectedchange->getDate();
    $editChangeslistCurrent = $selectedchange->getChanges();
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
        <div class="content-container-admin">
           <h1 class="acp-greetings-text">Hello administrator, <span class="admin-name-highlight"><?=$username?></span>!</h1>
           <a href="logout.php" class="logout-btn">Logout</a>

            <div class="admin-control-body">
                <div class="admin-control-versions">
                    <ul>
                        <li class="changes-list-item">
                            <a href='add.php'>Add new changelog</a>
                        </li>
                        <li class="changes-list-item">
                            <a href='addtype.php'>Add new type</a>
                        </li>
                        <li class="changes-list-item">
                        </li>
                    <?php 
                    if(!$changeLogs->isDataEmpty()) {
                        $changes = $changeLogs->getAllChanges();
                        foreach($changes as $change) { 
                            $addSelectedClass = "";
                            if($editid!= -1 && $editid== $change['id']) {
                                $addSelectedClass = "class='active'";
                            }
                            echo '<li class="changes-list-item">';
                            echo "<a href='main.php?editid={$change['id']}' $addSelectedClass>{$change['version']}</a>";
                            echo '</li>';
                        }
                    }
                    ?>
                    </ul>
                </div>
                <div class="admin-control-actions">
                <?php if($editid!= -1) {?>
                    <form action="main.php?editid=<?=$editid?>" method="POST">
                        <label for="version">Version:</label>
                        <input type="text" name="version" id="version" placeholder="Enter changelog version" value="<?=$editVersionCurrent?>">
                        
                        <label for="date">Date:</label>
                        <input type="text" name="date" id="date" placeholder="Enter changelog date" value="<?=$editDateCurrent?>">
                        
                        <label for="datalist">Changes list:</label>
                        <div class="admin-control-suggestions">
                            <button class="badge-main-btn added" type="button">Added</button>
                            <button class="badge-main-btn updated" type="button">Updated</button>
                            <button class="badge-main-btn fixed" type="button">Fixed</button>
                            <button class="badge-main-btn removed" type="button">Removed</button>
                        </div>
                        <textarea name="datalist" id="datalist" placeholder="Enter changes"><?=$editChangeslistCurrent?></textarea>

                        <div class="admin-control-buttons">
                            <button type="submit" name="submit" value="submit" class="admin-control-form-btn update-btn">Update</button>
                            <a href="delete.php?id=<?=$editid?>" class="admin-control-form-btn delete-btn">Delete</a>
                        </div>

                    </form>
                    <?php } ?>
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
    <script src="js/editappend.js"></script>
    <!-- SCRIPTS -->

</body>
</html>