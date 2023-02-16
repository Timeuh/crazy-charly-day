<?php
namespace custumbox;
require_once "../vendor/autoload.php";

use custumbox\classes\dispatcher\Dispatcher;
use Illuminate\Database\Capsule\Manager as DB;


$db = new DB();
$db->addConnection(parse_ini_file("../src/conf/conf.ini"));
$db->setAsGlobal();
$db->bootEloquent();

$action = (isset($_GET['action'])) ? $_GET['action'] : "";
$dispatch = new Dispatcher($action);
$dispatch->run();

print <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Crazy Charly Day</title>
    <link href="styles/output.css" rel="stylesheet">
</head>
<body>
<div>
      <nav class="drop-shadow-2xl bg-black text-slate-400">
        <ul>
          <div class="flex flex-row justify-between">
            <img class="w-36"  src="../www/documents/court-circuit-logo-rond-jaune-vert.png" alt="logo"  />
            <div class="flex flex-row ">
              <button class="indexNavBtn"> <li>Accueil</li> </button>
              <button class="indexNavBtn"> <li>page1</li> </button>
              <button class="indexNavBtn"> <li>page2</li> </button>
              <button class="indexNavBtn"> <li>page3</li> </button>
              <button class="indexNavBtn"> <li>a propos de nous</li> </button>
            </div>
          </div>
        </ul>
      </nav>
      <h1>Notre Site</h1>
    </div>
</body>
</html>
HTML;
