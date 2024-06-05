<?php 
    session_start();
    if (!isset($_SESSION['sessionToken'])) {
        header("location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="pt-PT">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>WebChat</title>
    
    <link rel="stylesheet" href="css/chat.css">

</head>

<body>

    <div id="wrapper">

        <div id="chatContainer">

            <header id="chatHeader">
                
                <h1>Webchat</h1>

                <button type="submit" id="logoutButton">Sair</button>

            </header>

            <div id="messageContainer"></div>

            <form autocomplete="off">
                <input type="text" id="messageInput" placeholder="Digite uma mensagem">
                <button type="submit">Enviar</button>
            </form>
            
        </div>

    </div>

</body>

</html>

<script src="js/sendMessages.js"></script>
<script src="js/getMessages.js"></script>
<script src="js/userLogout.js"></script>