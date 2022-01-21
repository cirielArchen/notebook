<?php

declare(strict_types=1);

spl_autoload_register(function (string $classNamespace) {
    $path = str_replace(['\\', 'App/'], ['/', ''], $classNamespace);
    $path = "C:/xampp/htdocs/app/src/$path.php";
    require_once($path);
});

require_once("C:/xampp/htdocs/app/src/Utils/debug.php");
$configuration = require_once("C:/xampp/htdocs/app/config/config.php");

use App\Exception\AppException;
use App\Exception\ConfigurationException;
use App\Request;
use App\Controller\NoteController;
use App\Controller\AbstractController;

$request = new Request($_GET, $_POST, $_SERVER);

try {
    AbstractController::initConfiguration($configuration);
    (new NoteController($request))->run();
} catch (ConfigurationException $e) {
    //mail('support@app.pl', 'Error', $e->getMessage());
    echo '<h1>Wystąpił błąd w aplikacji</h1>';
    echo 'Wystąpił problem, administrator został poinformowany. Proszę spróbować za chwilę.';
} catch (AppException $e) {
    echo '<h1>Wystąpił błąd w aplikacji</h1>';
    echo '<h3>'.$e->getMessage().'</h3>';
} catch (Throwable $e) {
    echo '<h1>Wystąpił błąd w aplikacji</h1>';
    dump($e);
}
