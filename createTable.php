<?php
    $table = 'tarefa';
    $tableExists = $mysqli->query("SHOW TABLES LIKE '$table'")->num_rows > 0;
    if($tableExists==1){

    }else{
        $create_table="CREATE TABLE tarefa (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            nomeTarefa VARCHAR(2000) NOT NULL,
            checklist VARCHAR(200) NOT NULL
            )";
        $mysqli->query($create_table);
    
    }

?>