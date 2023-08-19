<?php

//Começa apenas quando clico no botão de inscrever

if(isset($_POST['btn-inscrever'])):

    //Array de erros
    $erros = array();

    //Criando variáveis mais simples para trabalhar melhor
    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];
    $data_nascimento = $_POST['data_nascimento'];

    //Verificando se o usuário preencheu os campos

    if(empty($cpf) or empty($nome) or empty($data_nascimento)):
        $erros[] = "<li> Os campos precisam estar todos preenchidos </li>";
    else:

        //Criando estrutura e escrevendo dados em array
        $usuario = array("cpf" => "$cpf", "nome" => "$nome", "data_nascimento" => "$data_nascimento");
        $usuarios = array();
        array_push($usuarios, $usuario);

        //Escrever os dados em arquivo
        //$arquivoAberto = fopen('arquivo.txt','w'); //Caso queira sobreescrever os dados existentes
        $arquivoAberto = fopen('arquivo.txt','a'); //Caso não queria sobreescrever os dados existentes

        //Adiciona efetivamente no arquivo
        foreach($usuarios as $usuario):
            $contador++;
            $organizacao = "\nUsuário \r\n\n";
            fwrite($arquivoAberto,$organizacao);
            
            foreach($usuario as $chave => $valor):
                
                $dado = $chave.": ".$valor."\r\n";
                fwrite($arquivoAberto,$dado);
            
            endforeach;
        endforeach;
        header("Location: get.php");
    endif;

endif;

?>

<html>
<head>

    <meta charset="utf-8">
    <title>Inscrição de dados</title>

</head>

<body>

<h1> Inscrição de dados </h1>

<?php

if(!empty($erros)):
    foreach($erros as $erro):
        echo $erro;
    endforeach;
endif;

?>
    
<form method="POST" id="inscricao" name="inscricao", action="<?php echo $_SERVER['PHP_SELF']; ?>">
cpf: <input type="text" name="cpf"><br>
nome: <input type="text" name="nome"><br>
data_nascimento: <input type="date" name="data_nascimento"><br>
<button type="submit" name="btn-inscrever"> Inscrever </button>
</form>

</body>

</html>