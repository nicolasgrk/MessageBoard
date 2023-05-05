Feature: ORMMemory
    As a developer
    I want to test the ORMMemory class
    So that I can ensure it works as expected

    Scenario: Creating a salon
        Given I have an instance of ORMMemory
        When I create a salon named "Test salon"
        Then the salon "Test salon" should exist in the list of salons

    Scenario: Creating a user
        Given I have an instance of ORMMemory
        When I create a user named "John"
        Then the user "John" should exist in the list of users


    Scenario: Deleting a user
        Given I have an instance of ORMMemory
        And I create a user named "John"
        When I delete the user "John"
        Then the user "John" should not exist in the list of users

    Scenario: Posting a message
        Given I have an instance of ORMMemory
        When John posts a message "Hello, world!" in the salon "Test salon"
        Then the salon "Test salon" should contain John's message