<!DOCTYPE html>
<html lang="pt-br" class="w-screen h-screen overflow-none">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Cadastro</title>
</head>

<body class="w-screen h-screen bg-slate-200 p-4 flex items-center justify-center">
    <main class="bg-neutral-200 p-4 md:p-8 gap-4 rounded-lg shadow-lg flex flex-col items-center container xl:max-w-[40vw] max-h-[80vh] overflow-auto">
        <h1 class="text-2xl uppercase font-black font-sans">Cadastre-se</h1>

        <?php
        include_once 'conexao.php';

        $loginError = '';

        if (isset($_POST['cadastrar'])) {
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
            $senha = $_POST['password'];

            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

            $login = $email;

            $query_clientes = "INSERT INTO clientes(nome, endereco, numero, bairro, cidade, estado, email, cpf_cnpj, rg, telefone, celular, data_nasc) 
                            VALUES ('$nome', '$endereco', '$numero', '$bairro', '$cidade', '$estado', '$email', '$cpf', '$rg', '$telefone', '$celular', '$data_nasc')";

            $query_login = "INSERT INTO login_usuarios(login, senha, id_cliente) 
                            VALUES ('$login', '$senha_hash', LAST_INSERT_ID())";

            $result_clientes = mysqli_query($conexao, $query_clientes);

            if ($result_clientes) {
                $result_login = mysqli_query($conexao, $query_login);

                if ($result_login) {
                    echo "Cadastro realizado com sucesso!";
                }
            }

            mysqli_close($conexao);
        }
        ?>


        <form action="register.php" method="POST" class="flex flex-col gap-4 w-full items-center">
            <div class="flex flex-col gap-2 w-full cursor-pointer">
                <label for="email">Email</label>
                <input name="email" id="email" type="email" required class="bg-neutral-100 p-2 rounded-lg w-full border-none outline-0 focus:ring-2 focus:ring-blue-500 cursor-pointer" placeholder="Insira seu email" />
            </div>
            <div class="flex flex-col gap-2 w-full cursor-pointer">
                <label for="password">Senha</label>
                <input name="password" id="password" type="password" required class="bg-neutral-100 p-2 rounded-lg w-full border-none outline-0 focus:ring-2 focus:ring-blue-500 cursor-pointer" placeholder="Insira sua senha" />
            </div>

            <div class="flex flex-col gap-2 w-full cursor-pointer">
                <label for="name">Nome</label>
                <input name="name" id="name" type="text" required class="bg-neutral-100 p-2 rounded-lg w-full border-none outline-0 focus:ring-2 focus:ring-blue-500 cursor-pointer" placeholder="Insira seu nome" />
            </div>

            <div class="flex flex-wrap gap-4 w-full">
                <div class="grid grid-cols-2 gap-2 w-full flex-1 min-w-[320px]">
                    <div class="flex flex-col gap-2 w-full cursor-pointer">
                        <label for="bairro">Bairro</label>
                        <input name="bairro" id="bairro" type="text" required class="bg-neutral-100 p-2 rounded-lg w-full border-none outline-0 focus:ring-2 focus:ring-blue-500 cursor-pointer" placeholder="Insira seu bairro" />
                    </div>
                    <div class="flex flex-col gap-2 w-full cursor-pointer">
                        <label for="cidade">Cidade</label>
                        <input name="cidade" id="cidade" type="text" required class="bg-neutral-100 p-2 rounded-lg w-full border-none outline-0 focus:ring-2 focus:ring-blue-500 cursor-pointer" placeholder="Insira sua cidade" />
                    </div>
                </div>
                <div class="flex flex-col gap-2 cursor-pointer">
                    <label for="numero">Número</label>
                    <input name="numero" id="numero" type="number" required class="bg-neutral-100 p-2 rounded-lg w-full border-none outline-0 focus:ring-2 focus:ring-blue-500 cursor-pointer" placeholder="Insira o número" />
                </div>
            </div>

            <div class="flex flex-wrap gap-4 w-full">
                <div class="flex flex-col gap-2 w-full cursor-pointer flex-1 min-w-[320px]">
                    <label for="endereco">Endereço</label>
                    <input name="endereco" id="endereco" type="text" required class="bg-neutral-100 p-2 rounded-lg w-full border-none outline-0 focus:ring-2 focus:ring-blue-500 cursor-pointer" placeholder="Insira o endereço" />
                </div>
                <div class="flex flex-col gap-2 cursor-pointer">
                    <label for="estado">Estado</label>
                    <select name="estado" id="estado" required class="bg-neutral-100 p-2 rounded-lg w-full border-none outline-0 focus:ring-2 focus:ring-blue-500 cursor-pointer" placeholder="Insira o número">
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
                    <input name="cpf" id="cpf" type="text" required pattern="[0-9]{3}[0-9]{3}[0-9]{3}[0-9]{2}" class="bg-neutral-100 p-2 rounded-lg w-full border-none outline-0 focus:ring-2 focus:ring-blue-500 cursor-pointer" placeholder="Insira seu CPF" />
                </div>
                <div class="flex flex-col gap-2 cursor-pointer flex-1 min-w-[240px]">
                    <label for="rg">RG</label>
                    <input name="rg" id="rg" type="text" required pattern="[0-9]{2}[0-9]{3}[0-9]{3}[0-9]{1}" class="bg-neutral-100 p-2 rounded-lg w-full border-none outline-0 focus:ring-2 focus:ring-blue-500 cursor-pointer" placeholder="Insira seu RG" />
                </div>
            </div>

            <div class="flex flex-wrap gap-4 w-full">
                <div class="flex flex-col gap-2 cursor-pointer flex-1 min-w-[240px]">
                    <label for="celular">Celular</label>
                    <input name="celular" id="celular" type="number" required pattern="[0-9]{2}9[0-9]{4}[0-9]{4}" class="bg-neutral-100 p-2 rounded-lg w-full border-none outline-0 focus:ring-2 focus:ring-blue-500 cursor-pointer" placeholder="Insira seu celular" />
                </div>
                <div class="flex flex-col gap-2 cursor-pointer flex-1 min-w-[240px]">
                    <label for="telefone">Telefone</label>
                    <input name="telefone" id="telefone" type="number" required pattern="[0-9]{2}[0-9]{4}[0-9]{4}" class="bg-neutral-100 p-2 rounded-lg w-full border-none outline-0 focus:ring-2 focus:ring-blue-500 cursor-pointer" placeholder="Insira seu telefone" />
                </div>
            </div>

            <div class="flex flex-col gap-2 w-full cursor-pointer">
                <label for="dataNascimento">Data de nascimento</label>
                <input name="dataNascimento" id="dataNascimento" type="date" required max="2005-01-01" class="bg-neutral-100 p-2 rounded-lg w-full border-none outline-0 focus:ring-2 focus:ring-blue-500 cursor-pointer" />
            </div>

            <div class="flex flex-col gap-2 w-full my-4">
                <button name="cadastrar" type="submit" class="bg-blue-500 text-white p-2 rounded-lg hover-bg-blue-700 transition-colors duration-300">Cadastre-se</button>
            </div>
        </form>
        <div class="flex flex-col gap-2">
            <a class="hover-underline decoration-blue-500 underline-offset-4" href="login.php">Já tem conta? <strong class="text-blue-500">Voltar ao login</strong></a>
        </div>
    </main>
</body>

</html>
