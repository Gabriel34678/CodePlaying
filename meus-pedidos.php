<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php
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

   require_once "src/AmizadeDAO.php";
$pedidosRecebidos = AmizadeDAO::listarPedidosRecebidos($idLogado);
$pedidosEnviados = AmizadeDAO::listarPedidosEnviados($idLogado);
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Pedidos</title>
    <style>
        .titulo-secao {
            background-color: #3DBDB6;
            color: white;
            font-weight: bold;
            font-size: 22px;
            border-radius: 10px;
            padding: 10px 0;
            text-align: center;
            width: 80%;
            margin: 0 auto 20px;
        }

        .lista-usuarios {
            background-color: #83E0DD;
            border-radius: 10px;
            padding: 15px;
            height: 450px;
            overflow-y: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }

        .usuario-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #c5f4f3;
            border-radius: 10px;
            padding: 10px 15px;
            margin-bottom: 10px;
            transition: transform 0.2s ease-in-out;
        }

        .usuario-item:hover {
            transform: scale(1.02);
        }

        .usuario-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .usuario-info img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
        }

        .usuario-nome {
            font-weight: bold;
        }

        .usuario-tag {
            color: gray;
            font-size: 0.9rem;
        }

        .btn-acao {
            border: none;
            border-radius: 8px;
            padding: 8px 14px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-adicionar {
            background-color: #4ED1CA;
            color: white;
        }

        .btn-adicionar:hover {
            background-color: #3bb5ae;
        }

        .btn-recusar {
            background-color: #f96a6a;
            color: white;
        }

        .btn-recusar:hover {
            background-color: #e05656;
        }

        .btn-voltar {
            background-color: #85DEDB;
            color: #000;
            border: none;
            border-radius: 10px;
            box-shadow: 2px 2px 5px rgba(0,0,0,0.2);
            font-size: 18px;
            padding: 10px 25px;
            font-weight: 400;
        }
    </style>
</head>
<body>

<div class="container my-5">
    <div class="row">
        <!-- Coluna 1: Pedidos Pendentes (enviados por você) -->
        <div class="col-12 col-md-6 mb-4">
            <div class="titulo-secao">Pedidos Pendentes</div>
            <div class="lista-usuarios">
                <?php if (count($pedidosEnviados) === 0): ?>
                    <p class="text-center text-muted mt-3">Nenhum pedido pendente.</p>
                <?php else: ?>
                    <?php foreach ($pedidosEnviados as $u): ?>
                        <div class="usuario-item">
                            <div class="usuario-info">
                                <img src="uploads/<?= htmlspecialchars($u['foto'] ?? 'default.png') ?>" alt="foto">
                                <div>
                                    <div class="usuario-nome"><?= htmlspecialchars($u['nome']) ?></div>
                                    <div class="usuario-tag"><?= htmlspecialchars($u['nome']) ?>#<?= htmlspecialchars($u['idusuarios']) ?></div>
                                </div>
                            </div>
                            <div>
                                <span class="text-muted">Aguardando</span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Coluna 2: Novas Amizades (pedidos recebidos por você) -->
        <div class="col-12 col-md-6 mb-4">
            <div class="titulo-secao">Novas Amizades</div>
            <div class="lista-usuarios">
                <?php if (count($pedidosRecebidos) === 0): ?>
                    <p class="text-center text-muted mt-3">Nenhum pedido recebido.</p>
                <?php else: ?>
                    <?php foreach ($pedidosRecebidos as $u): ?>
                        <div class="usuario-item">
                            <div class="usuario-info">
                                <img src="uploads/<?= htmlspecialchars($u['foto'] ?? 'default.png') ?>" alt="foto">
                                <div>
                                    <div class="usuario-nome"><?= htmlspecialchars($u['nome']) ?></div>
                                    <div class="usuario-tag"><?= htmlspecialchars($u['nome']) ?>#<?= htmlspecialchars($u['idusuarios']) ?></div>
                                </div>
                            </div>
                            <div>
                                <button class="btn-acao btn-adicionar" onclick="window.location.href='aceitar-amizade.php?id=<?= $u['idusuarios'] ?>'">Aceitar</button>
                                <button class="btn-acao btn-recusar" onclick="window.location.href='recusar-amizade.php?id=<?= $u['idusuarios'] ?>'">Recusar</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <div style="display: flex; justify-content: center; margin-bottom: 0px;">
        <button class="btn"
                style="background-color: #85DEDB; color: #000; border: none; border-radius: 10px;
                       box-shadow: 2px 2px 5px rgba(0,0,0,0.2); font-size: 18px; font-weight: 400;
                       width: 100%; height:45px;"
                onclick="window.location.href='minhas-amizades.php'">
            Minhas Amizades
        </button>
    </div>
    </div>
</div>

</body>
</html>
<?php
    include "incs/footer.php";
    ?>