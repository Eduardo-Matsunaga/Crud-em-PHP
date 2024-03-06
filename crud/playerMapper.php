<?php
require_once 'player.php';
require_once 'app.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

            $stmt =$db->prepare("INSERT INTO players (id, name, userName, email, password, dateRegister) 
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

    public function getPlayerById( $id)
    {
        $db = Database::getInstance();
        try {
            $stmt = $db->prepare('SELECT * FROM players WHERE id = :id');
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $player = new player();
                $player->setId($result['id']);
                $player->setName($result['name']);
                $player->setUserName($result['userName']);
                $player->setEmail($result['email']);
                $player->setPassword($result['password']);
                $player->setDateRegister($result['dateRegister']);
                return $player;
            }
            return null;
        } catch (\PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
        } finally {
            Database::closeInstance();
        }

    }

    public function updatePlayer(player $player){
        $db = Database::getInstance();
        try {
            $id = $player->getId();
            $name = $player->getName();
            $userName = $player->getUserName();
            $email = $player->getEmail();
            $password = $player->getPassword();
            $dateRegister = $player->getDateRegister();



            $stmt = $db->prepare("UPDATE players 
                                  SET name = :name, userName = :userName, email = :email, 
                                      password = :password, dateRegister = :dateRegister
                                  WHERE id = :id");

            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':userName', $userName);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':dateRegister', $dateRegister);

            $stmt->execute();
        } catch (\PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
        } finally {
            Database::closeInstance();
        }
    }


    /*
        public function deletePlayer(player $player)
        {


        }

       public static function searchPlayer(player $player->getId)
        {


        }
     */
    public static function listAll()
    {
        $db = Database::getInstance();
        try {

          $stmt = $db -> prepare('SELECT * FROM players');
          $stmt -> execute();
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

          return $result;


        } catch (\PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
        } finally{
            Database::closeInstance();
        }


    }

}
//jogadorMapper->criaJogador chama na classe main(app.php)