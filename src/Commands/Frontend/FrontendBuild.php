<?php 

declare(strict_types=1);

namespace Masturbrain\Ci4LitRollup\Commands\Frontend;

use CodeIgniter\CLI\CLI;

class FrontendBuild extends BaseFrontendCommand 
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
    protected $name = 'frontend:build';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'Running npm build';

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
        $code = $this->npm(['run','build']);

        if($code !== 0) {
            CLI::error("npm run build failed (exit code {$code})");
            return;
        }

        CLI::write('Build success','green');
    }
}