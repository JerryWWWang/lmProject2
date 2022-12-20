<?php

namespace Test\Service;

use PHPUnit\Framework\TestCase;
use App\Service\AppLogger;

/**
 * Class ProductHandlerTest
 */
class AppLoggerTest extends TestCase
{

    public function testInfoLog()
    {
        $logger = new AppLogger('log4php');
        $logger->info('This is info log message');
        $logger->error('This is error log message');
        $logger->debug('This is debug log message');

        $file = fopen("./logs/log4php.log", "r") or exit("无法打开文件!");
        $log4PhpArray = array();
        while(!feof($file))
        {
            array_push($log4PhpArray, fgets($file));
        }
        fclose($file);
        $this->assertEquals([
            'INFO - This is info log message
',
            'ERROR - This is error log message
',
            'DEBUG - This is debug log message
',
            false], $log4PhpArray);
    }

    public function testInfoLog2()
    {
        $thinkLogger = new AppLogger('think-log');
        $thinkLogger->info('This is info log message');
        $thinkLogger->error('This is error log message');
        $thinkLogger->debug('This is debug log message');

        $file = fopen("./logs/202212/20_cli.log", "r") or exit("无法打开文件!");
        $thinkLogArray = array();
        while(!feof($file))
        {
            array_push($thinkLogArray, fgets($file));
        }
        fclose($file);

        $this->assertEquals([
            '[' . date('c', time()) . '][info] THIS IS INFO LOG MESSAGE
',
            '[' . date('c', time()) . '][error] THIS IS ERROR LOG MESSAGE
',
            '[' . date('c', time()) . '][debug] THIS IS DEBUG LOG MESSAGE
',
            false], $thinkLogArray);
    }
}