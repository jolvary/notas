<HTML>

<HEAD>
    <TITLE>MI NEGOCIO</TITLE>
</HEAD>

<BODY>
    <center>
    <h2>ASIGNATURAS</h2>
    <FORM METHOD=POST ACTION="">
        <TABLE>
			<TR><TH>Código</TH><TH>Nombre</TH><TH>Horas/Sem</TH><TH>Profesor</TH></TR>
		    <?php 
                include("funciones.php");
                delAsi();
                addAsi();
                showTable();
                reload();
                newLine();

                var_dump($_POST);
            ?>
        </TABLE><br/>
		<INPUT TYPE="submit" name="procesar" value="Guardar Cambios">
		<INPUT TYPE="submit" name="procesar" value="Descartar Cambios">            
    </FORM>
    </center>
</BODY>

</HTML>

<?php

function newLine() {
    ?>
    <TR>
        <TD><INPUT TYPE='text' NAME='newCode' size="10"></TD>
        <TD><INPUT TYPE='text' NAME='newName' size="40"></TD>
        <TD><INPUT TYPE='text' NAME='newHour' size="9"></TD>
        <TD><INPUT TYPE='text' NAME='newProf' size="40"></TD>
    </TR>
    <?php   
}

?>