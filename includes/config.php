<?php
// Configurações do banco de dados
define('DB_HOST', 'waha_financeiro');
define('DB_NAME', 'waha');
define('DB_USER', 'mysql');
define('DB_PASS', 'bd3becd5eed6baf1405f');

// Configurações da aplicação
define('SITE_URL', 'http://localhost/sistema_financeiro/');
define('SITE_NAME', 'Netmai - Sistema Financeiro');

// Configurações de sessão
session_start();

// Conexão com o banco de dados
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}

// Função para verificar se o usuário está logado
function verificarLogin() {
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: login.php');
        exit();
    }
}

// Função para formatar valor monetário
function formatarMoeda($valor) {
    return 'R$ ' . number_format($valor, 2, ',', '.');
}

// Função para converter valor monetário para decimal
function converterMoeda($valor) {
    $valor = str_replace(['R$', ' ', '.'], '', $valor);
    $valor = str_replace(',', '.', $valor);
    return floatval($valor);
}
?>
