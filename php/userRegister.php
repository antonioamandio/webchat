<?php

// Verificando se todos os campos foram preenchidos
if (empty($_POST['firstName']) || empty($_POST['lastName']) || empty($_POST['email']) || empty($_POST['password'])) {
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
    $firstName = filter_var($_POST['firstName'], FILTER_SANITIZE_SPECIAL_CHARS);
    $firstName = htmlspecialchars($firstName);

    $lastName = filter_var($_POST['lastName'], FILTER_SANITIZE_SPECIAL_CHARS);
    $lastName = htmlspecialchars($lastName);

    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $email = htmlspecialchars($email);

    $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);
    $password = htmlspecialchars($password);

    // Criptografando a senha
    $password = password_hash($password, PASSWORD_BCRYPT);

    // Criando o token de sessão
    session_start();
    $_SESSION['sessionToken'] = bin2hex(random_bytes(16));
    $sessionToken = $_SESSION['sessionToken'];
    
    // Verificando se o email já está cadastrado na base de dados
    $sql_code = "SELECT * FROM tb_users WHERE email = ?;";

    $query_code = $connection->prepare($sql_code);

    $query_code->execute([$email]);

    if ($query_code->rowCount() > 0) {
        
        echo json_encode(["status" => "failure", "message" => "Este email já está cadastrado."]);

    } else {

        // Inserindo os dados do usuário na base de dados
        $sql_code = "INSERT INTO tb_users (firstName, lastName, email, userPassword, sessionToken) VALUES (?, ?, ?, ?, ?);";

        $query_code = $connection->prepare($sql_code);

        $query_code->execute([$firstName, $lastName, $email, $password, $sessionToken]);

        echo json_encode(["status" => "success", "message" => "Usuário cadastrado com sucesso"]);

    }

}