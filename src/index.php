<?php

use Illuminate\Database\Capsule\Manager as DB;

$db = new DB();
$db->addConnection(parse_ini_file("../conf/conf.ini"));
$db->setAsGlobal();
$db->bootEloquent();
