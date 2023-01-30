<?php
$container['view'] = function ($container)
{
    $view = new \Slim\Views\Twig(
        $container['settings']['view']['template_path'],
        $container['settings']['view']['twig'],
        [
            'debug' => true // This line should enable debug mode
        ]
    );

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;
};

$container['Logger'] = function () {
    $logger = new Logger('logger');

    $log_notices = LOG_FILE_PATH . 'notices.log';
    $stream_notices = new StreamHandler($log_notices, Logger::NOTICE);
    $logger->pushHandler($stream_notices);

    $log_warnings = LOG_FILE_PATH . 'warnings.log';
    $stream_warnings = new StreamHandler($log_warnings, Logger::WARNING);
    $logger->pushHandler($stream_warnings);

    return $logger;

};