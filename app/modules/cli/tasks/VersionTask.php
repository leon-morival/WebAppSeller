<?php
declare(strict_types=1);

namespace WebAppSeller\Modules\Cli\Tasks;

class VersionTask extends \Phalcon\Cli\Task
{
    public function mainAction()
    {
        $config = $this->getDI()->get('config');

        echo $config['version'];
    }
}
