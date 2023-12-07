<?php
if (isset($_COOKIE['pedido_delete_id'])) {
    $order_id = $_COOKIE['pedido_delete_id'];

    require_once('../conexao.php');

    $query_itens = "DELETE FROM itens_pedido WHERE id_pedido = $order_id";
    $result_itens = mysqli_query($conexao, $query_itens);

    $query_order = "DELETE FROM pedidos WHERE id = $order_id";
    $result_order = mysqli_query($conexao, $query_order);

    mysqli_close($conexao);

    if ($result_itens && $result_order) {
        echo "Pedido excluído com sucesso!";
    } else {
        echo "Erro ao excluir o pedido.";
    }
} else {
    echo "ID do pedido não especificado.";
}
header("Location: ../pedidos.php");
exit();
?>
