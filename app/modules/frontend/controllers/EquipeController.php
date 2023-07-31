<?php
declare(strict_types=1);

namespace WebAppSeller\Modules\Frontend\Controllers;

use WebAppSeller\Models\Equipe;




class EquipeController extends ControllerBase
{
    public function indexAction()
    {
        // Fetch all applications
        $equipes = Equipe::find();


        $this->view->setVar('equipes',$equipes);
    }
}
