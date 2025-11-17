<?php
require_once "src/AmizadeDAO.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['idusuarios'])) {
    header("Location: login.php");
    exit;
}

$idLogado = $_SESSION['idusuarios'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['idAmigo'])) {
    $idAmigo = intval($_POST['idAmigo']);
    AmizadeDAO::removerAmigo($idLogado, $idAmigo);
}

// Volta para a página de amigos
header("Location: minhas-amizades.php");
exit;
