<?php
session_start(); // topo do arquivo

header('Content-Type: application/json');
ini_set('display_errors', 0);
error_reporting(0);

require_once 'src/SalvarJogoDAO.php';

// Pega o ID do usuário logado da sessão
$idUsuario = isset($_SESSION['idusuarios']) ? intval($_SESSION['idusuarios']) : 0;

// Pega os outros dados enviados pelo fetch
$pontuacao = isset($_POST['pontuacao']) ? intval($_POST['pontuacao']) : 0;
$tempo_jogo = isset($_POST['tempo_jogo']) ? floatval($_POST['tempo_jogo']) : 0;
$objetivos = isset($_POST['objetivos_completos']) ? intval($_POST['objetivos_completos']) : 0;
$pl1 = isset($_POST['pl1']) ? intval($_POST['pl1']) : 0;
$pl2 = isset($_POST['pl2']) ? intval($_POST['pl2']) : 0;
$pl3 = isset($_POST['pl3']) ? intval($_POST['pl3']) : 0;

$response = ['success' => false, 'msg' => 'Erro desconhecido'];

try {
    if ($idUsuario > 0) {
        $salvo = SalvarJogoDAO::salvarJogo($idUsuario, $pontuacao, $tempo_jogo, $objetivos, $pl1, $pl2, $pl3);
        if ($salvo) {
            $response['success'] = true;
            $response['msg'] = 'Jogo salvo com sucesso!';
        } else {
            $response['msg'] = 'Erro ao salvar no banco.';
        }
    } else {
        $response['msg'] = 'Usuário não está logado.';
    }
} catch (Exception $e) {
    $response['msg'] = 'Erro interno: ' . $e->getMessage();
}

echo json_encode($response);
