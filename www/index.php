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
<div>
      <nav className=" drop-shadow-2xl bg-black text-slate-400">
        <ul>
          <div className="flex flex-row justify-between">
            <img className="w-36"  src="../www/documents/court-circuit-logo-rond-jaune-vert.png" alt="logo"  />
            <div className="flex flex-row ">
              <button className="indexNavBtn"> <li>Accueil</li> </button>
              <button className="indexNavBtn"> <li>page1</li> </button>
              <button className="indexNavBtn"> <li>page2</li> </button>
              <button className="indexNavBtn"> <li>page3</li> </button>
              <button className="indexNavBtn"> <li>a propos de nous</li> </button>
            </div>
          </div>
        </ul>
      </nav>
      <h1>Notre Site</h1>
    </div>
HTML;
