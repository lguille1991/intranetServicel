<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include ('../plantilla/plantilla.php');
include('../clases/sesion.php');
include('../procesos/slcPolitica.php');
$interfaz = new plantilla($user,$dir);
$interfaz->header($rol);
$interfaz->body();
?>
<body>
<br>
<script Language="JavaScript">
        function validate(){
            var cmb1 = document.getElementById("slcReporte").value;
            if(cmb1==0){
                alert("Por favor seleccionar políticas a visualizar");
                return false;
            }
        }
</script>
<div class="container">
    <div class="row3">
        <br>
        <h3 class="text-center text-muted">
            <strong>SELECCIÓN DE POLÍTICA</strong>
        </h3>
        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 form-wrap">
            <form  action="#" method="GET" name="frm" id="frm">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <select name="slcPolitica" id="slcPolitica" class="form-control">
					    <option value="0">Selecccionar políticas a visualizar</option>
                        <option value="1">Prueba política</option>
                    </select>
                </div>
                <br>
                    <button type="submit" class="btn btn-primary btnGuardar" name="btnSeleccionar" onclick="return validate()">Seleccionar</button>
                    <a href="../index.php" id="btnCancelar" class="btn btn-warning">Cancelar</a>    
            </form>
        </div>
    </div><!--Fin row3-->
</div><!--Fin Container-->
</body>
</html>