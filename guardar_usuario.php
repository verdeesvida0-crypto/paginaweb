<?php
require_once "funciones.php";
require_once "conexion.php";
if($_SERVER["REQUEST_METHOD"]!=="POST") redirect("registro.php");
verify_csrf();
$nombre=trim($_POST["nombre"]??""); $correo=trim($_POST["correo"]??""); $contrasena=$_POST["contraseña"]??"";
$rol=trim($_POST["rol"]??"visitante"); $grado=trim($_POST["grado"]??"");
$roles=["estudiante","profesor","visitante"];
if(!in_array($rol,$roles,true)) $rol="visitante";

if($nombre===""||$correo===""||$contrasena===""){flash("error_registro","Completa todos los campos obligatorios.");redirect("registro.php");}
if(!filter_var($correo,FILTER_VALIDATE_EMAIL)){flash("error_registro","El correo no es válido.");redirect("registro.php");}
if(strlen($contrasena)<8){flash("error_registro","La contraseña debe tener al menos 8 caracteres.");redirect("registro.php");}

// El registro de estudiantes solo permite grados del 1° al 11°.
if($rol === "estudiante"){
    if($grado === '' || !ctype_digit($grado) || (int)$grado < 1 || (int)$grado > 11){
        flash("error_registro","El grado debe estar entre 1° y 11°.");
        redirect("registro.php");
    }
    $grado=(string)(int)$grado;
}else{
    // Profesores y visitantes no necesitan grado.
    $grado="";
}

$stmt=$conexion->prepare("SELECT id_usuario FROM usuarios WHERE correo=? LIMIT 1"); if(!$stmt) die("Error de base de datos.");
$stmt->bind_param("s",$correo);$stmt->execute();$stmt->store_result();
if($stmt->num_rows){$stmt->close();flash("error_registro","Ese correo ya está registrado.");redirect("registro.php");}
$stmt->close();$hash=password_hash($contrasena,PASSWORD_DEFAULT);
$stmt=$conexion->prepare("INSERT INTO usuarios(nombre_completo,correo,contraseña,rol,grado,estado) VALUES(?,?,?,?,?,'activo')");
if(!$stmt) die("Error de base de datos.");
$stmt->bind_param("sssss",$nombre,$correo,$hash,$rol,$grado);
if(!$stmt->execute()){ $stmt->close(); die("No se pudo registrar el usuario."); }
$id=$stmt->insert_id;$stmt->close();
$stmt=$conexion->prepare("INSERT INTO auditoria(id_usuario,accion,tabla_afectada,id_registro,detalle) VALUES(NULL,'registro','usuarios',?,?)");
if($stmt){$detalle="Registro de cuenta: ".$rol.($grado!==''?" - grado ".$grado:"");$stmt->bind_param("is",$id,$detalle);$stmt->execute();$stmt->close();}
$conexion->close();flash("exito_registro","Cuenta creada correctamente. Ahora puedes iniciar sesión.");redirect("login.php");
?>
