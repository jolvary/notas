<HTML>

<HEAD>
    <TITLE>RA5</TITLE>
</HEAD>

<BODY>
    <center>
    <h2>ASIGNATURAS</h2>
    <FORM METHOD=POST ACTION="">
        <TABLE>
			<TR><TH>CÓDIGO</TH><TH>NOMBRE</TH><TH>HORAS</TH><TH>PROFESOR</TH></TR>
		    <?php 
                include("funciones.php");
                deleteAsig();
                updateAsig();
                addAsig();
                showAsig();
                newAsigForm();
            ?>
        </TABLE><br/>
		<INPUT TYPE="submit" name="procesar" value="Guardar Cambios">
		<INPUT TYPE="submit" name="procesar" value="Descartar Cambios">            
    </FORM>
    </center>
</BODY>

</HTML>

<?php
    
    function newAsigForm() {
        ?>
        <TR>
	        <TD><INPUT TYPE='text' NAME='addCode' size="10"></TD>
	        <TD><INPUT TYPE='text' NAME='addName' size="40"></TD>
	        <TD><INPUT TYPE='text' NAME='addHour' size="9"></TD>
	        <TD><INPUT TYPE='text' NAME='addProf' size="40"></TD>
        </TR>
        <?php   
    }

?>
