<!DOCTYPE html>
<html lang="pt-br" class="w-screen h-screen overflow-none">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <title>Ecom | Dashboard</title>
</head>

<body class="w-screen h-screen bg-white items-center justify-center">
    <?php
    include_once 'conexao.php';

    $id = $_COOKIE['user_id'];

    if (empty($_GET['apagar'])) {
        $query = "SELECT * FROM clientes WHERE id = '$id'";
        $result = mysqli_query($conexao, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
        }
    }
    ?>
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
                        <a class="" href="pedidos.php">
                            <button class="middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg text-white hover:bg-white/10 active:bg-white/30 w-full flex items-center gap-4 px-4 capitalize" type="button">
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
                        <a class="" href="./produtos.php">
                            <button class="middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg text-white hover:bg-white/10 active:bg-white/30 w-full flex items-center gap-4 px-4 capitalize" type="button">
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
                        <a aria-current="page" class="active" href="#">
                            <button class="middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg bg-gradient-to-tr from-blue-600 to-blue-400 text-white shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/40 active:opacity-[0.85] w-full flex items-center gap-4 px-4 capitalize" type="button">
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
            <div class="mt-12 h-[calc(100vh-80px)] flex flex-col overflow-x-hidden">
                <main class="bg-neutral-200 p-4 md:p-8 gap-4 rounded-lg shadow-lg flex flex-col items-center container">
                    <div class="flex items-center justify-between w-full gap-4 flex-wrap">
                        <h1 class="text-2xl font-bold">Usuário</h1>

                    </div>
                    <hr class="border border-neutral-100 w-full" />
                    <?php
                    if (isset($_GET['apagar'])) {
                        $query_login = "DELETE FROM login_usuarios WHERE id_cliente = '$id'";
                        $result_login = mysqli_query($conexao, $query_login);
                        $query_clientes = "DELETE FROM clientes WHERE id = '$id'";
                        $result_clientes = mysqli_query($conexao, $query_clientes);

                        if ($result_clientes) {
                            echo "Usuário deletado com sucesso!";

                            echo '<script>setTimeout(function() { window.location = "login.php"; }, 1500);</script>';

                            exit();
                        } else {
                            echo "Algo deu errado e não foi possível deletar o usuário!";
                        }

                        mysqli_close($conexao);
                    }

                    if (isset($_POST['salvar'])) {
                        $nome = $_POST['name'];
                        $endereco = $_POST['endereco'];
                        $numero = $_POST['numero'];
                        $bairro = $_POST['bairro'];
                        $cidade = $_POST['cidade'];
                        $estado = $_POST['estado'];
                        $email = $_POST['email'];
                        $cpf = $_POST['cpf'];
                        $rg = $_POST['rg'];
                        $telefone = $_POST['telefone'];
                        $celular = $_POST['celular'];
                        $data_nasc = $_POST['dataNascimento'];

                        // $query_clientes = "UPDATE clientes SET nome = '$nome', endereco = '$endereco', numero = '$numero', bairro = '$bairro', cidade = '$cidade', estado = '$estado', cpf_cnpj = '$cpf', rg = '$rg', telefone = '$telefone', celular = '$celular', data_nasc = '$data_nasc' WHERE id = '$1'";

                        // $result_clientes = mysqli_query($conexao, $query_clientes);

                        $stmt = $conexao->prepare("UPDATE clientes SET nome = ?, endereco = ?, numero = ?, bairro = ?, cidade = ?, estado = ?, cpf_cnpj = ?, rg = ?, telefone = ?, celular = ?, data_nasc = ? WHERE id = ?");
                        $stmt->bind_param("sssssssssssi", $nome, $endereco, $numero, $bairro, $cidade, $estado, $cpf, $rg, $telefone, $celular, $data_nasc, $id);


                        $stmt->execute();

                        if ($stmt) {
                            echo "<script>window.location.replace('http://localhost/website/user.php')</script>";
                        } else {
                            echo "Algo deu errado e não foi possível editar!";
                        }

                        mysqli_close($conexao);
                    }
                    ?>
                    <form action="./user.php" method="POST" class="flex flex-col gap-4 w-full items-center">
                        <div class="flex flex-col gap-2 w-full cursor-pointer">
                            <label for="email">Email</label>
                            <input value="<?php echo (isset($row['email'])) ? $row['email'] : ''; ?>" name="email" id="email" type="email" required class="bg-neutral-100 p-2 rounded-lg w-full border-none outline-0 focus:ring-2 focus:ring-blue-500 cursor-pointer" placeholder="Insira seu email" />
                        </div>

                        <div class="flex flex-col gap-2 w-full cursor-pointer">
                            <label for="name">Nome</label>
                            <input value="<?php echo (isset($row['nome'])) ? $row['nome'] : ''; ?>" name="name" id="name" type="text" required class="bg-neutral-100 p-2 rounded-lg w-full border-none outline-0 focus:ring-2 focus:ring-blue-500 cursor-pointer" placeholder="Insira seu nome" />
                        </div>

                        <div class="flex flex-wrap gap-4 w-full">
                            <div class="grid grid-cols-2 gap-2 w-full flex-1 min-w-[320px]">
                                <div class="flex flex-col gap-2 w-full cursor-pointer">
                                    <label for="bairro">Bairro</label>
                                    <input value="<?php echo (isset($row['bairro'])) ? $row['bairro'] : ''; ?>" name="bairro" id="bairro" type="text" required class="bg-neutral-100 p-2 rounded-lg w-full border-none outline-0 focus:ring-2 focus:ring-blue-500 cursor-pointer" placeholder="Insira seu bairro" />
                                </div>
                                <div class="flex flex-col gap-2 w-full cursor-pointer">
                                    <label for="cidade">Cidade</label>
                                    <input value="<?php echo (isset($row['cidade'])) ? $row['cidade'] : ''; ?>" name="cidade" id="cidade" type="text" required class="bg-neutral-100 p-2 rounded-lg w-full border-none outline-0 focus:ring-2 focus:ring-blue-500 cursor-pointer" placeholder="Insira sua cidade" />
                                </div>
                            </div>
                            <div class="flex flex-col gap-2 cursor-pointer">
                                <label for="numero">Número</label>
                                <input value="<?php echo (isset($row['numero'])) ? $row['numero'] : ''; ?>" name="numero" id="numero" type="number" required class="bg-neutral-100 p-2 rounded-lg w-full border-none outline-0 focus:ring-2 focus:ring-blue-500 cursor-pointer" placeholder="Insira o número" />
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-4 w-full">
                            <div class="flex flex-col gap-2 w-full cursor-pointer flex-1 min-w-[320px]">
                                <label for="endereco">Endereço</label>
                                <input value="<?php echo (isset($row['endereco'])) ? $row['endereco'] : ''; ?>" name="endereco" id="endereco" type="text" required class="bg-neutral-100 p-2 rounded-lg w-full border-none outline-0 focus:ring-2 focus:ring-blue-500 cursor-pointer" placeholder="Insira o endereço" />
                            </div>
                            <div class="flex flex-col gap-2 cursor-pointer">
                                <label for="estado">Estado</label>
                                <select value="<?php echo (isset($row['estado'])) ? $row['estado'] : ''; ?>" name="estado" id="estado" required class="bg-neutral-100 p-2 rounded-lg w-full border-none outline-0 focus:ring-2 focus:ring-blue-500 cursor-pointer" placeholder="Insira o número">
                                    <option value="AC">Acre</option>
                                    <option value="AL">Alagoas</option>
                                    <option value="AP">Amapá</option>
                                    <option value="AM">Amazonas</option>
                                    <option value="BA">Bahia</option>
                                    <option value="CE">Ceará</option>
                                    <option value="DF">Distrito Federal</option>
                                    <option value="ES">Espirito Santo</option>
                                    <option value="GO">Goiás</option>
                                    <option value="MA">Maranã</option>
                                    <option value="MT">Mato Grosso</option>
                                    <option value="MS">Mato Grosso do Sul</option>
                                    <option value="MG">Minas Gerais</option>
                                    <option value="PA">Pará</option>
                                    <option value="PB">Pará</option>
                                    <option value="PR">Paraná</option>
                                    <option value="PE">Pernambuco</option>
                                    <option value="PI">Piauí</option>
                                    <option value="RJ">Rio de Janeiro</option>
                                    <option value="RN">Rio Grande do Norte</option>
                                    <option value="RS">Rio Grande do Sul</option>
                                    <option value="RO">Rondônia</option>
                                    <option value="RR">Roraima</option>
                                    <option value="SC">Santa Catarina</option>
                                    <option value="SP">São Paulo</option>
                                    <option value="SE">Sergipe</option>
                                    <option value="TO">Tocantins</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-4 w-full">
                            <div class="flex flex-col gap-2 cursor-pointer flex-1 min-w-[240px]">
                                <label for="cpf">CPF</label>
                                <input value="<?php echo (isset($row['cpf_cnpj'])) ? $row['cpf_cnpj'] : ''; ?>" name="cpf" id="cpf" type="text" required pattern="[0-9]{3}[0-9]{3}[0-9]{3}[0-9]{2}" class="bg-neutral-100 p-2 rounded-lg w-full border-none outline-0 focus:ring-2 focus:ring-blue-500 cursor-pointer" placeholder="Insira seu CPF" />
                            </div>
                            <div class="flex flex-col gap-2 cursor-pointer flex-1 min-w-[240px]">
                                <label for="rg">RG</label>
                                <input value="<?php echo (isset($row['rg'])) ? $row['rg'] : ''; ?>" name="rg" id="rg" type="text" required pattern="[0-9]{2}[0-9]{3}[0-9]{3}[0-9]{1}" class="bg-neutral-100 p-2 rounded-lg w-full border-none outline-0 focus:ring-2 focus:ring-blue-500 cursor-pointer" placeholder="Insira seu RG" />
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-4 w-full">
                            <div class="flex flex-col gap-2 cursor-pointer flex-1 min-w-[240px]">
                                <label for="celular">Celular</label>
                                <input value="<?php echo (isset($row['celular'])) ? $row['celular'] : ''; ?>" name="celular" id="celular" type="number" required pattern="[0-9]{2}9[0-9]{4}[0-9]{4}" class="bg-neutral-100 p-2 rounded-lg w-full border-none outline-0 focus:ring-2 focus:ring-blue-500 cursor-pointer" placeholder="Insira seu celular" />
                            </div>
                            <div class="flex flex-col gap-2 cursor-pointer flex-1 min-w-[240px]">
                                <label for="telefone">Telefone</label>
                                <input value="<?php echo (isset($row['telefone'])) ? $row['telefone'] : ''; ?>" name="telefone" id="telefone" type="number" required pattern="[0-9]{2}[0-9]{4}[0-9]{4}" class="bg-neutral-100 p-2 rounded-lg w-full border-none outline-0 focus:ring-2 focus:ring-blue-500 cursor-pointer" placeholder="Insira seu telefone" />
                            </div>
                        </div>

                        <div class="flex flex-col gap-2 w-full cursor-pointer">
                            <label for="dataNascimento">Data de nascimento</label>
                            <input value="<?php echo (isset($row['data_nasc'])) ? $row['data_nasc'] : ''; ?>" name="dataNascimento" id="dataNascimento" type="date" required max="2005-01-01" class="bg-neutral-100 p-2 rounded-lg w-full border-none outline-0 focus:ring-2 focus:ring-blue-500 cursor-pointer" />
                        </div>

                        <div class="flex items-center justify-center gap-2 w-full my-4">
                            <button id="clear" name="cancelar" type="reset" class="bg-transparent p-2 rounded-lg hover:bg-red-700 hover:text-white transition-colors duration-300">Cancelar</button>
                            <button name="salvar" type="submit" class="bg-blue-500 text-white p-2 rounded-lg hover-bg-blue-700 transition-colors duration-300">Salvar</button>
                        </div>
                    </form>
                    <hr class="border border-neutral-100 w-full" />
                    <form action="user.php" method="GET">
                        <button type="submit" name="apagar" class="bg-red-500 text-white p-2 gap-2 px-4 flex items-center justify-center rounded-lg hover:bg-red-700 transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512" fill="currentColor">
                                <path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z" />
                            </svg>
                            Apagar
                        </button>
                    </form>
                </main>
            </div>
        </div>
    </div>
</body>

</html>