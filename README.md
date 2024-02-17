# Proyecto JavaScript

En este archivo se describe qué y cómo se ha implementado JavaScript en cada uno de los apartados requeridos para el proyecto, así cómo problemas que se han encontrado y la solución a estos.


# Opiniones del Restaurante

Para mostrar las opiniones del restaurante se ha decidido crear una nueva página dónde los usuarios pueden ver las opiniones de otros clientes así cómo dar ellos la suya si se han registrado y han realizado cómo mínimo un pedido.

## Obtener y mostrar opiniones

Para obtener las opiniones se ha utilizado **Fetch**, pidiendo a la API que nos devuelva todas las opiniones con toda la información de cada una. 
Luego todas estas opiniones se muestran de forma dinámica a través de JavaScript en la última sección de la página. Para mostrarlas, en lugar de utilizar el total de opiniones que nos devuelve el Fetch, se trabaja con una copia del array de opiniones para poder aplicar la paginación y los filtros.

## Insertar opiniones

Para insertar las opiniones se ha utilizado **Fetch**, enviando los datos que ha insertado el usuario en el formulario a la API para guardar en la base de datos la nueva opinión, después de esto se vuelven a cargar las opiniones para mostrar al momento la nueva opinión y se reinician los valores del formulario para insertar otra opinión si es necesario.

## Filtros de Opiniones

El filtro sobre las opiniones se ha realizado con **JavaScript**, se ha creado una copia del array de opiniones y sobre ésta se han aplicado métodos de array para filtrar  según las indicaciones del usuario. Se pueden filtrar las opiniones por el contenido de texto de la opinión a través de la barra de búsqueda y por valoración, además se pueden ordenar los resultados por fecha o por valoración.

## NotieJS

Para darle feedback al usuario sobre sus acciones, se ha implementado **NotieJS**. Cuando el usuario deja una nueva opinión, se le muestra un mensaje en la parte superior de la pantalla con un fondo verde para darle a entender que se ha guardado la opinión con éxito, cuándo el usuario no cumple las condiciones para dejar una opinión, o no ha rellenado todos los campos del formulario, se le muestra un mensaje con un fondo rojo en el que se le hace saber la razón por la que no puede cumplir la acción que intenta realizar. 

## Formulario de opiniones

El formulario con la opinión que inserta el usuario se envía con **Fetch**, en lugar de utilizar PHP, se envían los datos con JavaScript a la API, la cual se encarga de insertar la información en la base de datos.


# Programa de fidelidad

El programa de fidelidad está implementado en la clase de **UsuarioComun**, que tiene un atributo dónde acumula los puntos. Por cada 10€ de un pedido se genera 1 punto de fidelidad, y por cada punto de fidelidad canjeado se descuenta 1€ del total del pedido.

## Obtener los puntos del usuario

Al cargar la página del carrito se realiza una petición **Fetch** para obtener el Id del usuario y sus puntos de fidelidad, los cuales se guardan en unas variables globales para luego poder operar con ellas y descontar los puntos utilizados en la compra.

## Mostrar y utilizar puntos disponibles

Para mostrar y utilizar los puntos del usuario además de otros elementos de la página, se ha aplicado un **addEventListener** al **DOM** una vez se ha cargado, de forma que al aplicar los puntos de fidelidad, podemos ver de forma dinámica cómo estos aplican el descuento sobre el precio final del pedido, de la misma forma que si el usuario no tiene puntos de fidelidad acumulados, no se le permite abrir el apartado para aplicar los puntos y se le muestra una notificación con NotieJS.


# QR

Después de realizar un pedido el usuario es redirigido a otra página dónde se le informa de que el pedido se ha realizado con éxito y se le muestra un código **QR** que si lo escanea le redirigirá a una página con los detalles del pedido que acaba de realizar, para volver a la página Home puede hacer clic en el botón "continuar".

## Generador de QR

Para generar el código QR no se ha realizado una petición Fetch una API, ya que las diferentes API que probé no conseguí que generasen el QR del enlace que tocaba, en su lugar utilicé directamente la URL de "qrserver", que simplemente con añadirle al final la URL de la página de los detalles con su id correspondiente e insertar en el "src" de una etiqueta de imagen la URL completa ya genera el QR y lo muestra por pantalla.

## Mostrar QR por pantalla

Una vez generada la URL completa para crear el QR a través de la API de "qrserver" se le aplica esta URL a una etiqueta de imagen del HTML en "src", y una vez carga la página se muestra por pantalla.


# Propinas

Cuando el usuario quiere finalizar el pedido, antes de realizarlo, se muestra un popup en el que se le pregunta si quiere dejar una propina, la propina se realiza basada en un porcentaje sobre el pedido realizado. El usuario puede seleccionar el porcentaje a aplicar en la propina, desde el 1% hasta el 100%, y se le muestra el total de propina que dejará. El usuario puede cerrar el popup para volver a modificar el pedido, puede aceptar la propina y realizar el pedido, o omitir la propina y realizar el pedido.

## Detectar y mostrar propina

La propina se calcula a partir de una variable global que guarda el coste total del pedido, la cual se va actualizando según los productos que hay en el carrito, si hay coste envío o no, y los puntos de descuento aplicados.

## Aplicar propina a un input

Una vez el usuario decide dejar propina en el pedido, la variable global para la propina se asigna a un input oculto del formulario del pedido, de esta forma el pedido se genera a través del formulario con PHP, habiendo asignado también las variables del coste total, descuento y puntos de fidelidad generados a otros inputs ocultos del formulario.

# Filtro de productos

En la carta se pueden filtrar los productos por distintos atributos, cómo valoración, precio, envío gratuito y producto en oferta, además de poder ordenar los productos por precio o más vendidos. Los productos se obtienen con un **Fecth** si estos no estaban previamente guardados en **localStorage**, de esta forma si el usuario ya había visitado la página anteriormente se puede mejorar el rendimiento al no tener que hacer la llamada a la API para obtener los productos. Luego sobre estos productos se hace una copia del array, sobre el que se utilizarán distintos métodos de filtrado.

## Métodos de array para filtrar

En cuanto al filtrado en el array de productos se ha utilizado ".filter", aplicando los filtros según si el usuario había marcados los distintos checkbox o introducido los inputs de precio.

## Valor checkbox

Los checkbox se utilizan para definir que valoraciones deben tener los productos, si el producto tiene envío gratuito o si el producto está en oferta.
En la función JS que aplica los filtros primero se comprueba si el estado de estos es "checked" y en el caso de que así sea se aplica el filtro sobre los productos.
