<?php

use Symfony\Component\DependencyInjection\ContainerBuilder;

require_once __DIR__ . '/vendor/autoload.php';

$configs['zuske_auth_client']  = ['auth'=> [
    'resource_owner' => null,
    'client_id' => null,
    'client_secret' => null,
    'host_client' => null,
    'redirect_uris' => null,
    'response_type' => null,
    'grant_type' => null,
    'scope' => null,
]];

// Build the service container
$container = new ContainerBuilder();
$extension = new \Zuske\AuthClient\DependencyInjection\AuthClientExtension();
$extension->load($configs, $container);
$container->compile();
var_dump($container);
exit();
// Set and create the output directory
$outDir = __DIR__ . '/out';
if (!file_exists($outDir))
    mkdir($outDir);
// Define the file name and contents
$index = count(scandir($outDir));
$path = "$outDir/document$index.docx";
$text = 'Hello world!';
// Use the services in the bundle
$id = $container->get('app.document.db')->newDocument($text);
$container->get('app.document.formatter')->format($id, $path);
echo "The document is at '$path'\n";