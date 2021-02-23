<?php
define('METHOD_POST', 'post');
define('METHOD_GET', 'get');
define('METHODS', [METHOD_POST, METHOD_GET]);

define('TYPE_TEXT', 'text'); // Champ texte
define('TYPE_PASSWORD', 'password'); // Champ mot de passe
define('TYPE_NUMBER', 'number'); // Champ numérique
define('TYPE_EMAIL', 'email'); // Champ mail
define('TYPE_HIDDEN', 'hidden'); // Champ caché
define('TYPE_SELECT', 'select'); // select
define('TYPE_TEXTAREA', 'textarea'); // textarea
define('TYPE_CHECKBOX', 'checkbox'); // checkbox
define('TYPES', [TYPE_TEXT, TYPE_PASSWORD, TYPE_NUMBER, TYPE_HIDDEN, TYPE_EMAIL, TYPE_SELECT, TYPE_TEXTAREA]);

define('FORM_CONTROL', 'form-control');
define('FORM_SELECT', 'form-select');
define('FORM_LABEL', 'form-label');
class BootstrapForm
{
    private $name;
    private $method;
    private $action;

    private $inputs = [];
    private $submit = [];

    private $htmlAttributs = [];

    public function __construct($name, $action, $method = METHOD_POST)
    {
        $this->name = $name;
        if (!in_array($method, METHODS)) {
            die('Erreur fatale [BF 001 mauvaise configuration du formulaire '  . $name);
        }
        $this->method = $method;
        $this->action = $action;
    }

    //Initialisation de l'input
    public function addInput($name, $type, $options = [])
    {
        if (!in_array($type, TYPES)) {
            die('Erreur fatale [BF 002] mauvaise configuration du type ' . $name);
        }

        $this->inputs[] = [
            'name' => $name,
            'type' => $type,
            'options' => $options
        ];
    }

    //Html d'un input
    public function input($name, $type, $options = []): string
    {
        $input = '<div class="mb-3">';

        $idName =  $this->slug($this->name . ' ' . $name);
        $this->htmlAttributs = '';

        if ($type !== TYPE_HIDDEN) {
            $label = $options['label'] ?? $name;
            $input .= '<label for="' . $idName . '" class="' . FORM_LABEL . '">' . $label . '</label>';
            $this->handleHtmlAttributs($options, 'placeholder');
        }
        $class = $options['class'] ?? '';

        switch ($type) {
            case TYPE_TEXTAREA:
                $rows = $options['rows'] ?? 3;
                $input .= '<textarea class="' . FORM_CONTROL . '" name="' . $name . '" id="' . $idName . '" rows="' . $rows . '"></textarea>';
                break;
            case TYPE_CHECKBOX:
                $input .= '<input class="form-check-input" type="' . TYPE_CHECKBOX . '" id="' . $idName . '">';
                break;
            default:
                if ($type !== TYPE_PASSWORD) {
                    $this->handleValue($name, $options);
                }
                $input .= '<input type="' . $type . '" name="' . $name . '" class="' . FORM_CONTROL . ' ' . $class . ' " id="' . $idName . '" ' . $this->htmlAttributs . '>';
                break;
        }
        $input .= '</div>';
        return $input;
    }

    //Ajouter des attributs (placeholder = 'valeur du champ' )
    private function handleHtmlAttributs($options, $field)
    {
        if (isset($options[$field])) {
            $this->htmlAttributs .= $field . '="' . $options[$field] . '"';
        }
    }

    private function handleValue($name, $options)
    {
        if (isset($_SESSION[PROCESS_FORM_SESSION . $name])) {
            $this->htmlAttributs .= 'value="' . $_SESSION[PROCESS_FORM_SESSION . $name] . '"';
            unset($_SESSION[PROCESS_FORM_SESSION . $name]);
        } else {
            $this->handleHtmlAttributs($options, 'value');
        }
    }

    public function setSubmit($name, $options = [])
    {
        // $form->setSubmit('Je m\'inscris', ['color' => SUCCESS]);
        $this->submit = [
            'name' => $name,
            'options' => $options
        ];
    }

    private function submit()
    {
        $color = $this->submit['options']['color'] ?? PRIMARY;
        $class = $this->submit['options']['class'] ?? '';
        return ' <button type="submit" value="' . $this->submit['name'] . '" name="' . lcfirst($this->submit['name']) . '" class="' . BTN . ' ' . BTN . '-' . $color . ' mb-3 ' . $class . '">' . $this->submit['name'] . '</button>';
    }

    //Permet de mettre un slug au nom (nouveau_todo_)
    public function slug($string): string
    {
        return strtolower(preg_replace('/[^A-Za-z0-9-]+/', '_', $string));
    }

    //Pour le formulaire
    public function form()
    {
        // Début du formulaire
        $form = '<form method="' . $this->method . '" action="' . $this->action . '">';

        // Pour savoir, sur la page d'atterissage, quel est le formulaire soumis
        $form .= $this->input($this->name, TYPE_HIDDEN);

        // Inputs
        foreach ($this->inputs as $input) {
            $form .= $this->input($input['name'], $input['type'], $input['options']);
        }

        // Submit
        $form .= $this->submit();

        // Fin du formulaire
        $form .= '</form>';

        return $form;
    }
}
