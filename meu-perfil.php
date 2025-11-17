<?php
include "incs/topo.php";
require_once "src/UsuarioDAO.php";
require_once "src/SalvarJogoDAO.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$idLogado = $_SESSION['idusuarios'];

// Busca os dados atuais do usuário logado
$usuario = UsuarioDAO::buscarUsuarioId($idLogado);
$tempoTotalMinutos = UsuarioDAO::tempoTotalJogo($idLogado);
$pontos = UsuarioDAO::pontosTotais($idLogado);
$pontosExtras = UsuarioDAO::objetivosTotais($idLogado);
$totalPontos = $pontos + $pontosExtras;

$segundos = 0;

if ($tempoTotalMinutos <=60) {
    $segundos = $tempoTotalMinutos;
}else if ($tempoTotalMinutos >60) {
    $segundos = 59;
}

// Formata em horas e minutos
$horas = floor($tempoTotalMinutos / 3600); // 3600 segundos = 1 hora
$minutos = floor(($tempoTotalMinutos % 3600) / 60); // pega os minutos restantes
$tempoFormatado = "{$horas}h {$minutos}m {$segundos}s";

// --- Atualizar nome ---
if (isset($_POST['atualizar_nome'])) {
    $novoNome = trim($_POST['novo_nome']);
    if (!empty($novoNome)) {
        UsuarioDAO::atualizarNome($idLogado, $novoNome);
        $usuario['nome'] = $novoNome;
        $_SESSION['nome'] = $novoNome;
        echo "<div class='alert alert-success text-center temp-alert'>Nome atualizado com sucesso!</div>";
    } else {
        echo "<div class='alert alert-warning text-center temp-alert'>O nome não pode estar vazio.</div>";
    }
}

// --- Atualizar foto ---
if (isset($_FILES['nova_foto']) && $_FILES['nova_foto']['error'] === UPLOAD_ERR_OK) {
    $fotoAtual = $usuario['foto'];
    $novaFoto = $_FILES['nova_foto']['name'];
    $tmp = $_FILES['nova_foto']['tmp_name'];

    if (!file_exists("uploads")) mkdir("uploads", 0777, true);

    $extensao = pathinfo($novaFoto, PATHINFO_EXTENSION);
    $nomeArquivo = "foto_" . $idLogado . "." . strtolower($extensao);
    $destino = "uploads/" . $nomeArquivo;

    if (move_uploaded_file($tmp, $destino)) {
        if (!empty($fotoAtual) && file_exists("uploads/$fotoAtual") && $fotoAtual !== $nomeArquivo) {
            unlink("uploads/$fotoAtual");
        }
        UsuarioDAO::atualizarFoto($idLogado, $nomeArquivo);
        $usuario['foto'] = $nomeArquivo;
        echo "<div class='alert alert-success text-center temp-alert'>Foto atualizada com sucesso!</div>";
    } else {
        echo "<div class='alert alert-danger text-center temp-alert'>Erro ao enviar a nova foto.</div>";
    }
}

// --- Atualizar descrição ---
if (isset($_POST['atualizar_descricao'])) {
    $novaDescricao = trim($_POST['descricao']);
    UsuarioDAO::atualizarDescricao($idLogado, $novaDescricao);
    $usuario['descricao'] = $novaDescricao;
    echo "<div class='alert alert-success text-center temp-alert'>Descrição atualizada com sucesso!</div>";
}

// Definir rank e cor conforme total de pontos
                    if ($totalPontos < 10) {
                        $rank = "Bronze";
                        $corRank = "#cd7f32"; // bronze
                    } elseif ($totalPontos >= 10 && $totalPontos < 20) {
                        $rank = "Prata";
                        $corRank = "#615f5fff"; // prata
                    } elseif ($totalPontos >= 20 && $totalPontos < 50 ) {
                        $rank = "Ouro";
                        $corRank = "#ffd700"; // ouro
                    } elseif ($totalPontos >= 50) {
                        $rank = "Diamante";
                        $corRank = "#146363ff"; // diamante
                    } else {
                        $rank = "Nenhum";
                        $corRank = "#000"; // cor padrão
                    }



$nomeColorido = "<span style='color: $corRank;'>" . htmlspecialchars($usuario['nome']) . "</span>";

$totaisPL = SalvarJogoDAO::somarPL($idLogado);

$xpJava = $totaisPL['totalPl1']; // cada unidade = 1%
$xpPHP  = $totaisPL['totalPl2'];
$xpLua  = $totaisPL['totalPl3'];

