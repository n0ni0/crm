<?php

$file = __DIR__.'/../vendor/autoload.php';
if (!file_exists($file)) {
    throw new RuntimeException('Install dependencies to run test suite.');
}
$autoload = require $file;

// Test Setup: remove all the contents in the build/ directory
// (PHP doesn't allow to delete directories unless they are empty)
if (is_dir($buildDir = 'build/')) {
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($buildDir, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::CHILD_FIRST
    );
    foreach ($files as $fileinfo) {
        $fileinfo->isDir() ? rmdir($fileinfo->getRealPath()) : unlink($fileinfo->getRealPath());
    }
}

//drop/create database
system(sprintf('php "app/console" doctrine:database:drop --env=test --force', __DIR__));
//create database
system(sprintf('php "app/console" doctrine:database:create --env=test', __DIR__));
//init database
system(sprintf('php "app/console" doctrine:schema:create --env=test', __DIR__));
//insert fixtures
system(sprintf('php "app/console" doctrine:fixtures:load --env=test -n', __DIR__));

// Make a copy of the original SQLite database to use the same unmodified database in every test
copy($buildDir.'/test.db', $buildDir.'/original_test.db');
