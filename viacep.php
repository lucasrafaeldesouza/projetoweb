<?php 
require_once 'dbconfig.php';

if (isset($_POST['salvar_endereco'])) {
    $cep = mysqli_escape_string($connect, $_POST['cep']);
    $cidade = mysqli_escape_string($connect, $_POST['cidade']);
    $bairro = mysqli_escape_string($connect, $_POST['bairro']);
    $rua = mysqli_escape_string($connect, $_POST['rua']);
    $estado = mysqli_escape_string($connect, $_POST['estado']);

    if (isCep($cep)) {
        $sql = "INSERT INTO endereco (cep, cidade, bairro, rua, estado) 
                VALUES ('$cep', '$cidade', '$bairro' ,'$rua', '$estado')";

        if (mysqli_query($connect, $sql)) {
            $_SESSION['mensagem'] = "Cadastrado com sucesso";
            header('Location: ../projetoweb');
        } else {
            $_SESSION['mensagem'] = "Erro ao cadastrar";      
            header('Location: .../index.php');
        }
    } else {
        $_SESSION['mensagem'] = "CEP não pode estar vazio";      
        header('Location: ../projetoweb');
    }
}

function buscaEndereco() {
    
    if(isset($_POST['cep'])) {
        $cep = $_POST['cep'];
    
        $cep = filterCep($cep);

        if(isCep($cep)) {
            $address = buscaEnderecoViaCep($cep);
            if(property_exists($address, 'erro')) {
                $address = enderecoEmpty();
                $address->cep = 'CEP Não encontrado';
            }
        } else {
            $address = enderecoEmpty();
            $address->cep = 'CEP Inválido';
        }
    } else {
        $address = enderecoEmpty();
    }
    return $address;
}

function enderecoEmpty() {
    return (object) [
        'cep' => '',
        'logradouro' => '',
        'bairro' => '',
        'localidade' => '',
        'uf' => ''
    ];
}

function filterCep(String $cep):String {
    return preg_replace('/[^0-9]/','', $cep);
}

function isCep(String $cep):bool {
    return preg_match('/^[0-9]{5}-?[0-9]{3}$/', $cep);
}

function buscaEnderecoViaCep(String $cep) {
    $url = "https://viacep.com.br/ws/{$cep}/json/";
    return json_decode(file_get_contents($url));
}



