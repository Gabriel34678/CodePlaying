<?php
include "incs/topo.php";
require_once "src/UsuarioDAO.php";
require_once "src/AmizadeDAO.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['idusuarios'])) {
    header("Location: login.php");
    exit;
}

$idLogado = $_SESSION['idusuarios'];
$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['codigo_usuario'])) {
    $codigo = $_POST['codigo_usuario'];
    $partes = explode('#', $codigo);

    if (count($partes) === 2) {
        $nome = trim($partes[0]);
        $idDestino = intval($partes[1]);

        // Verifica se o ID existe no banco
        $usuario = UsuarioDAO::buscarUsuarioPorId($idDestino);

        if (!$usuario) {
            $mensagem = "Usuário não encontrado!";
        } elseif ($usuario['nome'] !== $nome) {
            $mensagem = "Usuário não encontrado!"; // Nome não bate com o ID
        } elseif ($idDestino == $idLogado) {
            $mensagem = "Você não pode enviar pedido para si mesmo!";
        } else {
            // Tenta enviar o pedido
            if (AmizadeDAO::enviarPedidoAmizade($idLogado, $idDestino)) {
                $mensagem = "Pedido enviado com sucesso!";
            } else {
                $mensagem = "Já existe amizade ou pedido pendente.";
            }
        }

    } else {
        $mensagem = "Código inválido!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Adicionar Amigos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8fffe;
      font-family: "Poppins", sans-serif;
    }
    .card-adicionar {
      background-color: #3dbdb6;
      color: white;
      border-radius: 15px;
      text-align: center;
      padding: 30px 20px;
      width: 380px;
      margin: 100px auto 20px auto;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    .card-adicionar h3 {
      font-weight: 600;
      font-size: 22px;
      margin-bottom: 10px;
    }
    .card-adicionar p {
      margin-bottom: 20px;
      font-size: 15px;
    }
    .icones {
      font-size: 30px;
      display: flex;
      justify-content: center;
      gap: 25px;
    }
    .campo-usuario {
      display: block;
      width: 100%;
      background-color: #83E0DD;
      border: none;
      border-radius: 10px;
      padding: 12px 16px;
      font-size: 16px;
      color: #000;
      margin: 25px auto 10px auto;
      outline: none;
    }
    .btn-enviar {
        width: 100%;
      display: block;
      width: 380px;
      background-color: #00E0D1;
      border: none;
      border-radius: 10px;
      color: black;
      font-weight: 500;
      padding: 12px 16px;
      margin: 0 auto;
      box-shadow: 2px 3px 5px rgba(0,0,0,0.2);
      transition: 0.2s;
    }
    .btn-enviar:hover {
      background-color: #00c7ba;
      color: white;
    }
    .botoes {
        width: 100%;    
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      margin-top: 10px;
      width: 380px;
      margin-left: auto;
      margin-right: auto;
    }
    .botoes button {
        width: 100%;
      background-color: #5faaa6;
      border: none;
      color: white;
      border-radius: 8px;
      padding: 6px 12px;
      font-size: 14px;
      box-shadow: 2px 2px 5px rgba(0,0,0,0.2);
      transition: 0.2s;
    }
    .botoes button:hover {
      background-color: #4a8f8b;
    }
    .alert-info {
        width: 100%;
      margin: 10px auto;
      border-radius: 10px;
      padding: 10px;
      text-align: center;
    }
  </style>
</head>
<body>

  <div class="card-adicionar">
    <h3>Adicione amigos!</h3>
    <p>Seus códigos também precisam de companhia!</p>
    <div class="icones">
        <i class="fa-solid fa-users"></i>
        <i class="fa-solid fa-face-smile"></i>
    </div>

    <?php if ($mensagem): ?>
        <div class="alert alert-info"><?= htmlspecialchars($mensagem) ?></div>
    <?php endif; ?>

    <form method="post">
      <input type="text" name="codigo_usuario" class="campo-usuario" placeholder="Exemplo#12  (Nome + # + ID)" required>
      <button type="submit" class="btn-enviar" style="width: 100%;">Enviar Pedido de Amizade</button>
    </form>
  </div>

  <div class="botoes">
    <button onclick="window.location.href='minhas-amizades.php'">Amizades</button>
    <button onclick="window.location.href='meus-pedidos.php'">Meus Pedidos</button>
  </div>

</body>
</html>

<?php include "incs/footer.php"; ?>
