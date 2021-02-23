<?php
// Constantes liées à Bootstrap
define('WARNING', 'warning');
define('SUCCESS', 'success');
define('PRIMARY', 'primary');
define('SECONDARY', 'secondary');
define('DANGER', 'danger');
define('INFO', 'info');
define('LIGHT', 'light');
define('DARK', 'dark');

//Elements
define('BTN', 'btn');
define('BADGE', 'badge');
define('BG', 'bg');
class Bootstrap
{
    private $title;
    private $content;
    private $menuItems = [];

    public function __construct($title, $content)
    {
        $this->title = $title;
        $this->content = $content;
    }

    public function startDOM()
    {
        return '<!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="' . $this->content . '">
            <link rel="stylesheet" href="' . DIR_ASSETS . DIR_CSS . 'boostrap.css" ?>
            <title>' . NAME_APPLICATION . ' - ' . $this->title . '</title>
        </head>';
    }

    public function startMain()
    {
        return '<body><main class="container">';
    }
    public function endMain()
    {
        return '</main>';
    }

    public function endDOM()
    {
        return ' <script scr="' . DIR_ASSETS . DIR_JS . 'bootstrap.min.js"></script>
                </body></html>';
    }
}
