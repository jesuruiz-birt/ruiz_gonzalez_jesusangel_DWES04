<?php
require_once __DIR__ . '/../models/DAO/DiscoDAO.php';

class Disco {
    public $id;
    public $name;
    public $artist;
    public $type_of_music;
    public $release_date;

    public function __construct($id, $name, $artist, $type_of_music, $release_date) {
        $this->id = $id;
        $this->name = $name;
        $this->artist = $artist;
        $this->type_of_music = $type_of_music;
        $this->release_date = $release_date;
    }


    public static function getAll() {
        $discoDAO = new DiscoDAO();
        return $discoDAO->obtenerDiscos(); 
    }

    public static function getById($id) {
        $discoDAO = new DiscoDAO();
        return $discoDAO->obtenerDiscoPorId($id); 
    }

    public static function saveAll($discos) {
        throw new Exception("Esta función ya no es necesaria. Los datos se guardan en la base de datos.");
    }

    public function toArray() {
        return get_object_vars($this);
    }
}