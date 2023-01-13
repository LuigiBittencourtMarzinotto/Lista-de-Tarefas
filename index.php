<?php

include("./conexao.php");
include("./createTable.php");
if(isset($_POST['tarefa'])){
    $tarefa = $_POST['tarefa'];
    $sql_code =  "SELECT * FROM tarefa WHERE nomeTarefa = '$tarefa' ";
    $sql_query = $mysqli->query($sql_code)or die("erro");
    $quantidade = $sql_query->num_rows;
    if($quantidade!=1){
        $mysqli->query("INSERT INTO tarefa (nometarefa, checklist) VALUES ('$tarefa','Pendente')");
    
    }else{
        unset($tarefa);
        echo"<script>alert('tarefa ja adicionada')</script>";
    }
    
}
if(isset($_POST['newtarefa']) ){
    $idTarefa=$_POST['idOldTarefa'];
    $newtarefa=$_POST['newtarefa'];
    $selecttarefa = $_POST['selecttarefa'];
    $sql_update_tarefa = "UPDATE tarefa SET nomeTarefa = '$newtarefa'  WHERE id = '$idTarefa'";
    $mysqli->query($sql_update_tarefa);
    $sql_update_status = "UPDATE tarefa SET checklist = '$selecttarefa'  WHERE id = '$idTarefa'";
    $mysqli->query($sql_update_status);

}
if(isset($_POST['delete'])){
    $idTarefaDelete=$_POST['idTarefaDelete'];
    $sql_delete = "DELETE FROM tarefa WHERE id ='$idTarefaDelete'";
    $mysqli->query($sql_delete);


}


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <title>Lista de Tarefa</title>
</head>
<body>
    <main>
        <h1>Tarefas</h1>
        <form method="post" class="addList" >
            <input type="text" placeholder="Adicionar uma nova tarefa" name="tarefa">
            <button type="submit" class="newTarefa"><img src='./midia/add.png'></button>

        </form>

        <div class="tasklist">
            <?php
                $sql_add_query = $mysqli->query("SELECT * FROM tarefa");
                while($list = $sql_add_query->fetch_assoc()){
                    $tarefa=$list['nomeTarefa'];
                    $status=$list['checklist'];
                    $id = $list['id'];
                    $newname= uniqid();
                    if($status=="concluido"){
                        
                        $statusColor = "#01ff01";
                    }else{
                        $statusColor="#ff0101";
                    }
                    echo"
                    <article class='task'>
                        <div>
                            <p>$tarefa</p>
                        </div>
                        <div class='status_$id'></div>
                        <div class='edit' >
                            <form method='post'>
                                <input class='disabledInput' type='text' name='idTarefa' value='$id'></input>
                                <button class='click edit disabledButton'><img src='./midia/edit.png'></button> <!--edit-->
                            </form>
                            <form method='post'>
                            <input class='disabledInput' type='text' name='idTarefaDelete' value='$id'></input>
                                <input class='disabledInput' type='text' name='delete' value='delete'></input>
                                <button class='click disabledButton'><img src='./midia/delete.png'></button> <!--delete-->                            
                            </form>
                        </div>
                    </article>
                    <style>
                        div.status_$id{
                            width: 10px;
                            height: 10px;
                            border-radius: 100%;
                            background-color:$statusColor
                        }
                    </style>";
                }

            ?>
        </div>
        
        <article id="tarefaedit"<?php  
        if(isset($_POST['idTarefa']) ){
            echo'class="active"';
        }else{
            echo'class="disabledTarefa"';

        } ?>>
            <form action="" class="editnewtarefa" method="post">
                <h2>Configuração de tarefa</h2>
                <div class="configTarefa">
                    <?php
                        if(isset($_POST['idTarefa']) ){
                            $idnew=$_POST['idTarefa'];
                            echo"<input value='$idnew'class='disabledInput' name='idOldTarefa'></input>";
                            $sql_add_query = $mysqli->query("SELECT * FROM tarefa WHERE id = $idnew");
                            while($list = $sql_add_query->fetch_assoc()){
                                $tarefa=$list['nomeTarefa'];
                                $status=$list['checklist'];
                                $id = $list['id'];
                    ?>
                    <label for="edittarefa">Tarefa:</label>
                    <input type="text" name="newtarefa" class="editTarefa" id="edittarefa" value="<?php echo $tarefa ?>">
                    <label for="">Status:</label>
                    <select name="selecttarefa" >
                        <?php
                            if($status!=="concluido"){
                                echo'<option value="pendente">Não concluido</option>';
                                echo'<option value="concluido">Concluido</option>';
                            }else{
                                echo'<option value="concluido">Concluido</option>';
                                echo'<option value="pendente">Não concluido</option>';
 
                            }
                        ?>
                    </select>
                    <?php
                        } 
                    }
                    ?>
                </div>
                <button type="submit" class="alterar">Alterar</button>
            </form>
        </article>
    </main>
    <script src="./js/index.js"></script>
</body>
</html>