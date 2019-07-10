<?php
   require_once 'lib/mercadopago.php';  // Biblioteca Mercado Pago
   require_once 'lib/configs.php';  // Biblioteca Mercado Pago
   require_once 'class/PagamentoMP.php';            // Classe Pagamento
   $conexao = iniciaConexao();
   $pagar = new PagamentoMP;


   if(isset($_GET['collection_id'])):
    $id =  $_GET['collection_id'];
   elseif(isset($_GET['id'])):
    $id =  $_GET['id'];
   endif;


    $retorno = $pagar->Retorno($id);
    
   if($retorno){
      // Redirecionar usuario
      echo '<script>location.href="../index.php"</script>';
   }else{
     // Redirecionar usuario e informar erro ao admin
      echo '<script>location.href="../index.php"</script>';
      

       

      

   }


 
 