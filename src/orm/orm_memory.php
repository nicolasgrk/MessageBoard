<?php

require_once 'orm_interface.php';

class ORMMemory implements ORMInterface {

    private $salons;
    private $utilisateurs;

    public function __construct() {
        $this->salons = [];
        $this->utilisateurs = [];
    }

    public function getSalons() {
        return array_keys($this->salons);
    }

    public function getUsers() {
        return array_keys($this->utilisateurs);
    }
    public function getUserByUsername(string $username): ?User
{
    foreach ($this->users as $user) {
        if ($user->getUsername() === $username) {
            return $user;
        }
    }

    return null;
}

    public function deleteUser($username) {
        if (!isset($this->utilisateurs[$username])) {
            throw new Exception("L'utilisateur n'existe pas");
        }
        unset($this->utilisateurs[$username]);
    }

    public function createSalon($salonName) {
        if (strlen($salonName) > 50) { // Vérifie la longueur du nom de salon
            throw new Exception("Le nom de salon est trop long (maximum 50 caractères)");
        }
        if (!isset($this->salons[$salonName])) {
            $this->salons[$salonName] = [];
        } else {
            // Si le salon existe déjà, ne faites rien
            return;
        }
    }

    public function getMessages($salonName) {
        return isset($this->salons[$salonName]) ? $this->salons[$salonName] : [];
    }

    public function postMessage($salon_name, $username, $content) {
        if (strlen($username) > 20) { // Vérifie la longueur du nom d'utilisateur
            throw new Exception("Le nom d'utilisateur est trop long (maximum 20 caractères)");
        }
        if (strlen($content) < 2 || strlen($content) > 2048) { // Vérifie la longueur du message
            throw new Exception("La longueur du message doit être comprise entre 2 et 2048 caractères");
        }
        $message = [
            'username' => $username,
            'content' => $content,
            'timestamp' => date('Y-m-d H:i:s') // Assurez-vous que cette ligne est présente
        ];

        if (!isset($this->salons[$salon_name])) {
            $this->salons[$salon_name] = [];
        }

        array_push($this->salons[$salon_name], $message);
    }

    public function deleteAllSalons() {
        $this->salons = [];
    }

    public function createUser($username) {
        // Vérifie la longueur du nom d'utilisateur
        if (strlen($username) > 20) { 
            throw new Exception("Le nom d'utilisateur est trop long (maximum 20 caractères)");
        }
        if (!isset($this->utilisateurs[$username])) {
            $this->utilisateurs[$username] = [];
        } else {
            // Si l'utilisateur existe déjà, ne faites rien
            return;
        }
    }

    public function getUserMessages($username) {
        $messages = [];
        foreach ($this->salons as $salon) {
            foreach ($salon as $message) {
                if ($message['username'] === $username) {
                    array_push($messages, $message);
                }
            }
        }
        return $messages;
    }
}
