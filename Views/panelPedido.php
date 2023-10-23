<?php

echo 'Este es tu panel de pedido' . "<br>";

$productos = ProductoDAO::getAllProducts();

foreach ($productos as $producto) {
    echo $producto ->getNombre_producto() . " " ."<button onclick=''>Añadir</button>". " " ."<button onclick=''>Eliminar</button>" . "<br>";
}
