<?php

use PHPUnit\Framework\TestCase;
use Exception;

require_once 'src/orm/orm_memory.php';

class ORMMemoryTest extends TestCase
{
    private $orm;

    protected function setUp(): void
    {
        $this->orm = new ORMMemory();
    }

    public function testCreateSalon(): void
    {
        $this->orm->createSalon('salon1');
        $this->orm->createSalon('salon2');

        $this->assertEquals(['salon1', 'salon2'], $this->orm->getSalons());
    }

    public function testGetMessages(): void
    {
        $this->orm->createSalon('salon1');
        $this->orm->postMessage('salon1', 'user1', 'message1');
        $this->orm->postMessage('salon1', 'user2', 'message2');

        $this->assertEquals(
            [
                ['username' => 'user1', 'content' => 'message1', 'timestamp' => date('Y-m-d H:i:s')],
                ['username' => 'user2', 'content' => 'message2', 'timestamp' => date('Y-m-d H:i:s')],
            ],
            $this->orm->getMessages('salon1')
        );
    }

    public function testDeleteAllSalons(): void
    {
        $this->orm->createSalon('salon1');
        $this->orm->createSalon('salon2');
        $this->orm->deleteAllSalons();

        $this->assertEquals([], $this->orm->getSalons());
    }

    public function testCreateUser(): void
    {
        $this->orm->createUser('user1');
        $this->orm->createUser('user2');

        $this->assertEquals(['user1', 'user2'], $this->orm->getUsers());
    }

    public function testGetUserMessages(): void
    {
        $this->orm->createSalon('salon1');
        $this->orm->createUser('user1');
        $this->orm->postMessage('salon1', 'user1', 'message1');
        $this->orm->postMessage('salon1', 'user2', 'message2');

        $this->assertEquals(
            [['username' => 'user1', 'content' => 'message1', 'timestamp' => date('Y-m-d H:i:s')]],
            $this->orm->getUserMessages('user1')
        );
    }

    public function testDeleteUser(): void
    {
        $this->orm->createUser('user1');
        $this->orm->createUser('user2');
        $this->orm->deleteUser('user2');

        $this->assertEquals(['user1'], $this->orm->getUsers());
    }

    public function testDeleteUserThatDoesNotExist() {
        $orm = new ORMMemory();
        $orm->createUser('user1');
    
        $this->expectException(Exception::class);
        $orm->deleteUser('user2');
        
        // Vérifie que l'utilisateur 'user1' est toujours présent
        $this->assertContains('user1', $orm->getUsers());
    }
}