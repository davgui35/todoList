<?php
define('PROCESS_FORM', 'FORM');
define('PROCESS_FORM_SESSION', 'FORM_');
define('PROCESS_FORM_SESSION_HELP', 'FORM_HELP_');
class Validator
{
    private $data = [];
    private $urlError;
    private $typeProcess;

    private $errors = false;

    private $Alert;
    private $Orm;

    public function __construct($data, $urlError, $typeProcess = PROCESS_FORM)
    {
        $this->typeProcess = $typeProcess;

        foreach ($data as $key => $value) {
            $cleanValue = strip_tags($value, '<p><b><i><br><strong>');

            $cleanValue = htmlentities($value);

            if ($this->typeProcess == PROCESS_FORM) {
                $_SESSION[PROCESS_FORM_SESSION . $key] = $cleanValue;
            }

            $this->data[$key] = $cleanValue;
        }

        $this->urlError = $urlError;

        $this->Alert = new Alert;
        $this->Orm = new Orm;
    }

    public function validateNumeric($field)
    {
        if (!isset($this->data[$field])) {
            die('Erreur [Val 003] Champ ' . $field . ' inconnu');
        }

        if (!is_numeric($this->data[$field])) {
            $this->alert($field, 'Erreur type. Valeur numérique attendue');
        }
    }

    private function alert($field, $text)
    {
        if ($this->typeProcess == PROCESS_FORM) {
            $this->Alert->setAlertForm($field, $text);
        }

        $this->errors = true;
    }

    public function validateExist($field, $tableAndField, $typePDO = PDO::PARAM_STR)
    {
        if (!isset($this->data[$field])) {
            die('Erreur [val 004] Champ' . $field . ' inconnu');
        }

        [$table, $tableField] = explode('.', $tableAndField);

        $this->Orm->setTable($table);
        $this->Orm->addWhereFields($tableAndField, $this->data[$field], '=', $typePDO);

        if ($this->Orm->get('count') == 0) {
            $this->alert($field, $this->data[$field] . ' n\'existe pas.');
        }
    }

    public function validateUnique($field, $tableAndField, $typePDO = PDO::PARAM_STR)
    {
        if (!isset($this->data[$field])) {
            die('Erreur [Val 004] Champ ' . $field . ' inconnu');
        }

        // "Multi attribution"
        [$table, $tableField] = explode('.', $tableAndField);

        // Travail avec l'ORM
        $this->Orm->setTable($table);
        $this->Orm->addWhereFields($tableField, $this->data[$field], '=', $typePDO);

        if ($this->Orm->get('count') != 0) {
            $this->alert($field, $this->data[$field] . ' existe déjà.');
        }
    }

    public function getData()
    {
        if ($this->errors) {
            $this->Alert->redirectAlert($this->urlError);
        }
        return $this->data;
    }
}
