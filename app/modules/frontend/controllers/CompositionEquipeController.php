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
        // Récupérer toutes les compositions avec les développeurs associés
        $equipes = CompositionEquipe::find(['with' => 'Developpeurs']);

        // Regrouper les compositions par nom d'équipe
        $groupedCompositions = [];
        foreach ($equipes as $equipe) {
            $teamName = $equipe->getEquipe()->getLibelle();
            $groupedCompositions[$teamName][] = $equipe;
        }

        // Calculer les moyennes
        $groupedAverages = [];
        foreach ($groupedCompositions as $teamName => $compositions) {
            $totalDevelopers = count($compositions);
            $averageProduction = $totalDevelopers > 0 ? array_sum(array_map(function ($composition) {
                    return $composition->getDeveloppeur()->getIndiceProduction();
                }, $compositions)) / $totalDevelopers : 0;

            $totalBoost = array_sum(array_map(function ($composition) {
                return $composition->getEquipe()->getChefDeProjet()->getBoostProduction();
            }, $compositions));

            $averageProduction += ($averageProduction * $totalBoost) / (100 * $totalDevelopers);

            $groupedAverages[$teamName] = round($averageProduction, 2);
        }

        // Définir les variables de vue
        $this->view->setVars([
            'groupedCompositions' => $groupedCompositions,
            'groupedAverages' => $groupedAverages,
            'equipes' => Equipe::find(),
            'developpeurs' => Developpeur::find(),
            'chefdeprojets' => ChefDeProjet::find(),
        ]);
    }





    public function saveAction()
    {
        if ($this->request->isPost()) {
            $equipe = new Equipe();

            $team_name = $this->request->getPost('team_name', 'string');

            $chef = $this->request->getPost('chef', 'int');
            $developpeurs = $this->request->getPost('developpeur');

            // Vérifie si une équipe avec le même nom existe déjà
            if (Equipe::teamExists($team_name)) {
                echo "Une équipe avec le nom '$team_name' existe déjà." . "<br>" . "<a href='/WebAppSeller/composition_equipe' class='btn btn-primary'>Retour</a>";
                return;
            }
//             Vérifie si l'un des développeurs sélectionnés appartient déjà à une autre équipe avec le même Chef de Projet
            if (CompositionEquipe::developerExists($developpeurs, $chef)) {
                echo "L'un des développeurs sélectionnés appartient déjà à une autre équipe avec le même Chef de Projet." . "<br>" . "<a href='/WebAppSeller/composition_equipe' class='btn btn-primary'>Retour</a>";
                return;
            }
            // Valide le nombre de développeurs sélectionnés
            if (!CompositionEquipe::validateDeveloperCount($developpeurs)) {
                echo "Veuillez sélectionner au moins un développeur et jusqu'à trois développeurs." . "<br>" . "<a href='/WebAppSeller/composition_equipe' class='btn btn-primary'>Retour</a>";
                return;
            }

            $equipe->setIdChefDeProjet($chef);
            $equipe->setLibelle($team_name);

            // Sauvegarde d'abord l'équipe
            if ($equipe->save()) {
                $equipe_id = $equipe->getId();

                // Crée maintenant des enregistrements CompositionEquipe pour chaque développeur
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

            // Trouve tous les enregistrements de CompositionEquipe avec l'id_equipe donné
            $compositions = CompositionEquipe::find([
                'conditions' => 'id_equipe = :id:',
                'bind' => ['id' => $id]
            ]);

            if ($compositions->count() > 0) {
                // Supprime tous les enregistrements trouvés dans CompositionEquipe
                foreach ($compositions as $composition) {
                    if (!$composition->delete()) {
                        echo "La suppression de la composition n'a pas fonctionné.";
                        return;
                    }
                }

                // Trouve l'enregistrement correspondant dans la table equipe
                $equipe = Equipe::findFirstById($id);

                if ($equipe) {
                    // Supprime l'enregistrement de la table equipe
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

    public function selectAction(){
        if($this->request->isPost()){
            $this->response->redirect("WebAppSeller/composition_equipe/index");
        }
    }
}
