<?php
declare(strict_types=1);
if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }
function e(?string $value): string { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }
function redirect(string $url): never { header('Location: '.$url); exit; }
function is_admin_path(): bool { return strpos(str_replace('\\','/', $_SERVER['PHP_SELF'] ?? ''), '/admin/') !== false; }
function require_login(): void { if (empty($_SESSION['id_usuario'])) redirect(is_admin_path() ? '../login.php' : 'login.php'); }
function require_admin(): void { require_login(); if (($_SESSION['rol'] ?? '') !== 'administrador') { http_response_code(403); exit('Acceso restringido.'); } }
function csrf_token(): string { if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32)); return $_SESSION['csrf']; }
function verify_csrf(): void { if (!hash_equals((string)($_SESSION['csrf'] ?? ''), (string)($_POST['csrf'] ?? ''))) { http_response_code(419); exit('Solicitud no válida.'); } }
function flash(string $key,string $msg): void { $_SESSION[$key]=$msg; }
function get_flash(string $key): string { $m=(string)($_SESSION[$key]??''); unset($_SESSION[$key]); return $m; }
function audit(mysqli $db, ?int $userId, string $action, string $table, ?int $recordId, string $detail=''): void { $s=$db->prepare('INSERT INTO auditoria(id_usuario,accion,tabla_afectada,id_registro,detalle) VALUES(?,?,?,?,?)'); if($s){ $s->bind_param('issis',$userId,$action,$table,$recordId,$detail); $s->execute(); $s->close(); } }
?>
