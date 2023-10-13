<?php
declare(strict_types=1);

namespace WebAppSeller\Modules\Frontend\Controllers;
use WebAppSeller\Models\Developpeur;
use WebAppSeller\Models\ChefDeProjet;


class AssignerRoleController extends ControllerBase
{
    // Your controller code here
    public function indexAction()
    {
        /*Développeur*/
        $developpeurs = Developpeur::find();
        $this->view->setVar('developpeurs',$developpeurs);

        /*Chef De Projet*/
        $chefDeProjets = ChefDeProjet::find();
        $this->view->setVar('chefdeprojets',$chefDeProjets);
    }
    public function addDeveloperAction()
    {
        if ($this->request->isPost()) {
            $collaborateurId = $this->request->getPost('collaborateur_id', 'int');

            // Create a new developer and associate it with the collaborator
            $developer = new Developer();
            $developer->setCollaborateurId($collaborateurId);
            // Set other developer properties as needed
            $developer->save();

            // Redirect or provide a response as needed
        }
    }

}