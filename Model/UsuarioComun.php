<?php

class UsuarioComun extends Usuario {

    // Propiedades específicas del usuario común
    private $puntos_fidelidad;

    public function sumarPuntos($puntos){
        $this->puntos_fidelidad += $puntos;
    }

    public function setPuntos_fidelidad($puntos) {
        $this->puntos_fidelidad = $puntos;
    }

    public function getPuntos_fidelidad() {
        return $this->puntos_fidelidad;
    }
}