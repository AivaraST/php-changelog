<?php
include_once('lib/classes/ChangeLogsPreview.class.php');

$changeLogs = new ChangeLogsPreview();
$version = $changeLogs->getCurrentVersion();
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
                    <span id="versionNumberHead"><?=$version?></span>
                </div>
            </div>
        </div>
    </header>
   <!--END: Heading text section area-->

   <!--START: List of changes section area-->
    <section class="change-log-section">
        <div class="content-container">
            <div class="changelog-main-block">
                <div class="changelog-slide-bg"></div>
                <!--Version area-->
                <?php 
                if(!$changeLogs->isDataEmpty()) {
                    $changes = $changeLogs->getAllChanges();
                    foreach($changes as $change) { 
                        $datalist = explode(PHP_EOL, $change['datalist']);
                        echo '<div class="change-log-version">';
                        echo '<span class="change-log-dot"></span>';
                        echo '<div class="change-log-line"></div>';
                        echo "<h1>{$change['version']} ({$change['date']})</h1>";
                        echo '<ul class="changes-list">';
                            foreach($datalist as $dl) {
                                echo '<li class="changes-list-item">';
                                if(strpos($dl, "[added]") !== false) {
                                    $upd = str_replace("[added]", "", $dl);
                                    echo "<span class='badge-main added'>Added</span>$upd";
                                }
                                if(strpos($dl, "[updated]") !== false) {
                                    $upd = str_replace("[updated]", "", $dl);
                                    echo "<span class='badge-main updated'>Updated</span>$upd";
                                }
                                if(strpos($dl, "[fixed]") !== false) {
                                    $upd = str_replace("[fixed]", "", $dl);
                                    echo "<span class='badge-main fixed'>Fixed</span>$upd";
                                }
                                if(strpos($dl, "[removed]") !== false) {
                                    $upd = str_replace("[removed]", "", $dl);
                                    echo "<span class='badge-main removed'>Removed</span>$upd";
                                }
                                echo '</li>';
                            }
                        echo '</ul>';
                        echo '</div>';
                    }
                }
                ?>
                <!--Version area-->
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