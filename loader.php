<?php
require('constantes.php');
// ORM et Modèles
require(DIR_MODELS . 'ORM.php');
require(DIR_MODELS . 'Validator.php');
require(DIR_MODELS . 'Todos.php');

// Utils
require(DIR_UTILS . 'Bootstrap.php');
require(DIR_UTILS . 'BootstrapForm.php');
require(DIR_UTILS . 'BootstrapAlert.php');
require(DIR_UTILS . 'BootstrapCard.php');

require(DIR_UTILS . 'Alert.php');
$Alert = new Alert; // Disponible partout dans toutes mes pages
