<?php
    
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "serenatto";
    
    try {
        $pdo = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
         echo "Erro na conexão: " . $e->getMessage();

        
    }
    
