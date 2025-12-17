<?php
declare(strict_types=1);

namespace Masturbrain\Ci4LitRollup\Config;

use CodeIgniter\Config\BaseConfig;
use Masturbrain\Ci4LitRollup\Commands\Frontend\FrontendBuild;
use Masturbrain\Ci4LitRollup\Commands\Frontend\FrontendDev;
use Masturbrain\Ci4LitRollup\Commands\Frontend\FrontendInit;
use Masturbrain\Ci4LitRollup\Commands\Frontend\FrontendInstall;

class Register extends BaseConfig 
{
    public static function commands(): array 
    {
        return [
            'frontend:init' => FrontendInit::class,
            'frontend:install' => FrontendInstall::class,
            'frontend:build' => FrontendBuild::class,
            'frontend:dev' => FrontendDev::class,
        ];
    }

    public static function helpers(): array 
    {
        return [
            'frontend' => [__DIR__ . "/../Helpers/frontend_helper.php"]
        ];
    }
}