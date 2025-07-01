<?php include "header.php" ?>
<?php include "validarSessao.php" ?> <!-- Assegura que esta página poderá ser acessada apenas por um usuário administrador -->

<div class="container text-center mb-3 mt-3">
    
    <?php
        if(isset($_GET['idTarefa'])){
            $idProduto = $_GET['idTarefa'];

            session_start();
            $idUsuario = $_SESSION['idTarefa'];

            include("conexaoBD.php");
            $buscarProduto = "SELECT * FROM Tarefas WHERE idTarefa = $idTarefa";
            $res = mysqli_query($conn, $buscarProduto); //Executa a query
            $totalTarefa = mysqli_num_rows($res);

            if($totalProdutos > 0){
                if($registro = mysqli_fetch_assoc($res)){
                    $idTarefa        = $registro['idTarefa'];
                    $tituloTarefa      = $registro['tituloTarefa'];
                    $descricaoTarefa = $registro['tituloTarefa'];
                    $dataCriacao     = $registro['dataCriacao'];
                    $dataLimite     = $registro['dataLimite'];
                    $statusTarefa     = $registro['statusTarefa'];
                }
            }
            else{
                echo "<div class='alert alert-danger text-center'>Não foi possível carregar o Produto</div>";
            }
            
        }
        else{
            echo "<div class='alert alert-danger text-center'>Não foi possível carregar o Produto</div>";
        }
    ?>

    <h2>Editar tarefa:</h2>
    <div class="d-flex justify-content-center mb-3">
        <div class="row">
            <div class="col-12">
                <form action="editarProduto.php" method="POST" class="was-validated" enctype="multipart/form-data">
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control" id="idTarefa" name="idTarefa" value="<?php echo $idTarefa ?>" required readonly>
                        <label for="idTarefa">*ID</label>
                    </div>

                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control" id="tituloTarefa" placeholder="Titulo" name="tituloTarefa" value="<?php echo $tituloTarefa ?>"required>
                        <label for="tituloTarefa">Titulo da tarefa</label>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <textarea class="form-control" id="descricaoTarefa" placeholder="Informe uma breve descrição da tarefa" name="descricaoTarefa"required><?php echo $descricaoTarefa ?></textarea>
                        <label for="descricaoTarefa">Descrição da tarefa</label>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-floating mt-3 mb-3">
                        <input type="text" class="form-control" id="dataCriacao" placeholder="Data" name="dataCriacao" value="<?php echo $dataCriacao ?>"required>
                        <label for="dataCriacao">data da tarefa:</label>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="form-floating mt-3 mb-3">
                        <input type="text" class="form-control" id="dataLimite" placeholder="Data" name="dataLimite" value="<?php echo $dataLimite ?>"required>
                        <label for="dataLimite">data limite da tarefa:</label>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="form-floating mt-3 mb-3">
                        <input type="text" class="form-control" id="statusTarefa" placeholder="Status" name="statusTarefa" value="<?php echo $statusTarefa ?>"required>
                        <label for="statusTarefa">status da tarefa:</label>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>

                    <button type="submit" class="btn btn-success">Salvar Alterações</button>
                </form>
            </div>
        </div>
    </div>
    <br>

</div>

<?php include "footer.php" ?>