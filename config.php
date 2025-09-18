<?php

/**
 * Configuration for database connection
 *
 */

$host       = "datadb.ckbu20c2ie89.us-east-1.rds.amazonaws.com";
$username   = "admin";
$password   = "4t.WM]CYAg-vY(Hxywlpp51EhY6W";
$dbname     = "datadb"; // will use later
$dsn        = "mysql:host=$host;dbname=$dbname"; // will use later
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );
?>