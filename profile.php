<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
</head>
<body>
    <h2>Perfil de <?php echo $_SESSION["user"]; ?></h2>
    <p>Esta página e do perfil do Administrador</p>
    <a href="dashboard.php">Voltar para o Dashboard<a> | <a href="logout.php">Logout<a> 
</body>
</html>