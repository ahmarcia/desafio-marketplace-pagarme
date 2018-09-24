<?php
return [
    'displayErrorDetails' => false,

    // Allow the web server to send the content-length header
    'addContentLengthHeader' => false,

    // Renderer settings
    'renderer' => [
        'template_path' => __DIR__ . '/../src/Views/',
    ],

    // Monolog settings
    'logger' => [
        'name' => 'slim-app',
        'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
        'level' => \Monolog\Logger::DEBUG,
    ],

    // Config SDK PagarMe
    'pagarMe' => [
        'api_key' => '',
        'code_splits' => [],
        'recipient' => ''
    ]
];
