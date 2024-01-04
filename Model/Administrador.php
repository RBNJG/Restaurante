<?php

class Administrador extends Usuario {

    // Propiedades específicas de administrador
    private $area_responsable;

    public function setArea_responsable($area) {
        $this->area_responsable = $area;
    }

    public function getArea_responsable() {
        return $this->area_responsable;
    }
}