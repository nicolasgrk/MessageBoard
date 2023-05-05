<?php
require_once 'orm/orm_interface.php';
require_once 'orm/orm_memory.php';
session_start();

if (!isset($_SESSION['orm'])) {
    $_SESSION['orm'] = new ORMMemory();
}

$orm = $_SESSION['orm'];
// salon
function get_salons() {
    global $orm;
    return $orm->getSalons();
}

function create_salon($salon_name) {
    global $orm;
    $orm->createSalon($salon_name);
}
function check_salon($salon_name) {
    global $orm;
    $salons = $orm->getSalons();
    return in_array($salon_name, $salons);
}
function delete_all_salons() {
    global $orm;
    $orm->deleteAllSalons();
}

function validate_salon_name($salon_name) {
    // Vérifie que le nom du salon n'est pas vide
    if (strlen(trim($salon_name)) == 0) {
        return false;
    }
    return true;
}
// message
function get_messages($salon_name) {
    global $orm;
    return $orm->getMessages($salon_name);
}

function can_post_message($salon_name, $username) {
    global $orm;
    $messages = $orm->getMessages($salon_name);

    if (empty($messages)) {
        return true;
    }

    $last_message = end($messages);

    if ($last_message['username'] === $username) {
        $time_since_last_post = time() - strtotime($last_message['timestamp']);
        $hours_since_last_post = $time_since_last_post / 3600;

        if ($hours_since_last_post < 24) {
            // Vérifier si un autre utilisateur a posté depuis le dernier message de cet utilisateur
            foreach (array_reverse($messages) as $message) {
                if ($message['username'] !== $username) {
                    $time_since_last_post = time() - strtotime($message['timestamp']);
                    $hours_since_last_post = $time_since_last_post / 3600;

                    if ($hours_since_last_post >= 24) {
                        return true;
                    }
                }
            }

            return false;
        }
    }

    return true;
}

function post_message($salon_name, $username, $content) {
    if (!can_post_message($salon_name, $username)) {
        return false;
    }
    global $orm;
    $orm->postMessage($salon_name, $username, $content);
    return true;
}
function validate_message_content($content) {
    $content_length = strlen(trim($content));

    // Vérifie que le contenu du message a entre 2 et 2048 caractères
    if ($content_length < 2 || $content_length > 2048) {
        return false;
    }
    return true;
}


//user
function validate_username($username) {
    // Vérifie que le nom d'utilisateur n'est pas vide
    if (strlen(trim($username)) == 0) {
        return false;
    }
    return true;
}



