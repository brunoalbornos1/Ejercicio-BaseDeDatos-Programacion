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

require("conexion.php");
$con= conectar_bd() ;


function consultar_usuario($con) {
    $consulta = "SELECT * FROM usuario";
    $resultado = mysqli_query($con, $consulta);
   
    // Inicializo una variable para guardar los resultados
    $salida = "";
   
    //si se recupera algun registro de la consulta
    if (mysqli_num_rows($resultado) > 0) {

        //mientras haya registros..
        $salida = "<table class='tabla'>";
        $salida .= "<tr><th>ID</th><th>Nombre</th><th>Contraseña</th></tr>";
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $salida .= "<tr><td>" . $fila["ID"] . "</td><td>" . $fila["Nombre"] . "</td><td>" . $fila["Password"] . "</td></tr>";
        }
        $salida .= "</table>";
        }else{
            $salida = "Sin datos";
            }
    

    return $salida;
}





function consultar_producto($con) {
    $consulta = "SELECT * FROM productos";
    $resultado = mysqli_query($con, $consulta);
   
    // Inicializo una variable para guardar los resultados
    $salida = "";
   
    //si se recupera algun registro de la consulta
    if (mysqli_num_rows($resultado) > 0) {

        //mientras haya registros..
        $salida = "<table class='tabla'>";
        $salida .= "<tr><th>ID</th><th>Nombre</th><th>Descripcion</th><th>Precio</th></tr>";
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $salida .= "<tr><td> " . $fila["ID"] . "</td><td>" . $fila["Nombre"] . "</td><td>" . $fila["Descripcion"] . "</td><td>" . $fila["Precio"] .  "</td></tr>";
        }
         $salida .= "</table>";
        }else{
            $salida = "Sin datos";
            }

    return $salida;
}

function consultar_compra($con) {
    $consulta = "SELECT * FROM compra";
    $resultado = mysqli_query($con, $consulta);
   
    // Inicializo una variable para guardar los resultados
    $salida = "";
   
    //si se recupera algun registro de la consulta
    if (mysqli_num_rows($resultado) > 0) {

        //mientras haya registros..
        $salida = "<table class='tabla'>";
        $salida .= "<tr><th>ID</th><th>Fecha</th><th>ID-Producto</th><th>ID-Usuario</th></tr>";
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $salida .= "<tr><td>" . $fila["ID"] . "</td><td>" . $fila["Fecha"] . "</td><td>" . $fila["IDProductos"] . "</td><td>" . $fila["IDUsuario"] .  "</td></tr>";
        }
        $salida .= "</table>";
    } else {
        $salida = "Sin datos ";
    }

    return $salida;
}

function consulta_tres($con) {
    $consulta = "SELECT usuario.ID, usuario.Nombre FROM compra JOIN usuario ON compra.IDUsuario = usuario.ID GROUP BY usuario.ID, usuario.Nombre";
    $resultado = mysqli_query($con, $consulta);
   
    // Inicializo una variable para guardar los resultados
    $salida = "";
   
    //si se recupera algun registro de la consulta
    if (mysqli_num_rows($resultado) > 0) {

        //mientras haya registros..
        $salida = "<table class='tabla'>";
        $salida .= "<tr><th>Los usuarios que compraron fueron</th></tr>";
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $salida .= "<tr><td> --> ". $fila["Nombre"] .  "</td></tr>";
        }
        $salida .= "</table>";
    } else {
        $salida = "Sin datos ";
    }

    return $salida;
}


function consulta_cuatro($con) {
    $consulta = " SELECT productos.Descripcion FROM compra JOIN productos ON compra.IDProductos = productos.ID WHERE compra.IDUsuario = 3";
    $resultado = mysqli_query($con, $consulta);
   
    // Inicializo una variable para guardar los resultados
    $salida = "";
   
    //si se recupera algun registro de la consulta
    if (mysqli_num_rows($resultado) > 0) {

        //mientras haya registros..
        $salida = "<table class='tabla'>";
        $salida .= "<tr><th>La descripcion del producto que compro el usuario 3 fue</th></tr>";
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $salida .= "<tr><td> --> ". $fila["Descripcion"] .  "</td></tr>";
            $salida .= "</table>";
        }
    } else {
        $salida = "Sin datos ";
    }

    return $salida;
}









$salida_usuario= consultar_usuario($con);
$salida_producto= consultar_producto($con);
$salida_compra= consultar_compra($con);
$salida_tres= consulta_tres($con);
$salida_cuatro= consulta_cuatro($con);

echo $salida_usuario;

echo "<br>";
echo $salida_producto;
echo "<br>";
echo $salida_compra;
echo "<br>";
echo $salida_tres;
echo "<br>";
echo $salida_cuatro;


mysqli_close($con);   


?>

<form class="formularioAñadirUser" action="functions.php.php" method="post">
                <h2 class="title">Añadir Usuario</h2>
                <div>
                    <div class="col-md-6 form-group">
                        <label for="nombreCurso" class="form-label text-uppercase">Nombre</label>
                        <input type="text" class="" name="nombre">
                        <div id="nombreCursoHelp" class="form-text">Ingrese el nombre del cliente</div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="nombreCortoCurso" class="form-label text-uppercase">Nombre Corto del curso</label>
                        <input type="text" class="form-control" id="nombreCortoCurso" name="nombreCortoCurso" aria-describedby="nombreCortoCurso">
                        <div id="nombreCortoCursoHelp" class="form-text">Ingrese el Nombre Corto del curso.</div>
                    </div>
                </div>
                <div >
                  <div class="col-md-12 form-group">
                    <label for="observacionesCurso" class="text-uppercase">Observaciones</label>
                    <textarea class="form-control" id="observacionesCurso" name="observacionesCurso" rows="3" placeholder="Ingresa tús observaciones"></textarea>
                  </div>
                </div>
                <div>
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-success text-uppercase btn-lg btn-block" id="errores">Guardar Curso</button>
                    </div>
                </div>
                
                <div>
                  <div class="alert alert-danger btn-block text-center font-weight-bold" role="alert" id="mostrarError">
                    
                  </div> 
                </div>
</form>



</body>
</html>
