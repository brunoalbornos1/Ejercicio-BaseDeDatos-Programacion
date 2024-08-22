<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Ejercicio con BD</title>
</head>
<body>
    
<?php
// include("functions.php");
require("conexion.php");
$con= conectar_bd() ;



?>
<div class="container">
    
   <div class="forms-container">
    <div class="div-forms">    
        <form class="formularioAñadirUser" action="functions.php" method="post">
            <h2 class="title">Añadir Cliente</h2>
            <div class="form-group">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-input" name="nombre" id="nombre" placeholder="Ingresa el Nombre...">
            </div>
            <div class="form-group">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-input" name="apellido" id="apellido" placeholder="Ingresa el Apellido...">
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-input" name="email" id="email" placeholder="Ingresa el Email...">
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-input" name="password" id="password" placeholder="Ingresa la Contraseña...">
            </div>
            <div class="form-group">
                <label for="dirCalle" class="form-label">Dirección de calle</label>
                <input type="text" class="form-input" name="dirCalle" id="dirCalle" placeholder="Ingresa la Direccion de calle...">
            </div>
            <div class="form-group">
                <label for="dirNum" class="form-label">Número de casa</label>
                <input type="text" class="form-input" name="dirNum" id="dirNum" placeholder="Ingresa el Número de casa...">
            </div>
            <button type="submit" class="form-button">Añadir Cliente</button>
        </form>
    </div>

    <div class="div-forms">
        <form class="formularioAñadirProducto" action="functions.php" method="post">
            <h2 class="title">Añadir Producto</h2>
            <div class="form-group">
                <label for="nombreProd" class="form-label">Nombre</label>
                <input type="text" class="form-input" name="nombreProd" id="nombreProd" placeholder="Ingresa el Nombre del producto...">
            </div>
            <div class="form-group">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" class="form-input" name="descripcion" id="descripcion" placeholder="Ingresa una Descripcion...">
            </div>
            <div class="form-group">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" class="form-input" name="precio" id="precio" placeholder="Ingresa el Precio...">
            </div>
            <div class="form-group">
                <label for="origen" class="form-label">Origen del producto</label>
                <input type="text" class="form-input" name="origen" id="origen" placeholder="Ingresa el Origen del producto...">
            </div>
            <button type="submit" class="form-button">Añadir Producto</button>
        </form>
    </div>

    <div class="div-forms">
        <h2 class="title">Funciones rápidas</h2>
        <form action="functions.php" method="post"> 
            <button type="submit" class="form-button" name="btn-show">Ver todas las tablas</button>
        </form>
        <br>
        <form action="functions.php" method="post">
            <div class="form-group">
                <label for="searchProd" class="form-label">Buscar Producto</label>
                <input type="number" class="form-input" name="searchProd" id="searchProd" placeholder="Ingresa la ID del Producto">
                <button type="submit" class="form-button">Buscar</button>
            </div>
        </form>
    </div>
</div>

    
  




<script src="script.js"></script>
</body>
</html>
