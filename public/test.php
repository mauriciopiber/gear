<?php
   $hostname = 'localhost';
   $database = 'livraria';
   $username = 'root';
   $password = '';
   $con = mysql_connect($hostname, $username, $password)
   or die(mysql_error().'Erro ao tentar conectarrrr-se ao banco');
   mysql_select_db($database, $con);
   ?>
<!DOCTYPE html>
<head>
   <meta charset="UTF-8">
   <title>Exemplo - 1 php</title>
   <style>
      body  {
      margin: 100px 40px 10px 70px;
      color:#e60000;
      background-color:#ff9999;
	  font-family:Verdana, Geneva, sans-serif;
	  font-size:18px;
      }

   </style>
</head>
<body>
<h1> Cadastro de livros:</h1>

                  <form name="cadastro de usuario" method="post" action="grupo.php">
            <table>
               <tbody><tr>
 <td>
      Id:</td><td><input name="ID" size="20" maxlenght="20"

type="text">
                 </td>
              </tr>
              <tr>
<td>Título:</td>
                <td><input name="TITULO" size="20" maxlenght="20"

type="text"></td>
              </tr>
              <tr>
<td>Gênero:</td>
                <td><input name="GENERO" size="20" maxlenght="20"

type="text"></td>
</tr>
              <tr>
<td>Ano:</td>
                <td><input name="ANO" size="20" maxlenght="20"

type="text"></td>
</tr>
              <tr>
<td>Valor:</td>
                <td><input name="VALOR" size="20" maxlenght="20"

type="text"></td>
</tr>
              <tr>
<td>Qntd Estoque:</td>
                <td><input name="QNTD_ESTOQUE" size="20" maxlenght="20"

type="text"></td>
              </tr>
              <tr>

           </tbody></table>
        </form>




		<!TABELA CLIENTES INSERINDO OK >

		<h1> Dados do Cliente:</h1>

                  <form name="cadastro de usuario" method="post" action="form_conecta.php">
            <table>
               <tbody><tr>
 <td>
      Id Cliente:</td><td><input name="ID_CLIENTE" size="20" maxlenght="20"

type="text">
                 </td>
              </tr>
              <tr>
<td>Nome:</td>
                <td><input name="NOME" size="20" maxlenght="20"

type="text"></td>
              </tr>
              <tr>
<td>Endereço:</td>
                <td><input name="ENDERECO" size="20" maxlenght="20"

type="text"></td>
</tr>
              <tr>
<td>Telefone:</td>
                <td><input name="TELEFONE" size="20" maxlenght="20"

type="text"></td>
</tr>
              <tr>
<td>E-m@il:</td>
                <td><input name="EMAIL" size="20" maxlenght="20"

type="text"></td>
</tr>
              <tr>
<td>Cpf:</td>
                <td><input name="CPF" size="20" maxlenght="20"

type="text"></td>
              </tr>
              <tr>

           </tbody></table>
        </form>







<h1> Dados do disco Bluray:</h1>

                  <form name="cadastro de usuario" method="post" action="form_conecta.php">
            <table>
               <tbody><tr>
 <td>
      Id Bluray:</td><td><input name="ID_BLURAYS" size="20" maxlenght="20"

type="text">
                 </td>
              </tr>
              <tr>
<td>Nome:</td>
                <td><input name="NOME1" size="20" maxlenght="20"

type="text"></td>
              </tr>
              <tr>
<td>Gênero:</td>
                <td><input name="GENERO1" size="20" maxlenght="20"

type="text"></td>
</tr>
              <tr>
<td>Ano:</td>
                <td><input name="ANO1" size="20" maxlenght="20"

type="text"></td>
</tr>
              <tr>
<td>Valor:</td>
                <td><input name="VALOR1" size="20" maxlenght="20"

type="text"></td>
</tr>
              <tr>
<td>Qntd Estoque:</td>
                <td><input name="QNTD_ESTOQUE1" size="20" maxlenght="20"

type="text"></td>
              </tr>
              <tr>



           </tbody></table>
        </form>






<!TABELA VENDAS INSERINDO OK >

<h1> Dados de vendas:</h1>

                  <form name="cadastro de usuario" method="post" action="form_conecta.php">
            <table>
               <tbody><tr>
 <td>
      Id Cupom:</td><td><input name="ID_CUPOM" size="20" maxlenght="20"

type="text">
                 </td>
              </tr>
              <tr>
