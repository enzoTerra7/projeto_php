<?php
include_once '../conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pedido_id = $_COOKIE['pedido_id_edit'];
    echo $pedido_id;
    $data = $_POST['data'];
    $observacao = $_POST['observacao'];
    $cond_pagto = $_POST['cond_pagto'];
    $prazo_entrega = $_POST['prazo_entrega'];
    $produtos = isset($_POST['selecionados']) ? $_POST['selecionados'] : [];

    $verifica_pedido_query = "SELECT id FROM pedidos WHERE id = ?";
    $verifica_pedido_stmt = mysqli_prepare($conexao, $verifica_pedido_query);

    if ($verifica_pedido_stmt) {
        mysqli_stmt_bind_param($verifica_pedido_stmt, 'i', $pedido_id);
        mysqli_stmt_execute($verifica_pedido_stmt);
        mysqli_stmt_store_result($verifica_pedido_stmt);

        if (mysqli_stmt_num_rows($verifica_pedido_stmt) > 0) {
            mysqli_begin_transaction($conexao);

            $query_pedido = "UPDATE pedidos SET data = ?, observacao = ?, cond_pagto = ?, prazo_entrega = ? WHERE id = ?";
            $stmt_pedido = mysqli_prepare($conexao, $query_pedido);

            if ($stmt_pedido) {
                mysqli_stmt_bind_param($stmt_pedido, 'ssssi', $data, $observacao, $cond_pagto, $prazo_entrega, $pedido_id);

                if (mysqli_stmt_execute($stmt_pedido)) {
                    $query_remove_itens = "DELETE FROM itens_pedido WHERE id_pedido = ?";
                    $stmt_remove_itens = mysqli_prepare($conexao, $query_remove_itens);

                    if ($stmt_remove_itens) {
                        mysqli_stmt_bind_param($stmt_remove_itens, 'i', $pedido_id);
                        mysqli_stmt_execute($stmt_remove_itens);

                        foreach ($produtos as $id_produto) {
                            $qtde = 10; 
                            $query_insere_itens = "INSERT INTO itens_pedido (qtde, id_pedido, id_produto) VALUES (?, ?, ?)";
                            $stmt_insere_itens = mysqli_prepare($conexao, $query_insere_itens);

                            if ($stmt_insere_itens) {
                                mysqli_stmt_bind_param($stmt_insere_itens, 'iii', $qtde, $pedido_id, $id_produto);
                                mysqli_stmt_execute($stmt_insere_itens);
                            } else {
                                echo "Erro na preparação da declaração para itens_pedido: " . mysqli_error($conexao);
                                mysqli_rollback($conexao);
                                exit();
                            }
                        }
                        mysqli_commit($conexao);

                        echo "Pedido atualizado com sucesso!";
                        header("Location: ../pedidos.php");
                    } else {
                        echo "Erro na preparação da declaração para remoção de itens_pedido: " . mysqli_error($conexao);
                        mysqli_rollback($conexao);
                    }
                } else {
                    echo "Erro ao executar a atualização do pedido: " . mysqli_stmt_error($stmt_pedido);
                    mysqli_rollback($conexao);
                }

                mysqli_stmt_close($stmt_pedido);
            } else {
                echo "Erro na preparação da declaração para atualização do pedido: " . mysqli_error($conexao);
                mysqli_rollback($conexao);
            }
        } else {
            echo "Pedido não encontrado.";
        }

        mysqli_stmt_close($verifica_pedido_stmt);
    } else {
        echo "Erro na preparação da declaração para verificação de pedido: " . mysqli_error($conexao);
    }

    mysqli_close($conexao);
} else {
    echo "Método de requisição inválido.";
}
exit();
?>
