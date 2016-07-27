<?php
require __DIR__."/DataBaseTests.php";

use Doctrine\DBAL\Connection;
use PHPUnit\Framework\TestCase;

class LobbyTest extends TestCase
{
    public $betSql = 'SELECT b.*
FROM `bet` b
WHERE b.id = :id';
    public $gameSql = 'SELECT g.*
FROM `game` g
WHERE g.id = :id';
    public $gameAccountSql = 'SELECT ga.*
FROM `gameaccount` ga
WHERE ga.id = :id';
    public $gameAccounTypeSql = 'SELECT gat.*
FROM `gameaccountType` gat
WHERE gat.id = :id';
    public $lobbySql ='SELECT l.*
FROM `lobby` l
WHERE l.id = :id';
    public $userSql = 'SELECT o.*
FROM `user` o
WHERE o.id = :id';


    public function testGetLobbyByID() {
        $appMock = $this->getMockBuilder(\Silex\Application::class)->disableOriginalConstructor()->getMock();
        $appMock->expects($this->never())->method('abort');

        $connectionMock = $this->getMockBuilder(Connection::class)->disableOriginalConstructor()->getMock();
        $connectionMock->expects($this->any())->method('fetchAll')->will($this->returnCallback(array($this, 'connectionMockCallback')));

        $lobbyRepo = new \projectx\api\lobby\LobbyRepository($appMock, $connectionMock);
        $this->assertNotEmpty($lobbyRepo->getById(1));
    }

    public function connectionMockCallback($foo) {
        if(strcmp($foo, $this->betSql) === 0) {
            return [['userid' => 1, 'lobbyId' => 1, 'amount' => 0, 'team' => 0]];
        }
        else if(strcmp($foo, $this->gameSql) === 0) {
            return [['id' => 1, 'name' => "someName", 'typ' => "sometype", 'icon' => "someIcon", 'rules' => 'someRules', 'genre' => "somegenre", 'timelimit' => 1000]];
        }
        else if(strcmp($foo, $this->gameAccountSql) === 0) {
            return [['userid' => 1, 'userIdentifier' => "username", 'gameaccountTypeId' => 1]];
        }
        else if(strcmp($foo, $this->gameAccounTypeSql) === 0) {
            return [['id' => 1, 'name' => "gameAccountTypeName", 'icon' => 'someIcon']];
        }
        else if(strcmp($foo, $this->lobbySql) === 0) {
            return [['id' => 1, 'ownerId' => 1, 'gameId' => 1, 'winnerteam' => 1, 'createdAt' => 0, 'starttime' => 0, 'endtime' => 0]];
        }
        else if(strcmp($foo, $this->userSql) === 0) {
            return [['id' => 1, 'email' => "someMail", 'username' => "username", 'trusted' => 1, 'password' => 'somePassWord', 'icon' => "someIcon", 'coins' => 0, 'createdAt' => 0]];
        }
        else {
            var_dump($foo);
        }
    }
}