<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Paciente</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="cabecalho">
        <h1>Cadastro de Paciente 📄</h1>
        <hr>
    </div>

    <form action="" method="post" class="formulario">
        <div class="campoNome">
            <label for="nome">Nome do Paciente: </label><br>
            <input type="text" name="nome" id="nome" required><br><br>
        </div>

        <div class="campoAno">
            <label for="ano">Ano de Nascimento: </label><br>
            <input type="text" name="ano" id="ano" required><br><br>
        </div>



        <div class="motivo">
            <label for="motivo">O que te trouxe aqui:</label>
            <select name="motivo" id="motivo" required>
                <option value="">Selecione o motivo da sua vinda</option>
                <option value="Recolhimeto de Laudo Medico">Recolhimeto de Laudo Medico</option>
                <option value="Vacinação">Vacinação</option>
                <option value="Exame de Rotina">Exame de Rotina</option>
                <option value="Consulta de Agendada">Consulta de Agendada</option>
                <option value="Pronto Socorro">Pronto socorro</option>
            </select><br><br>
        </div>

        <div class="botoes">
            <button type="submit">Cadastrar</button>
            <button type="reset">Limpar</button><br><br>
        </div>

    </form>



    <form action="fila.php" class="visualizarFila">
        <button>Visualizar fila</button>
    </form>
</body>

</html>
<?php



if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST['nome'];
    $ano = $_POST['ano'];
    $motivo = $_POST['motivo'];


    if (!is_numeric($ano) && $ano < 0) {
        echo "Insira um ano válido!";
    } elseif (is_numeric($ano) && $ano > 0) {
        $idade = 2026 - $ano;
        $prioridade = '';
        $tempDeEspera = '';

        //conecta com o banco 
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "sistema_hospital";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica a conexão
        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }

        // 
        if ($motivo == "Recolhimeto de Laudo Medico" || $motivo == "Vacinação") {
            $prioridade = 'Não Urgente';


        } elseif ($motivo == "Exame de Rotina" || $motivo == "Consulta de Agendada") {
            $prioridade = 'Pouco Urgente';

        } elseif ($motivo == "Pronto Socorro") {
            $prioridade = 'Urgente';

        }
        if ($prioridade == "Não Urgente") {
            $tempDeEspera = "60";
        } elseif ($prioridade == "Pouco Urgente") {
            $tempDeEspera = "45";
        } elseif ($prioridade == "Urgente") {
            $tempDeEspera = "10";
        }


        // Insere os dados na tabela 'pacientes'
        $sql = "INSERT INTO pacientes (nome, ano_nascimento, idade, motivo, prioridade, tempo_espera) 
                VALUES ('$nome', '$ano', '$idade', '$motivo', '$prioridade', '$tempDeEspera')";

        if ($conn->query($sql) === TRUE) {
            echo "<p style='color: green;'>Paciente cadastrado com sucesso!</p>";
        } else {
            echo "<p style='color: red;'>Erro ao cadastrar: " . $conn->error . "</p>";
        }

        // Fecha a conexão
        $conn->close();
    }



}
?>