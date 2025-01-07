<?php

$composerLockFile = 'composer.lock';
$composerJsonFile = 'composer.json';

if (!file_exists($composerLockFile)) {
    echo "Error: composer.lock file not found.\n";
    exit(1);
}

$lockData = json_decode(file_get_contents($composerLockFile), true);

if (!isset($lockData['packages']) || !is_array($lockData['packages'])) {
    echo "Error: Invalid composer.lock file.\n";
    exit(1);
}

$packages = [];

foreach ($lockData['packages'] as $package) {
    if (isset($package['name']) && isset($package['version'])) {
        $packages[$package['name']] = $package['version'];
    }
}

$composerJson = [
    'require' => $packages,
];

file_put_contents($composerJsonFile, json_encode($composerJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

echo "composer.json file has been created successfully.\n";