<?php
require_once "funciones.php";
require_once "conexion.php";
if($_SERVER["REQUEST_METHOD"]!=="POST") redirect("login.php");
verify_csrf();
$correo=trim($_POST["correo"]??"");$contrasena=$_POST["contraseña"]??"";
if($correo===""||$contrasena===""){flash("error_login","Completa todos los campos.");redirect("login.php");}
$stmt=$conexion->prepare("SELECT id_usuario,nombre_completo,correo,contraseña,rol,grado,estado FROM usuarios WHERE correo=? LIMIT 1");
if(!$stmt) die("Error de base de datos.");
$stmt->bind_param("s",$correo);$stmt->execute();$res=$stmt->get_result();$u=$res->fetch_assoc();$stmt->close();
if(!$u || $u["estado"]!=="activo" || !password_verify($contrasena,$u["contraseña"])){flash("error_login","Correo o contraseña incorrectos.");$conexion->close();redirect("login.php");}
session_regenerate_id(true);
$_SESSION["id_usuario"]=(int)$u["id_usuario"];$_SESSION["usuario"]=$u["nombre_completo"];$_SESSION["correo"]=$u["correo"];$_SESSION["rol"]=$u["rol"];$_SESSION["grado"]=$u["grado"];
$stmt=$conexion->prepare("UPDATE usuarios SET ultima_sesion=NOW() WHERE id_usuario=?");if($stmt){$stmt->bind_param("i",$_SESSION["id_usuario"]);$stmt->execute();$stmt->close();}
$stmt=$conexion->prepare("INSERT INTO ingresos_estudiantes(id_usuario) VALUES(?)");if($stmt){$stmt->bind_param("i",$_SESSION["id_usuario"]);$stmt->execute();$stmt->close();}
$conexion->close();redirect("index.php");
?>