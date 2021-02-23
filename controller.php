<?php
include('loader.php');

if (isset($_POST['creer'])) {

    var_dump($_POST);

    $validator = new Validator($_POST, 'index.php');
    $validator->validateUnique('title', 'todos.title');
    $data = $validator->getData();

    $todo = new Todos();
    $todo->create(
        $data['title'],
        $data['content']
    );

    $Alert->setAlert('Tâche a été créé avec succès !', ['color' => SUCCESS]);
    $Alert->redirectAlert('index.php');
}
