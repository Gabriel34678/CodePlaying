<?php
session_start();
require "src/UsuarioDAO.php";


$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';


if (!$email || !$senha) {
    $_SESSION['msg'] = "Preencha e-mail e senha.";
    header("Location: login.php");
    exit;
}


$usuario = UsuarioDAO::validarUsuario(['email' => $email, 'senha' => $senha]);

if ($usuario) {
    $_SESSION['idusuarios'] = $usuario['idusuarios']; 
    $_SESSION['nome'] = $usuario['nome'];           
    $_SESSION['email'] = $usuario['email'];          
    $_SESSION['foto'] = $usuario['foto'];          

    header("Location: tela-inicial.php");
    exit;
} else {

    $_SESSION['msg'] = "Usuário ou senha inválido.";
    header("Location: login.php");
    exit;
}
?>
