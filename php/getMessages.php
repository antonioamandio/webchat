<?php

// Puxando os dados do arquivo de conexão com a base de dados
require_once "databaseConnection.php";

// Consulta para buscar todas as mensagens
$sql_code = "SELECT tb_messages.*, tb_users.* FROM tb_messages JOIN tb_users ON tb_messages.senderId = tb_users.userId;";

$query_code = $connection->query($sql_code);

$result = $query_code->fetchAll(PDO::FETCH_ASSOC);

session_start();
$sessionToken = $_SESSION['sessionToken'];

// Retornando as mensagens em formato JSON e o status da operação
echo json_encode(["status" => "success", "clientSideSessionToken" => $sessionToken, "messageDatas" => $result]);
// echo json_encode(["status" => "success", "messageDatas" => $result]);