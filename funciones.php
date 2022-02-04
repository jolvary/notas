<?php

function conectar()
{
	// Conectar al host localhost 
	$conn =@ mysqli_connect ( "localhost", "administrador", "iO5TvRslT18VYcV9", 'Estudios');
	// Comprobar errores
	if ( mysqli_connect_errno () != 0 )	{
		echo "ERROR al conectarse con la base de datos<br />";
		echo "Error n�mero: " . mysqli_connect_errno() . "<br />";
		echo "Descripci�n del error: " . mysqli_connect_error() . "<br />";
		exit();
	}
	return $conn;
}

function crearBd ( $conn, $bd )
{
	$sql = "CREATE DATABASE IF NOT EXISTS $bd";
	$conn->query( $sql );
}

function poblarFormulario() {
	$conn = conectar();
    $sql = "SELECT * FROM ESTUDIOS.ASIGNATURAS";

	if ($result = mysqli_query($conn, $sql)) {
        $cont=0;
		while ($fila = mysqli_fetch_row($result)) {
            echo "<TR>";
	        echo "    <INPUT TYPE='hidden' name='code[$cont]' value='$fila[0]'>";
	        echo "    <TD><INPUT TYPE='text' name='newCode[$cont]' value='$fila[0]' size='10'></TD>";
	        echo "    <TD><INPUT TYPE='text' name='name[$cont]' value='$fila[1]' size='40'></TD>";
	        echo "    <TD><INPUT TYPE='text' name='hour[$cont]' value='$fila[2]' size='9'></TD>";
	        echo "    <TD><INPUT TYPE='text' name='prof[$cont]' value='$fila[3]' size='40'></TD>";
	        echo "    <TD><a href='index.php?operacion=eliminar&asignatura=$fila[0]'>";
            echo "        <img src='iconos/remove32.png'></a></TD>";
            echo "    <TD><a href='unidades.php?code=$fila[0]'>";
            echo "        <img src='iconos/tarta.png'></a></TD>";
            echo "    <TD><a href='instrumentos.php?code=$fila[0]'>";
            echo "        <img src='iconos/smile.png'></a></TD>";
            echo "    <TD><a href='expediente.php'>";
            echo "        <img src='iconos/birrete.png'></a></TD>";
            echo "</TR>";
            $cont++;
        }
		mysqli_free_result($result);
	}

}

function eliminarCliente() {
    if(isset($_GET['operacion'])&&$_GET['operacion']=="eliminar") {
        $code = $_GET['asignatura'];
        $conn = conectar();
	    $sql = "DELETE FROM ESTUDIOS.ASIGNATURAS WHERE code='$code'";
	    $conn->query( $sql );
    }
}

function anadirClienteFormulario()
{
    if(!isset($_POST['procesar'])||$_POST['procesar']!='Guardar Cambios'){
        return;
     }
     if(!isset($_POST["code"]))
        return;
    $conn = conectar();
    if(isset($_POST['addCode'])&&$_POST['addCode']!="") {
     	$code = $_POST["addCode"];
        $name = $_POST["addName"];
        $hour = $_POST["addHour"];
        $prof = $_POST["addProf"];
	    $sql = "INSERT INTO ESTUDIOS.ASIGNATURAS VALUES ( '$code','$name', '$hour', '$prof' )";
	    $conn->query( $sql );   
    }   

}

function actualizarCliente ($code, $newCode, $name, $hour, $prof )
{
	$conn = conectar();
	$sql = "UPDATE ESTUDIOS.ASIGNATURAS SET code='$newCode', name='$name', hour='$hour', prof='$prof' WHERE code='$code'";
	$conn->query( $sql );
}

function procesarModificacionesFormulario()
{
    if(!isset($_POST['procesar'])||$_POST['procesar']!='Guardar Cambios'){
       return;
    }
    if(!isset($_POST["code"]))
       return;
	$conn = conectar();
	$codes = $_POST["code"];
	$newCodes = $_POST["newCode"];
	$names = $_POST["name"];
	$hours = $_POST["hour"];
	$profs = $_POST["prof"];
	for($i=0; $i<count($_POST["code"]); $i++) 
		actualizarCliente ($codes[$i], $newCodes[$i], $names[$i], $hours[$i], $profs[$i] );
}


?>