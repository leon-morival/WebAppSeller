<?php

declare(strict_types=1);

namespace WebAppSeller\Modules\Frontend\Controllers;

use WebAppSeller\Models\Client;

class ClientController extends ControllerBase
{
    public function indexAction()
    {

        $clients = Client::find();


        $this->view->setVar('clients', $clients);
    }
    public function editAction($id)
    {

        $client = Client::findFirstById($id);

        if (!$client) {
            $this->response->redirect('client/index');
            $this->view->disable();
            return;
        }

        // Pass the client object to the edit view
        $this->view->setVar('client', $client);
    }
    public function updateAction()
    {

        if ($this->request->isPost()) {
            $id = $this->request->getPost('id', 'int');

            // Find the client by id
            $client = Client::findFirstById($id);

            if (!$client) {

                $this->response->redirect('client/index');
                $this->view->disable();
                return;
            }

            $raison_sociale = $this->request->getPost('raison_sociale', 'string');
            $ridet = $this->request->getPost('ridet', 'string');
            $ssi2 = $this->request->getPost('ssi2', 'int');

            $client->setRaisonSociale($raison_sociale);
            $client->setRidet($ridet);
            $client->setSsi2($ssi2);


            if ($client->save()) {
                $this->response->redirect('WebAppSeller/client/index');
                $this->view->disable();
            } else {
                echo "The update operation failed.";
            }
        } else {

        }
    }
    public function saveAction()
    {

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
