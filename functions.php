<link rel="stylesheet" href="style.css">
<?php
include("conexion.php");
$con = conectar_bd();

// Verificar si la conexión es exitosa
if (!$con) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Procesar el formulario de añadir usuario
if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['dirCalle']) && isset($_POST['dirNum'])) {
    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $dirCalle = $_POST['dirCalle'];
    $dirNum = $_POST['dirNum'];

    echo '<div class="container">'; 
    AgregarUsuario($con, $nombre, $apellido, $email, $password, $dirCalle, $dirNum);
    echo '<br>' . '<button class="form-button" id="back"><a href="index.php">Volver a la página principal</a></button>';
    echo"</div>";
    // Llamar a la función para agregar usuario
}

// Procesar el formulario de añadir producto
if (isset($_POST['nombreProd']) && isset($_POST['precio']) && isset($_POST['descripcion']) && isset($_POST['origen'])) {
    $nombre = $_POST['nombreProd'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $origen = $_POST['origen'];
    echo '<div class="container">';
    AgregarProducto($con, $nombre, $descripcion, $precio, $origen);
    echo '<br>' . '<button class="form-button" id="back"><a href="index.php">Volver a la página principal</a></button>';
    echo"</div>";   
}

// INSERT INTO `detalle`(`Codigo`, `Descripcion`, `Origen`, `IDProductos`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]')


if (isset($_POST['btn-show'])) {
    echo '<div class="container">'; 
    echo consultar_datos_Usuario($con);
    echo consultar_datos_Producto($con);
    echo consultar_datos_Detalles($con);
    echo '<br>' . '<button class="form-button" id="back"><a href="index.php">Volver a la página principal</a></button>';
    echo"</div>";
}

if (isset($_POST['searchProd'])) {
    $searchProd = $_POST['searchProd'];
    echo '<div class="container">';
    echo buscar_Producto($con, $searchProd);
    echo '<br>' . '<button class="form-button" id="back"><a href="index.php">Volver a la página principal</a></button>';
    echo"</div>";
}



// Funcion de agregar Usuario/Cliente
function AgregarUsuario($con, $nombre, $apellido, $email, $password, $dirCalle, $dirNum)
{
    $text = "<h4 class='text'>Cliente agregado con exito!</h4>";
    $consulta_insertar_user = "INSERT INTO usuario (Nombre, Contrasenia, DireccionDeCalle, Apellido, Email, NumeroDeDir) VALUES 
    ('$nombre', '$password', '$dirCalle', '$apellido', '$email', '$dirNum')";

    if (mysqli_query($con, $consulta_insertar_user)) {
        echo $text;
        // Mostrar los datos
        echo consultar_datos_Usuario($con);
    } else {
        echo "Error al insertar datos: " . mysqli_error($con) . "<br>";
        echo "Consulta: " . $consulta_insertar_user . "<br>";
    }
}


// Funcion de agregar Producto
function AgregarProducto($con, $nombre, $descripcion, $precio, $origen)
{
    $text = "<h4 class='text'>Producto y detalle agregados con éxito!</h4>";
    // Insertar en la tabla productos
    $consulta_insertar_producto = "INSERT INTO `productos`(`Nombre`,`Precio`) VALUES ('$nombre','$precio')";

    if (mysqli_query($con, $consulta_insertar_producto)) {
        // Obtener el ID del producto recién insertado
        $id_producto = mysqli_insert_id($con);

        // Insertar en la tabla detalle, utilizando el ID del producto
        $consulta_insertar_detalle = "INSERT INTO `detalle`(`Descripcion`, `Origen`, `IDProductos`) VALUES 
        ('$descripcion', '$origen', '$id_producto')";

        if (mysqli_query($con, $consulta_insertar_detalle)) {
            echo $text;
        } else {
            echo "Error al insertar detalle: " . mysqli_error($con) . "<br>";
            echo "Consulta: " . $consulta_insertar_detalle . "<br>";
        }

        // Mostrar los datos
        echo consultar_datos_Producto($con);
        echo consultar_datos_Detalles($con);
    } else {
        echo "Error al insertar producto: " . mysqli_error($con) . "<br>";
        echo "Consulta: " . $consulta_insertar_producto . "<br>";
    }
}






function consultar_datos_Usuario($con)
{
    $consulta = "SELECT * FROM usuario";
    $resultado = mysqli_query($con, $consulta);

    if (!$resultado) {
        return "Error en la consulta: " . mysqli_error($con);
    }

    // Inicializo una variable para guardar los resultados
    $salida = "";

    // Si se recupera algún registro de la consulta
    if (mysqli_num_rows($resultado) > 0) {
        // Construir la tabla HTML
        $salida = "<h2 class='title'>Clientes</h2> <br> <table class='tabla'>";
        $salida .= "<tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Email</th><th>Contraseña</th><th>Dirección de calle</th><th>Dirección de casa</th></tr>";

        // Mientras haya registros, construir filas de la tabla
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $salida .= "<tr><td>" . $fila["ID"] . "</td><td>" . $fila["Nombre"] . "</td><td>" . $fila["Apellido"] . "</td><td>" .
                $fila["Email"] . "</td><td>" . $fila["Contrasenia"] . "</td><td>" . $fila["DireccionDeCalle"] . "</td><td>" . $fila["NumeroDeDir"] . "</td></tr>";
        }
        $salida .= "</table> <br>";
    } else {
        $salida = "Sin datos <br>";
    }

    // Liberar el resultado
    mysqli_free_result($resultado);

    return $salida;
}





