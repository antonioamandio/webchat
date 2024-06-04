<?php

// Verificando se todos os campos foram preenchidos ou não
if (empty($_POST['email']) || empty($_POST['password'])) {
    echo json_encode(["status" => "failure", "message" => "Por favor, preencha todos os campos!"]);
} 

// Validação do email
else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["status" => "failure", "message" => "Formato de email inválido!"]);
}

// Validação da senha
else if (strlen($_POST['password']) < 8) {
    echo json_encode(["status" => "failure", "message" => "A senha deve ter no mínimo 8 caracteres"]);
}

else {

    // Puxando os dados do arquivo de conexão com a base de dados
    require_once "databaseConnection.php";

    // Limpeza dos valores dos campos do formulário
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $email = htmlspecialchars($email);

    $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);
    $password = htmlspecialchars($password);

    // Verifica se o email já está cadastrado
    $sql_code = "SELECT userId, userPassword FROM tb_users WHERE email = ?;";

    $query_code = $connection->prepare($sql_code);

    $query_code->execute([$email]);

    if ($query_code->rowCount() === 1) {

        $result = $query_code->fetch(PDO::FETCH_ASSOC);
        
        $databasePassword = $result['userPassword'];

        // Comparando a senha fornecida pelo usuário com a do banco de dados
        if (password_verify($password, $databasePassword)) {

            $databaseUserId = $result['userId'];

            // Criando o token de sessão
            session_start();
            $_SESSION['sessionToken'] = bin2hex(random_bytes(16));
            $sessionToken = $_SESSION['sessionToken'];

            // Alterando o token de sessão da base de dados
            $sql_code = "UPDATE tb_users SET sessionToken = ? WHERE userId = ?;";

            $query_code = $connection->prepare($sql_code);
        
            $query_code->execute([$sessionToken, $databaseUserId]);
        
            echo json_encode(["status" => "success", "message" => "Usuário logado com sucesso"]);
            
        } else {
            
            echo json_encode(["status" => "failure", "message" => "Email ou senha inválidos"]);
                
        }
        
    } else {
        
        echo json_encode(["status" => "failure", "message" => "Email ou senha inválidos"]);
        
    }

}