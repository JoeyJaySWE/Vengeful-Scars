<?php
namespace model\db;

class DBManager
{
    private static $instance;
    private $pdo;

    const DB_IP = "localhost";
    const DB_PORT = "3306";
    const DB_USER = "207231_zv87806";
    const DB_PASS = "ZerxiaDemented1";
    const DB_NAME = "207231-vengefulscars";

    private function __construct()
    {
        try {
            $this->pdo = new \PDO("mysql:host=".self::DB_IP.";dbname=".self::DB_NAME, self::DB_USER, self::DB_PASS);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->pdo->query("USE ".self::DB_NAME);
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public static function getInstance(){
        if (self::$instance === null){
            self::$instance = new DBManager();
        }
        return self::$instance;
    }

    public function getConnection(){
        return $this->pdo;
    }
}