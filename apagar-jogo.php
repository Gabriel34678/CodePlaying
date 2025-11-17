<?php
session_start();

if (!isset($_SESSION['idusuarios'])) {
    header("Location: login.php");
    exit;
}

require_once "src/ConexaoBD.php";

$idusuario = $_SESSION['idusuarios'];
$idjogo = $_POST['idjogo'] ?? null;

if ($idjogo) {
    // conecta ao banco
    $pdo = ConexaoBD::conectar();

    // apaga apenas o jogo do usuário logado
    $stmt = $pdo->prepare("DELETE FROM jogo WHERE idjogo = ? AND idusuario = ?");
    $stmt->execute([$idjogo, $idusuario]);
}

// redireciona de volta para a página de registros
header("Location: registro-jogos.php");
exit;
