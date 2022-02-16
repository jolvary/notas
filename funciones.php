<?php

// CREACIÓN BÁSICA BASE DE DATOS

function conectar()
{

	$conn = mysqli_connect ( "localhost", "administrador", "iO5TvRslT18VYcV9", 'Estudios');

	if ( mysqli_connect_errno () != 0 )	{
		echo "ERROR al conectarse con la base de datos<br />";
		echo "Error n�mero: " . mysqli_connect_errno() . "<br />";
		echo "Descripci�n del error: " . mysqli_connect_error() . "<br />";
		exit();
	}
	return $conn;
	
}

function newDB() {

    $conn = $conn =@ mysqli_connect ( "localhost", "administrador", "iO5TvRslT18VYcV9");

    $sql = ("create database if not exists Estudios");
    $result = $conn->query($sql);

    if (!$result) {

        die("Ha fallado la conexión debido a : ".mysqli_connect_error());

    }

}

function delDB() {

    $conn = conectar();

    $sql = ("drop database if exists Estudios");
    $result = $conn->query($sql);

    if ($result) {

        echo "La base se ha eliminado correctamente.";

    } else {

        die("Ha fallado la conexión debido a : ".mysqli_connect_error());

    }

}

function pobDB() {

    $conn = mysqli_connect("localhost", "administrador", "iO5TvRslT18VYcV9", "Estudios");

    if ($conn) {

        $sql = file_get_contents('pob.sql');

        $conn->multi_query($sql);

    } else {

        echo "Ha ocurrido un error";

    }

}

?>

<?php

// OPERACIONES SOBRE LA TABLA ASIGNATURAS

function showAsig() {

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
            echo "    <TD><a href='unidades.php?asignatura=$fila[0]'>";
            echo "        <img src='iconos/tarta.png'></a></TD>";
            echo "    <TD><a href='instrumentos.php?asignatura=$fila[0]'>";
            echo "        <img src='iconos/smile.png'></a></TD>";
            echo "    <TD><a href='expediente.php'>";
            echo "        <img src='iconos/birrete.png'></a></TD>";
            echo "</TR>";
            $cont++;

        }

		mysqli_free_result($result);

	}

}

function deleteAsig() {

    if(isset($_GET['operacion'])&&$_GET['operacion']=="eliminar") {

        $code = $_GET['asignatura'];
        $conn = conectar();

	    $sql = "DELETE FROM ESTUDIOS.ASIGNATURAS WHERE code='$code'";
	    $conn->query( $sql );

    }

}

function addAsig() {

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

function reloadAsig ($code, $newCode, $name, $hour, $prof ) {

	$conn = conectar();
	$sql = "UPDATE ESTUDIOS.ASIGNATURAS SET code='$newCode', name='$name', hour='$hour', prof='$prof' WHERE code='$code'";
	$conn->query( $sql );

}

function updateAsig() {

    if(!isset($_POST['procesar'])||$_POST['procesar']!='Guardar Cambios'){

       return;

    }

    if(!isset($_POST["code"])) {

       return;

	}
	
	$conn = conectar();
	$codes = $_POST["code"];
	$newCodes = $_POST["newCode"];
	$names = $_POST["name"];
	$hours = $_POST["hour"];
	$profs = $_POST["prof"];

	for($i=0; $i<count($_POST["code"]); $i++) 

		reloadAsig ($codes[$i], $newCodes[$i], $names[$i], $hours[$i], $profs[$i] );

}

?>

<?php

// OPERACIONES SOBRE LA TABLA UNIDADES

function showUnit() {

	$conn = conectar();
	$unidad = $_GET['asignatura'];
    $sql = "SELECT * FROM ESTUDIOS.UNIDADES where asignatura='$unidad'";

	if ($result = mysqli_query($conn, $sql)) {

        $cont=0;

		while ($fila = mysqli_fetch_row($result)) {

            echo "<TR>";
	        echo "    <INPUT TYPE='hidden' name='clave[$cont]' value='$fila[0]'>";
	        echo "    <TD><INPUT TYPE='text' name='numUnit[$cont]' value='$fila[2]' size='10'></TD>";
	        echo "    <TD><INPUT TYPE='text' name='nombre[$cont]' value='$fila[3]' size='40'></TD>";
	        echo "    <TD><INPUT TYPE='text' name='porcentaje[$cont]' value='$fila[4]' size='9'></TD>";
	        echo "    <TD><a href='unidades.php?asignatura=$unidad&operacion=eliminar&unidad=$fila[0]'>";
            echo "        <img src='iconos/remove32.png'></a></TD>";
            $cont++;

        }

		mysqli_free_result($result);

	}

}

function deleteUnit() {

    if(isset($_GET['operacion'])&&$_GET['operacion']=="eliminar") {

        $clave = $_GET['unidad'];
        $conn = conectar();

	    $sql = "DELETE FROM ESTUDIOS.UNIDADES WHERE clave='$clave'";
		$result = $conn->query($sql);

    }

}

function addUnit() {

    if(!isset($_POST['procesar'])||$_POST['procesar']!='Guardar Cambios'){

        return;

     }

	if(!isset($_POST["clave"]))

        return;

    if(isset($_POST['addNum'])&&$_POST['addNum']!="") {

		$conn = conectar();

		$selNum = ($conn->query( "SELECT clave FROM ESTUDIOS.UNIDADES ORDER BY clave DESC LIMIT 1" ));
		$code = mysqli_fetch_row($selNum);
		$idUnit = $code[0] + 1;
		$clave = $_GET['asignatura'];
     	$uni = $_POST["addNum"];
        $name = $_POST["addNombre"];
        $porc = $_POST["addPorcentaje"];

	    $sql = "INSERT INTO ESTUDIOS.UNIDADES ( clave, asignatura, numero, nombre, porcentaje ) VALUES ( '$idUnit', '$clave', '$uni', '$name', '$porc' )";
	    $result = $conn->query( $sql );
	
		if (!$result) {

			die("Ha fallado la conexión debido a : ".mysqli_error($conn));

		}

	}   

}

function reloadUnit ($code, $newUnit, $name, $proc ) {

	$conn = conectar();
	$sql = "UPDATE ESTUDIOS.UNIDADES SET numero='$newUnit', nombre='$name', porcentaje='$proc' WHERE clave='$code'";
	$result = $conn->query( $sql );
	
	if (!$result) {

		die("Ha fallado la conexión debido a : ".mysqli_error($conn));

	}

}

function updateUnit() {

    if(!isset($_POST['procesar'])||$_POST['procesar']!='Guardar Cambios'){

       return;

    }

    if(!isset($_POST["clave"])) {

       return;

	}
	
	$conn = conectar();
	$codes = $_POST["clave"];
	$newCodes = $_POST["numUnit"];
	$names = $_POST["nombre"];
	$procs = $_POST["porcentaje"];

	for($i=0; $i<count($_POST["clave"]); $i++) 

		reloadUnit ($codes[$i], $newCodes[$i], $names[$i], $procs[$i] );

}

?>