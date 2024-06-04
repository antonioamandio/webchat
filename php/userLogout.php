<?php

// Puxando os dados do arquivo de conexão com a base de dados
require_once "databaseConnection.php";

session_start();
$sessionToken = $_SESSION['sessionToken'];

$sql_code = "SELECT userId FROM tb_users WHERE sessionToken = ?;";

$query_code = $connection->prepare($sql_code);

$query_code->execute([$sessionToken]);

if ($query_code->rowCount() === 1) {

    $result = $query_code->fetch(PDO::FETCH_ASSOC);
    $databaseUserId = $result['userId'];

    // Alterando o token de sessão
    $_SESSION['sessionToken'] = bin2hex(random_bytes(16));
    $sessionToken = $_SESSION['sessionToken'];

    // Alterando o token de sessão da base de dados
    $sql_code = "UPDATE tb_users SET sessionToken = ? WHERE userId = ?;";

    $query_code = $connection->prepare($sql_code);

    $query_code->execute([$sessionToken, $databaseUserId]);

    session_unset();
    session_destroy();

    echo json_encode(["status" => "success", "message" => "Logout feito com sucesso."]);

}