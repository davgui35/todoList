<?php

class BootstrapAlert
{
    private $text;
    private $options;

    public function __construct($text, $options = [])
    {
        $this->text = $text;
        $this->options = $options;
    }

    public function alert()
    {
        $color = $this->options['color'] ?? DANGER;
        //class par défault
        $class = ALERT . ' ' . ALERT . '-' . $color . '';
        //classes supplementaires
        $class = $this->options['class'] ?? '';
    }
}
