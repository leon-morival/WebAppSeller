<?php
declare(strict_types=1);

namespace WebAppSeller\Modules\Frontend\Controllers;

use WebAppSeller\Models\Client;
use WebAppSeller\Models\Collaborateur;

class CollaborateurController extends ControllerBase
{
    public function indexAction()
    {
        // Fetch all applications
        $collaborateurs = Collaborateur::find();


        $this->view->setVar('collaborateurs', $collaborateurs);
    }
    public function saveAction()
    {

        if ($this->request->isPost()) {

            $collaborateur = new Collaborateur();

            $nom = $this->request->getPost('nom_collaborateur', 'string');
            $prenom = $this->request->getPost('prenom_collaborateur', 'string');
            $prime_embauche = $this->request->getPost('prime_embauche', 'int');
            $niveau_competence = $this->request->getPost('niveau_competence', 'int');

            $collaborateur->setNom(strtoupper($nom));
            $collaborateur->setPrenom(strtolower($prenom));
            $collaborateur->setPrimeEmbauche($prime_embauche);
            $collaborateur->setNiveauCompetence($niveau_competence);


            // Enregistrer le client
            if ($collaborateur->save()) {

                $this->response->redirect('WebAppSeller/collaborateur/index');
                $this->view->disable();

            } else {
                echo "l'ajout n'a pas fonctionné";
            }
        }
    }
    public function deleteAction()
    {
        if ($this->request->isPost()) {
            $id = $this->request->getPost('del', 'int');


            $collaborateur = Collaborateur::findFirstById($id);

            if ($collaborateur) {
                // Supprimer le client
                if ($collaborateur->delete()) {

                    $this->response->redirect('WebAppSeller/collaborateur/index');
                    $this->view->disable();

                } else {
                    echo "la suppression n'a pas fonctionné";

                }
            } else {
                echo "client non trouver";

            }
        }
    }
}
