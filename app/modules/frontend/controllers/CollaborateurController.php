<?php
declare(strict_types=1);

namespace WebAppSeller\Modules\Frontend\Controllers;

use WebAppSeller\Models\ChefDeProjet;
use WebAppSeller\Models\Collaborateur;
use WebAppSeller\Models\CompositionEquipe;
use WebAppSeller\Models\Developpeur;
use Phalcon\Validation;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Numericality;

class CollaborateurController extends ControllerBase
{
    public function indexAction()
    {
        //Récupère tous les collaborateurs
        $collaborateurs = Collaborateur::find();

        $this->view->setVar('collaborateurs', $collaborateurs);



        //Récupère tous les développeurs
        $developpeurs = Developpeur::find();
        foreach ($developpeurs as $developpeur) {
            $developpeur->competence_label = $developpeur->translateCompetence();
        }
        $this->view->setVar('developpeurs', $developpeurs);
    }












    public function saveAction()
    {

        if ($this->request->isPost()) {

    $collaborateur = new Collaborateur();

    $nom = $this->request->getPost('nom_collaborateur', 'string');
    $prenom = $this->request->getPost('prenom_collaborateur', 'string');
    $prime_embauche = $this->request->getPost('prime_embauche', 'int');
    $niveau_competence = $this->request->getPost('niveau_competence', 'int');
    /*Recupere valeur case à cocher*/

    $roles = $this->request->getPost('roles');

    // Verifie si les valeur developpeur et chef de projet existe dans le tableau
    $is_developpeur = in_array('developpeur', $roles);
    $is_chef_de_projet = in_array('chef_de_projet', $roles);

            $validation = new Validation();
            $validation->add(
                'nom_collaborateur',
                new StringLength([
                    'max' => 100,
                    'messageMaximum' => 'La longueur du nom ne doit pas dépasser 100 caractères.'
                ])
            );
            $validation->add(
                'prenom_collaborateur',
                new StringLength([
                    'max' => 100,
                    'messageMaximum' => 'La longueur du prénom ne doit pas dépasser 100 caractères.'
                ])
            );
            $validation->add(
                'prime_embauche',
                new Numericality([
                    'message' => 'La prime d\'embauche doit être un entier.'
                ])
            );
            $messages = $validation->validate($_POST);

            if (count($messages)) {
                // Afficher les messages d'erreur
                echo '<script>alert("';
                foreach ($messages as $message) {
                    echo 'Erreur : ' . $message . '\n';
                }
                echo '");';
                echo 'window.location.href = "/WebAppSeller/collaborateur";';
                echo '</script>';
                return;
            }





            $collaborateur->setNom(strtoupper($nom));
    $collaborateur->setPrenom(strtolower($prenom));
    $collaborateur->setPrimeEmbauche($prime_embauche);
    $collaborateur->setNiveauCompetence($niveau_competence);




            // Enregistrer le client
            if ($collaborateur->save()) {

                if($is_developpeur){
                    $developpeur = new Developpeur();
                    $competence = $this->request->getPost('competence');
                    $indice_production = $this->request->getPost('indice_production', 'int');
                    $developpeur->setIdCollaborateur($collaborateur->getId());
                    $developpeur->setCompetence($competence);
                    $developpeur->setIndiceProduction($indice_production);
                    $developpeur->save();

                }
                if($is_chef_de_projet){
                    $chef_de_projet = new ChefDeProjet();
                    $boost_production = $this->request->getPost('boost_production','int');
                    $chef_de_projet->setIdCollaborateur($collaborateur->getId());
                    $chef_de_projet->setBoostProduction($boost_production);

                    $chef_de_projet->save();
                }
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

            // Find the collaborateur by ID
            $collaborateur = Collaborateur::findFirst([
                'conditions' => 'id = :id:',
                'bind' => ['id' => $id],
            ]);

            if ($collaborateur) {
                $developpeurs = Developpeur::find([
                    'conditions' => 'id_collaborateur = :id:',
                    'bind' => ['id' => $id]
                ]);
                foreach ($developpeurs as $developpeur) {
                    $compositions = CompositionEquipe::find([
                        'conditions' => 'id_developpeur = :id_developpeur:',
                        'bind' => ['id_developpeur' => $developpeur->getId()],
                    ]);

                    foreach ($compositions as $composition) {
                        if (!$composition->delete()) {
                            echo "La suppression de la composition n'a pas fonctionné.";
                            return;
                        }
                    }

                    // Finally, delete the Developpeur record
                    if (!$developpeur->delete()) {
                        echo "La suppression du développeur n'a pas fonctionné.";
                        return;
                    }
                }

                // Delete related ChefDeProjet records
                $chefDeProjets = ChefDeProjet::find([
                    'conditions' => 'id_collaborateur = :id:',
                    'bind' => ['id' => $id]
                ]);

                foreach ($chefDeProjets as $chefDeProjet) {
                    if (!$chefDeProjet->delete()) {
                        echo "La suppression du Chef de Projet n'a pas fonctionné.";
                        return;
                    }
                }

                // Finally, delete the collaborateur
                if ($collaborateur->delete()) {
                    $this->response->redirect('WebAppSeller/collaborateur/index');
                    $this->view->disable();
                } else {
                    echo "La suppression du collaborateur n'a pas fonctionné.";
                }
            } else {
                echo "Collaborateur non trouvé avec l'ID: " . $id;
            }
        }
    }


}
