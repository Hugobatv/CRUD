<?php
require_once 'class-equip.php';
$p = new Equipamento("sistema","localhost","root","");
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Sistema VG</title>
</head>
<body>
    <?php
   // echo "ola";
     if(isset($_POST['submit'])) 
     {
      if(isset($_GET['id_up']) && !empty($_GET['id_up'])){

      //atualizar
          $id_upd = addslashes($_GET['id_up']);
          $hotel = addslashes($_POST['hotel']);
          $ticket= addslashes($_POST['ticket']);
          $avaria = addslashes($_POST['avaria']);
          $situacao = addslashes($_POST['situacao']);
         //echo $hotel ;
           if(!empty($hotel) && !empty($ticket) && !empty($avaria) && !empty($situacao)) 
           {
           if( !$p->Atualizar($id_up,$hotel,$ticket,$avaria,$situacao)){
            echo $p ;   
           }
            
           }
           else
           {
             echo "Preencha todos os campos";
           }
  
        }
     
      //cadastrar
      
      else {
        $hotel = addslashes($_POST['hotel']);
        $ticket= addslashes($_POST['ticket']);
        $avaria = addslashes($_POST['avaria']);
        $situacao = addslashes($_POST['situacao']);
       //echo $hotel ;
         if(!empty($hotel) && !empty($ticket) && !empty($avaria) && !empty($situacao)) 
         {
          $p->Cadastro($hotel,$ticket,$avaria,$situacao);
           
         }
         else
         {
           echo "Preencha todos os campos";
         }

         }
      }
    
    ?>
    <?php
      if(isset($_GET['id_up'])){
        $id_update= addslashes($_GET['id_up']);
       $res = $p->BuscarDados($id_update);
      }
      

    ?>
    <section class="primeira"> 
       
        <form action="index.php" method="post"> 
            <h2>CADASTRAR</h2>
            <label for="hotel">Hotel</label>
            <input type="text" name="hotel" value="<?php if(isset($res)){echo $res['hotel'];} ?>"> 

            <label for="ticket">Ticket</label>
            <input type="number" name="ticket" value="<?php if(isset($res)){echo $res['ticket'];} ?>">

            <label for="avaria">Avaria</label>
            <input type="text" name="avaria" value="<?php if(isset($res)){echo $res['avaria'];} ?>">

            <label for="situacao">Situação</label>
            <input type="text" name="situacao" value="<?php if(isset($res)){echo $res['situacao'];} ?>"> 

            <input type="submit" value="<?php if(isset($res)){echo "Atualizar";}else{echo "Cadastrar";}?>" name="submit">
        </form>
    </section> 

         
           <section class="segunda">
             <table>
                <tr id="titulo">
                    <td>Hotel</td>
                    <td>Ticket</td>
                    <td>Avaria</td>
                    <td>Situação</td>
                </tr>
                <?php
                  $info = $p->Buscador(); 
                     if( count($info) > 0) 
                        {
                            for ($i=0; $i < count($info) ; $i++) { 
                                echo "</tr>";

                            foreach ($info[$i] as $k => $v){
                                if($k != "id")
                                {
                                  echo "<td>".$v."</td>";
                                  
                                }
                      }     
                      ?>
                                  <td> 
                                  <a href="index.php?id_up=<?php echo $info[$i]['id']; ?>">Editar</a>
                                  <a href="index.php?id=<?php echo $info[$i]['id']; ?>">Excluir</a>
                                  </td>
                     <?php 
                                 echo "</tr>";
                   }
                      
                 } 
                 else{
                   echo "Ainda não há equipamentos avariados";
                
                 }

                  ?>
                <tr>
                </tr>
            
             </table>
           </section>
   
</body>
</html>
<?php
//excluir
 if(isset($_GET['id'])) {
  $id_eq=addslashes($_GET['id']);
  $p->Excluir($id_eq);
}

?>