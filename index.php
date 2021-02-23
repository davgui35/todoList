<?php
// Démarrage de la session, pour utiliser $_SESSION
session_start();
include('loader.php');

$html = new Bootstrap('Accueil', NAME_APPLICATION);
echo $html->startDOM();
echo $html->startMain();
?>
<?php
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
        // var_dump($_POST);
        ?>
    </div>
</div>

<div class="container">
    <?php if (isset($_POST['title']) && isset($_POST['content'])) {
        $card = new BootstrapCard();
        echo $card->addCardHtml($_POST['title'], $_POST['content']);
    }
    ?>
</div>
<?php
// var_dump($form);
echo $html->endMain();
echo $html->endDOM();
