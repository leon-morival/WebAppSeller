<?php
declare(strict_types=1);

namespace WebAppSeller\Modules\Frontend\Controllers;

// CompositionEquipeController
use WebAppSeller\Models\CompositionEquipe;

class CompositionEquipeController extends ControllerBase
{
    public function indexAction()
    {
        // Fetch all compositions (teams) along with their associated developers
        $compositions = CompositionEquipe::find(['with' => 'Developpeurs']);

        // Group the developers by team name
        $groupedCompositions = [];
        foreach ($compositions as $composition) {
            $teamName = $composition->getEquipe()->getLibelle();
            $groupedCompositions[$teamName][] = $composition;
        }

        $this->view->setVar('groupedCompositions', $groupedCompositions);
    }
}
