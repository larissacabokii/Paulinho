<?php include "header.php"; ?>
<div class="container text-center mt-5 mb-5">

<?php
if (isset($_GET['idTarefa'])) {
    $idTarefa = intval($_GET['idTarefa']); // segurança
    $idUsuario = $_SESSION['idUsuario'];

    include("conexaoBD.php");

    $exibirTarefa = "SELECT * FROM tarefas WHERE idTarefa = $idTarefa AND idUsuario = $idUsuario ";
    echo $exibirTarefa;
    
    $res = mysqli_query($conn, $exibirTarefa);
    $totalTarefa = mysqli_num_rows($res);

    if ($totalTarefa > 0) {
        echo "<div class='row text-center'>";

        if ($registro = mysqli_fetch_assoc($res)) {
            $tituloTarefa   = $registro["tituloTarefa"];
            $descricaoTarefa = $registro["descricaoTarefa"];
            $dataCriacao    = $registro["dataCriacao"];
            $dataLimite     = $registro["dataLimite"];
            $statusTarefa   = $registro["statusTarefa"];
            $dataConclusao  = $registro["dataConclusao"];

            ?>

            <div class="d-flex justify-content-center mb-3">
                <div class="card" style="width: 30%; border-style: none;">
                    <div class="card-body">
                        <h4 class="card-title"><b><?php echo $tituloTarefa ?></b></h4>
                        <p class="card-text"><?php echo $descricaoTarefa ?></p>
                        <p class="card-text">Criada em: <?php echo $dataCriacao ?></p>
                        <p class="card-text">Data limite: <?php echo $dataLimite ?></p>
                        <p class="card-text">Status: <?php echo $statusTarefa ?></p>
                        <?php if (!empty($dataConclusao)) { ?>
                            <p class="card-text">Concluida em: <?php echo $dataConclusao ?></p>
                        <?php } ?>

                        <div class="card bg-light">
                            <div class="card-body">
                                <?php
                                // Verifica se o usuário está logado
                                if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
                                    // Qualquer tipo de usuário pode editar
                                    echo "
                                        <form action='formEditarTarefa.php?idTarefa=$idTarefa' method='POST'>
                                            <input type='hidden' name='idTarefa' value='$idTarefa'>
                                            <button type='submit' class='btn btn-outline-primary'>
                                                <i class='bi bi-pencil-square'></i> Editar Tarefa
                                            </button>
                                        </form>
                                    ";
                                } else {
                                    echo "
                                        <div class='alert alert-info'>
                                            <a href='formLogin.php' class='alert-link'>
                                                Faça login para editar esta tarefa. <i class='bi bi-person'></i>
                                            </a>
                                        </div>
                                    ";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }

        echo "</div>";
    } else {
        echo "<div class='alert alert-danger text-center'>Tarefa não localizada!</div>";
    }
} else {
    echo "<div class='alert alert-danger text-center'>Não foi possível carregar a tarefa! <br>$exibirTarefa</div>";
}
?>

</div>
<?php include "footer.php"; ?>