// Limitar máximo de 100% caso queira
$xpJava = min(100, $xpJava);
$xpPHP  = min(100, $xpPHP);
$xpLua  = min(100, $xpLua);


?>

<!-- Script para sumir automaticamente as notificações -->
<script>
document.addEventListener("DOMContentLoaded", function(){
    const alerts = document.querySelectorAll('.temp-alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s, transform 0.5s';
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-20px)';
            setTimeout(() => alert.remove(), 500);
        }, 3000); // desaparece após 4 segundos
    });
});
</script>


<style>
    .xp-label {
      font-size: 1.2rem;
      font-weight: 500;
      text-align:left;
    }

    .progress {
      height: 25px;
      background-color: #d9d9d9;
      border-radius: 4px;
      overflow: hidden;
    }

    .progress-bar {
      background: repeating-linear-gradient(
        45deg,
        #00cc00,
        #00cc00 10px,
        #00e600 10px,
        #00e600 20px
      );
      transition: width 0.6s ease;
    }

    .xp-text {
      font-size: 0.9rem;
      color: #333;
      margin-top: 4px;
      text-align:left;
    }

    .xp-container {
      margin-bottom: 18px;
    }

     .card-estatisticas {
      background-color: #80dedc;
      border-radius: 10px;
      box-shadow: 2px 4px 10px rgba(0, 0, 0, 0.1);
      padding: 25px 35px;
      width: 100%;
      height: 320px;
    }

    .titulo-estatisticas {
      display: inline-block;
      background-color: #22b8cf;
      color: white;
      font-weight: bold;
      padding: 6px 15px;
      border-radius: 10px;
      border: 2px solid #0d99b3;
      margin-bottom: 20px;
      box-shadow: 1px 2px 4px rgba(0,0,0,0.1);
    }

    .stat-line {
      font-size: 1.1rem;
      margin-bottom: 6px;
    }

    .stat-label {
      color: #000;
      font-weight: 500;
      text-align:left;
    }

    .stat-value {
      color: #a06000;
      font-weight: 600;
      margin-left: 5px;
    }

    /* Ajustes para responsividade */
    @media (max-width: 768px) {
        .card-estatisticas {
            padding: 15px 20px;
            height: auto;
        }
        .titulo-estatisticas {
            font-size: 1rem;
            padding: 4px 10px;
        }
        .stat-line {
            font-size: 1rem;
        }
        .xp-label {
            font-size: 1rem;
        }
        .progress {
            height: 20px;
        }
        .xp-text {
            font-size: 0.8rem;
        }
        .btn {
            width: 100% !important;
            margin: 5px 0 !important;
            font-size: 18px !important;
        }
        .form-control {
            width: 100% !important;
        }
    }
</style>

