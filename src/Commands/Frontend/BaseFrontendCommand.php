<?php 
declare(strict_types=1);

namespace Masturbrain\Ci4LitRollup\Commands\Frontend;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class BaseFrontendCommand extends BaseCommand 
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
    protected $name = 'command:name';

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


    public function runProcess(string $command, array $params) 
    {
        $cmd = array_merge([$command],$params);

        $cwd = ROOTPATH;

        CLI::write('> '. implode(' ',$cmd), 'yellow');

        $descriptors = [
            0 => STDIN,
            1 => STDOUT,
            2 => STDERR,
        ];


        $process = proc_open($cmd,$descriptors,$pipes,$cwd);

        if(!is_resource($process)) {
            CLI::error('Failed to initialize process: '.$command);
            return 1;
        }

        return proc_close($process);
    }
    /**
     * Actually execute a command.
     *
     * @param array $params
     */
    public function run(array $params){}

    protected function npm(array $args): int 
    {
        return $this->runProcess('npm',$args);
    }
}