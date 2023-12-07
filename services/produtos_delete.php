<?php
if (isset($_COOKIE['product_delete_id'])) {
    $product_id = $_COOKIE['product_delete_id'];

    require_once('../conexao.php');

    $query_check_association = "SELECT COUNT(*) AS num_associations FROM itens_pedido WHERE id_produto = $product_id";
    $result_check_association = mysqli_query($conexao, $query_check_association);

    if ($result_check_association) {
        $row = mysqli_fetch_assoc($result_check_association);
        $num_associations = $row['num_associations'];

        if ($num_associations > 0) {
            echo '<script>';
            echo 'alert("Este produto está vinculado a pedidos e não pode ser excluído.");';
            echo 'window.location.href = "../produtos.php";'; 
            echo '</script>';
            exit();
        } else {
            $query_delete_product = "DELETE FROM produto WHERE id = $product_id";
            $result_delete_product = mysqli_query($conexao, $query_delete_product);

            if ($result_delete_product) {
                echo "Produto excluído com sucesso!";
            } else {
                echo "Erro ao excluir o produto.";
            }
        }
    } else {
        echo "Erro ao verificar as associações do produto.";
    }

    mysqli_close($conexao);
} else {
    echo "ID do produto não especificado.";
}

header("Location: ../produtos.php");
exit();
?>
