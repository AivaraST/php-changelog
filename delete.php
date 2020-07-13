<?php
include_once('lib/classes/ChangelogEdit.class.php');

$selectedchange = new ChangeLogEdit($_GET['id']);
$selectedchange->deleteChangelog();

header('location: main.php');