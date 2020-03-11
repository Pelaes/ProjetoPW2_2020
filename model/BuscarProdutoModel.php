<?php

function buscarProdutoIndex ($busca) 
{
    include "conexao.php";

    $sql = $conn->prepare("SELECT * FROM Produto WHERE nome LIKE ?");
    $busca = "%".$busca."%";
    $sql->bind_param("s", $busca);
    $sql->execute();
    $resultado = $sql->get_result();
    $retornoProdutos = "";
    
        if($resultado->num_rows > 0){
            while ($linha = $resultado->fetch_assoc()) {
                $retornoProdutos .= 
                    '<div class="col-lg-4 col-sm-6">
                        <div class="card h-100 border-0">
                            <img class="mx-auto img-fluid w-100 h-100 rounded-circle" src="../../imagens/'.$linha['foto'].'">
                            <div class="card-body">
                                <a id="produtoTeste" class="card-link" href="javascript:void(0);" target="_self" rel="noopener"><h4 class="card-title text-center mb-3">'.$linha['nome'].'</h4></a>
                                <h6 class="card-title text-center mb-3">'.$linha['preco'].'</h6>
                            </div>
                        </div>
                    </div>    
                ';
            }
        }
        else{
            $retornoProdutos .= "ErroNaoExiste";
        }
    
    echo $retornoProdutos;
}

function buscarProdutoAlteracao ($busca) 
{
    include "conexao.php";

    $sql = $conn->prepare("SELECT * FROM Produto WHERE idProduto = ?");
    $sql->bind_param("s", $busca);
    $sql->execute();
    $resultado = $sql->get_result();
    while ($linha = $resultado->fetch_assoc()) {
        echo '
            <form action="../../controller/CadastroProduto.php" method="POST" id="cadProduto" enctype="multipart/form-data">
                <div id="imagem" class="imgCadastro mx-auto my-5">
                    <img class="card-img-top imgCadastro imgBorder" src="../../imagens/'.$linha['foto'].'">
                </div>
                <div class="form-row">
                    <div class="col-lg-9 my-3 mx-auto">
                        <input type="file" class="form-control-file card-title" accept="image/*" id="arquivo" name="arquivo">  
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-lg-9 my-3 mx-auto">
                        <input class="form-control form-control-lg" type="text" placeholder="Digite o nome do produto" name="nome" value="'.$linha['nome'].'">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-lg-9 my-3 mx-auto">
                        <textarea rows="5" class="form-control form-control-lg" placeholder="Digite a descrição do produto" name="descricao"></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-5 my-3 ml-auto">
                        <input class="form-control form-control-lg" type="text" placeholder="Digite o preço" name="preco">
                    </div>
                    <div class="form-group col-lg-4 my-3 mr-auto">
                        <input class="form-control form-control-lg" type="text" placeholder="Digite a quantidade em estoque" name="estoque">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-lg-9 my-3 mx-auto">
                        <div class="custom-control form-control-lg custom-checkbox">
                            <input type="checkbox" class="custom-control-input mt-2" id="customCheck1" name="ativo" checked>
                            <label class="ml-2 custom-control-label" for="customCheck1">Ativar produto?</label>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-lg-6 my-3 mx-auto">
                        <input class="form-control btn-lg btn btn-success" type="submit" value="Cadastrar" name="cadastro" id="Cadastrar">
                    </div>
                </div>
            </form>
        ';   
    }
}
?>
