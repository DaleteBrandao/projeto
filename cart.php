<?php 
session_start();

$conn = new mysqli ('localhost', 'root', '' , 'mercearia');
if ($conn->connect_error) {
   die ("Conexão falhou: " . $conn->connect_error);
}

function addToCart($productId, $quantity = 1) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM produtos WHERE id = ?");
    
    if (!$stmt) {
        return "Erro ao preparar consulta: " . $conn->error;
    }

    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $product = $stmt->get_result()->fetch_assoc();

    if (!$product) {
        return "Produto não encontrado.";
    }

    // Verifica se a quantidade solicitada está disponível no estoque
    if ($product['estoque'] < $quantity) {
        return "Quantidade solicitada não disponível no estoque.";
    }

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$productId])) {
        $newQuantity = $_SESSION['cart'][$productId]['quantity'] + $quantity;
        
        // Verifica novamente o estoque para a nova quantidade
        if ($product['estoque'] < $newQuantity) {
            return "Quantidade total excede o estoque disponível.";
        }
        
        $_SESSION['cart'][$productId]['quantity'] = $newQuantity;
    } else {
        $_SESSION['cart'][$productId] = [
            'name' => $product['nome'],
            'price' => $product['preco'],
            'quantity' => $quantity,
            'category' => $product['categoria']
        ];
    }

    $stmt->close();
    return "Produto adicionado ao carrinho!";
}
?>
