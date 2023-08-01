<?php
declare(strict_types=1);

namespace WebAppSeller\Modules\Frontend\Controllers;

use WebAppSeller\Models\CompositionEquipe;
use WebAppSeller\Models\ChefDeProjet;
use WebAppSeller\Models\Equipe;

class CompositionEquipeController extends ControllerBase
{
    public function indexAction()
    {
        // Fetch all applications with 'ChefDeProjet' and 'equipe' included
        $compositions = CompositionEquipe::find(['include' => ['Developpeur', 'Equipe']]);

        $this->view->setVar('compositions', $compositions);
    }
}
