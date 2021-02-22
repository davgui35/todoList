<?php
include('loader.php');

$form = new BootstrapForm('todo', 'controllers/controller.php');
echo $form->addInput('todo', 'text', ['placeholder' => 'Entrez votre tâche']);
echo $form->setSubmit('valider');
echo $form->form();
var_dump($form);
