<!DOCTYPE html>
<?php include "incs/topo.php"; ?>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Botão sobre a imagem</title>
<style>
    body {
        background-color: #FAFAFA;
        margin: 0;
        font-family: Arial, sans-serif;
    }

    .imagem-container {
        position: relative; /* base para o botão absoluto */
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 5px;
    }

    .imagem-container img {
        width: 69%;
        height: auto;
        display: block;
    }

    .btn {
        position: absolute; 
        z-index: 10;       
        background-color: #438F94;
        color: white;
        border: none;
        border-radius: 10px;
        padding: 10px 23px;
        font-size: 25px;
        top: 70%;           
        left: 67%;         
    }

    .btn:hover {
    background-color: #36787B;
    color: white;
}

</style>
</head>
<body>

<!-- Imagem 1 normal -->
<div style="display: flex; justify-content: center; align-items: center;">
    <img src="uploads/tela1.png" style="width: 69%; height:auto; margin-top:5px;">
</div>

<!-- Imagem 2 com botão sobreposto -->
<div class="imagem-container">
    <img src="uploads/tela2.png" alt="Tela 2">
    <button class="btn" onclick="window.location.href='game.html'">Comece Agora!</button>
</div>

</body>
</html>

<?php include "incs/footer.php"; ?>