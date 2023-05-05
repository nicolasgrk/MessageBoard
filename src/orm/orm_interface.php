<?php

interface ORMInterface {
    public function getSalons();
    public function createSalon($salonName);
    public function getMessages($salonName);
    public function postMessage($salonName, $username, $content);
    public function getUsers();
    public function createUser($username);
    public function deleteUser($username);
    public function getUserMessages($username);
    public function getUserByUsername(string $username): ?User;

}