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
    <p class="text"><?= $Alert->getAlertHTML(); ?></p>
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

<div class="container-fluid">
    <h2 class="text-center">Tâches à faire</h2>
    <?php if (count($tasks->showTasks()) > 0) : ?>
        <div class="row">
            <?php foreach ($tasks->showTasks() as $task) : ?>
                <div class="col-sm-3">
                    <div class="card m-2">
                        <div class="card-header">
                            <h5 class="card-title"><?= $task->title; ?></h5>
                        </div>
                        <div class="card-body">
                            <?php
                            $form = new BootstrapForm('card', 'controller.php?id=' . $task->id . '', METHOD_POST);
                            $form->addInput('id', TYPE_HIDDEN, ['value' => $task->id]);
                            $form->addInput('title', TYPE_TEXT, ['label' => 'Titre à modifier', 'placeholder' => 'Ajouter une tâche', 'value' => $task->title]);
                            $form->addInput('content', TYPE_TEXT, ['label' => 'Contenu à modifier', 'placeholder' => 'Description de la tâche', 'value' => $task->content]);
                            $form->addInput('checked', TYPE_CHECKBOX, ['label' => 'Tâche effectuée ']);
                            $form->setSubmit('Modifier', ['class' => 'btn-sm', 'color' => WARNING]);
                            echo $form->form(); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
<?php if (count($tasks->showTasksChecked()) > 0) : ?>
    <div class="container-fluid bg-secondary rounded">
        <h2 class="text-center">Tâches Terminées</h2>
        <?php foreach ($tasks->showTasksChecked() as $taskChecked) : ?>
            <div class="card m-2">
                <div class="card-header">
                    <?= $taskChecked->title; ?>
                </div>
                <div class="card-body d-flex justify-content-between">
                    <h5 id="ckeck-task"><?= $taskChecked->content; ?></h5>
                    <p><a href="controller.php?action=delete&id=<?= $taskChecked->id; ?>" class="btn btn-danger">Supprimer</a></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php
// var_dump($form);
echo $html->endMain();
echo $html->endDOM();
