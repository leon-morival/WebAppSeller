<?php
declare(strict_types=1);

namespace WebAppSeller\Modules\Frontend\Controllers;
use WebAppSeller\Models\Equipe;

class EquipeSelectionneController extends ControllerBase
{


    public function indexAction()
    {
        if ($this->request->isPost()) {
            $equipeId = $this->request->getPost('equipe_id', 'int');
            $this->view->setVar('equipe', $equipeId);
        }
    }


}