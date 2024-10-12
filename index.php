<?php
session_start();
$error = '';

// Recebendo os dados via JSON
$data = json_decode(file_get_contents('php://input'), true);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $data['username'];
    $password = $data['password'];

    // Simples lista de usuários e senhas
    $valid_users = ['admin' => 'admin@123'];


    if (array_key_exists($username, $valid_users)) {
       
        if ($password == $valid_users[$username]) {
            $_SESSION['user'] = $username;
            header('Content-Type: application/json');
            echo json_encode(['status' => 'success', 'message' => 'Login bem-sucedido']);
            exit;
        } else {
        
            $error = 'Usuário ou senha incorreta.';
        }
    } else {
       
        $error = 'Usuário ou senha incorreta';
    }

    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => $error]);
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Login</title>
    <script>
        async function login() {
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            const response = await fetch('index.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ username, password })
            });

            const result = await response.json();
            alert(result.message);
            if (result.status === 'success') {
                window.location.href = 'dashboard.php';
            }
        }
    </script>
</head>
<body>
    <h2>Login</h2>
    <form onsubmit="event.preventDefault(); login();">
        <label for="username">Usuário:</label><br>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Senha:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>
