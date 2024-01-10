<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gerador de Senhas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <style>
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 50px;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="number"] {
            width: 50%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
            margin-bottom: 10px;
        }

        input[type="checkbox"] {
            margin-right: 5px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #3e8e41;
        }
    </style>
</head>

<body>
    <?php
    // Define a função para gerar senhas aleatórias
    function gerar_senha($tamanho, $letras_maiusculas = true, $letras_minusculas = true, $numeros = true, $caracteres_especiais = true)
    {
        // Define os caracteres possíveis que podem ser usados na senha
        $caracteres = '';
        if ($letras_maiusculas) {
            $caracteres .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
        if ($letras_minusculas) {
            $caracteres .= 'abcdefghijklmnopqrstuvwxyz';
        }
        if ($numeros) {
            $caracteres .= '0123456789';
        }
        if ($caracteres_especiais) {
            $caracteres .= '!@#$%^&*()_-=+;:,.?';
        }

        // Gera a senha aleatória com base nos caracteres possíveis
        $senha = '';
        for ($i = 0; $i < $tamanho; $i++) {
            // Usei o random_int() para gerar números aleatórios mais seguros
            $senha .= $caracteres[random_int(0, strlen($caracteres) - 1)];
        }

        return $senha;
    }

    // Processa o formulário quando é enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Obtém os dados do formulário e valida o tamanho da senha
        $tamanho = filter_input(INPUT_POST, 'tamanho', FILTER_VALIDATE_INT, array('options' => array('min_range' => 1, 'max_range' => 50)));
        if (!$tamanho) {
            $mensagem_erro = 'Tamanho da senha inválido';
        } else {
            $letras_maiusculas = isset($_POST["letras_maiusculas"]);
            $letras_minusculas = isset($_POST["letras_minusculas"]);
            $numeros = isset($_POST["numeros"]);
            $caracteres_especiais = isset($_POST["caracteres_especiais"]);

            // Gera a senha com as opções selecionadas
            $senha = gerar_senha($tamanho, $letras_maiusculas, $letras_minusculas, $numeros, $caracteres_especiais);

            // Mostra a senha ao usuário
            echo '<div class="alert alert-success" role="alert">Sua senha é: ' . htmlspecialchars($senha) . '</div>';
        }
    }
    ?>

    <!-- O formulário permite ao usuário definir as especificações para gerar uma senha segura -->
    <div class="container">
        <form method="post">
            <label class="form-label">Tamanho da senha:</label>
            <input type="number" class="form-control" name="tamanho" value="10" min="1" max="50">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="letras_maiusculas" checked>
                <label class="form-check-label">Incluir letras maiúsculas</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="letras_minusculas" checked>
                <label class="form-check-label">Incluir letras minúsculas</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="numeros" checked>
                <label class="form-check-label">Incluir números</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="caracteres_especiais" checked>
                <label class="form-check-label">Incluir caracteres especiais</label>
            </div>
            <input type="submit" class="btn btn-primary" value="Gerar Senha">
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
