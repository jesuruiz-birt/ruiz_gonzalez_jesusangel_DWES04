<?php
require_once __DIR__ . '/../models/DAO/DiscoDAO.php';
require_once __DIR__ . '/../models/DTO/DiscoDTO.php';

class DiscosController {
    private $discoDAO;

    public function __construct() {
        $this->discoDAO = new DiscoDAO();
    }

    public function getAll() {
        $discos = $this->discoDAO->obtenerDiscos();
        header('Content-Type: application/json');
        echo json_encode($discos);
    }

    public function getById($id) {
        $disco = $this->discoDAO->obtenerDiscoPorId($id);
        header('Content-Type: application/json');
        if ($disco) {
            echo json_encode($disco);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Disco no encontrado']);
        }
    }

    public function create() {
        $data = json_decode(file_get_contents('php://input'), true);

        if (!$data) {
            http_response_code(400);
            echo json_encode(['error' => 'Datos no válidos']);
            return;
        }

        $disco = new DiscoDTO(null, $data['nombre'], $data['genero'], $data['anio_lanzamiento'], $data['id_artista']);
        $id = $this->discoDAO->crearDisco($disco);

        if ($id) {
            $disco->id_cancion = $id;
            header('Content-Type: application/json');
            http_response_code(201);
            echo json_encode($disco);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error al crear el disco']);
        }
    }

    public function update($id) {
        $data = json_decode(file_get_contents('php://input'), true);
    
        if (!$data) {
            http_response_code(400);
            echo json_encode(['error' => 'Datos no válidos']);
            return;
        }
    
        $discoExistente = $this->discoDAO->obtenerDiscoPorId($id);
    
        if (!$discoExistente) {
            http_response_code(404);
            echo json_encode(['error' => 'Disco no encontrado']);
            return;
        }
    
        $disco = new DiscoDTO(
            $id,
            $data['nombre'] ?? $discoExistente->nombre, 
            $data['genero'] ?? $discoExistente->genero, 
            $data['anio_lanzamiento'] ?? $discoExistente->anio_lanzamiento, 
            $discoExistente->id_artista 
        );
    
        $rowsAffected = $this->discoDAO->actualizarDisco($disco);
    
        if ($rowsAffected > 0) {
            header('Content-Type: application/json');
            echo json_encode($disco);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Disco no encontrado']);
        }
    }
    
    public function delete($id) {
        $rowsAffected = $this->discoDAO->eliminarDisco($id);

        if ($rowsAffected > 0) {
            http_response_code(204);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Disco no encontrado']);
        }
    }
}