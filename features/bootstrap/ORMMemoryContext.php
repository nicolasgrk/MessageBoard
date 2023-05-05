<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use PHPUnit\Framework\Assert;

require_once 'src/orm/orm_memory.php';

class ORMMemoryContext implements Context
{
    private $ormMemory;

    /**
     * @Given I have an instance of ORMMemory
     */
    public function iHaveAnInstanceOfORMMemory()
    {
        $this->ormMemory = new ORMMemory();
    }

    /**
     * @When I create a salon named :salonName
     * @Given I create a salon named :salonName
     */
    public function iCreateASalonNamed($salonName)
    {
        $this->ormMemory->createSalon($salonName);
    }

    /**
     * @Then the salon :salonName should exist in the list of salons
     */
    public function theSalonShouldExistInTheListOfSalons($salonName)
    {
        $salons = $this->ormMemory->getSalons();
        Assert::assertContains($salonName, $salons);
    }

    /**
     * @When I delete the salon :salonName
     */
    public function iDeleteTheSalon($salonName)
    {
        $this->ormMemory->deleteSalon($salonName);
    }

    /**
     * @Then the salon :salonName should not exist in the list of salons
     */
    public function theSalonShouldNotExistInTheListOfSalons($salonName)
    {
        $salons = $this->ormMemory->getSalons();
        Assert::assertNotContains($salonName, $salons);
    }

    /**
     * @When I create a user named :username
     * @Given I create a user named :username
     * @Given I create a user named :username2
     */
    public function iCreateAUserNamed($username)
    {
        $this->ormMemory->createUser($username);
    }

    /**
     * @Then the user :username should exist in the list of users
     */
    public function theUserShouldExistInTheListOfUsers($username)
    {
        $users = $this->ormMemory->getUsers();
        Assert::assertContains($username, $users);
    }

    /**
     * @When I delete the user :username
     */
    public function iDeleteTheUser($username)
    {
        $this->ormMemory->deleteUser($username);
    }

    /**
     * @Then the user :username should not exist in the list of users
     */
    public function theUserShouldNotExistInTheListOfUsers($username)
    {
        $users = $this->ormMemory->getUsers();
        Assert::assertNotContains($username, $users);
    }

    /**
     * @Given I create a user named :username2
     */
    public function iCreateAUserNamed2($username)
    {
        $this->ormMemory->createUser($username);
    }
    /**
     * @When John posts a message :content in the salon :salonName
     */
    public function johnPostsAMessageInTheSalon($content, $salonName)
    {
        $user = $this->ormMemory->getUserByUsername("John");
        $salon = $this->ormMemory->getSalonByName($salonName);

        $this->ormMemory->createMessage($user->getId(), $salon->getId(), $content);
    }

    /**
     * @Then the salon :salonName should contain John's message
     */
    public function theSalonShouldContainJohnsMessage($salonName)
    {
        $user = $this->ormMemory->getUserByUsername("John");
        $salon = $this->ormMemory->getSalonByName($salonName);
        $messages = $this->ormMemory->getMessagesByUserAndSalon($user->getId(), $salon->getId());

        Assert::assertNotEmpty($messages);
    }
    /**
     * @When :username posts a message :message in the salon :salonName
     */
    public function userPostsMessageInSalon($username, $message, $salonName)
    {
        $userId = $this->ormMemory->getUserIdByUsername($username);
        $salonId = $this->ormMemory->getSalonIdByName($salonName);
        $this->ormMemory->createMessage($userId, $salonId, $message);
    }

    /**
     * @Then the salon :salonName should contain :username's message :message
     */
    public function salonContainsUsersMessage($salonName, $username, $message)
    {
        $salonId = $this->ormMemory->getSalonIdByName($salonName);
        $messages = $this->ormMemory->getMessagesBySalonId($salonId);
        $userId = $this->ormMemory->getUserIdByUsername($username);
        $userMessage = array_filter($messages, function($message) use ($userId) {
            return $message['user_id'] === $userId;
        });
        Assert::assertNotEmpty($userMessage);
        Assert::assertEquals($message, reset($userMessage)['content']);
    }
}
