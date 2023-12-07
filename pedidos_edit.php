<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include_once 'conexao.php';

if (isset($_COOKIE['pedido_id_edit'])) {
  $pedido_id = $_COOKIE['pedido_id_edit'];

  $query = "SELECT * FROM pedidos WHERE id = ?";
  $stmt = mysqli_prepare($conexao, $query);

  if ($stmt) {
    mysqli_stmt_bind_param($stmt, 'i', $pedido_id);

    if (mysqli_stmt_execute($stmt)) {
      $result = mysqli_stmt_get_result($stmt);

      if ($result && $row = mysqli_fetch_assoc($result)) {
        $data = $row['data'];
        $observacao = $row['observacao'];
        $cond_pagto = $row['cond_pagto'];
        $prazo_entrega = $row['prazo_entrega'];
      } else {
        echo "Pedido não encontrado.";
        exit();
      }
    } else {
      echo "Erro ao executar a consulta: " . mysqli_stmt_error($stmt);
      exit();
    }

    mysqli_stmt_close($stmt);
  } else {
    echo "Erro na preparação da declaração: " . mysqli_error($conexao);
    exit();
  }
} else {
  echo "ID do pedido não especificado.";
  exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br" class="w-screen h-screen overflow-none">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <title>Ecom | Editar pedido</title>
</head>

<script>

  function goBack() {
    const a = document.createElement('a')
    a.href = `./pedidos.php`
    a.click()
  }

  function validarFormulario() {
    var checkboxes = document.getElementsByName('selecionados[]');

    var peloMenosUmMarcado = false;
    for (var i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i].checked) {
        peloMenosUmMarcado = true;
        break;
      }
    }
    if (!peloMenosUmMarcado) {
      alert("Selecione pelo menos uma opção!");
      return false;
    }
    return true;
  }
</script>

