<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fila de Atendimento</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container-fila">
        <div class="cabecalho">
            <h2>Fila de Atendimento 📋</h2>
            <hr>
        </div>

        <?php
        // Conecta com o banco 
        $servername = "localhost";
        $username = "root";
        $password = "gus@2009";
        $dbname = "sistema_hospital";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica a conexão
        if ($conn->connect_error) {
            die("<p class='erro'>Falha na conexão: " . $conn->connect_error . "</p>");
        }

        // Consulta para buscar todos os pacientes ordenados pelo tempo de espera
        $sql = "SELECT id, nome, ano_nascimento, idade, motivo, prioridade, tempo_espera FROM pacientes ORDER BY tempo_espera ASC";
        $result = $conn->query($sql);

        // Verifica se existem registros e os exibe em formato de tabela
        if ($result->num_rows > 0) {
            echo "<div class='tabela-wrapper'>";
            echo "<table class='tabela-pacientes'>";
            echo "<thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Ano de Nascimento</th>
                        <th>Idade</th>
                        <th>Motivo</th>
                        <th>Prioridade</th>
                        <th>Tempo de Espera</th>
                    </tr>
                  </thead>";
            echo "<tbody>";

            while ($row = $result->fetch_assoc()) {
                // Adiciona uma classe CSS com base na prioridade para colorir a linha/badge
                $classePrioridade = strtolower(str_replace([' ', 'ê'], ['-', 'e'], $row['prioridade']));

                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td><strong>" . $row['nome'] . "</strong></td>";
                echo "<td>" . $row['ano_nascimento'] . "</td>";
                echo "<td>" . $row['idade'] . " anos</td>";
                echo "<td>" . $row['motivo'] . "</td>";
                echo "<td><span class='badge " . $classePrioridade . "'>" . $row['prioridade'] . "</span></td>";
                echo "<td>" . $row['tempo_espera'] . " min</td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
            echo "</div>";
        } else {
            echo "<p class='sem-registros'>Nenhum paciente na fila de atendimento.</p>";
        }

        // Fecha a conexão
        $conn->close();
        ?>

        <form action="index.php" class="form-voltar">
            <button type="submit" class="btn-voltar">⬅ Voltar ao Cadastro</button>
        </form>
    </div>

</body>

</html>