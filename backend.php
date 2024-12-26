<?php
session_start();

if (!isset($_SESSION['players'])) {
    $_SESSION['players'] = [];
}

$action = $_POST['action'] ?? $_GET['action'] ?? '';

switch ($action) {
    case 'addPlayer':
        $name = $_POST['name'] ?? '';
        if ($name) {
            $id = uniqid();
            $_SESSION['players'][] = ['id' => $id, 'name' => $name, 'score' => 0];
        }
        break;

    case 'updateScore':
        $id = $_POST['id'] ?? '';
        $score = $_POST['score'] ?? 0;
        foreach ($_SESSION['players'] as &$player) {
            if ($player['id'] === $id) {
                $player['score'] = (int)$score;
                break;
            }
        }
        break;

    case 'getPlayers':
        echo json_encode($_SESSION['players']);
        break;

    default:
        echo json_encode(['error' => 'Invalid action']);
        break;
}

