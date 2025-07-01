<?php include "header.php" ?>

<div class='container mt-3 mb-3'>

<?php

// Verifica o método de requisição do servidor
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Corrigida a declaração das variáveis
    $tituloTarefa = $descricaoTarefa = $dataCriacao = $dataLimite = $statusTarefa = "";
    $erroPreenchimento = false;

    // Validação do campo tituloTarefa
    if (empty($_POST["tituloTarefa"])) {
        echo "<div class='alert alert-warning text-center'>
                O campo <strong>NOME</strong> é obrigatório!
              </div>";
        $erroPreenchimento = true;
    } else {
        $tituloTarefa = testar_entrada($_POST["tituloTarefa"]);
    }

    // Validação do campo descricaoTarefa
    if (empty($_POST["descricaoTarefa"])) {
        echo "<div class='alert alert-warning text-center'>
                O campo <strong>DESCRIÇÃO</strong> é obrigatório!
              </div>";
        $erroPreenchimento = true;
    } else {
        $descricaoTarefa = testar_entrada($_POST["descricaoTarefa"]);
    }

    // Validação do campo dataCriacao
    if (empty($_POST["dataCriacao"])) {
        echo "<div class='alert alert-warning text-center'>
                O campo <strong>DATA DE CRIAÇÃO</strong> é obrigatório!
              </div>";
        $erroPreenchimento = true;
    } else {
        $dataCriacao = testar_entrada($_POST["dataCriacao"]);
    }

    // Validação do campo dataLimite
    if (empty($_POST["dataLimite"])) {
        echo "<div class='alert alert-warning text-center'>
                O campo <strong>DATA LIMITE</strong> é obrigatório!
              </div>";
        $erroPreenchimento = true;
    } else {
        $dataLimite = testar_entrada($_POST["dataLimite"]);
    }

    // Validação do campo statusTarefa
    if (empty($_POST["statusTarefa"])) {
        echo "<div class='alert alert-warning text-center'>
                O campo <strong>STATUS</strong> é obrigatório!
              </div>";
        $erroPreenchimento = true;
    } else {
        $statusTarefa = testar_entrada($_POST["statusTarefa"]);
    }

    // Se não houver erros, insere no banco
    if (!$erroPreenchimento) {

        // Corrigido: nome da variável e a string da query
        $inserirTarefa = "INSERT INTO Tarefas (tituloTarefa, descricaoTarefa, dataCriacao, dataLimite, statusTarefa)
                          VALUES ('$tituloTarefa', '$descricaoTarefa', '$dataCriacao', '$dataLimite', '$statusTarefa')";

        include "conexaoBD.php";

        if (mysqli_query($conn, $inserirTarefa)) {

            echo "<div class='alert alert-success text-center'>Produto(a) cadastrado(a) com sucesso!</div>";

            echo "<div class='container mt-3'>
                    <div class='table-responsive'>
                        <table class='table'>
                            <tr><th>TITULO DA TAREFA</th><td>$tituloTarefa</td></tr>
                            <tr><th>DESCRIÇÃO DA TAREFA</th><td>$descricaoTarefa</td></tr>
                            <tr><th>DATA DA CRIAÇÃO</th><td>$dataCriacao</td></tr>
                            <tr><th>DATA LIMITE</th><td>$dataLimite</td></tr>
                            <tr><th>STATUS DA TAREFA</th><td>$statusTarefa</td></tr>
                        </table>
                    </div>
                </div>";

            mysqli_close($conn);

        } else {
            echo "<div class='alert alert-danger text-center'>
                    Erro ao tentar inserir dados do <strong>Produto</strong> na base de dados!
                  </div>";
        }
    }
} else {
    // Corrigido: redirecionar para o formulário correto (formTarefa)
    header("location:formTarefa.php");
}

// Função de limpeza de entrada
function testar_entrada($dado) {
    $dado = trim($dado);
    $dado = stripslashes($dado);
    $dado = htmlspecialchars($dado);
    return $dado;
}
?>

</div>

<?php include "footer.php" ?>
