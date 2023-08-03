<?php
declare(strict_types=1);

namespace WebAppSeller\Modules\Frontend\Controllers;

use WebAppSeller\Models\Collaborateur;

class DashboardController extends ControllerBase
{
    public function indexAction()
    {
        // Fetch all applications
        $collaborateurs = Collaborateur::find();


        $this->view->setVar('collaborateurs', $collaborateurs);
    }
}