function consultar_datos_Producto($con)
{
    $consulta = "SELECT * FROM productos";
    $resultado = mysqli_query($con, $consulta);

    if (!$resultado) {
        return "Error en la consulta: " . mysqli_error($con);
    }

    // Inicializo una variable para guardar los resultados
    $salida = "";

    // Si se recupera algún registro de la consulta
    if (mysqli_num_rows($resultado) > 0) {
        // Construir la tabla HTML
        $salida = "<h2 class='title'>Productos</h2> <br> <table class='tabla'>";
        $salida .= "<tr><th>ID</th><th>Nombre</th><th>Precio</th></tr>";

        // Mientras haya registros, construir filas de la tabla
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $salida .= "<tr><td>" . $fila["ID"] . "</td><td>" . $fila["Nombre"] . "</td><td>" .
                $fila["Precio"] . "</td></tr>";
        }
        $salida .= "</table> <br>";
    } else {
        $salida = "Sin datos <br>";
    }

    // Liberar el resultado
    mysqli_free_result($resultado);

    return $salida;
}



function consultar_datos_Detalles($con)
{
    $consulta = "SELECT * FROM detalle";
    $resultado = mysqli_query($con, $consulta);

    if (!$resultado) {
        return "Error en la consulta: " . mysqli_error($con);
    }

    // Inicializo una variable para guardar los resultados
    $salida = "";

    // Si se recupera algún registro de la consulta
    if (mysqli_num_rows($resultado) > 0) {
        // Construir la tabla HTML
        $salida = "<h2 class='title'>Detalles</h2> <br> <table class='tabla'>";
        $salida .= "<tr><th>ID</th><th>Descripcion</th><th>Origen</th><th>ID del Producto</th></tr>";

        // Mientras haya registros, construir filas de la tabla
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $salida .= "<tr><td>" . $fila["Codigo"] . "</td><td>" . $fila["Descripcion"] . "</td><td>" .
                $fila["Origen"] . "</td><td>" . $fila["IDProductos"] . "</td></tr>";
        }
        $salida .= "</table>";
    } else {
        $salida = "Sin datos";
    }

    // Liberar el resultado
    mysqli_free_result($resultado);

    return $salida;
}


function buscar_Producto($con, $searchProd) {
    // Preparar la consulta SQL para evitar inyecciones SQL
    $consulta = "SELECT * FROM productos WHERE id = ?";

    // Preparar la declaración
    if ($stmt = mysqli_prepare($con, $consulta)) {
        // Enlazar los parámetros
        mysqli_stmt_bind_param($stmt, "i", $searchProd);

        // Ejecutar la declaración
        mysqli_stmt_execute($stmt);

        // Obtener los resultados
        $resultado = mysqli_stmt_get_result($stmt);

        // Verificar si se encontraron resultados
        if (mysqli_num_rows($resultado) > 0) {
            // Iniciar la construcción de la tabla
            $salida = "<h2 class='title'>Resultados de la busqueda</h2> <br> <table class='tabla'>";
            $salida .= "<tr><th>ID</th><th>Nombre</th><th>Precio</th></tr>";  // Cabeceras de la tabla
            
            // Obtener los datos y construir las filas de la tabla
            while ($fila = mysqli_fetch_assoc($resultado)) {
                $salida .= "<tr><td>" . $fila['ID'] . "</td><td>" .  $fila['Nombre'] . "</td><td>" .  $fila['Precio'] . "</td></tr>";
            }

            $salida .= "</table>";  // Cerrar la tabla

            // Devolver la tabla
            return $salida;
        } else {
            return "<h3>No se encontró el producto con el ID: $searchProd</h3>";
        }

        // Cerrar la declaración
        mysqli_stmt_close($stmt);
    } else {
        // Mostrar un error si la preparación de la consulta falla
        return "Error al preparar la consulta: " . mysqli_error($con);
    }
}


// Cerrar la conexión (opcional, si no se necesita más)
mysqli_close($con);



?>
