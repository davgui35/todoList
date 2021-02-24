<?php
class Todos extends ORM
{
    public function __construct($id = null)
    {
        parent::__construct();
        $this->setTable('todos');

        if ($id != null) {
            $this->populate($id);
        }
    }

    public function create($title, $content)
    {
        $this->addInsertFields('title', $title, PDO::PARAM_STR);
        $this->addInsertFields('content', $content, PDO::PARAM_STR);
        $newId = $this->insert();
        $this->populate($newId);
    }

    public function updateCheck($datas, $id = null)
    {
        if ($id != null) {
            $this->addWhereFields('id', $id, '=', PDO::PARAM_INT);
        }
        foreach ($datas as $data) {
            $this->addUpdateFields($data['field'], $data['value']);
        }
        $idUpdate = $this->update();
        $this->populate($idUpdate);
    }

    public function showTasks()
    {
        $this->addOrder('id', 'DESC');
        $this->addWhereFields('checked', '0');
        $tasks = $this->get('all');
        return $tasks;
    }

    public function showTasksChecked()
    {
        $this->addOrder('id', 'DESC');
        $this->addWhereFields('checked', '1');
        $tasks = $this->get('all');
        return $tasks;
    }
}
