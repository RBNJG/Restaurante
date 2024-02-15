
<?php
                $contador = 0;
                $categoriaActual = "";
                if ($productos == null) {
                ?>
                    <h2 class="mt-3 text-h2">Ningún producto cumple los requisitos</h2>
                    <?php
                } else {
                    foreach ($productos as $producto) {
                        if ($categoriaActual != $producto->getCategoria_id()) {;
                            if ($categoriaActual != "") {
                    ?>
            </div>
        <?php
                            }
                            $categoriaActual = $producto->getCategoria_id();
                            $categoria = CategoriaDAO::getCategoryName($categoriaActual);
        ?>
        <div class="row mt-4" id="<?= $categoria ?>">
            <div class="col-12">
                <h3 class="text-h2"><?= $categoria ?></h3>
            </div>
        </div>
        <div class="row mt-2 mb-2">
        <?php
                        }
        ?>
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="h-carta">
                <div class="h-100">
                    <div class="img-carta" style="background-image: url(<?= $producto->getImagen() ?>);"></div>
                    <div class="d-flex flex-column justify-content-between h-texto-carta">
                        <div class="">
                            <p class="mb-0 text subrayado"><?= $producto->getNombre_producto() ?></p>
                            <div class="d-flex justify-content-start align-items-center mb-3">
                                <picture>
                                    <img src="<?php if ($producto->getEstrellas() == 3) {
                                                    echo 'assets/images/carta/3_estrellas.svg';
                                                } else if ($producto->getEstrellas() == 4) {
                                                    echo 'assets/images/carta/4_estrellas.svg';
                                                } else if ($producto->getEstrellas() == 0) {
                                                    echo 'assets/images/carta/0_estrellas.svg';
                                                } ?>" alt="calificación" class="pt-0 estrella">
                                </picture>
                                <p class="mb-0 mt-1 ms-2 text-opiniones"><?= $producto->getOpiniones() ?> opiniones</p>
                            </div>
                            <?php if ($producto->getCoste_base() == $precio) { ?>
                                <picture class="w-100">
                                    <img src="assets/images/carta/precio_mas_bajo.svg" alt="precio más bajo" class="mb-2 precio-bajo">
                                </picture>
                            <?php
                            }
                            if ($producto->getDescuento() == 0) {
                            ?>
                                <p class="text-precio"><?= $producto->getCoste_base() ?> €</p>
                            <?php
                            } else {
                            ?>
                                <div class="d-flex align-items-center justify-content-center mb-2 cartel-descuento">
                                    <p class="mb-0 text text-cartel-descuento"><?php echo '- ' . number_format(round($producto->getCoste_base() - ($producto->getCoste_base() * $producto->getDescuento()), 2), 2) ?> €</p>
                                </div>
                                <div class="mb-1">
                                    <p class="mb-0 text text-precio-tachado"><?= $producto->getCoste_base() ?> €</p>
                                </div>
                                <div class="mb-1">
                                    <p class="mb-0 text text-precio color-descuento"><?php echo number_format(round($producto->getCoste_base() * $producto->getDescuento(), 2), 2) ?> €</p>
                                </div>
                            <?php
                            }
                            if ($producto->getEnvio_gratis() == true) {
                            ?>
                                <div class="d-flex justify-content-start align-items-center">
                                    <picture>
                                        <img src="assets/images/carta/tick_envio.svg" alt="envío gratis">
                                    </picture>
                                    <p class="mb-0 ms-1 mt-1 text-envio-gratis">Envío gratis</p>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="">
                            <form action=<?= url . "?controller=Carta&action=anadir" ?> method='post'>
                                <input name="producto_id" value="<?= $producto->getProducto_id() ?>" hidden />
                                <button class="btn-anadir-carrito" type="submit">Añadir al carrito</button>
                            </form>
                            <hr class="w-100 mb-0 mt-4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
                    }
                }
?>
        </div>