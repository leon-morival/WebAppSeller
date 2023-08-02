<?php

declare(strict_types=1);

namespace WebAppSeller\Modules\Frontend\Controllers;

use WebAppSeller\Models\Projet;


class ProjetController extends ControllerBase
{
    public function indexAction()
    {

        $projets = Projet::find();

        $this->view->setVar('projets', $projets);
    }
}
