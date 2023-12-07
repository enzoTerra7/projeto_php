<?php
require_once '../conexao.php';
$data_inicio = '2023-10-05';
$data_termino = '2023-11-25';
$user_id = $_COOKIE['user_id'];

$query = "SELECT pedidos.id AS id_pedido, pedidos.data AS data_pedido, pedidos.observacao, 
                 pedidos.cond_pagto, pedidos.prazo_entrega, clientes.nome AS nome_cliente,
                 itens_pedido.id_item, itens_pedido.qtde, produto.nome AS nome_produto, produto.valor_unitario
          FROM pedidos
          INNER JOIN itens_pedido ON pedidos.id = itens_pedido.id_pedido
          INNER JOIN produto ON itens_pedido.id_produto = produto.id
          INNER JOIN clientes ON pedidos.id_cliente = clientes.id
          WHERE pedidos.data BETWEEN '$data_inicio' AND '$data_termino'
          AND clientes.id = $user_id";
$result = mysqli_query($conexao, $query);

$pedidos = [];

// echo '<pre>'; print_r($result); echo '</pre>';

if ($result) {
  while ($row = mysqli_fetch_assoc($result)) {
    $pedidos[$row['id_pedido']]['dados_pedido'] = [
      'id_pedido' => $row['id_pedido'],
      'data_pedido' => $row['data_pedido'],
      'observacao' => $row['observacao'],
      'cond_pagto' => $row['cond_pagto'],
      'prazo_entrega' => $row['prazo_entrega'],
      'nome_cliente' => $row['nome_cliente'],
    ];
    $pedidos[$row['id_pedido']]['itens'][] = [
      'id_item' => $row['id_item'],
      'qtde' => $row['qtde'],
      'nome_produto' => $row['nome_produto'],
      'valor_unitario' => $row['valor_unitario'],
    ];
  }
}

mysqli_close($conexao);
?>
<?php
require_once '../dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);

$dompdf = new Dompdf($options);
$html = '<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Pedidos</title>
    <!-- Adicione seus estilos CSS personalizados aqui, se necessário -->
</head>
<body>
    <h1>Relatório de Pedidos</h1>';

foreach ($pedidos as $pedido) {
  $html .= '<hr />';
  $html .= '<div class="mt-4">';
  $html .= '<h2>Dados do Pedido</h2>';
  $html .= '<p>ID do Pedido: ' . $pedido['dados_pedido']['id_pedido'] . '</p>';
  $html .= '<p>Data do Pedido: ' . $pedido['dados_pedido']['data_pedido'] . '</p>';
  $html .= '<p>Observação: ' . $pedido['dados_pedido']['observacao'] . '</p>';
  $html .= '<p>Condição de Pagamento: ' . $pedido['dados_pedido']['cond_pagto'] . '</p>';
  $html .= '<p>Prazo de Entrega: ' . $pedido['dados_pedido']['prazo_entrega'] . '</p>';
  $html .= '<p>Nome do Cliente: ' . $pedido['dados_pedido']['nome_cliente'] . '</p>';

  $html .= '<h2>Itens do Pedido</h2>';
  $html .= '<table border="1">
                <tr>
                    <th>ID do Item</th>
                    <th>Quantidade</th>
                    <th>Nome do Produto</th>
                    <th>Valor Unitário</th>
                </tr>';

  foreach ($pedido['itens'] as $item) {
    $html .= '<tr>';
    $html .= '<td>' . $item['id_item'] . '</td>';
    $html .= '<td>' . $item['qtde'] . '</td>';
    $html .= '<td>' . $item['nome_produto'] . '</td>';
    $html .= '<td>' . $item['valor_unitario'] . '</td>';
    $html .= '</tr>';
  }

  $html .= '</table>';
  $html .= '</div>';
}

$html .= '</body></html>';

$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'portrait');

$dompdf->render();
$dompdf->stream('relatorio_pedidos.pdf', array('Attachment' => 0));
header("Location: ../pedidos.php");
exit();
?>