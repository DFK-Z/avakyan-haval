<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $buildPath = public_path('build');
        $manifestPath = $buildPath.'/manifest.json';

        if (! is_file($manifestPath)) {
            if (! is_dir($buildPath)) {
                mkdir($buildPath, 0755, true);
            }

            file_put_contents($manifestPath, json_encode([
                'resources/css/app.css' => [
                    'file' => 'assets/app.css',
                    'src' => 'resources/css/app.css',
                    'isEntry' => true,
                ],
                'resources/js/app.js' => [
                    'file' => 'assets/app.js',
                    'src' => 'resources/js/app.js',
                    'isEntry' => true,
                ],
            ], JSON_THROW_ON_ERROR));
        }
    }
}
