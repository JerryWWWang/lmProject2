<?php

namespace App\Service;

use think\LogManager;
use Logger;

class AppLogger
{
    const TYPE_LOG4PHP = 'log4php';

    const TYPE_THINKLOG = 'think-log';

    private $logger;
    private $type;

    public function __construct($type = self::TYPE_LOG4PHP)
    {
        $this->type = $type;
        // 简单工厂模式
        if ($type == self::TYPE_LOG4PHP) {
            Logger::configure(array(
                'rootLogger' => array(
                    'appenders' => array('default'),
                ),
                'appenders' => array(
                    'default' => array(
                        'class' => 'LoggerAppenderFile',
                        'layout' => array(
                            'class' => 'LoggerLayoutSimple'
                        ),
                        'params' => array(
                            'file' => './logs/log4php.log',
                            'append' => true
                        )
                    )
                )
            ));
            $this->logger = Logger::getLogger("Log");
        } else if($type == self::TYPE_THINKLOG) {
            $this->logger = new LogManager();
            $this->logger->init([
                'default'	=>	'file',
                'channels'	=>	[
                    'file'	=>	[
                        'type'	=>	'file',
                        'path'	=>	'./logs/',
                    ],
                ],
            ]);
        }
    }

    public function info($message = '')
    {
        if($this->type == self::TYPE_THINKLOG) {
            $this->logger->info(strtoupper($message));
        } else {
            $this->logger->info($message);
        }
    }

    public function debug($message = '')
    {
        if($this->type == self::TYPE_THINKLOG) {
            $this->logger->debug(strtoupper($message));
        } else {
            $this->logger->debug($message);
        }
    }

    public function error($message = '')
    {
        if($this->type == self::TYPE_THINKLOG) {
            $this->logger->error(strtoupper($message));
        } else {
            $this->logger->error($message);
        }
    }
}