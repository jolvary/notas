<?php
    //var_dump($_POST);
    function newUnitForm() {
        ?>
        <TR>
	        <TD><INPUT TYPE='text' NAME='addNum' size="10"></TD>
	        <TD><INPUT TYPE='text' NAME='addNombre' size="40"></TD>
	        <TD><INPUT TYPE='text' NAME='addPorcentaje' size="9"></TD>
        </TR>
        <?php   
    }

    include("funciones.php");

    $conn = conectar();
    $asig = $_GET['asignatura'];

    $sql = ("SELECT name FROM ESTUDIOS.ASIGNATURAS where code='$asig'");
    $nombre = $conn->query($sql);
    $code = mysqli_fetch_row($nombre);
	$asignatura = $code[0];

?>

<HTML>

<HEAD>
    <TITLE>UNIDADES</TITLE>
</HEAD>

<BODY>
    

    <h2><a href="index.php"><div style="float: left">Volver</div></a>
    <div align="center"><?php echo 'Asignatura ', $asig, " : ", $asignatura;?></div></h2>

    <h1 style="text-align:center;"><img src='iconos/tarta.png'> UNIDADES </h1>
    <center>
    <FORM METHOD=POST ACTION="">
        <TABLE>
			<TR><TH>NÚM</TH><TH>NOMBRE</TH><TH>PESO (%)</TH></TR>
		    <?php 
                deleteUnit();
                updateUnit();
                addUnit();
                showUnit();
                newUnitForm();
            ?>
        </TABLE><br/>
		<INPUT TYPE="submit" name="procesar" value="Guardar Cambios">
		<INPUT TYPE="submit" name="procesar" value="Descartar Cambios">            
    </FORM>
    </center>
</BODY>

</HTML>

