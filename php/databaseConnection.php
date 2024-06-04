<?php

// Parâmetros de conexão
$dbms = "mysql";
$host= "127.0.0.1";
$dbname = "db_webchat";
$dbUser = "root";
$dbPassword = "";

// Conexão com a base de dados
$connection = new PDO("$dbms:host=$host;dbname=$dbname", $dbUser, $dbPassword);