<td>Valor Recebido:</td>
                <td><input name="VALOR_RECEBIDO" size="20" maxlenght="20"

type="text"></td>
              </tr>
              <tr>
<td>Forma de Pgto:</td>
                <td><input name="FORMA_PAGAMENTO" size="20" maxlenght="20"

type="text"></td>
</tr>
              <tr>
<td>Data da Venda:</td>
                <td><input name="DATA_VENDA" size="20" maxlenght="20"

type="text"></td>
</tr>
              <tr>

</tr>
              <tr>
<td>Cpf:</td>
                <td><input name="CPF" size="20" maxlenght="20"

type="text"></td>
              </tr>
              <tr>
<td colspan="2" align="center"><input name="Submit" value="Enviar"

type="submit"></td>
              </tr>
           </tbody></table>
        </form>


</body>
</html>
<?php
   include ('conecta.php'); // comando que inclui a conexão php feita em outro arquivo
   $id = $_POST ['ID'***REMOVED***;  //recebe dado digitado
   $titulo= $_POST ['TITULO'***REMOVED***;//recebe dado digitado
   $genero = $_POST ['GENERO'***REMOVED***;//recebe dado digitado
   $ano = $_POST ['ANO'***REMOVED***;//recebe dado digitado
   $valor = $_POST ['VALOR'***REMOVED***;//recebe dado digitado
   $qntd_estoque = $_POST ['QNTD_ESTOQUE'***REMOVED***;//recebe dado digitado
   $dbname = "livraria";//nome do banco que criamos


   $id_cliente = $_POST ['ID_CLIENTE'***REMOVED***;  //recebe dado digitado
   $nome= $_POST ['NOME'***REMOVED***;//recebe dado digitado
   $endereco = $_POST ['ENDERECO'***REMOVED***;//recebe dado digitado
   $telefone = $_POST ['TELEFONE'***REMOVED***;//recebe dado digitado
   $email = $_POST ['EMAIL'***REMOVED***;//recebe dado digitado
   $cpf = $_POST ['CPF'***REMOVED***;//recebe dado digitado
   //$dbname = "livraria";//nome do banco que criamos


   $id_blurays = $_POST ['ID_BLURAYS'***REMOVED***;  //recebe dado digitado
   $nome1= $_POST ['NOME1'***REMOVED***;//recebe dado digitado
   $genero1 = $_POST ['GENERO1'***REMOVED***;//recebe dado digitado
   $ano1 = $_POST ['ANO1'***REMOVED***;//recebe dado digitado
   $valor1 = $_POST ['VALOR1'***REMOVED***;//recebe dado digitado
   $qntd_estoque1 = $_POST ['QNTD_ESTOQUE1'***REMOVED***;//recebe dado digitado
   //$dbname = "livraria";//nome do banco que criamos


   $id_cupom = $_POST ['ID_CUPOM'***REMOVED***;  //recebe dado digitado
   $valor_recebido= $_POST ['VALOR_RECEBIDO'***REMOVED***;//recebe dado digitado
   $forma_pagamento = $_POST ['FORMA_PAGAMENTO'***REMOVED***;//recebe dado digitado
   $data_venda = $_POST ['DATA_VENDA'***REMOVED***;//recebe dado digitado
   //$dbname = "livraria";//nome do banco que criamos




   $sql= "insert into livros (id, titulo, genero, ano, valor, qntd_estoque) values ('$id', '$titulo', '$genero', '$ano', '$valor', '$qntd_estoque')";
   $sql= "insert into cliente (id_cliente, nome, endereco, telefone, email, cpf) values ('$id_cliente', '$nome', '$endereco', '$telefone', '$email', '$cpf')";
   $sql= "insert into blurays (id_blurays, nome, genero, ano, valor, qntd_estoque) values ('$id_blurays', '$nome1', '$genero1', '$ano1', '$valor1', '$qntd_estoque1')";
   $sql= "insert into venda (id_cupom, valor_recebido, forma_pagamento, data_venda ) values ('$id_cupom', '$valor_recebido', '$forma_pagamento', '$data_venda')";

   $result = mysql_query($sql);
   //as aspas devem ser usadas com cuidado para haver o cadastro da string!

   if ($result)
      echo ' <br> Dados cadastrados com sucesso!';
         else
         echo ' <br> Erro ao tentar cadastrarrrr dados no banco!'. mysql_errno($link) . ": " . mysql_error($link) . "\n";;

   ?>