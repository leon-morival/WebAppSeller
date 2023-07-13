<?php
declare(strict_types=1);

namespace WebAppSeller\Modules\Frontend\Controllers;

use WebAppSeller\Models\ChefDeProjet;




class ChefDeProjetController extends ControllerBase
{
    public function indexAction()
    {
        // Fetch all applications
        $chefDeProjets = ChefDeProjet::find(['include' => 'Collaborateur']);


        $this->view->setVar('chefdeprojets',$chefDeProjets);
    }
}
