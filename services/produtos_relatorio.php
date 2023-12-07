<?php
require_once '../conexao.php';
$user_id = $_COOKIE['user_id'];

$queryProdutos = "
    SELECT *
    FROM produto
    ORDER BY nome;
";

$resultProdutos = mysqli_query($conexao, $queryProdutos);
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
</head>
<body>
    <h1>Relatório de Produtos</h1>';

while ($row = mysqli_fetch_assoc($resultProdutos)) {
  $html .= '<hr />';
  $html .= '<div class="mt-4">';
  $html .= '<h2>Dados do Produto</h2>';
  $html .= '<p>ID do Produto: ' . $row['id'] . '</p>';
  $html .= '<p>Nome do Produto: ' . $row['nome'] . '</p>';
  $html .= '<p>Quantidade em Estoque: ' . $row['qtd_estoque'] . '</p>';
  $html .= '<p>Valor Unitário: ' . $row['valor_unitario'] . '</p>';
  $html .= '<p>Unidade de Medida: ' . $row['unidade_medida'] . '</p>';
  $html .= '</div>';
}

$html .= '</body></html>';

$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'portrait');

$dompdf->render();
$dompdf->stream('relatorio_produtos.pdf', array('Attachment' => 0));
header("Location: ../produtos.php");
exit();
?>