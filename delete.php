<?php
include_once('app/classes/ChangelogEdit.class.php');

$selectedchange = new ChangeLogEdit($_GET['id']);
$selectedchange->deleteChangelog();

header('location: main.php');