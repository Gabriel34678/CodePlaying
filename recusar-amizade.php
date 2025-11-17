<?php
session_start();
require_once "src/AmizadeDAO.php";

if (!isset($_SESSION['idusuarios'])) {
    header("Location: login.php");
    exit;
}

$idLogado = $_SESSION['idusuarios'];
$idAmigo = intval($_GET['id'] ?? 0);

if ($idAmigo) {
    AmizadeDAO::recusarAmizade($idLogado, $idAmigo);
    $_SESSION['mensagem'] = "Amizade recusada!";
}

header("Location: meus-pedidos.php");
exit;
