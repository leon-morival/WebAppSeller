<?php
declare(strict_types=1);

namespace WebAppSeller\Modules\Frontend\Controllers;

// CompositionEquipeController
use WebAppSeller\Models\CompositionEquipe;
use WebAppSeller\Models\Developpeur;
use WebAppSeller\Models\Equipe;
use WebAppSeller\Models\ChefDeProjet;


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

        //Chef de Projet
        $chefDeProjets = ChefDeProjet::find();
        $this->view->setVar('chefdeprojets',$chefDeProjets);
    }
    public function saveAction()
    {
        if ($this->request->isPost()) {
            $equipe = new Equipe();

            $team_name = $this->request->getPost('team_name', 'string');
            $chef = $this->request->getPost('chef', 'int');
            $developpeurs = $this->request->getPost('developpeur');

            // Check if a team with the same name already exists
            if (Equipe::teamExists($team_name)) {
                echo "Une équipe avec le nom '$team_name' existe déjà." . "<br>". "<a href='/WebAppSeller/composition_equipe' class='btn btn-primary'>Retour</a>";
                return;
            }

            // Validate the number of selected developers
            if (!CompositionEquipe::validateDeveloperCount($developpeurs)) {
                echo "Veuillez sélectionner au moins un développeur et jusqu'à trois développeurs." . "<br>". "<a href='/WebAppSeller/composition_equipe' class='btn btn-primary'>Retour</a>";
                return;
            }

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
                        echo "Échec de l'ajout de la composition pour l'ID du développeur: " . $developerId . ".<br>";
                    }
                }

                $this->response->redirect('WebAppSeller/composition_equipe/index');
                $this->view->disable();
            } else {
                echo "Échec de l'ajout de l'équipe.";
            }
        }
    }


    public function deleteAction()
    {
        if ($this->request->isPost()) {
            $id = $this->request->getPost('id', 'int');

            // Find all records in CompositionEquipe with the given id_equipe
            $compositions = CompositionEquipe::find([
                'conditions' => 'id_equipe = :id:',
                'bind' => ['id' => $id]
            ]);

            if ($compositions->count() > 0) {
                // Delete all found records in CompositionEquipe
                foreach ($compositions as $composition) {
                    if (!$composition->delete()) {
                        echo "La suppression de la composition n'a pas fonctionné.";
                        return;
                    }
                }

                // Find the corresponding record in equipe
                $equipe = Equipe::findFirstById($id);

                if ($equipe) {
                    // Delete the record from equipe table
                    if ($equipe->delete()) {
                        $this->response->redirect('WebAppSeller/composition_equipe/index');
                        $this->view->disable();
                    } else {
                        echo "La suppression de l'équipe n'a pas fonctionné.";
                    }
                } else {
                    echo "Équipe non trouvée avec l'ID: " . $id;
                }
            } else {
                echo "Aucune composition trouvée pour l'équipe avec l'ID: " . $id;
            }
        }
    }






}
