<?php 

declare(strict_types=1);

function frontend_manifest(): array 
{
    static $cache = null;

    if ($cache !== null) {
        return $cache;
    }
    
    $path = FCPATH . 'assets/manifest.json';

    if(!is_file($path)) {
        return $cache = [];
    }

    $manifestFile = new SplFileObject($path,'r');

    $json = $manifestFile->fread($manifestFile->getSize());

    if($json === false) {
        return $cache = [];
    }

    $data = json_decode($json,true);

    if(!is_array($data)) {
        return $cache = [];
    }

    return $cache = $data;
}


function frontend_script(string $entry = 'app.js'): string 
{
    $manifest = frontend_manifest();

    $value = $manifest[$entry] ?? null;
    
    $src = null;

    if (is_string($value)) {
        $src = $value;
    } else if (is_array($value)
    && isset($value['file']) && is_string($value['file'])) {
        $src = '/assets/'. ltrim($value['file'],'/');
    }

    if ($src === null) {
        $exceptStr = esc($entry);
        return "<!-- frontend_script: Manifest not found {$exceptStr}-->";
    }
    $escSrc = esc($src);

    return "<script type='module' src='{$escSrc}'></script>";
}

function frontend_css(string $entry = "app.css"): string 
{
    $manifest = frontend_manifest();

    $value = $manifest[$entry] ?? null;

    $src = null;

    if(is_string($value)) {
        $src = $value;
    } else if (is_array($value) && isset($value['file']) && is_string($value['file'])) {
        $src = '/assets/'.ltrim($value['file'],'/');
    }

    if($src === null) {
        $exceptStr = esc($entry);

        return "<!-- frontend_style: Manifest not found {$exceptStr}-->";
    }

    $escSrc = esc($src);

    return "<link rel='stylesheet' href='{$escSrc}'/>";
}