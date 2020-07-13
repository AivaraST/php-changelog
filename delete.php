<?php
include_once('app/classes/ChangeLogEdit.class.php');

$selectedchange = new ChangeLogEdit($_GET['id']);
$selectedchange->deleteChangelog();

header('location: main.php');