<?php
include_once 'conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br" class="w-screen h-screen overflow-none">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <title>Ecom | Pedidos</title>

    <style>
        html,
        body {
            height: 100%;
        }

        @media (min-width: 640px) {
            table {
                display: inline-table !important;
            }

            thead tr:not(:first-child) {
                display: none;
            }
        }

        td:not(:last-child) {
            border-bottom: 0;
        }

        th:not(:last-child) {
            border-bottom: 2px solid rgba(0, 0, 0, .1);
        }
    </style>
</head>

<script>
    function changePage(id) {
        document.cookie = 'pedido_id_edit' + "=" + id + "; path=/";
        const a = document.createElement('a')
        a.href = `./pedidos_edit.php`
        a.click()
    }

    function deleteProduct(id) {
        document.cookie = 'pedido_delete_id' + "=" + id + "; path=/";
        const a = document.createElement('a')
        a.href = `./services/pedidos_delete.php`
        a.click()
    }

    function goToRegister() {
        const a = document.createElement('a')
        a.href = `./pedidos_view.php`
        a.click()
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
                        <a aria-current="page" class="active" href="#">
                            <button class="middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg bg-gradient-to-tr from-blue-600 to-blue-400 text-white shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/40 active:opacity-[0.85] w-full flex items-center gap-4 px-4 capitalize" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512" fill="currentColor">
                                    <path d="M58.9 42.1c3-6.1 9.6-9.6 16.3-8.7L320 64 564.8 33.4c6.7-.8 13.3 2.7 16.3 8.7l41.7 83.4c9 17.9-.6 39.6-19.8 45.1L439.6 217.3c-13.9 4-28.8-1.9-36.2-14.3L320 64 236.6 203c-7.4 12.4-22.3 18.3-36.2 14.3L37.1 170.6c-19.3-5.5-28.8-27.2-19.8-45.1L58.9 42.1zM321.1 128l54.9 91.4c14.9 24.8 44.6 36.6 72.5 28.6L576 211.6v167c0 22-15 41.2-36.4 46.6l-204.1 51c-10.2 2.6-20.9 2.6-31 0l-204.1-51C79 419.7 64 400.5 64 378.5v-167L191.6 248c27.8 8 57.6-3.8 72.5-28.6L318.9 128h2.2z" />
                                </svg>
                                <p class="block antialiased font-sans text-base leading-relaxed text-inherit font-medium capitalize">
                                    Pedidos
                                </p>
                            </button>
                        </a>
                    </li>
                    <li>
                        <a class="" href="./produtos.php">
                            <button class="middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg text-white hover:bg-white/10 active:bg-white/30 w-full flex items-center gap-4 px-4 capitalize" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512" fill="currentColor">
                                    <path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
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
                        <h1 class="text-2xl font-bold">Pedidos</h1>
                        <span class="flex gap-4 flex-wrap">
                            <input id="filtro-inicio" name="filtro-inicio" required class="bg-neutral-100 p-2 rounded-lg min-w-[300px] border-none outline-0 focus:ring-2 focus:ring-blue-500 cursor-pointer" type="date" />
                            <input id="filtro-fim" name="filtro-fim" required class="bg-neutral-100 p-2 rounded-lg min-w-[300px] border-none outline-0 focus:ring-2 focus:ring-blue-500 cursor-pointer" type="date" />
                            <form action="./services/pedidos_relatorio.php" method="post">
                                <button class="bg-orange-500 text-white p-2 rounded-lg hover:bg-orange-700 transition-colors duration-300">
                                    Gerar relatório
                                </button>
                            </form>
                            <button class="bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-700 transition-colors duration-300" onclick="goToRegister()">
                                Cadastrar
                            </button>
                        </span>
                    </div>

                    <hr class="border border-neutral-100 w-full" />
                    <?php
                    require_once('conexao.php');

                    $id_client = $_COOKIE['user_id'];

                    $queryCliente = "SELECT nome FROM clientes WHERE id = '$id_client'";
                    $resultCliente = mysqli_query($conexao, $queryCliente);
                    $rowCliente = mysqli_fetch_assoc($resultCliente);
                    $nome_cliente = $rowCliente['nome'];
                    $query = "SELECT * FROM pedidos WHERE id_cliente = '$id_client'";
                    $result = mysqli_query($conexao, $query);

                    if ($result) {
                        echo '<table class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5">';
                        echo '<thead class="text-white">';
                        echo '<tr class="bg-teal-400 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">';
                        echo '<th class="p-3 text-left">ID do Pedido</th>';
                        echo '<th class="p-3 text-left">Data</th>';
                        echo '<th class="p-3 text-left">Observação</th>';
                        echo '<th class="p-3 text-left">Condição de Pagamento</th>';
                        echo '<th class="p-3 text-left">Prazo de Entrega</th>';
                        echo '<th class="p-3 text-left">Cliente</th>';
                        echo '<th class="p-3 text-left" width="110px">Ações</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody class="flex-1 sm:flex-none>';

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">';
                            echo '<td class="border-grey-light border hover:bg-gray-100 p-3">' . $row['id'] . '</td>';
                            echo '<td class="border-grey-light border hover:bg-gray-100 p-3">' . date('d/m/Y', strtotime($row['data'])) . '</td>';
                            echo '<td class="border-grey-light border hover-bg-gray-100 p-3">' . $row['observacao'] . '</td>';
                            echo '<td class="border-grey-light border hover-bg-gray-100 p-3">' . $row['cond_pagto'] . '</td>';
                            echo '<td class="border-grey-light border hover-bg-gray-100 p-3">' . $row['prazo_entrega'] . '</td>';
                            echo '<td class="border-grey-light border hover-bg-gray-100 p-3">' . $nome_cliente . '</td>';
                            echo '
                            <td class="border-grey-light border hover-bg-gray-100 p-3 hover:font-medium cursor-pointer">
                                <div class="flex items-center gap-2 justify-evenly w-full h-full">
                                    <span class="text-red-400 hover:text-red-600" onclick="deleteProduct(' . $row['id'] . ')">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512" fill="currentColor">
                                            <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                        </svg>
                                    </span>
                                    <span class="text-blue-400 hover:text-blue-600" onclick="changePage(' . $row['id'] . ')">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512" fill="currentColor">
                                            <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z" />
                                        </svg>
                                    </span>
                                </div>
                            </td>
                            ';
                            echo '</tr>';
                        }

                        echo '</tbody>';
                        echo '</table>';
                    } else {
                        echo "Nenhum pedido encontrado.";
                    }

                    mysqli_close($conexao);
                    ?>

                </main>
            </div>
        </div>
    </div>
    <script>
        document.querySelector('#filtro-inicio').addEventListener('change', filtrarPorPeriodo);
        document.querySelector('#filtro-fim').addEventListener('change', filtrarPorPeriodo);

        function filtrarPorPeriodo() {
            const inicio = document.querySelector('#filtro-inicio').value;
            const fim = document.querySelector('#filtro-fim').value;
            const linhasTabela = document.querySelectorAll('tbody tr');

            linhasTabela.forEach(linha => {
                const data = linha.querySelector('td:nth-child(2)').textContent.trim().substring(0, 10).split('/').reverse().join('-')
                if (!inicio && !fim) {
                    linha.style.display = '';
                } else if (!fim) {
                    linha.style.display = data >= inicio ? '' : 'none';
                } else if (!inicio) {
                    linha.style.display = data <= fim ? '' : 'none';
                } else {
                    linha.style.display = data >= inicio && data <= fim ? '' : 'none';
                }
            });
        }
    </script>
</body>

</html>