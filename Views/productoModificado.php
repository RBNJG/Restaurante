<?php
include_once 'config/parameters.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto modificado</title>
</head>

<body>
    <p>Producto modificado correctamente</p>
    <script>
        setTimeout(function() {
            window.location.href = "<?= url?>";
        }, 2000);
    </script>
</body>

</html>