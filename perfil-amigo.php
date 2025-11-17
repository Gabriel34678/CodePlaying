<?php
include "incs/topo.php";
require_once "src/ConexaoBD.php";
require_once "src/UsuarioDAO.php";

if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['idusuarios'])) {
    header("Location: login.php");
    exit;
}

$idLogado = $_SESSION['idusuarios'];

// Pega o amigo da URL
if (!isset($_GET['amigo'])) {
    echo "Amigo não especificado!";
    exit;
}
$idAmigo = intval($_GET['amigo']);

// Conexão
$conn = ConexaoBD::conectar();

// Pega os dados do amigo
$sql = "SELECT idusuarios, nome, email, foto FROM usuarios WHERE idusuarios = :idAmigo";
$stmt = $conn->prepare($sql);
$stmt->execute([':idAmigo' => $idAmigo]);
$amigo = $stmt->fetch(PDO::FETCH_ASSOC);

$pontosExtras = UsuarioDAO::objetivosTotais($idAmigo);
if (!$amigo) {
    echo "Amigo não encontrado!";
    exit;
}

// Calcula rank baseado nos pontos totais
$totalPontosAmigo = $totaisPL['totalPontos'] ?? 0;

if ($totalPontosAmigo < 10) {
    $rank = "Bronze";
    $corRank = "#cd7f32"; // bronze
} elseif ($totalPontosAmigo < 20) {
    $rank = "Prata";
    $corRank = "#615f5fff"; // prata
} elseif ($totalPontosAmigo < 50) {
    $rank = "Ouro";
    $corRank = "#ffd700"; // ouro
} else {
    $rank = "Diamante";
    $corRank = "#146363ff"; // diamante
}


// Pega a melhor gameplay (maior pontuação) do amigo
$sql = "SELECT * FROM jogo WHERE idusuario = :idAmigo ORDER BY pontuacao DESC LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->execute([':idAmigo' => $idAmigo]);
$melhorJogo = $stmt->fetch(PDO::FETCH_ASSOC);

// Pega a soma total de pl1, pl2, pl3 do amigo
$sql = "SELECT 
            SUM(pl1) AS totalPl1,
            SUM(pl2) AS totalPl2,
            SUM(pl3) AS totalPl3
        FROM jogo
        WHERE idusuario = :idAmigo";
$stmt = $conn->prepare($sql);
$stmt->execute([':idAmigo' => $idAmigo]);
$totaisPL = $stmt->fetch(PDO::FETCH_ASSOC);

// Calcula XP como porcentagem (cada unidade = 1%)
$xpJava = min(100, $totaisPL['totalPl1'] ?? 0);
$xpPHP  = min(100, $totaisPL['totalPl2'] ?? 0);
$xpLua  = min(100, $totaisPL['totalPl3'] ?? 0);

// Formata tempo do melhor jogo
if ($melhorJogo) {
    $segundos = $melhorJogo['tempo_jogo'];
    $horas = floor($segundos / 3600);
    $minutos = floor(($segundos % 3600) / 60);
    $segundosRestantes = $segundos % 60;
    $tempoFormatado = "{$horas}h {$minutos}m {$segundosRestantes}s";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Perfil de <?= htmlspecialchars($amigo['nome']) ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
    background: linear-gradient(160deg, #a0e0e0, #70c2c5);
    font-family: Arial, sans-serif;
}

.perfil-container {
    max-width: 900px;
    margin: 80px auto 40px auto;
    background: rgba(255,255,255,0.95);
    padding: 30px;
    border-radius: 20px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}

.perfil-header {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 30px;
}

.perfil-header img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #147279ff;
}

.perfil-info h2 {
    margin: 0;
    color: #147279ff;
}

.perfil-info p {
    margin: 4px 0;
    color: #333;
}

.card-jogo {
    background-color: #d9f7f7;
    border-radius: 15px;
    padding: 20px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    margin-bottom: 20px;
}

.card-jogo h4 {
    margin-bottom: 15px;
    color: #147279ff;
}

.card-jogo p {
    margin: 5px 0;
    font-weight: 500;
}

.xp-container {
    margin-bottom: 15px;
}

.xp-label {
    font-weight: 600;
    margin-bottom: 4px;
    color: #147279ff;
}

.progress {
    height: 22px;
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
    transition: width 0.5s ease;
}

.xp-text {
    font-size: 0.9rem;
    margin-top: 2px;
}
</style>
</head>
<body>

<div class="perfil-container">
    <div class="perfil-header">
        <img src="uploads/<?= htmlspecialchars($amigo['foto'] ?? 'default.png') ?>" alt="Foto de <?= htmlspecialchars($amigo['nome']) ?>">
        <div class="perfil-info">
            <h2><?= htmlspecialchars($amigo['nome']) ?></h2>
            <p><strong>Email:</strong> <?= htmlspecialchars($amigo['email']) ?></p>
            <p><strong>ID:</strong> <?= htmlspecialchars($amigo['nome']) . "#" .$amigo['idusuarios'] ?></p>
        </div>
    </div>

    <?php if ($melhorJogo): ?>
    <div class="card-jogo">
        <h4 class="mb-2 ">Melhor Gameplay</h4>
        <p><strong>Pontuação:</strong> <?= $melhorJogo['pontuacao'] ?></p>
        <p><strong>Tempo de jogo:</strong> <?= $tempoFormatado ?></p>
        <h4 class="mb-2 mt-3">Informações do Usuário:</h4>
        <p><strong>Pontos Extras Totais:</strong> <?= $pontosExtras?></p>
        <p><strong>Rank:</strong> <span style="color: <?= $corRank ?>; font-weight: 600;"><?= $rank ?></span></p>

        <h4 class="mt-4">Experiência:</h4>
        <div class="xp-container">
            <div class="xp-label">Java</div>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: <?= $xpJava ?>%;" aria-valuenow="<?= $xpJava ?>" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="xp-text"><?= $xpJava ?>/100 XP</div>
        </div>

        <div class="xp-container">
            <div class="xp-label">PHP</div>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: <?= $xpPHP ?>%;" aria-valuenow="<?= $xpPHP ?>" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="xp-text"><?= $xpPHP ?>/100 XP</div>
        </div>

        <div class="xp-container">
            <div class="xp-label">Lua</div>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: <?= $xpLua ?>%;" aria-valuenow="<?= $xpLua ?>" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="xp-text"><?= $xpLua ?>/100 XP</div>
        </div>
    </div>
    <?php else: ?>
    <p>Este amigo ainda não tem gameplays registradas.</p>
    <?php endif; ?>
</div>

</body>
</html>
