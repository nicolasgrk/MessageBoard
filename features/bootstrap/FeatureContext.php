<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use PHPUnit\Framework\Assert;

require_once './src/orm/orm_memory.php';

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
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
     * Given I create a salon named "Test salon
     * @When I create a salon named :salonName
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
        Assert::assertTrue(in_array($salonName, $salons), sprintf('Salon "%s" does not exist in the list of salons', $salonName));
    }
    /**
     * @When I create a user named :username
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
        if (!in_array($username, $users)) {
            throw new \Exception(sprintf('User "%s" does not exist in the list of users', $username));
        }
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
        Assert::assertFalse(in_array($username, $users), sprintf('User "%s" still exists in the list of users', $username));
    }
    /**
     * @When John posts a message :content in the salon :salonName
     */
    public function iPostAMessageInTheSalon($content, $salonName)
    {
        $this->ormMemory->createUser('John');
        $this->ormMemory->createSalon($salonName);
        $this->ormMemory->postMessage($salonName, 'John', $content);
    }

    /**
     * @Then the salon :salonName should contain John's message
     */
    public function theSalonShouldContainJohnsMessage($salonName)
    {
        $messages = $this->ormMemory->getMessages($salonName);
        $found = false;
        foreach ($messages as $message) {
            if ($message['username'] === 'John' && $message['content'] === 'Hello, world!') {
                $found = true;
                break;
            }
        }
        Assert::assertTrue($found, sprintf('John\'s message not found in salon %s', $salonName));
    }
    
}
