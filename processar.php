<?php
//incluo o arquivo 'config.php' para usar o PDO
require "config.php";
//receber qual o tipo de operação será realizada quando forem recebidos dados
$op = $_POST['operacao'];

if ($op == 1) { //realiza a atualização da tabela
//crio o comando SQL e monto a tabela
$sql = "SELECT * FROM tblaluno";
    $dados = $pdo->query($sql);
    $linhas = "";   
    if ($dados->rowcount() > 0) {          
        foreach ($dados->fetchAll() as $aluno) {
            $linhas .= "<tr data-id=".$aluno['mat']." >";
            $linhas .= "<td data-nome='". $aluno['nome'] ."'>" . $aluno['nome'] . "</td>";
            $linhas .= "<td data-dtnasc=". $aluno['datanascimento'] .">" . $aluno['datanascimento'] . "</td>";
            $linhas .= "<td data-cpf=". $aluno['cpf'] .">" . $aluno['cpf'] . "</td>";
            $linhas .= "<td data-tel=". $aluno['telefone'] .">" . $aluno['telefone'] . "</td>";
            $linhas .= "<td data-end='". $aluno['endereco'] ."'>" . $aluno['endereco'] . "</td>";
            if ($aluno['sexo'] == 1) {
                $linhas .= "<td data-sexo=1>Homem</td>";
             } else {
                $linhas .= "<td data-sexo=2>Mulher</td>";
            }
            $linhas .= "<td>";
            $linhas .= "<Button type='button' id='btnAlterar' onclick=''>Editar Aluno</Button>";
            $linhas .= "</td>";
            $linhas .= "<td>";
            $linhas .= "<Button type='button' id='btnApagar' onclick='apagar()'>Apagar Aluno</Button>";
            $linhas .= "</td>";
            $linhas .= "</tr>";
        }
        echo $linhas;
    }else{
        $linhas .= "<tr>";
        $linhas .= "<td>Não há alunos cadastrados...</td>";
        $linhas .= "</tr>";
        echo $linhas;
    }
}elseif ($op == 2) {// Realiza a INCLUSÃO de novos registros
    if (isset($_POST['nome']) && empty($_POST['nome']) == false ) {
        $nome = addslashes($_POST['nome']);
        $datanascimento = $_POST['datanascimento'];
        if(is_numeric($_POST['cpf'])){
            $cpf = $_POST['cpf'];
        }else{
            echo "ERRO, CPF INVÁLIDO";
        }
        if (is_numeric($_POST['telefone'])) {
            $telefone = $_POST['telefone'];
        } else {
            echo "ERRO, TELEFONE INVÁLIDO";
        }
        $endereco = $_POST['endereco'];
        $sexo = $_POST['sexo'];
    
        $sql = "INSERT INTO tblaluno 
        (mat, nome, datanascimento, cpf, endereco, telefone, sexo) VALUES
        (null, '$nome', '$datanascimento', '$cpf', '$endereco', 
        '$telefone', $sexo)";
        
        $sql = $pdo->query($sql);
        //returna 1 para o código JavaScript
        echo 1;
    }   
}elseif ($op = 3) {//realiza o UPDATE de um registro
    if(isset($_POST['nome']) && !empty($_POST['nome'])){
        $id = $_POST['mat'];
        $nome = addslashes($_POST['nome']);
        $datanascimento = $_POST['datanascimento'];
        if(is_numeric($_POST['cpf'])){
            $cpf = $_POST['cpf'];
        }else{
            echo "ERRO, CPF INVÁLIDO";
        }
        if (is_numeric($_POST['telefone'])) {
            $telefone = $_POST['telefone'];
        } else {
            echo "ERRO, TELEFONE INVÁLIDO";
        }
        $endereco = $_POST['endereco'];
        $sexo = $_POST['sexo'];
    
        $sql = "UPDATE tblaluno SET 
        nome='$nome', 
        datanascimento='$datanascimento',
        cpf='$cpf',
        telefone = '$telefone',
        endereco = '$endereco',
        sexo = '$sexo'
        WHERE mat='$id'";
        $sql = $pdo->query($sql);
    }
}


?>