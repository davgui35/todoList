<?php
include('loader.php');
$todo = new Todos();

if (isset($_POST['creer'])) {

    var_dump($_POST);

    $validator = new Validator($_POST, 'index.php');
    $validator->validateUnique('title', 'todos.title');
    $data = $validator->getData();

    $todo->create(
        $data['title'],
        $data['content']
    );

    $Alert->setAlert('Tâche a été créé avec succès !', ['color' => SUCCESS]);
    $Alert->redirectAlert('index.php');
}


if (isset($_POST['modifier'])) {
    var_dump($_POST);
    $id = $_POST['id'];

    $validator = new Validator($_POST, 'index.php');
    $data = $validator->getData();
    if ($data['checked'] == 'on') {
        $data['checked'] = 1;
    }
    $forUpdate = [
        ['field' => 'title', 'value' => $data['title']],
        ['field' => 'content', 'value' => $data['content']],
        ['field' => 'checked', 'value' => $data['checked']]
    ];
    $todo->updateCheck($forUpdate, $id);

    $Alert->setAlert('La tâche a été modifié', ['color' => SUCCESS]);
    $Alert->redirectAlert('index.php');
}


if (isset($_GET['action'])) {
    var_dump($_GET);
    extract($_GET);
    $validator = new Validator($_GET, 'controller.php');
    $validator->validateNumeric('id');
    $data = $validator->getData();

    if ($action == 'delete' && !empty($id)) {
        $todo->deleteTask(
            $data['id']
        );
    }

    $Alert->setAlert('Tâches supprimées', ['color' => SUCCESS]);
    $Alert->redirectAlert('index.php');
}
