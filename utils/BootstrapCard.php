<?php
class BootstrapCard
{

    public function addCardHtml($title, $description, $link = '')
    {
        return '<div class="card m-2">
        <div class="card-header">
            <h5 class="card-title">' . $title . '</h5>
       </div>
       <div class="card-body">
           <p class="card-text">' . $description . '</p>
       </div>
       </div> ';
    }
    // :TODO => faire la carte par défaut
    //- checkbox / la description/title / favoris / 
    //:TODO => Faire la validation des données de la carte
}
