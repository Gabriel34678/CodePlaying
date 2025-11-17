<?php
// Evita cache do navegador
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

include "incs/topo.php";
require_once "src/UsuarioDAO.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['idusuarios'])) {
    header("Location: login.php");
    exit;
}

$idLogado = $_SESSION['idusuarios'];
$fotoLogado = $_SESSION['foto'] ?? 'default.png';

// Pega o amigo da URL
if (!isset($_GET['amigo'])) {
    echo "Amigo não especificado!";
    exit;
}
$idAmigo = intval($_GET['amigo']);

// Verifica se são amigos
$amigos = UsuarioDAO::listarAmigos($idLogado);
$idsAmigos = array_column($amigos, 'idusuarios');
if (!in_array($idAmigo, $idsAmigos)) {
    echo "Você só pode conversar com seus amigos!";
    exit;
}

// Conexão
$conn = ConexaoBD::conectar();

// Enviar mensagem
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['mensagem'])) {
    $msg = trim($_POST['mensagem']);
    $sql = "INSERT INTO mensagens (idremetente, iddestinatario, mensagem) VALUES (:rem, :dest, :msg)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':rem' => $idLogado,
        ':dest' => $idAmigo,
        ':msg' => $msg
    ]);
    header("Location: chat.php?amigo=$idAmigo");
    exit;
}

// Pega mensagens
$sql = "SELECT m.*, u.nome, u.foto, (m.idremetente = :idLogado) AS ehMeu
        FROM mensagens m
        JOIN usuarios u ON u.idusuarios = m.idremetente
        WHERE (idremetente = :idLogado AND iddestinatario = :idAmigo)
           OR (idremetente = :idAmigo AND iddestinatario = :idLogado)
        ORDER BY criado_em ASC";
$stmt = $conn->prepare($sql);
$stmt->execute([':idLogado' => $idLogado, ':idAmigo' => $idAmigo]);
$mensagens = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Nome e foto do amigo
$sql = "SELECT nome, foto FROM usuarios WHERE idusuarios = :idAmigo";
$stmt = $conn->prepare($sql);
$stmt->execute([':idAmigo' => $idAmigo]);
$amigo = $stmt->fetch(PDO::FETCH_ASSOC);
$nomeAmigo = $amigo['nome'];
$fotoAmigo = $amigo['foto'] ?? 'default.png';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Chat com <?= htmlspecialchars($nomeAmigo) ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
body {
    margin: 0;
    background: linear-gradient(160deg, #65b6b6ff, #0ad8dfff);
    font-family: Arial, sans-serif;
}

/* Chat centralizado */
.chat-app {
    position: absolute;
    top: 60px; bottom: 0; left: 0; right: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    background: linear-gradient(160deg, #53c0c2ff, #a8e6cf);
    padding: 20px;
    overflow: hidden;
    box-shadow: inset 0 0 50px rgba(0,0,0,0.05);
}

/* Mensagens */
#chatMessages {
    flex: 1;
    width: 70%;
    max-width: 1000px;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    gap: 15px;
    margin: 0 auto;
    padding-right: 15px;
    padding-left: 15px;
    box-sizing: border-box;
    background: rgba(255,255,255,0.1);
    border-radius: 20px;
    padding-top: 20px;
    padding-bottom: 20px;
}

.chat-message {
    display: flex;
    align-items: flex-end;
    word-break: break-word;
}

.meu-msg {
    align-self: flex-end;
    flex-direction: row-reverse;
    gap: 10px;
}

.amigo-msg {
    align-self: flex-start;
    gap: 10px;
}

.mensagem-texto {
    padding: 12px 18px;
    border-radius: 20px;
    font-size: 16px;
    max-width: 100%;
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
}

.meu-msg .mensagem-texto { background-color: #147279ff; color: #fff; }
.amigo-msg .mensagem-texto { background-color: #ffffffcc; color: #000; }

/* Avatar */
.avatar {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #fff;
    box-shadow: 0 1px 3px rgba(0,0,0,0.2);
}

/* Input */
#chatInputContainer {
    display: flex;
    flex-direction: row-reverse;
    gap: 10px;
    margin: 15px auto 0;
    width: 70%;
    max-width: 1000px;
}

#chatInputContainer input {
    flex: 1;
    padding: 12px 18px;
    border-radius: 25px;
    border: 1px solid #ccc;
    font-size: 16px;
    outline: none;
    box-sizing: border-box;
}

#chatInputContainer input:focus {
    border-color: #147279ff;
    box-shadow: 0 0 5px rgba(20,114,121,0.5);
}

#chatInputContainer button {
    background-color: #147279ff;
    border: none;
    color: white;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    cursor: pointer;
}

#chatInputContainer button:hover {
    background-color: #0d5f61;
}

/* Scroll */
#chatMessages::-webkit-scrollbar {
    width: 8px;
}
#chatMessages::-webkit-scrollbar-thumb {
    background-color: #147279ff;
    border-radius: 4px;
}
#chatMessages::-webkit-scrollbar-track {
    background: rgba(255,255,255,0.2);
}

/* Responsividade */
@media(max-width:768px){
    #chatMessages, #chatInputContainer { width: 95%; }
    .mensagem-texto { max-width: 80%; font-size: 15px; }
    .avatar { width: 35px; height: 35px; }
    #chatInputContainer button { width: 50px; height: 50px; }
}
</style>
</head>
<body>
<div class="chat-app">
    <div id="chatMessages">
        <?php foreach ($mensagens as $m): ?>
            <div class="chat-message <?= $m['ehMeu'] ? 'meu-msg' : 'amigo-msg' ?>">
                <?php if ($m['ehMeu']): ?>
                    <div class="mensagem-texto"><?= htmlspecialchars($m['mensagem']) ?></div>
                <?php else: ?>
                    <img src="uploads/<?= htmlspecialchars($m['foto'] ?? $fotoAmigo) ?>" class="avatar">
                    <div class="mensagem-texto"><?= htmlspecialchars($m['mensagem']) ?></div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <form method="post" id="chatInputContainer" onsubmit="return enviarMensagem();">
        <button type="submit"><i class="fas fa-paper-plane"></i></button>
        <input type="text" name="mensagem" id="mensagemInput" placeholder="Escreva sua mensagem..." required>
    </form>
</div>

<script>
// Scroll e foco
const chatMessages = document.getElementById('chatMessages');
chatMessages.scrollTop = chatMessages.scrollHeight;

document.addEventListener("DOMContentLoaded", function() {
    const mensagemInput = document.getElementById('mensagemInput');
    mensagemInput.focus();
});

// Função de envio
function enviarMensagem(){
    const msg = document.getElementById('mensagemInput').value.trim();
    if(msg === '') return false;
}
</script>
</body>
</html>
