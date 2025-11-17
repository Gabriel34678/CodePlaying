<?php
require_once "src/UsuarioDAO.php";

// Só processa se vier via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dados = [
        'nome'  => $_POST['nome'] ?? '',
        'email' => $_POST['email'] ?? '',
        'senha' => $_POST['senha'] ?? ''
    ];

    // Tenta cadastrar
    if (UsuarioDAO::cadastrarUsuario($dados)) {
        // Sucesso: redireciona
        header("Location: index.php");
        exit;
    } else {
        // Falha: email já cadastrado
        echo '<div style="margin:20px; padding:10px; background:#f8d7da; color:#842029; border-radius:5px;">';
        echo 'Erro ao cadastrar usuário: este email já está cadastrado!';
        echo '</div>';
    }
}
?>
