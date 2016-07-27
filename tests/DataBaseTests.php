<?php
namespace projectx\tests;

use PHPUnit\Framework\TestCase;
use Doctrine\DBAL\Connection;

class DataBaseTestParent extends TestCase
{
    public $connectionMock;
    public $appMock;



    public function prepareMocks() {
        $appMock = $this->getMockBuilder(\Silex\Application::class)->disableOriginalConstructor()->getMock();
        $connectionMock = $this->getMockBuilder(Connection::class)->disableOriginalConstructor()->getMock();
    }
}