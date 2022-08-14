<?php

$erroNome = "";
$erroEmail = "";
$erroSenha = "";
$erroConfirmaSenha = "";
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        // validações nome,email e senha.
        if(empty($_POST['nome'])){
            $erroNome = "Por favor, preencha um nome";
        }else{
            $nome = limpaPost($_POST['nome']);
            if(!preg_match("/^[a-zA-Z-']*$/",$nome)){
                $erroNome = "Apenas aceitamos letras e espaços em branco.";
            }
        }
        if(empty($_POST['email'])){
            $erroEmail = "Por favor, preencha um email";
        }else{
            $email = limpaPost($_POST['email']);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $erroEmail = "Por favor, preencha um email válido";
            }
        }
        if(empty($_POST['senha'])){
            $erroSenha = "Por favor, preencha uma senha";
        }else{
            $senha = limpaPost($_POST['senha']);
            if(strlen($senha) < 6){
                $erroSenha = "A senha deve ter no mínimo 6 caracteres";
            }
        }
        if(empty($_POST['repte_senha'])){
            $erroConfirmaSenha = "Por favor, preencha uma confirmação de senha";
        }else{
            $erroConfirmaSenha = limpaPost($_POST['erroConfirmaSenha']);
            if($senha != $erroConfirmaSenha){
                $erroConfirmaSenha = "As senhas não conferem";
            }
        }
    }
// função de segurança.
        function limpaPost($valor){
            $valor = trim($valor);
            $valor = stripslashes($valor);
            $valor = htmlspecialchars($valor);
            return $valor;
        }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validação de Formulário</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <main>
    <h1><span>AULA PHP</span><br>Validação de Formulário</h1>

     <form method="post">

        <!-- NOME COMPLETO -->
        <label> Nome Completo </label>
        <input type="text" <?php if(!empty($erroNome)){echo "class='invalido'";}?> <?php if(isset($_POST['nome'])){echo "class='value=".$_POST['nome']."'";}?> name="nome" placeholder="Digite seu nome">
        <br><span class="erro"><?php echo $erroNome; ?></span>

        <!-- EMAIL -->
        <label> E-mail </label>
        <input type="email" <?php if(!empty($erroEmail)){echo "class='invalido'";}?> <?php if(isset($_POST['email'])){echo "class='value=".$_POST['email']."'";}?> name="email" placeholder="email@provedor.com">
        <br><span class="erro"><?php echo $erroEmail ?></span>

        <!-- SENHA -->
        <label> Senha </label>
        <input type="password" <?php if(!empty($erroSenha)){echo "class='invalido'";}?> <?php if(isset($_POST['senha'])){echo "class='value=".$_POST['senha']."'";}?> name="senha" placeholder="Digite uma senha">
        <br><span class="erro"><?php echo $erroSenha ?></span>

        <!-- REPETE SENHA -->
        <label> Repete Senha </label>
        <input type="password" <?php if(!empty($erroConfirmaSenha)){echo "class='invalido'";}?> <?php if(isset($_POST['erroConfirmaSenha'])){echo "class='value=".$_POST['erroConfirmaSenha']."'";}?> name="repete_senha" placeholder="Repita a senha">
        <br><span class="erro"><?php echo $erroConfirmaSenha ?></span>

        <button type="submit"> Enviar Formulário </button>

      </form>
    </main>
</body>
</html>