<body>
<main class="container mt-5">
    <div class="row">
        <!-- Coluna Esquerda: Perfil e Formulários -->
        <div class="col-md-6">
            <!-- Card de Perfil -->
        <div class="card shadow p-4 mb-4">
            <div class="d-flex align-items-start mb-3">
                <!-- Coluna da imagem + ID -->
                <div class="me-4 text-center">
                <img src="uploads/<?= htmlspecialchars($usuario['foto'] ?? 'default.png') ?>" 
                    alt="Foto de perfil" 
                    class="rounded-circle mb-2" 
                    style="width:150px; height:150px; object-fit:cover;">
                <p id="idDousuario" class="text-muted text-center mb-1 mt-3" style="font-size: 0.9rem;">
                    <?= htmlspecialchars($usuario['nome']) . "#" . $idLogado ?>
                </p>
                </div>

                <!-- Coluna do nome, descrição e botões -->
                <div class="flex-grow-1">
                <h4 class="mb-1"><?= $nomeColorido ?></h4>

                
                <?php if (!empty($usuario['descricao'])): ?>
                    <p class="fst-italic text-secondary mb-3">
                    Descrição: <?= htmlspecialchars($usuario['descricao']) ?>
                    </p>
                <?php else: ?>
                    <p class="fst-italic text-secondary mb-3">Nenhuma descrição disponível.</p>
                <?php endif; ?>

                <!-- Botões alinhados à direita -->
                <div class="d-flex justify-content-end gap-2" style="margin-top:30%;">
                    <button class="btn"
                            style="background-color: #85DEDB; color: #000; border: none; border-radius: 10px;
                                box-shadow: 2px 2px 5px rgba(0,0,0,0.2); font-size: 18px; font-weight: 400;
                                width: 110px; height:45px; margin-right:8px; " onclick="window.location.href='meus-pedidos.php'"> 
                    Pedidos
                    </button>

                    <button class="btn"
                            style="background-color: #85DEDB; color: #000; border: none; border-radius: 10px;
                                box-shadow: 2px 2px 5px rgba(0,0,0,0.2); font-size: 18px; font-weight: 400;
                                width: 120px; height:45px;"
                            onclick="window.location.href='minhas-amizades.php'">
                    Amizades
                    </button>
                </div>
                </div>
            </div>
        </div>

            <!-- Card Formulários -->
            <div class="card shadow p-4">
                <!-- Formulário de alteração de nome -->
                <form method="post" class="mb-3">
                    <div class="mb-3">
                        <label for="novo_nome" class="form-label">Alterar nome:</label>
                        <input type="text" class="form-control" name="novo_nome" id="novo_nome" 
                               placeholder="Seu nome vai aqui!" required>
                    </div>
                    <button type="submit" name="atualizar_nome" class="btn mb-3" style="background-color: #85DEDB; color: #000; border: none; border-radius: 10px; box-shadow: 2px 2px 5px rgba(0,0,0,0.2);">Salvar Nome</button>
                </form>

                <!-- Formulário de alteração de foto -->
                <form method="post" enctype="multipart/form-data" class="mb-3">
                    <div class="mb-3">
                        <label for="nova_foto" class="form-label">Substituir foto de perfil:</label>
                        <input type="file" class="form-control" name="nova_foto" id="nova_foto" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn mb-3" style="background-color: #85DEDB; color: #000; border: none; border-radius: 10px; box-shadow: 2px 2px 5px rgba(0,0,0,0.2);">Atualizar Foto</button>
                </form>

                <!-- Formulário de descrição -->
                <form method="post">
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição:</label>
                        <textarea class="form-control" maxlength="40" name="descricao" id="descricao" rows="3" placeholder="Sua descrição vai aqui!"></textarea>
                    </div>
                    <button type="submit" name="atualizar_descricao" class="btn" style="background-color: #85DEDB; color: #000; border: none; border-radius: 10px; box-shadow: 2px 2px 5px rgba(0,0,0,0.2);">Atualizar Descrição</button>
                </form>
            </div>
        </div>

        <!-- Coluna Direita: XP e Estatísticas -->
        <div class="col-md-6" >
            <!-- Botão Experiência -->
            <div class="text-center mb-4">
                <p class="p-2" style="background-color: #85DEDB; color: #000; border: none; border-radius: 10px; box-shadow: 2px 2px 5px rgba(0,0,0,0.2); font-size: 30px; font-weight: 400; width: 180px; height:60px; margin-left:33%;">Experiência</p>
            </div>

            <!-- Seção XP -->
            <div class="mb-4">
                <div class="xp-container">
                    <div class="xp-label">Java</div>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" 
                            style="width: <?= $xpJava ?>%;" 
                            aria-valuenow="<?= $xpJava ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="xp-text"><?= $xpJava ?>/100 XP</div>
                </div>

                <div class="xp-container">
                    <div class="xp-label">PHP</div>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" 
                            style="width: <?= $xpPHP ?>%;" 
                            aria-valuenow="<?= $xpPHP ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="xp-text"><?= $xpPHP ?>/100 XP</div>
                </div>

                <div class="xp-container">
                    <div class="xp-label">Lua</div>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" 
                            style="width: <?= $xpLua ?>%;" 
                            aria-valuenow="<?= $xpLua ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="xp-text"><?= $xpLua ?>/100 XP</div>
                </div>

            </div>

            <!-- Card Estatísticas -->
            <div class="card-estatisticas">
                <div class="titulo-estatisticas">Estatísticas</div>
                <div class="stat-line">
                    <span class="stat-label">Tempo total de jogo:</span>
                    <span class="stat-value" style="color:gray;"><?= htmlspecialchars($tempoFormatado) ?></span>

                </div>
                <div class="stat-line">
                    <span class="stat-label">Pontos totais:</span>
                    <span class="stat-value" style="color:gray;"><?= htmlspecialchars($totalPontos) ?></span>
                </div>
                    <div class="stat-line">
                    <span class="stat-label">Rank:</span>
                    <span class="stat-value" style="color: <?= $corRank ?>; font-weight: 600;"><?= $rank ?></span>
                </div>


            </div>
        </div>
    </div>
</main>
</body>
<?php include "incs/footer.php"; ?>