<body class="w-screen h-screen bg-white items-center justify-center">
  <div class="min-h-screen bg-gray-50/50">
    <aside class="bg-gradient-to-br from-gray-800 to-gray-900 -translate-x-80 fixed inset-0 z-50 my-4 ml-4 h-[calc(100vh-32px)] w-72 rounded-xl transition-transform duration-300 xl:translate-x-0">
      <div class="relative border-b border-white/20">
        <a class="flex items-center gap-4 py-6 px-8" href="#/">
          <h6 class="block antialiased tracking-normal font-sans text-base font-semibold leading-relaxed text-white">
            ECOM
          </h6>
        </a>
        <button class="middle none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-8 max-w-[32px] h-8 max-h-[32px] rounded-lg text-xs text-white hover:bg-white/10 active:bg-white/30 absolute right-0 top-0 grid rounded-br-none rounded-tl-none xl:hidden" type="button">
          <span class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" aria-hidden="true" class="h-5 w-5 text-white">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </span>
        </button>
      </div>
      <div class="m-4">
        <ul class="mb-4 flex flex-col gap-1">
          <li>
            <a class="" href="./dashboard.php">
              <button class="middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg text-white hover:bg-white/10 active:bg-white/30 w-full flex items-center gap-4 px-4 capitalize" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="w-5 h-5 text-inherit">
                  <path d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z"></path>
                  <path d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z"></path>
                </svg>
                <p class="block antialiased font-sans text-base leading-relaxed text-inherit font-medium capitalize">
                  dashboard
                </p>
              </button>
            </a>
          </li>
          <li>
            <a class="" href="./pedidos.php">
              <button class="middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg bg-gradient-to-tr from-blue-600 to-blue-400 text-white shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/40 active:opacity-[0.85] w-full flex items-center gap-4 px-4 capitalize" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512" fill="currentColor">
                  <path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
                </svg>
                <p class="block antialiased font-sans text-base leading-relaxed text-inherit font-medium capitalize">
                  Pedidos
                </p>
              </button>
            </a>
          </li>
          <li>
            <a aria-current="page" class="active" href="produtos.php">
              <button class="middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg text-white hover:bg-white/10 active:bg-white/30 w-full flex items-center gap-4 px-4 capitalize">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512" fill="currentColor">
                  <path d="M58.9 42.1c3-6.1 9.6-9.6 16.3-8.7L320 64 564.8 33.4c6.7-.8 13.3 2.7 16.3 8.7l41.7 83.4c9 17.9-.6 39.6-19.8 45.1L439.6 217.3c-13.9 4-28.8-1.9-36.2-14.3L320 64 236.6 203c-7.4 12.4-22.3 18.3-36.2 14.3L37.1 170.6c-19.3-5.5-28.8-27.2-19.8-45.1L58.9 42.1zM321.1 128l54.9 91.4c14.9 24.8 44.6 36.6 72.5 28.6L576 211.6v167c0 22-15 41.2-36.4 46.6l-204.1 51c-10.2 2.6-20.9 2.6-31 0l-204.1-51C79 419.7 64 400.5 64 378.5v-167L191.6 248c27.8 8 57.6-3.8 72.5-28.6L318.9 128h2.2z" />
                </svg>
                <p class="block antialiased font-sans text-base leading-relaxed text-inherit font-medium capitalize">
                  Produtos
                </p>
              </button>
            </a>
          </li>
                    <li>
                        <a class="" href="./itens_pedidos.php">
                            <button class="middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg text-white hover:bg-white/10 active:bg-white/30 w-full flex items-center gap-4 px-4 capitalize" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512" fill="currentColor">
                                    <path d="M248 0H208c-26.5 0-48 21.5-48 48V160c0 35.3 28.7 64 64 64H352c35.3 0 64-28.7 64-64V48c0-26.5-21.5-48-48-48H328V80c0 8.8-7.2 16-16 16H264c-8.8 0-16-7.2-16-16V0zM64 256c-35.3 0-64 28.7-64 64V448c0 35.3 28.7 64 64 64H224c35.3 0 64-28.7 64-64V320c0-35.3-28.7-64-64-64H184v80c0 8.8-7.2 16-16 16H120c-8.8 0-16-7.2-16-16V256H64zM352 512H512c35.3 0 64-28.7 64-64V320c0-35.3-28.7-64-64-64H472v80c0 8.8-7.2 16-16 16H408c-8.8 0-16-7.2-16-16V256H352c-15 0-28.8 5.1-39.7 13.8c4.9 10.4 7.7 22 7.7 34.2V464c0 12.2-2.8 23.8-7.7 34.2C323.2 506.9 337 512 352 512z" />
                                </svg>
                                <p class="block antialiased font-sans text-base leading-relaxed text-inherit font-medium capitalize">
                                    Itens Pedidos
                                </p>
                            </button>
                        </a>
                    </li>
          <li>
            <a class="" href="./user.php">
              <button class="middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg text-white hover:bg-white/10 active:bg-white/30 w-full flex items-center gap-4 px-4 capitalize" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512" fill="currentColor">
                  <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                </svg>
                <p class="block antialiased font-sans text-base leading-relaxed text-inherit font-medium capitalize">
                  Usuário
                </p>
              </button>
            </a>
          </li>
          <li>
            <a class="" href="./login.php">
              <button class="middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg text-white hover:bg-white/10 active:bg-white/30 w-full flex items-center gap-4 px-4 capitalize" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="w-5 h-5 text-inherit">
                  <path fill-rule="evenodd" d="M7.5 3.75A1.5 1.5 0 006 5.25v13.5a1.5 1.5 0 001.5 1.5h6a1.5 1.5 0 001.5-1.5V15a.75.75 0 011.5 0v3.75a3 3 0 01-3 3h-6a3 3 0 01-3-3V5.25a3 3 0 013-3h6a3 3 0 013 3V9A.75.75 0 0115 9V5.25a1.5 1.5 0 00-1.5-1.5h-6zm10.72 4.72a.75.75 0 011.06 0l3 3a.75.75 0 010 1.06l-3 3a.75.75 0 11-1.06-1.06l1.72-1.72H9a.75.75 0 010-1.5h10.94l-1.72-1.72a.75.75 0 010-1.06z" clip-rule="evenodd"></path>
                </svg>
                <p class="block antialiased font-sans text-base leading-relaxed text-inherit font-medium capitalize">
                  Sair
                </p>
              </button>
            </a>
          </li>
        </ul>
      </div>
    </aside>
    <div class="p-4 xl:ml-80">
      <div class="mt-12 h-[calc(100vh-80px)] flex flex-col">
        <main class="bg-neutral-200 p-4 md:p-8 gap-4 rounded-lg shadow-lg flex flex-col items-center container">
          <div class="flex items-center justify-between w-full gap-4 flex-wrap">
            <h1 class="text-2xl font-bold">Editar Pedidos</h1>

          </div>
          <hr class="border border-neutral-100 w-full" />
          <form class="w-full flex flex-col gap-4" method="POST" action="services/pedidos_edit.php" onsubmit="return validarFormulario();">
            <div class="flex gap-4 flex-wrap items-center">
              <div class="flex flex-col gap-2 min-w-[320px] flex-1 cursor-pointer">
                <label for="nome">Data</label>
                <input name="data" id="data" type="date" value="<?php echo $data; ?>" required class="bg-neutral-100 p-2 rounded-lg w-full border-none outline-0 focus:ring-2 focus:ring-blue-500 cursor-pointer" placeholder="Informe a data" />
              </div>
              <div class="flex flex-col gap-2 min-w-[320px] flex-1 cursor-pointer">
                <label for="qtd_estoque">Observação</label>
                <input name="observacao" id="observacao" value="<?php echo $observacao; ?>" type="text" step="1" maxlength="255" required class="bg-neutral-100 p-2 rounded-lg w-full border-none outline-0 focus:ring-2 focus:ring-blue-500 cursor-pointer" placeholder="Insira as observações" />
              </div>
            </div>
            <div class="flex gap-4 flex-wrap items-center">
              <div class="flex flex-col gap-2 min-w-[320px] flex-1 cursor-pointer">
                <label for="valor">Condição de Pagamento</label>
                <input name="cond_pagto" id="cond_pagto" type="varchar" value="<?php echo $cond_pagto; ?>" required maxlength="255" class="bg-neutral-100 p-2 rounded-lg w-full border-none outline-0 focus:ring-2 focus:ring-blue-500 cursor-pointer" placeholder="Informe a condição de pagamento" />
              </div>
              <div class="flex flex-col gap-2 min-w-[320px] flex-1 cursor-pointer">
                <label for="unit">Prazo de entrega em dias</label>
                <input name="prazo_entrega" id="prazo_entrega" type="number" value="<?php echo $prazo_entrega; ?>" step="1" required class="bg-neutral-100 p-2 rounded-lg w-full border-none outline-0 focus:ring-2 focus:ring-blue-500 cursor-pointer" placeholder="Informe o prazo de entrega" />
              </div>
            </div>
            <hr class="border-gray-300" />
            <div class="flex items-center justify-between w-full gap-4 flex-wrap">
              <h1 class="text-2xl font-bold">Adicionar Produtos</h1>
            </div>
            <div class="flex flex-wrap w-full gap-4">
              <?php
              require_once('conexao.php');
              $query_produtos = "SELECT p.id, p.nome, ip.id_produto AS produto_associado
                        FROM produto p
                        LEFT JOIN itens_pedido ip ON p.id = ip.id_produto AND ip.id_pedido = $pedido_id";

              $result_produtos = mysqli_query($conexao, $query_produtos);

              if ($result_produtos) {
                while ($row_produto = mysqli_fetch_assoc($result_produtos)) {
                  $produto_id = $row_produto['id'];
                  $produto_associado = $row_produto['produto_associado'];

                  echo '
                <label class="border border-gray-300 rounded-lg shadow p-4 flex gap-4 items-center cursor-pointer flex-1 min-w-[300px]">
                    <input type="checkbox" name="selecionados[]" value="' . $produto_id . '"';

                  // Marca como "checked" se o produto já estiver associado ao pedido
                  if ($produto_associado !== null) {
                    echo ' checked';
                  }

                  echo ' class="p-2 border border-gray-300 rounded bg-transparent w-5 h-5" />
                    <div class="flex flex-col">
                        <h1 class="text-lg font-bold">' . $row_produto['nome'] . '</h1>';

                  // Adiciona uma mensagem indicando que o produto já foi adicionado ao pedido
                  if ($produto_associado !== null) {
                    echo '<small>Produto já adicionado ao pedido.</small>';
                  }

                  echo '</div>
                </label>
            ';
                }
              } else {
                echo "Erro ao obter produtos do pedido: " . mysqli_error($conexao);
              }

              mysqli_close($conexao);
              ?>
            </div>
            <div class="flex flex-wrap items-center justify-between gap-4">
              <div class="flex gap-2 w-fit items-center my-4">
                <button type="reset" onclick="goBack()" class="bg-transparent p-2 rounded-lg hover:bg-red-700 hover:text-white transition-colors duration-300">
                  Cancelar
                </button>
                <button type="submit" name="pedido_id" class="bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-700 transition-colors duration-300">
                  Salvar
                </button>
              </div>
            </div>
          </form>
        </main>
      </div>
    </div>
  </div>
</body>

</html>