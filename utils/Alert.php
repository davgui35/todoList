<?php

class Alert
{
    //set l'alerte
    public function alert($text, $options = [])
    {
        $_SESSION['SESSION_ALERT'] = [
            'text' => $text,
            'options' => $options
        ];
    }

    //redirect l'alerte
    public function redirect($link)
    {
        header('Location: ' . $link);
        exit();
    }

    //Retourne HTML
    public function getHtmlAlert()
    {
        if (!isset($_SESSION[SESSION_ALERT])) {
            return '';
        }

        $alert = new BootstrapAlert($_SESSION[SESSION_ALERT]['text'], $_SESSION[SESSION_ALERT]['options']);

        $this->unsetSession();

        return $alert->alert();
    }

    public function unsetSession()
    {
        unset($_SESSION[SESSION_ALERT]);
    }
}
