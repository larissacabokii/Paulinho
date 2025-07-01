<?php include "header.php"; ?>

<div class="container mt-5 mb-5">

<?php
include("conexaoBD.php");

$listarTarefas = "SELECT * FROM Tarefas";

if (isset($_GET["filtroTarefa"])) {
    $filtroTarefa = $_GET["filtroTarefa"];

    if ($filtroTarefa != "todos") {
        $listarTarefas .= " WHERE statusTarefa LIKE '$filtroTarefa'";
    }

    switch ($filtroTarefa) {
        case "todos": $mensagemFiltro = "no total"; break;
        case "Pendente": $mensagemFiltro = "pendentes"; break;
        case "Em andamento": $mensagemFiltro = "em andamento"; break;
        case "Concluído": $mensagemFiltro = "concluido"; break;
    }

} else {
    $filtroTarefa = "todos";
    $mensagemFiltro = "no total";
}

$res = mysqli_query($conn, $listarTarefas);
$totalTarefas = mysqli_num_rows($res);

if ($totalTarefas > 0) {
    echo "<div class='alert alert-info text-center'>
            Há <strong>$totalTarefas</strong> tarefa(s) $mensagemFiltro!
          </div>";
} else {
    echo "<div class='alert alert-info text-center'>
            Não há tarefas cadastradas neste sistema!
          </div>";
}

// Filtro
echo "
    <form name='formFiltro' action='index.php' method='GET'>
        <div class='form-floating mt-3'>
            <select class='form-select' name='filtroTarefa' required>
                <option value='todos' ".($filtroTarefa == 'todos' ? 'selected' : '').">Visualizar todas as Tarefas</option>
                <option value='Pendente' ".($filtroTarefa == 'Pendente' ? 'selected' : '').">Apenas Pendentes</option>
                <option value='Em andamento' ".($filtroTarefa == 'Em andamento' ? 'selected' : '').">Apenas Em andamento</option>
                <option value='Concluído' ".($filtroTarefa == 'Concluído' ? 'selected' : '').">Apenas Concluídas</option>
            </select>
            <label for='filtroTarefa'>Selecione um Filtro</label>
            <br>
        </div>
        <button type='submit' class='btn btn-outline-success' style='float:right'>
            <i class='bi bi-funnel'></i> Filtrar Tarefas
        </button><br>
    </form>
";
?>

<hr>

<form action="atualizarStatus.php" method="POST">
    <div class="list-group">
        <?php
        while ($tarefa = mysqli_fetch_assoc($res)) {
            $idTarefa = $tarefa["idTarefa"];
            $tituloTarefa = $tarefa["tituloTarefa"];
            $descricaoTarefa = $tarefa["descricaoTarefa"];
            $dataCriacao = $tarefa["dataCriacao"];
            $dataLimite = $tarefa["dataLimite"];
            $statusTarefa = $tarefa["statusTarefa"];
            $dataConclusao = $tarefa["dataConclusao"];

            $checked = ($statusTarefa == "Concluido") ? "checked disabled" : "";

            echo "
                <label class='list-group-item d-flex justify-content-between align-items-center'>
                    <div class='form-check'>
                        <input class='form-check-input me-2' type='checkbox' name='tarefasConcluidas[]' value='$idTarefa' $checked>
                        <span>
                            <strong>$tituloTarefa</strong> - $descricaoTarefa<br>
                            <small>
                                Criação: $dataCriacao | Limite: $dataLimite".
                                ($dataConclusao ? " | Concluída em: $dataConclusao" : "").
                            "</small>
                        </span>
                    </div>
                    <span class='badge bg-".(
                        $statusTarefa == "Pendente" ? "warning" : (
                        $statusTarefa == "Em andamento" ? "primary" : "success")
                    )."'>$statusTarefa</span>
                </label>
            ";
        }
        ?>
    </div>

    <div class="mt-4 text-center">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-check2-circle"></i> Marcar selecionadas como concluídas
        </button>
    </div>
</form>

</div>

<?php include "footer.php"; ?>
