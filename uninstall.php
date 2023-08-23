<?php

require_once('modules/InfoManager.php');

if (!defined('ABSPATH') || !function_exists('add_action')) {
    echo "Bro, you are really curious...";
    exit;
}

$infoMan = new InfoManager();
$infoMan->dropAllTables();