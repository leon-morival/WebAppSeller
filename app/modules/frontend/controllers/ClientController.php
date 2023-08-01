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
}
