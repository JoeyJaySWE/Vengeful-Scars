<?php

namespace model\db;

use model\User;

class UserDao
{
    private static $instance;
    private $pdo;

    private function __construct(){
        $this->pdo = DBManager::getInstance()->getConnection();
    }

    public static function getInstance(){
        if (self::$instance === null){
            self::$instance = new UserDao();
        }
        return self::$instance;
    }

    public function existsUser(User $u){
        $mySQL = "SELECT count(*) AS number FROM users WHERE email = ?";
        $stmt = $this->pdo->prepare($mySQL);
        $params=[$u->getEmail()];
        $stmt->execute($params);
        return $stmt->fetch(\PDO::FETCH_ASSOC)["number"] > 0;
    }

    public function existsUserUsername(User $u){
        $mySQL = "SELECT count(*) AS number FROM users WHERE username = ?";
        $stmt = $this->pdo->prepare($mySQL);
        $params=[$u->getUsername()];
        $stmt->execute($params);
        return $stmt->fetch(\PDO::FETCH_ASSOC)["number"] > 0;
    }

    public function changeEmail(User $u){
        $mySQL = "UPDATE users SET email = ? WHERE user_id = ?";
        $stmt = $this->pdo->prepare($mySQL);
        $params=[$u->getEmail(),$u->getId()];
        $stmt->execute($params);
        $success = "changed";
        return $success;
    }

    public function changeUsername(User $u){
        $mySQL = "UPDATE users SET username = ? WHERE user_id = ?";
        $stmt = $this->pdo->prepare($mySQL);
        $params=[$u->getUsername(),$u->getId()];
        $stmt->execute($params);
        $success = "changed";
        return $success;
    }

    public function insertUser(User $u){
        $mySQL = "INSERT INTO users (username,password,email, profile_pic) VALUES (?,?,?,?)";
        $stmt = $this->pdo->prepare($mySQL);
        $params=[$u->getUsername(),$u->getPassword(),$u->getEmail(),$u->getProfilePic()];
        $stmt->execute($params);
        $u->setId($this->pdo->lastInsertId());
    }

    public function loginUser(User $u){
        $mySQL = "SELECT password FROM users WHERE email=?";
        $stmt = $this->pdo->prepare($mySQL);
        $params=[$u->getEmail()];
        $stmt->execute($params);
        $password_db = $stmt->fetch(\PDO::FETCH_ASSOC)["password"];

        if($password_db==$u->getPassword()){
            $mySQL = "SELECT user_id, username, profile_pic FROM users WHERE email = ? AND password = ?";
            $stmt = $this->pdo->prepare($mySQL);
            $params=[$u->getEmail(), $u->getPassword()];
            $stmt->execute($params);
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            $u->setId($row["user_id"]);
            $u->setUsername($row["username"]);
            $u->setProfilePic($row["profile_pic"]);
        }
        else{
            return false;
        }

    }

}