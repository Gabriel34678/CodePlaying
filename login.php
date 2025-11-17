<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <style>
        body {
            background-image: url('src/fundo.png');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
        }

        

        .login {
            background-color: #438F94;
            border-radius: 10px;
        }

        .form-control {
            background-color: #85DEDB;
            border-color: #85DEDB;
        }

        .form-label {
            font-size: 16px;
        }

        .btn {
            background-color: #00BBFF;
            border-color: #00BBFF;
        }

        .btn:hover {
            background-color: #00a8e6;
            border-color: #00a8e6;
        }

        

        .display-4 {
            font-family: 'Calamity Regular';
            src: url(C:\Users\WIN\Downloads\calamity-typeface) format("otf");
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">



    <!-- Conteúdo Principal -->
    <main class="container text-center my-5 flex-grow-1 mt-5" >
        <form action="efetua-login.php" method="post" class="login w-50 mx-auto text-start p-4 border rounded mt-5" style="margin-top: 400px;">
            <h2 class="display-4 text-white text-center mb-4">Login</h2>
            <?php
            session_start();
            if (isset($_SESSION['msg'])) {
                echo '<div class="alert alert-warning" role="alert">';
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
                echo '</div>';
            } else {
                echo '<div class="alert alert-info" role="alert">';
                echo 'Informe seu email e senha para entrar.';
                echo '</div>';
            }
            ?>
            <div class="mb-3">
                <label class="form-label text-light">Email</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label text-light">Senha</label>
                <input type="password" name="senha" class="form-control">
            </div>
            <button type="submit" class="btn text-dark btn-primary btn-lg w-100">Entrar</button>

            <div class="text-end mt-3">
                <a href="form-cadastra-usuario.html" class="text-light">Ainda não sou usuário</a>
            </div>
        </form>
    </main>

   

</body>

</html>
