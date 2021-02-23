<?php
define('SESSION_ALERT', 'session_alert');
//à utiliser : $_SESSION[SESSION_ALERT]
class Alert
{
    //Pas de constructeur

    //Méthode qui set mon alert dans ma session
    public function setAlert($text, $options = [])
    {
        $_SESSION[SESSION_ALERT] = [
            'text' => $text,
            'options' => $options
        ];
    }

    //Méthode qui set une alert de formulaire en session
    public function setAlertForm($field, $text)
    {
        $_SESSION[PROCESS_FORM_SESSION_HELP . $field] = $text;
    }

    //Methode qui redirige
    public function redirectAlert($link)
    {
        header('Location: ' . $link);
        exit;
    }


    //Methode qui renvoie l'HTML de l'alert
    public function getAlertHTML()
    {
        if (!isset($_SESSION[SESSION_ALERT])) {
            return '';
        }
        //Stocke dans la variable alert mon HTML de la class BOOTSTRAPALERT(instancie)
        $alert = new BootstrapAlert($_SESSION[SESSION_ALERT]['text'], $_SESSION[SESSION_ALERT]['options']);

        $this->unsetSession();
        //Retourne mon HTML avec la méthode alert de BootstrapAlert
        return $alert->alert();
    }


    //Méthode qui vide la session

    private function unsetSession()
    {
        //Vide la session
        unset($_SESSION[SESSION_ALERT]);
    }
}
