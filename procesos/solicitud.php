<?php
include('../clases/conexion.php');
$hCodigo        = (isset($_REQUEST['hCodigo'])?$_REQUEST['hCodigo']:null);
$accion         = (isset($_REQUEST['accion'])?$_REQUEST['accion']:'insert');
$idPersona      = (isset($_REQUEST['idPersona'])?$_REQUEST['idPersona']:null);
$nombrePersona  = (isset($_REQUEST['nombrePersona'])?$_REQUEST['nombrePersona']:null);
$slcTipo        = (isset($_REQUEST['slcTipo'])?$_REQUEST['slcTipo']:null);
$txtFecha       = (isset($_REQUEST['txtFecha'])?$_REQUEST['txtFecha']:null);
$txtComentario  = (isset($_REQUEST['txtComentario'])?$_REQUEST['txtComentario']:null);
$slcMotivo      = (isset($_REQUEST['slcMotivo'])?$_REQUEST['slcMotivo']:null);
$txtestado      = (isset($_REQUEST['txtestado'])?$_REQUEST['txtestado']:null);
$desac          = '';

if (isset($_REQUEST['btnGuardar'])){
    $sqlConsulta = "SELECT us.idusuario, per.idpersona, per.nombre, us.user, us.pass, us.idtipo, us.activo FROM tblusuario us INNER JOIN 
    tblpersona per ON per.idpersona = us.idpersona WHERE nombre ='$user' AND activo!='0'";
    $rsMostrar =  $bdConexion->ejecutarSql($sqlConsulta);
    $fila = mysqli_fetch_array($rsMostrar);
    $activo = $fila["activo"];
                if ($activo == 0 ){
                    session_destroy();                        
                    header("location:../forms/frmLogin.php");
                }else{
                    if ($accion=='insert'){
                        $tabla      = "tblsolicitud";
                        $campos     = "idpersona, idtipo, fecha, comentario, idmotivo, estado";
                        $valores    = "$idPersona, $slcTipo, '$txtFecha', '$txtComentario', $slcMotivo, '$txtestado'";
                        $resultado  = $bdConexion->insertarDB($tabla,$campos,$valores);
                        $hCodigo = $bdConexion->retornarId();
                        if($resultado==1){
                            $desac = 'disabled';
                            print "<br><br><div class='container'>
                                        <div class='alert alert-success alert-dismissable'>
                                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                            <strong>¡Éxito!</strong> Registro guardado de forma exitosa.
                                        </div>
                                        </div>";
                            
                        }
                    }
                }
}//Fin de boton Guardar

if (isset($_REQUEST['accion']) and $_REQUEST['accion']=='resolver'){
    $sqlConsulta = "SELECT us.idusuario, per.idpersona, per.nombre, us.user, us.pass, us.idtipo, us.activo FROM tblusuario us INNER JOIN 
    tblpersona per ON per.idpersona = us.idpersona WHERE nombre ='$user' AND activo!='0'";
    $rsMostrar =  $bdConexion->ejecutarSql($sqlConsulta);
    $fila = mysqli_fetch_array($rsMostrar);
    $activo = $fila["activo"];
                if ($activo == 0 ){
                    session_destroy();                        
                    header("location:../forms/frmLogin.php");
                }else{
                    $tabla		= "tblsolicitud";
                    $campos		= "estado = 0";
                    $condicion	= "idsolicitud = $hCodigo";
                    $resultado  = $bdConexion->actualizarDB($tabla,$campos,$condicion);
                }
}//Fin boton Resolver

if ($_SESSION['usuario'] == 'Iniciar Sesión'){echo '<script type="text/javascript">javascript:window.location="../index.php"</script>';}

?>