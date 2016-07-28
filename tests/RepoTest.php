<?php

use Doctrine\DBAL\Connection;

class RepoTests extends PHPUnit_Framework_TestCase
{
    public function testGetLobbyByID() {
        $connectionMock = $this->getMockBuilder(Connection::class)->disableOriginalConstructor()->getMock();
        $connectionMock->expects($this->any())->method('fetchAll')->will($this->returnCallback(array($this, 'connectionMockCallback')));

        $appMock = $this->getMockBuilder(\Silex\Application::class)->disableOriginalConstructor()->getMock();
        $appMock->expects($this->never())->method('abort');

        $lobbyRepo = new \projectx\api\lobby\LobbyRepository($appMock, $connectionMock);
        $lobbyService = new \projectx\api\lobby\LobbyService($lobbyRepo);
        $this->assertNotEmpty($lobbyService->getById(1));
    }

    public function testGetBetByUserID() {
        $connectionMock = $this->getMockBuilder(Connection::class)->disableOriginalConstructor()->getMock();
        $connectionMock->expects($this->any())->method('fetchAll')->will($this->returnCallback(array($this, 'connectionMockCallback')));

        $appMock = $this->getMockBuilder(\Silex\Application::class)->disableOriginalConstructor()->getMock();
        $appMock->expects($this->never())->method('abort');

        $betRepo = new \projectx\api\bet\BetRepository($appMock, $connectionMock);
        $betService = new \projectx\api\bet\BetService($betRepo);
        $this->assertNotEmpty($betService->getByUserId(1));
    }

    public function testGameAccountByID() {
        $connectionMock = $this->getMockBuilder(Connection::class)->disableOriginalConstructor()->getMock();
        $connectionMock->expects($this->any())->method('fetchAll')->will($this->returnCallback(array($this, 'connectionMockCallback')));

        $appMock = $this->getMockBuilder(\Silex\Application::class)->disableOriginalConstructor()->getMock();
        $appMock->expects($this->never())->method('abort');

        $gameAccountRepo = new \projectx\api\gameAccount\GameAccountRepository($appMock, $connectionMock);
        $gameAccountService = new \projectx\api\gameAccount\GameAccountService($gameAccountRepo);
        $this->assertNotEmpty($gameAccountService->getByUserId(1));
    }

    public function testGetGameByGenre() {
        $connectionMock = $this->getMockBuilder(Connection::class)->disableOriginalConstructor()->getMock();
        $connectionMock->expects($this->any())->method('fetchAll')->will($this->returnCallback(array($this, 'connectionMockCallback')));

        $appMock = $this->getMockBuilder(\Silex\Application::class)->disableOriginalConstructor()->getMock();
        $appMock->expects($this->never())->method('abort');

        $gameRepo = new \projectx\api\game\GameRepository($appMock, $connectionMock);
        $gameServive = new \projectx\api\game\GameService($gameRepo);
        $this->assertNotEmpty($gameServive->getByGenre("somegenre"));
    }


    //this mocks the database
    public function connectionMockCallback($foo) {
        if(strpos($foo, 'bet') !== false) {//strcmp($foo, $this->betSql) === 0) {
            return [['userId' => 1, 'lobbyId' => 1, 'amount' => 0, 'team' => 0]];
        }
        else if(strpos($foo, 'gameaccountType') !== false) {//strcmp($foo, $this->gameAccounTypeSql) === 0) {
            return [['id' => 1, 'name' => "gameAccountTypeName", 'icon' => 'someIcon']];
        }
        else if(strpos($foo, 'gameaccount') !== false) {//strcmp($foo, $this->gameAccountSql) === 0) {
            return [['userId' => 1, 'userIdentifier' => "username", 'gameaccountTypeId' => 1]];
        }
        else if(strpos($foo, 'game') !== false) {//strcmp($foo, $this->gameSql) === 0) {
            return [['id' => 1, 'name' => "someName", 'typ' => "sometype", 'icon' => "someIcon", 'rules' => 'someRules', 'genre' => "somegenre", 'timelimit' => 1000]];
        }
        else if(strpos($foo, 'lobby') !== false) {//strcmp($foo, $this->lobbySql) === 0) {
            return [['id' => 1, 'ownerId' => 1, 'gameId' => 1, 'winnerteam' => 1, 'createdAt' => 0, 'starttime' => 0, 'endtime' => 0]];
        }
        else if(strpos($foo, 'user') !== false) {//strcmp($foo, $this->userSql) === 0) {
            return [['id' => 1, 'email' => "someMail", 'username' => "username", 'trusted' => 1, 'password' => 'somePassWord', 'icon' => "someIcon", 'coins' => 0, 'createdAt' => 0]];
        }
        else {
            var_dump($foo);
        }
    }
}