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
    AmizadeDAO::aceitarAmizade($idLogado, $idAmigo);
    $_SESSION['mensagem'] = "Amizade aceita!";
}

header("Location: meus-pedidos.php");
exit;
