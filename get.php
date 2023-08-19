<?php

//Verificando se o botão consultar foi clicado
if(isset($_GET['btn-buscar'])):

    //Verificar se o campo foi preenchido
    $cpf = $_GET['cpf'];
    $erros = array();
    if(empty($cpf)):
        $erros[] = "<li>O campo precisa ser preenchido</li>";
    
    else:
        $arquivo = "arquivo.txt";
        $arquivoAberto = fopen($arquivo,'r');
        //Colocar o arquivo em um array, cada elemento é uma linha e as quebras de linha 
        $array_arquivo = file($arquivo, FILE_IGNORE_NEW_LINES);
        //Variável de verificação
        $existe = 0;
        //Pegar linhas das informações desejadas
        $primeiraLinha = 0;
        //Verificar se o CPF existe
        foreach($array_arquivo as $numLinha => $linha):
            $comparar = "cpf: ".$cpf;
            if($linha == $comparar):
                $primeiraLinha = $numLinha + 1;
                $existe = 1;
                break;
            endif;
        endforeach;

        //Aplicar funções de acordo com o resultado de $existe
        if($existe == 0):
            $erros[] = "<li>O usuário que você está procurando não existe</li>";
        else:
            //Mostra em qual linha está
            $linhaAtual = 1;
            //Mostra as informações procuradas
            while(($linha = fgets($arquivoAberto)) !== false):
                            if($linhaAtual >= $primeiraLinha and $linhaAtual <= ($primeiraLinha+2)):
                                echo $linha."<br>";
                            endif;
                            $linhaAtual++;
            endwhile;
        endif;
    endif;

endif;


?>


<html>
<head>

    <meta charset="utf-8">
    <title>Consultar dados</title>

</head>

<body>

<h1> Consultar dados </h1>
   
<?php
if(!empty($erros)):
    foreach($erros as $erro):
        echo $erro;
    endforeach;
endif;
?>


<form method="GET" id="inscricao" name="inscricao", action="<?php echo $_SERVER['PHP_SELF']; ?>">
cpf: <input type="text" name="cpf"><br>
<button type="submit" name="btn-buscar"> Buscar </button>
</form>

</body>

</html>