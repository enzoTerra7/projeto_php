<?php
include_once 'conexao.php';

$loginError = '';

if (isset($_POST['login'])) {
    $login = $_POST['email']; // Use 'email' em vez de 'login'
    $senha = $_POST['password']; // Use 'password' em vez de 'senha'

    $query = "SELECT * FROM login_usuarios WHERE login = '$login'"; // Use 'login' em vez de 'email'
    $result = mysqli_query($conexao, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $senha_hash = $row['senha']; // Use 'senha' em vez de 'senha_hash'

        if (password_verify($senha, $senha_hash)) {
            // Senha válida, redirecione para a página "dashboard.html"
            setcookie("user_id", $row['id']);
            // echo $row['id'];
            header('Location: dashboard.php');
            exit();
        } else {
            $loginError = 'Credenciais inválidas. Verifique seu email e senha.';
        }
    } else {
        $loginError = 'Credenciais inválidas. Verifique seu email e senha.';
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
    <title>Login</title>
</head>

<body class="w-screen h-screen bg-slate-200 p-4 flex items-center justify-center">
    <main class="bg-neutral-200 p-4 md:p-8 gap-4 rounded-lg shadow-lg flex flex-col items-center container xl:max-w-[40vw]">
        <h1 class="text-2xl uppercase font-black font-sans">Login</h1>
        <form action="login.php" method="POST" class="flex flex-col gap-4 w-full items-center">
            <div class="flex flex-col gap-2 w-full cursor-pointer">
                <label for="email">Email</label>
                <input name="email" id="email" type="email" required class="bg-neutral-100 p-2 rounded-lg w-full border-none outline-0 focus:ring-2 focus:ring-blue-500 cursor-pointer" placeholder="Insira seu email" />
            </div>
            <div class="flex flex-col gap-2 w-full cursor-pointer">
                <label for="password">Senha</label>
                <input name="password" id="password" type="password" required class="bg-neutral-100 p-2 rounded-lg w-full border-none outline-0 focus:ring-2 focus:ring-blue-500 cursor-pointer" placeholder="Insira sua senha" />
            </div>
            <div class="flex flex-col gap-2 w-full -mt-1">
                <a class="hover:underline decoration-blue-500 w-full text-xs underline-offset-4" href="./change_password.php">Esqueceu sua senha? <strong class="text-blue-500">Redefina!</strong></a>
            </div>
            <div class="flex flex-col gap-2 w-full my-4">
                <button type="submit" name="login" class="bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-700 transition-colors duration-300">Entrar</button>
            </div>
            <?php
            if (!empty($loginError)) {
                echo '<div class="text-red-500">' . $loginError . '</div>';
            }
            ?>
        </form>
        <div class="flex flex-col gap-2">
            <a class="hover:underline decoration-blue-500 underline-offset-4" href="register.php">Não tem uma conta? <strong class="text-blue-500">Cadastre-se</strong></a>
        </div>
    </main>
</body>

</html>