<?php
/**
 * Script de correção para adicionar dados iniciais em sistemas já instalados
 * Execute este arquivo uma vez se você está enfrentando erro de "dados não encontrados"
 */

require_once 'includes/config.php';

try {
    // Verificar se existem centro de custos
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM centro_custos");
    $total_centros = $stmt->fetch()['total'];
    
    if ($total_centros == 0) {
        echo "Inserindo centros de custo...<br>";
        $pdo->exec("
            INSERT INTO centro_custos (nome) VALUES 
            ('Administrativo'),
            ('Vendas'),
            ('Marketing'),
            ('Operacional')
        ");
        echo "✓ Centros de custo inseridos com sucesso!<br>";
    } else {
        echo "✓ Centros de custo já existem.<br>";
    }
    
    // Verificar se existem categorias
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM categorias");
    $total_categorias = $stmt->fetch()['total'];
    
    if ($total_categorias == 0) {
        echo "Inserindo categorias...<br>";
        $pdo->exec("
            INSERT INTO categorias (nome) VALUES 
            ('Receitas'),
            ('Despesas Operacionais'),
            ('Despesas Administrativas'),
            ('Investimentos')
        ");
        echo "✓ Categorias inseridas com sucesso!<br>";
        
        echo "Inserindo subcategorias...<br>";
        $pdo->exec("
            INSERT INTO subcategorias (nome, categoria_id) VALUES 
            ('Vendas de Produtos', 1),
            ('Prestação de Serviços', 1),
            ('Receitas Financeiras', 1),
            ('Salários e Encargos', 2),
            ('Aluguel', 2),
            ('Energia Elétrica', 2),
            ('Telefone e Internet', 2),
            ('Material de Escritório', 3),
            ('Viagens e Hospedagem', 3),
            ('Treinamentos', 3),
            ('Equipamentos', 4),
            ('Software', 4)
        ");
        echo "✓ Subcategorias inseridas com sucesso!<br>";
    } else {
        echo "✓ Categorias já existem.<br>";
    }
    
    echo "<br><strong>Correção concluída com sucesso!</strong><br>";
    echo "Agora você pode usar o sistema normalmente.<br>";
    echo "<a href='index.php'>Voltar ao sistema</a>";
    
} catch (PDOException $e) {
    echo "Erro na correção: " . $e->getMessage();
}
?>
