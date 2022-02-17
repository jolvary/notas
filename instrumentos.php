<?php
    //var_dump($_POST);
    function newInstForm() {
        ?>
        <TR>
	        <TD><INPUT TYPE='text' NAME='addNombre' size="40"></TD>
	        <TD><INPUT TYPE='text' NAME='addNomInst' size="40"></TD>
	        <TD><INPUT TYPE='text' NAME='addPeso' size="10"></TD>
            <TD><INPUT TYPE='text' NAME='addCalificacion' size="20"></TD>
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
    
<center>

    <h2><a href="index.php"><div style="float: left">Volver</div></a>
    <div align="center"><?php echo 'Asignatura ', $asig, " : ", $asignatura;?></div></h2>

    <h1 style="text-align:center;"><img src='iconos/smile.png'> INSTRUMENTOS DE EVALUACIÓN </h1>
    
    <FORM METHOD=POST ACTION="">
        <TABLE>
			<TR><TH>UNIDAD</TH><TH>Nombre del Instrumento</TH><TH>PESO (%)</TH><TH>CALIFICACIÓN</TH></TR>
		    <?php 
                deleteInst();
                updateInst();
                addInst();
                showInst();
                newInstForm();
            ?>
        </TABLE><br/>
		<INPUT TYPE="submit" name="procesar" value="Guardar Cambios">
		<INPUT TYPE="submit" name="procesar" value="Descartar Cambios">            
    </FORM>
    </center>
</BODY>

</HTML>

