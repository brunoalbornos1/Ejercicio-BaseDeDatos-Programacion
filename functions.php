<?php
include("conexion.php");
$con=conectar_bd();

$id = $_POST['ID'];
$nombre = $_POST['nombreCurso'];
$apellido = $_POST['nombreCortoCurso'];
$email = $_POST['email'];
$password = $_POST['password'];
$dirCalle = $_POST['calle'];
$dirNum = $_POST['num'];



function AgregarUsuario($con, $id ,$nombre, $apellido, $email, $password,$dirCalle,$dirNum){
    
        $consulta_insertar_user= "INSERT INTO `usuario`(`ID`, `Nombre`, `Password`, `DireccionDeCalle`, `Apellido`, `Email`, `NumeroDeDir`) VALUES 
        ('$id','$nombre','$password','$dirCalle','$apellido','$email','$dirNum')";
    
        if (mysqli_query($con, $consulta_insertar_user)) {
            
    
            // consultar_datos($con);
    
    
      } else {
            echo "Error: " . $consulta_insertar_user . "<br>" . mysqli_error($con);
      }
    
    }
    



    function consultar_datos($con) {


        $consulta = "SELECT * FROM usuario";
        $resultado = mysqli_query($con, $consulta);
       
        // Inicializo una variable para guardar los resultados
        $salida = "";
       
        //si se recupera algun registro de la consulta
        if (mysqli_num_rows($resultado) > 0) {
    
            //mientras haya registros..
            $salida = "<table class='tabla'>";
            $salida .= "<tr><th>ID</th><th>Nombre</th><th>Contraseña</th><th></tr>";
            while ($fila = mysqli_fetch_assoc($resultado)) {
                $salida .= "<tr><td>" . $fila["ID"] . "</td><td>" . $fila["Nombre"] . "</td><td>" . $fila["Password"] . "</td></tr>";
            }
            $salida .= "</table>";
            }else{
                $salida = "Sin datos";
                }
        
    
        return $salida;
    }
    



?>






?>