<?php 
    include_once ('viacep.php');
    include_once ('dbconfig.php');
    $address = buscaEndereco();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto Web</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5"> 
        <div class="bordered-content">
            <form action="." method="post">
                <div class="col-md-12">
                    <p>Digite o CEP para encontrar o endereço</p>
                    <div class="row">
                        <div class="col-md-10">
                            <input class="form-control spaced-input" type="text" placeholder="Digite um cep..." name="cep" value="<?php echo $address->cep ?>">
                        </div>
                        <div class="col-md-2" style="display: flex; justify-content: end;">
                            <button class="btn btn-primary spaced-input" type="submit">Buscar</button>
                        </div>
                    </div>
                    <hr>
                    <h4>Endereço</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Cidade</label>
                            <input class="form-control spaced-input" type="text" placeholder="cidade" name="cidade" value="<?php echo $address->localidade ?>"> 
                        </div>
                        <div class="col-md-6">
                            <label for="">Bairro</label>
                            <input class="form-control spaced-input" type="text" placeholder="bairro" name="bairro" value="<?php echo $address->bairro ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <label for="">Rua</label>
                            <input class="form-control spaced-input" type="text" placeholder="rua" name="rua" value="<?php echo $address->logradouro ?>" >
                        </div>
                        <div class="col-md-2">
                            <label for="">UF</label>
                            <input class="form-control spaced-input" type="text" placeholder="estado" name="estado" value="<?php echo $address->uf ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success" name="salvar_endereco">Salvar endereço</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
<div class="container mt-5">  
    <table class="table">
        <thead>
            <tr>
                <th scope="col">CEP</th>
                <th scope="col">Cidade</th>
                <th scope="col">Bairro</th>
                <th scope="col">Rua</th>
                <th scope="col">UF</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM endereco";
            $resultado = mysqli_query($connect, $sql);
            $dados_endereco = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
            foreach ($dados_endereco as $dados) {
            ?>
                <tr>
                    <td><?php echo $dados['cep']; ?></td>
                    <td><?php echo $dados['cidade']; ?></td>
                    <td><?php echo $dados['bairro']; ?></td>
                    <td><?php echo $dados['rua']; ?></td>
                    <td><?php echo $dados['estado']; ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html> 