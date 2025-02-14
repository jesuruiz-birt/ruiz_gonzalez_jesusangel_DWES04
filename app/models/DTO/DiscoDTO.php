<?php

class DiscoDTO implements JsonSerializable {
    public $id_cancion;
    public $nombre;
    public $genero;
    public $anio_lanzamiento;
    public $id_artista;

    public function __construct($id_cancion, $nombre, $genero, $anio_lanzamiento, $id_artista) {
        $this->id_cancion = $id_cancion;
        $this->nombre = $nombre;
        $this->genero = $genero;
        $this->anio_lanzamiento = $anio_lanzamiento;
        $this->id_artista = $id_artista;
    }

    public function jsonSerialize() {
        return [
            'id_cancion' => $this->id_cancion,
            'nombre' => $this->nombre,
            'genero' => $this->genero,
            'anio_lanzamiento' => $this->anio_lanzamiento,
            'id_artista' => $this->id_artista,
        ];
    }
}