<?php

function conectar() {

     $conn = mysqli_connect("localhost", "administrador", "iO5TvRslT18VYcV9");
     return $conn;

}

function newDB() {

    $conn = conectar();

    $sql = ("create database if not exists Estudios");
    $result = $conn->query($sql);

    if ($result) {

        echo "La base se ha creado correctamente.";

    } else {

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

function showTable() {

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
	        echo "    <TD><a href='index.php?operacion=delasi&code=$fila[0]'>";
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

function delAsi() {

    if(isset($_GET['operacion'])&&$_GET['operacion']=="delasi") {

        $code = $_GET['code'];
        $conn = conectar();
	    $sql = "DELETE FROM ESTUDIOS.ASIGNATURAS WHERE code='$code'";
	    
        $conn->query($sql);

    }
}

function addAsi() {

    $conn = conectar();
    if(isset($_POST['newCode'])&&$_POST['newCode']!="") {
     	$code = $_POST["newCode"];
        $name = $_POST["newName"];
        $hour = $_POST["newHour"];
        $prof = $_POST["newProf"];
	    $sql = "INSERT INTO ESTUDIOS.ASIGNATURAS VALUES ( '$code','$name', '$hour', '$prof' )";
	    $conn->query($sql);   
    }

}

function updAsi ($code, $newCode, $name, $hour, $prof )
{
	$conn = conectar();
	$sql = "UPDATE ESTUDIOS.ASIGNATURAS SET code='$newCode', name='$name', hour='$hour', prof='$prof' WHERE code='$code'";
	$conn->query($sql);
}

function reload()
{
    if(!isset($_POST['procesar'])||$_POST['procesar']!='Guardar Cambios')
       return;
    if(!isset($_POST["code"]))
       return;
	$conn = conectar();
	$codes = $_POST["code"];
	$newCodes = $_POST["newCode"];
	$names = $_POST["name"];
	$hours = $_POST["hour"];
	$profs = $_POST["prof"];
	for($i=0; $i<count($_POST["code"]); $i++) {

        if ($newCodes != ''){

		    updAsi ($codes[$i], $codes[$i], $names[$i], $hours[$i], $profs[$i] );

        } else {

            updAsi ($codes[$i], $newCodes[$i], $names[$i], $hours[$i], $profs[$i] );

        }
}
}
?>