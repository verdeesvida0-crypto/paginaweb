<?php
require_once "funciones.php";require_once "conexion.php";require_login();
$numero='573226065687';$idu=(int)$_SESSION['id_usuario'];$asunto=trim($_GET['asunto']??'Contacto general');
$stmt=$conexion->prepare("INSERT INTO whatsapp_eventos(id_usuario,telefono_destino,asunto) VALUES(?,?,?)");
if($stmt){$stmt->bind_param("iss",$idu,$numero,$asunto);$stmt->execute();$stmt->close();}
$conexion->close();header("Location: https://wa.me/".$numero);exit;
?>