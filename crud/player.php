<?php

class player
{
    private $id;
    private $name;
    private $userName;
    private $email;
    private $password;
    private $dateRegister;


    public function setId( $id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }


    public function setName($name)
    {
        $this->name = $name;
    }
    public function getName()
    {
        return $this->name;
    }


    public function setUserName($userName)
    {
        $this->userName = $userName;
    }
    public function getUserName()
    {
        return $this->userName;
    }


    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getEmail()
    {
        return $this->email;
    }


    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function getPassword()
    {
        return $this->password;
    }


    public function setDateRegister($dateRegister)
    {
        $this->dateRegister = $dateRegister;

    }
    public function getDateRegister()
    {
        return $this->dateRegister;
    }


}
