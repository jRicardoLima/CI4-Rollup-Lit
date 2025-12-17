<?php

declare(strict_types=1);

namespace Masturbrain\Ci4LitRollup\Commands\Frontend;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class FrontendDev extends BaseFrontendCommand
{
    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group = 'Frontend';

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'frontend:dev';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = '';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = '';

    /**
     * The Command's Arguments
     *
     * @var array
     */
    protected $arguments = [];

    /**
     * The Command's Options
     *
     * @var array
     */
    protected $options = [];

    /**
     * Actually execute a command.
     *
     * @param array $params
     */
    public function run(array $params)
    {
        CLI::write('Init Watcher','yellow');

        $code = $this->npm(['run','dev']);

        if($code !== 0) {
            CLI::error("npm run dev failed (exit code {$code})");
            return;
        }
    }
}
