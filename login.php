<?php 
    session_start();
    if (isset($_SESSION['sessionToken'])) {
        header("location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="pt-PT">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>WebChat | Login</title>
    
    <link rel="stylesheet" href="css/login.css">

</head>

<body>
    
    <div id="wrapper">

        <div id="formContainer">
            
            <h1>WebChat</h1>

            <form autocomplete="off">

                <div id="errorText">Senha inválida</div>

                <div class="inputField">
                    <label for="email">Endereço de email</label>
                    <input type="email" id="email" placeholder="Digite o seu email" >
                </div>

                <div class="inputField">
                    <label for="password">Senha</label>
                    <input type="password" id="password" placeholder="Digite a sua senha" >
                </div>

                <div id="buttonField">
                    <button type="submit">Iniciar Sessão</button>
                </div>

            </form>

            <div id="link">
                Ainda não tem uma conta?
                <a href="register.php">Cadastrar-se</a>
            </div>

        </div>

    </div>

</body>

</html>

<script src="js/userLogin.js"></script>