<?php
require_once __DIR__ . '/../../core/Database.php';
require_once __DIR__ . '/../DTO/DiscoDTO.php';

class DiscoDAO {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function obtenerDiscos() {
        $stmt = $this->db->query("SELECT * FROM canciones"); 
        $discos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $discosDTO = [];
        foreach ($discos as $disco) {
            $discosDTO[] = new DiscoDTO(
                $disco['id_cancion'],
                $disco['nombre'],
                $disco['genero'],
                $disco['anio_lanzamiento'],
                $disco['id_artista'] 
            );
        }
        return $discosDTO;
    }
    
    public function obtenerDiscoPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM canciones WHERE id_cancion = ?"); 
        $stmt->execute([$id]);
        $disco = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($disco) {
            return new DiscoDTO(
                $disco['id_cancion'],
                $disco['nombre'],
                $disco['genero'],
                $disco['anio_lanzamiento'],
                $disco['id_artista'] 
            );
        } else {
            return null;
        }
    }

    public function crearDisco($disco) {
        $stmt = $this->db->prepare("INSERT INTO canciones (nombre, genero, anio_lanzamiento, id_artista) VALUES (?, ?, ?, ?)");
        $stmt->execute([$disco->nombre, $disco->genero, $disco->anio_lanzamiento, $disco->id_artista]);
        return $this->db->lastInsertId();
    }

    public function actualizarDisco($disco) {
        var_dump($disco);
        $stmt = $this->db->prepare("UPDATE canciones SET nombre = ?, genero = ?, anio_lanzamiento = ?, id_artista = ? WHERE id_cancion = ?");
        $stmt->execute([$disco->nombre, $disco->genero, $disco->anio_lanzamiento, $disco->id_artista, $disco->id_cancion]);
        return $stmt->rowCount();
    }

    public function eliminarDisco($id) {
        $stmt = $this->db->prepare("DELETE FROM canciones WHERE id_cancion = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }
}