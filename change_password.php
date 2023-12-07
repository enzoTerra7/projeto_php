<?php
include_once 'conexao.php';

$loginError = '';
$alteracaoSucesso = ''; 

if (isset($_POST['alterar'])) { 
    $email = $_POST['email'];
    $senha = $_POST['password'];
    $confirmPassword = $_POST['confirm_password']; 

    if ($senha !== $confirmPassword) {
        $loginError = 'As senhas não coincidem.';
    } else {
        $query = "SELECT * FROM login_usuarios WHERE login = '$email'";
        $result = mysqli_query($conexao, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $senha_hash = password_hash($senha, PASSWORD_BCRYPT); 

            $updateQuery = "UPDATE login_usuarios SET senha = '$senha_hash' WHERE login = '$email'";
            if (mysqli_query($conexao, $updateQuery)) {
                $alteracaoSucesso = 'Senha alterada com sucesso.';
            } else {
                $loginError = 'Erro ao atualizar a senha no banco de dados.';
            }
        } else {
            $loginError = 'E-mail não encontrado no banco de dados.';
        }
    }

    mysqli_close($conexao);
}
?>

<!DOCTYPE html>
<html lang="pt-br" class="w-screen h-screen overflow-none">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Alterar Senha</title>
</head>

<body class="w-screen h-screen bg-slate-200 p-4 flex items-center justify-center">
    <main class="bg-neutral-200 p-4 md:p-8 gap-4 rounded-lg shadow-lg flex flex-col items-center container xl:max-w-[40vw]">
        <h1 class="text-2xl uppercase font-black font-sans">Alterar Senha</h1>
        <form action="change_password.php" method="POST" class="flex flex-col gap-4 w-full items-center">
            <div class="flex flex-col gap-2 w-full cursor-pointer">
                <label for="email">Email</label>
                <input name="email" id="email" type="email" required class="bg-neutral-100 p-2 rounded-lg w-full border-none outline-0 focus:ring-2 focus:ring-blue-500 cursor-pointer" placeholder="Insira seu email" />
            </div>
            <div class="flex flex-col gap-2 w-full cursor-pointer">
                <label for="password">Senha</label>
                <input name="password" id="password" type="password" required class="bg-neutral-100 p-2 rounded-lg w-full border-none outline-0 focus:ring-2 focus:ring-blue-500 cursor-pointer" placeholder="Insira sua senha" />
            </div>
            <div class="flex flex-col gap-2 w-full cursor-pointer">
                <label for="confirm_password">Confirmar senha</label>
                <input name="confirm_password" id="confirm_password" type="password" required class="bg-neutral-100 p-2 rounded-lg w-full border-none outline-0 focus:ring-2 focus:ring-blue-500 cursor-pointer" placeholder="Confirme sua senha" />
            </div>
            <div class="flex flex-col gap-2 w-full my-4">
                <button type="submit" name="alterar" class="bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-700 transition-colors duration-300">Alterar</button>
            </div>
            <?php
            if (!empty($loginError)) {
                echo '<div class="text-red-500">' . $loginError . '</div>';
            }
            if (!empty($alteracaoSucesso)) {
                echo '<div class="text-green-500">' . $alteracaoSucesso . '</div>';
                echo '<p>Redirecionando para a página de login...</p>';
                echo '<meta http-equiv="refresh" content="1;url=login.php">';
            }
            ?>
        </form>
        <div class="flex flex-col gap-2">
            <a class="hover:underline decoration-blue-500 underline-offset-4" href="./login.php"><strong class="text-blue-500">Voltar</strong></a>
        </div>
    </main>
</body>

</html>
