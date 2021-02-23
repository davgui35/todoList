<?php
class todos extends ORM
{
    private $title;
    private $description;

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
}
