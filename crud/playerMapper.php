<?php
require_once 'connection.php';
require_once 'player.php';
require_once 'app.php';
use pdo_poo\Database;
class playerMapper{

    public function createPlayer(player $player)
    {

        $db = Database::getInstance();
        try {

            $id = $player->getId();
            $name = $player->getName();
            $userName = $player->getUserName();
            $email = $player->getEmail();
            $password = $player->getPassword();
            $dateRegister = $player->getDateRegister();

            $stmt = $db->prepare("INSERT INTO players (id, name, userName, email, password, dateRegister) 
                                  VALUES (:id, :name, :userName, :email, :password, :dateRegister)");

            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':userName', $userName);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':dateRegister', $dateRegister);

            $stmt->execute();
        } catch (\PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
        } finally{
             Database::closeInstance();
        }

    }

    public function updatePlayer(player $player)
    {


    }


    public function deletePlayer(player $player)
    {


    }

   /* public static function searchPlayer(player $player->getId)
    {


    }

    public static function listAll()
    {


    }
   */
}
//jogadorMapper->criaJogador chama na classe main(app.php)