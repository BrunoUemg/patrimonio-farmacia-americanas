


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="img/americanas.png" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css boostrap -->
    <link href="assets/bootstrap.min.css" rel="stylesheet" >
    <title>Login</title>
    <link rel="stylesheet" href="assets/style_login.css">
</head>
<body>
    <div class="wrapper-login">
        <img src="img/americanas.png" alt="Logo gm" class="img-logo">
        <p class="text-white">Sistema de patrimônio</p>
    </div>
    <div class="login-continue">
        <h3>Entrar no sistema</h3>
        <?php
        session_start();
                          if(!empty($_SESSION['msg'])){
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
				             } ?>
        <form action="dao/valida.php" method="POST">
            <label for="">Usuario</label>
            <input type="text" required class="form-control" name="userAcesso" id="">
            <label for="">Senha</label>
            <input type="password" required name="senha" class="form-control" id="">

            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>