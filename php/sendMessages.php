<?php

// Verificando se a mensagem foi digitada
if (!empty($_POST['message'])) {

    // Limpeza da mensagem
    $message = filter_var($_POST['message'], FILTER_SANITIZE_SPECIAL_CHARS);

    // Puxando os dados do arquivo de conexão com a base de dados
    require_once "databaseConnection.php";

    // Pegando o token de sessão
    session_start();
    $sessionToken = $_SESSION['sessionToken'];

    // Obtendo o id de um usuário actravés do seu token de sessão

    $sql_code = "SELECT userId FROM tb_users WHERE sessionToken = ?;";

    $query_code = $connection->prepare($sql_code);

    $query_code->execute([$sessionToken]);
    
    if ($query_code->rowCount() === 1) {
        
        $result = $query_code->fetch(PDO::FETCH_ASSOC);
        
        $senderId = $result['userId'];

        $sql_code = "INSERT INTO tb_messages (senderId, content) VALUES (?, ?);";

        $query_code = $connection->prepare($sql_code);
                
        if ( $query_code->execute([$senderId, $message]) ) {
    
            echo json_encode(["status" => "success", "message" => "Mensagem enviada com sucesso."]);
    
        } else {
    
            echo json_encode(["status" => "failure", "message" => "Erro ao enviar a mensagem."]);
    
        }

    }   
    
}