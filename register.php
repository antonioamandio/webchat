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
    
    <title>WebChat | Cadastro</title>
    
    <link rel="stylesheet" href="css/register.css">

</head>

<body>
    
    <div id="wrapper">

        <div id="formContainer">
            
            <h1>WebChat</h1>

            <form autocomplete="off">

                <div id="errorText">Senha inválida</div>

                <div id="nameInputs">

                    <div class="inputField">
                        <label for="firstName">Primeiro nome</label>
                        <input type="text" id="firstName" placeholder="Primeiro nome" >
                    </div>

                    <div class="inputField">
                        <label for="lastName">Último nome</label>
                        <input type="text" id="lastName" placeholder="Último nome" >
                    </div>

                </div>

                <div class="inputField">
                    <label for="email">Endereço de email</label>
                    <input type="email" id="email" placeholder="Digite o seu email" >
                </div>

                <div class="inputField">
                    <label for="password">Senha</label>
                    <input type="password" id="password" placeholder="Digite a sua senha" >
                </div>

                <div id="buttonField">
                    <button type="submit">Criar conta</button>
                </div>

            </form>

            <div id="link">
                Já tem uma conta?
                <a href="login.php">Logar agora</a>
            </div>

        </div>

    </div>

</body>

</html>

<script src="js/userRegister.js"></script>