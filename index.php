<?php
include('loader.php');

$html = new Bootstrap('Accueil', NAME_APPLICATION);
echo $html->startDOM();
echo $html->startMain();
?>
<?php
?>
<div class="container-fluid col-md-6">
    <h1 class="text-center">Todoslist</h1>
    <div class="row text-center  bg-light rounded">
        <?php
        $form = new BootstrapForm('todos', 'controllers/controller.php', METHOD_POST);
        $form->addInput('Titre', TYPE_TEXT, ['placeholder' => 'Ecrivez votre tâche']);
        $form->addInput('Description', TYPE_TEXTAREA, ['placeholder' => 'Description de la tâche']);
        $form->setSubmit('Valider', ['class' => 'col-6']);
        echo $form->form();
        ?>
    </div>
</div>
<?php
// var_dump($form);
echo $html->endMain();
echo $html->endDOM();
