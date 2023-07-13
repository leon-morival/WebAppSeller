<?php
declare(strict_types=1);

namespace WebAppSeller\Modules\Frontend\Controllers;

use WebAppSeller\Models\Application;

class ApplicationController extends Controller
{
    public function indexAction()
    {
        // Fetch all applications
        $applications = Application::find();

        // Pass the applications data to the view
        $this->view->applications = $applications;
    }
}
