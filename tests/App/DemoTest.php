<?php

namespace Test\App;

use App\App\Demo;
use PHPUnit\Framework\TestCase;
use App\Util\HttpRequest;


class DemoTest extends TestCase
{
    private $demo;
    private $_logger;
    private $_req;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->_req = new HttpRequest();

        $this->demo = new Demo($this->_logger, $this->_req);
    }

    public function test_foo()
    {
        $result = $this->demo->foo();

        $this->assertEquals('bar', $result);
    }

    public function test_get_user_info()
    {
        $userInfo = $this->demo->get_user_info();

        $this->assertEquals(['id' => 1, 'username'=>'hello world'], $userInfo);
    }
}
