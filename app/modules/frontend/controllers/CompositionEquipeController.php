<?php
declare(strict_types=1);

namespace WebAppSeller\Modules\Frontend\Controllers;

// CompositionEquipeController
use WebAppSeller\Models\CompositionEquipe;
use WebAppSeller\Models\Developpeur;
use WebAppSeller\Models\Equipe;


class CompositionEquipeController extends ControllerBase
{
    public function indexAction()
    {
        // Fetch all compositions (teams) along with their associated developers
        $equipes = CompositionEquipe::find(['with' => 'Developpeurs']);

        // Group the developers by team name
        $groupedCompositions = [];
        foreach ($equipes as $equipe) {
            $teamName = $equipe->getEquipe()->getLibelle();
            $groupedCompositions[$teamName][] = $equipe;
        }

        $this->view->setVar('groupedCompositions', $groupedCompositions);

        //Equipe
        $equipe = Equipe::find();
        $this->view->setVar('equipes',$equipe);

        //Développeur
        $developpeurs = Developpeur::find();
        $this->view->setVar('developpeurs',$developpeurs);
    }
    public function saveAction()
    {
        if ($this->request->isPost()) {
            $equipe = new Equipe();

            $team_name = $this->request->getPost('team_name', 'string');
            $chef = $this->request->getPost('chef', 'int');
            $developpeurs = $this->request->getPost('developpeur');

            $equipe->setIdChefDeProjet($chef);
            $equipe->setLibelle($team_name);

            // Save the equipe first
            if ($equipe->save()) {
                $equipe_id = $equipe->getId();

                // Now create CompositionEquipe records for each developer
                foreach ($developpeurs as $developerId) {
                    $composition = new CompositionEquipe();
                    $composition->setIdEquipe($equipe_id);
                    $composition->setIdDeveloppeur($developerId);
                    if (!$composition->save()) {
                        echo "Failed to add composition for developer ID: " . $developerId . ".<br>";
                    }
                }

                $this->response->redirect('WebAppSeller/composition_equipe/index');
                $this->view->disable();
            } else {
                echo "Failed to add equipe.";
            }
        }
    }




}
