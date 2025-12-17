<?php

declare(strict_types=1);

namespace Masturbrain\Ci4LitRollup\Commands\Frontend;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use RuntimeException;

class FrontendInit extends BaseFrontendCommand
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
    protected $name = 'frontend:init';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'Generate files and configs for Rollup,Lit and Typescript';

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
        try {
                    $root = rtrim(ROOTPATH, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;

          $paths = [
            $root . 'writable/resources/frontend',
            $root . 'writable/resources/frontend/components',
            $root . 'public/assets',
            $root . 'app/Helpers',
          ];

          foreach ($paths as $dir) {
            $this->ensureDir($dir);
          }

          $this->writeIfMissing($root .'rollup.config.js', $this->stubs('rollup.config.js'));
          $this->writeIfMissing($root .'writable/resources/frontend/app.ts', $this->stubs('app.ts'));
          $this->writeIfMissing($root . 'writable/resources/frontend/components/x-hello.ts', $this->stubs('components/x-hello.ts'));
          $this->writeIfMissing($root . 'package.json', $this->stubs('package.json'));
          $this->writeIfMissing($root . 'tsconfig.json', $this->stubs('tsconfig.json'));
          $this->writeIfMissing($root .'app/Helpers/frontend_helper.php',$this->stubs('helpers/frontend_helper.php'));

          CLI::write('Base files created (or already existed)', 'green');

          CLI::write('Runnig npm install...', 'yellow');
          $code = $this->npm(['install']);

          if ($code !== 0) {
            CLI::error("npm install failed (exit code {$code})");
            return $code;
          }

          CLI::write('Frontend initialized successfully.', 'green');
          CLI::write('Next commands:', 'yellow');
          CLI::write('- php spark frontend:build', 'yellow');
          CLI::write('- php spark frontend:dev', 'yellow');

          return 0;
        } catch(\Throwable $e) {
            CLI::error($e->getMessage());
            return 1;
        }

    }

    private function ensureDir(string $dir): void 
    {
        if(is_dir($dir)) {
            return;
        }

        if(!mkdir($dir,0775,true) && !is_dir($dir)) {
            throw new RuntimeException("Failed to create Directory {$dir}");
        }

        CLI::write("Directory {$dir} created");
    }

    private function writeIfMissing(string $path, string $content): void 
    {
        if(is_file($path)) {
            CLI::write("Exists file: {$path}",'blue');
            return;
        }

        $dir = dirname($path);

        if(!is_dir($dir)) {
            $this->ensureDir($dir);
        }

        if(file_put_contents($path,$content) === false) {
            throw new RuntimeException("Failed write file {$path}");
        }

        CLI::write("Created: {$path}",'green');
    }

    private function stubs(string $name): string 
    {
        $path = dirname(__DIR__, 2) . '/Contents/' . ltrim($name,'/');

        $content = file_get_contents($path);
        if ($content === false) {
           throw new \RuntimeException("Contents not found: {$name}");
        }

        return $content;
    }
   
}
