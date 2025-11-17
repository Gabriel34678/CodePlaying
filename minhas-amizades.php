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

    // 🔹 Lista todos os amigos aceitos corretamente
    $usuarios = UsuarioDAO::listarAmigos($idLogado);
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amigos</title>
    <style>
        .usuario-card {
            transition: transform 0.2s ease-in-out;
        }
        .usuario-card:hover {
            transform: scale(1.02);
        }
        .mostrar-mais-btn {
            background-color: #85DEDB;
            color: #000;
            border: none;
            border-radius: 10px;
            box-shadow: 2px 2px 5px rgba(0,0,0,0.2);
            font-size: 18px;
            font-weight: 400;
            padding: 10px 30px;
        }
    </style>
</head>
<body>

<div class="container my-5">
    <div class="row">
        <div class="text-center mt-4 col-4">
            <p class="mostrar-mais-btn" style="width:80%; background-color: #438F94; color:white; font-size:25px;">
                Minhas Amizades
            </p>
        </div>
        <div class="text-center mt-4 col-4">
            <button onclick="window.location.href='meus-pedidos.php'" 
                    class="mostrar-mais-btn" style="width:80%; margin-left:40%">
                Meus Pedidos
            </button>
        </div>
        <div class="text-center mt-4 col-4 right-0">
            <button class="mostrar-mais-btn" style="width:80%; margin-left:20%" 
                    onclick="window.location.href='add-amigo.php'">
                Adicionar Amigos
            </button>
        </div>
    </div>

    <div class="row" id="usuariosContainer">
        <?php if ($usuarios): ?>
            <?php foreach ($usuarios as $i => $u): ?>
                <div class="col-12 col-md-6 mb-4 usuario-card" style="<?= $i >= 4 ? 'display: none;' : '' ?>">
                    <div class="card shadow p-4 h-100">
                        <div class="d-flex align-items-start mb-3" >

                            <!-- Coluna da imagem + ID -->
                            <div class="me-4 text-center">
                                <img onclick="window.location.href='perfil-amigo.php?amigo=<?= $u['idusuarios'] ?>'" src="uploads/<?= htmlspecialchars($u['foto'] ?? 'default.png') ?>" 
                                    alt="Foto de perfil" 
                                    class="rounded-circle mb-2" 
                                    style="width:150px; height:150px; object-fit:cover;">
                                <p id="idDousuario" class="text-muted text-center mb-1 mt-3" style="font-size: 0.9rem;">
                                    <?= htmlspecialchars($u['nome']) . "#" . htmlspecialchars($u['idusuarios']) ?>
                                </p>
                            </div>

                            <!-- Coluna do nome, descrição e botões -->
                            <div class="flex-grow-1">
                                <h4 onclick="window.location.href='perfil-amigo.php?amigo=<?= $u['idusuarios'] ?>'" class="mb-1"><?= htmlspecialchars($u['nome']) ?> </h4>
                                
                                <?php if (!empty($u['descricao'])): ?>
                                    <p onclick="window.location.href='perfil-amigo.php?amigo=<?= $u['idusuarios'] ?>'" class="fst-italic text-secondary mb-3">
                                        Descrição: <?= htmlspecialchars($u['descricao']) ?>
                                    </p>
                                <?php else: ?>
                                    <p class="fst-italic text-secondary mb-3">Nenhuma descrição disponível.</p>
                                <?php endif; ?>

                              <!-- Botões alinhados à direita -->
        <div class="d-flex justify-content-end gap-2" style="margin-top:30%;">
            <button class="btn"
                    style="background-color: #85DEDB; color: #000; border: none; border-radius: 10px;
                        box-shadow: 2px 2px 5px rgba(0,0,0,0.2); font-size: 18px; font-weight: 400;
                        width: 120px; height:45px;"
                    onclick="window.location.href='chat.php?amigo=<?= $u['idusuarios'] ?>'">
                Mensagem
            </button>

            <form method="post" action="remover-amigo.php" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja remover este amigo?');">
                <input type="hidden" name="idAmigo" value="<?= $u['idusuarios'] ?>">
                <button type="submit" class="btn"
                        style="background-color: #FF6B6B; color: #fff; border: none; border-radius: 10px;
                            box-shadow: 2px 2px 5px rgba(0,0,0,0.2); font-size: 16px; font-weight: 400;
                            width: 120px; height:45px;">
                    Remover
                </button>
            </form>
        </div>

                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-muted">Você ainda não possui amigos.</p>
        <?php endif; ?>
    </div>

    <?php if (count($usuarios) > 4): ?>
        <div class="text-center mt-2">
            <button id="mostrarMaisBtn" class="mostrar-mais-btn" style="width:100%;">Mostrar mais</button>
        </div>
    <?php endif; ?>
</div>

<script>
    const btn = document.getElementById('mostrarMaisBtn');
    if (btn) {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.usuario-card').forEach(card => {
                card.style.display = 'block';
            });
            btn.style.display = 'none';
        });
    }
</script>

</body>
</html>
<?php
    include "incs/footer.php";
    ?>