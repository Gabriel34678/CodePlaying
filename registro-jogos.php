<?php
session_start();

if (!isset($_SESSION['idusuarios'])) {
    header("Location: login.php");
    exit;
}

require_once "src/ConexaoBD.php";
require_once "src/SalvarJogoDAO.php";
require_once "incs/topo.php"; 

$idusuario = $_SESSION['idusuarios'];

// conecta ao banco
$pdo = ConexaoBD::conectar();

// cria DAO
$dao = new SalvarJogoDAO($pdo);

// lista jogos
$jogos = $dao->listarJogos($idusuario);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logs de Gameplay</title>
     

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
     <p class=" text-center mb-5" style="background-color: #85DEDB; color: #000; border: none; 
     border-radius: 10px; box-shadow: 2px 2px 5px rgba(0,0,0,0.2); font-size: 30px; 
     font-weight: 400; width: 100%; height:50px;">Registro de Gameplays</p>

    <?php if (!empty($jogos)): ?>
        <div class="row g-4">
            <?php foreach ($jogos as $j): ?>
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Registro da  gameplay</h5>
                            <p><strong>Pontuação:</strong> <?= htmlspecialchars($j['pontuacao']) ?></p>
                            <p><strong>Tempo:</strong> <?= htmlspecialchars($j['tempo_jogo']) ?> s</p>
                            <p><strong>Pontos Extras:</strong> <?= htmlspecialchars($j['objetivos_completos']) ?></p>
                            <p class="text-muted mt-auto"><small><?= $j['data_registro'] ?></small></p>
                            <form method="POST" action="apagar-jogo.php" class="mt-2">
                                <input type="hidden" name="idjogo" value="<?= $j['idjogo'] ?>">
                                <button class="btn btn-danger btn-sm w-100" type="submit">🗑️ Apagar</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-center">Você ainda não possui registros de gameplay.</p>
    <?php endif; ?>
</div>

<?php include "incs/footer.php"; ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
