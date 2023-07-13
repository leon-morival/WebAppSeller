<?php
declare(strict_types=1);

namespace WebAppSeller\Modules\Frontend\Controllers;

use WebAppSeller\Models\Application;

class ApplicationController extends ControllerBase
{
    public function indexAction()
    {
        // Fetch all applications
        $applications = Application::find();


        $this->view->setVar('applications',$applications);
    }
}
