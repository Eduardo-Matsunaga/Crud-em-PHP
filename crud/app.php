<?php

require_once 'player.php';
require_once 'playerMapper.php';
require_once 'connection.php';



$id = $_POST['id'];
$name = $_POST['name'];
$userName = $_POST['userName'];
$email = $_POST['email'];
$password = $_POST['password'];
$dateRegister = $_POST['dateRegister'];


$playerMapper = new playerMapper();

    $player = new player();
    $player->setId( $id);
    $player-> setName($name);
    $player->setUserName($userName);
    $player->setEmail($email);
    $player->setPassword($password);
    $player->setDateRegister($dateRegister);

    $playerMapper ->createPlayer($player);




