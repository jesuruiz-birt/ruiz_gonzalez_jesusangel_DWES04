<?php
class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        $configFile = __DIR__ . '/../config/db-conf.json';
        if (!file_exists($configFile)) {
            die("Error: Archivo de configuración no encontrado en: " . $configFile);
        }

        $config = json_decode(file_get_contents($configFile), true);

        if ($config === null) {
            die("Error: El archivo de configuración no contiene JSON válido.");
        }

        $this->pdo = new PDO("mysql:host={$config['host']};dbname={$config['db_name']};charset=utf8", $config['user'], $config['password']);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance->pdo;
    }
}