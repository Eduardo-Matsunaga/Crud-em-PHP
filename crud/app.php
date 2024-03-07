<?php

require_once 'player.php';
require_once 'playerMapper.php';
require_once 'connection.php';

use pdo_poo\Database;

$requestMethod = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : '';

if ($requestMethod === 'POST') {
    $playerMapper = new playerMapper();
    $id = $_POST['id'];
    $action = $_POST['action'];
    $playersRows = '';

    switch ($action) {
        case 'create':
            $name = $_POST['name'];
            $userName = $_POST['userName'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $dateRegister = $_POST['dateRegister'];

            $newPlayer = new player();
            $newPlayer->setId($id);
            $newPlayer->setName($name);
            $newPlayer->setUserName($userName);
            $newPlayer->setEmail($email);
            $newPlayer->setPassword($password);
            $newPlayer->setDateRegister($dateRegister);

            $playerMapper->createPlayer($newPlayer);
            break;

        case 'edit':
            $idToEdit = $_POST['id'];

            $playerToEdit = $playerMapper->getPlayerById($idToEdit);
            $template = file_get_contents(__DIR__.'/editPlayer.html');

            $template = str_replace('{{id}}', $playerToEdit->getId(), $template);
            $template = str_replace('{{name}}', $playerToEdit->getName(), $template);
            $template = str_replace('{{userName}}', $playerToEdit->getUserName(), $template);
            $template = str_replace('{{email}}', $playerToEdit->getEmail(), $template);
            $template = str_replace('{{password}}', $playerToEdit->getPassword(), $template);
            $template = str_replace('{{dateRegister}}', $playerToEdit->getDateRegister(), $template);

            echo $template;
            break;

        case 'update':
            $idToUpdate = $_POST['id'];
            $playerToUpdate = $playerMapper->getPlayerById($idToUpdate);

            $playerToUpdate->setName($_POST['name'] ?? '');
            $playerToUpdate->setUserName($_POST['userName'] ?? '');
            $playerToUpdate->setEmail($_POST['email'] ?? '');
            $playerToUpdate->setPassword($_POST['password'] ?? '');
            $playerToUpdate->setDateRegister($_POST['dateRegister'] ?? '');

            $playerMapper->updatePlayer($playerToUpdate);

            break;

        case 'confirmDelete':
            $idToEdit = $_POST['id'];

            $playerToEdit = $playerMapper->getPlayerById($idToEdit);
            $template = file_get_contents(__DIR__.'/delete.html');

            $template = str_replace('{{id}}', $playerToEdit->getId(), $template);
            $template = str_replace('{{name}}', $playerToEdit->getName(), $template);
            $template = str_replace('{{userName}}', $playerToEdit->getUserName(), $template);
            $template = str_replace('{{email}}', $playerToEdit->getEmail(), $template);
            $template = str_replace('{{password}}', $playerToEdit->getPassword(), $template);
            $template = str_replace('{{dateRegister}}', $playerToEdit->getDateRegister(), $template);
            echo $template;



            break;

        case 'delete':

            $deletePlayer = new player();
            $deletePlayer->setId($id);
            $playerMapper->deletePlayer($deletePlayer);


            break;

        case 'listAll':
            $result = $playerMapper->listAll();

            $playersRows = '';

            foreach ($result as $item) {
                $playersRows .= '<tr>';
                $playersRows .= '<td>'. $item['id'] .'</td>';
                $playersRows .= '<td>'. $item['name'] .'</td>';
                $playersRows .= '<td>'. $item['userName'] .'</td>';
                $playersRows .= '<td>'. $item['email'] .'</td>';
                $playersRows .= '<td>'. $item['password'] .'</td>';
                $playersRows .= '<td>'. $item['dateRegister'] .'</td>';
                $playersRows .= '<td>';
                $playersRows .= '<form action="app.php" method="POST">';
                $playersRows .= '<input type="hidden" name="id" value="' . $item['id'] . '">';
                $playersRows .= '<button type="submit" name="action" value="edit">Editar</button>';
                $playersRows .= '<button type="submit" name="action" value="confirmDelete">Deletar</button>';
                $playersRows .= '</form>';
                $playersRows .= '</td>';
                $playersRows .= '</tr>';
            }

            $template = file_get_contents(__DIR__ .'/listPlayers.html');
            $template = str_replace('<!--AQUI_VEM_AS_LINHAS-->', $playersRows, $template);
            echo $template;
            break;

        default:

            break;
    }
}
