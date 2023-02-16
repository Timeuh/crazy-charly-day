<?php
namespace custumbox;
require_once "../vendor/autoload.php";

use custumbox\classes\data\User;
use custumbox\classes\dispatcher\Dispatcher;
use Illuminate\Database\Capsule\Manager as DB;


$db = new DB();
$db->addConnection(parse_ini_file("../src/conf/conf.ini"));
$db->setAsGlobal();
$db->bootEloquent();

session_start();
$_SESSION['user'] = User::where('id', '=', 1)->first();
$action = (isset($_GET['action'])) ? $_GET['action'] : "";
$dispatch = new Dispatcher($action);
$dispatch->run();


