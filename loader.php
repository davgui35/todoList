<?php
// Démarrage de la session, pour utiliser $_SESSION
session_start();

// Constantes-----------------------
define('DIR_CONSTANTES', 'constantes' . DIRECTORY_SEPARATOR);
require(DIR_CONSTANTES . 'system.php');
require(DIR_CONSTANTES . 'bootstrap.php');
require(DIR_CONSTANTES . 'session.php');

function loader($class)
{
    $folders = [
        DIR_MODELS,
        DIR_CONTROLLERS,
        DIR_UTILS
    ];

    foreach ($folders as $folder) {
        $fileName = $folder . $class . '.php';
        if (file_exists($fileName)) {
            require($fileName);
            return true;
        }
    }
}

//Chargement automatique des classes
spl_autoload_register('loader');
