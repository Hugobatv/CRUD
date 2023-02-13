<?php



class Equipamento {

    private $pdo ;
   
    //conexão
   public function __construct($dbname ,$host ,$user , $senha)
   {
    try {
        $this->pdo = new PDO ("mysql:dbname=".$dbname.";host=".$host ,$user , $senha);
    } catch (Exception $e) {
        echo "Erro no db".$e->getMessage();
    }
     
   }

   //buscar tudo no db
    public function Buscador() 
    {
        $res = array();
        $cmd = $this->pdo->query("SELECT * FROM equip order by id desc");
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
         return $res ;
     }
     
    //cadastro de equipamento

    public function Cadastro($hotel,$ticket,$avaria,$situacao)
    {
         $cmd = $this->pdo->query("SELECT * FROM equip WHERE ticket=".$ticket);
         $cmd->execute();
         echo $cmd->rowCount() ;
         if($cmd->rowCount() > 0) 
         {
            echo "ticket ja existente ";
            return false;
         }else{ 
            $cmd=$this->pdo->prepare("INSERT INTO equip(hotel,ticket,avaria,situacao) VALUES (:h,:t,:a,:s)");
            $cmd->bindValue(":h",$hotel);
            $cmd->bindValue(":t",$ticket);
            $cmd->bindValue(":a",$avaria);
            $cmd->bindValue(":s",$situacao);
            $cmd->execute();
            header("location:index.php");
            return true ;
         } 

    }
    public function Excluir($id) {
        
        $cmd = $this->pdo->prepare("DELETE FROM equip  WHERE  id = :id");
        $cmd->bindValue(":id",$id);
        $cmd->execute();
         header("location:index.php");
         
            
          

    }
    public function BuscarDados($id){   
        $res= array();
        $cmd = $this->pdo->prepare("SELECT * FROM equip  WHERE  id = :id");
        $cmd->bindValue(":id",$id);
        $cmd->execute();
        $res=$cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
}

public function Atualizar($id,$hotel,$ticket,$avaria,$situacao) {
    $cmd=$this->pdo->prepare("UPDATE equip SET hotel = :h,ticket = :t,avaria = :a, situacao = :s WHERE id= :id ");
            $cmd->bindValue(":h",$hotel);
            $cmd->bindValue(":t",$ticket);
            $cmd->bindValue(":a",$avaria);
            $cmd->bindValue(":s",$situacao);
            $cmd->bindValue(":id",$id);
            $cmd->execute();
            return true;
           
}
}










?>