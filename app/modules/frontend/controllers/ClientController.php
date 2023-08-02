<?php

declare(strict_types=1);

namespace WebAppSeller\Modules\Frontend\Controllers;

use WebAppSeller\Models\Client;

class ClientController extends ControllerBase
{
    public function indexAction()
    {
        // Fetch all applications
        $clients = Client::find();


        $this->view->setVar('clients', $clients);
    }
    public function saveAction()
    {
        // Handle the form submission
        if ($this->request->isPost()) {
            $client = new Client();

            $raison_sociale = $this->request->getPost('raison_sociale', 'string');
            $ridet = $this->request->getPost('ridet', 'string');
            $ssi2 = $this->request->getPost('ssi2', 'int');

            $client->setRaisonSociale($raison_sociale);
            $client->setRidet($ridet);
            $client->setSsi2($ssi2);

            // Enregistrer le client
            if ($client->save()) {

                $this->response->redirect('WebAppSeller/client/index');
                $this->view->disable();

            } else {
                echo "l'ajout n'a pas fonctionné";
            }
        }
    }
    public function deleteAction()
    {
        if ($this->request->isPost()) {
            $id = $this->request->getPost('id', 'int');


            $client = Client::findFirstById($id);

            if ($client) {
                // Supprimer le client
                if ($client->delete()) {

                    $this->response->redirect('WebAppSeller/client/index');
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
