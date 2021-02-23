<?php
// Démarrage de la session, pour utiliser $_SESSION
session_start();
include('loader.php');

$html = new Bootstrap('Accueil', NAME_APPLICATION);
echo $html->startDOM();
echo $html->startMain();

$tasks = new Todos();
// var_dump($tasks->showTasks());


?>
<!-- Form for addTodo -->
<div class="container-fluid col-md-6">
    <h1 class="text-center">Todoslist</h1>
    <div class="row text-center  bg-light rounded">
        <?php
        $form = new BootstrapForm('todos', 'controller.php', METHOD_POST);
        $form->addInput('title', TYPE_TEXT, ['label' => 'Titre', 'placeholder' => 'Ajouter une tâche']);
        $form->addInput('content', TYPE_TEXTAREA, ['label' => 'Description', 'placeholder' => 'Description de la tâche', 'rows' => 2]);
        $form->setSubmit('Creer', ['class' => 'col-6']);
        echo $form->form();
        ?>
    </div>
</div>

<div class="container">
    <?php foreach ($tasks->showTasks() as $task) : ?>
        <div class="card m-2">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title"><?= $task->title; ?></h5>
                <?php
                $form = new BootstrapForm('card', 'controller.php', METHOD_POST);
                $form->addInput('checked ',  TYPE_CHECKBOX, ['label' => 'Fait']);
                $form->setSubmit('Terminer', ['class' => 'btn-sm', 'color' => WARNING]);
                echo $form->form(); ?>
            </div>
            <div class="card-body">
                <p class="card-text"><?= $task->content; ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>
</div>
<?php
// var_dump($form);
echo $html->endMain();
echo $html->endDOM();
