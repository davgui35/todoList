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

    public function showTasks()
    {
        $this->addOrder('id', 'DESC');
        $tasks = $this->get('all');
        return $tasks;
    }
}
