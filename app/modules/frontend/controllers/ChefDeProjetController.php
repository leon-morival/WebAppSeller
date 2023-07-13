<?php
declare(strict_types=1);

namespace WebAppSeller\Modules\Frontend\Controllers;

use WebAppSeller\Models\Developpeur;
use WebAppSeller\Models\Collaborateur;



class DeveloppeurController extends ControllerBase
{
    public function indexAction()
    {
        // Fetch all applications
        $chefDeProjets = Developpeur::find(['include' => 'Collaborateur']);


        $this->view->setVar('developpeurs',$chefDeProjets);
    }
}
