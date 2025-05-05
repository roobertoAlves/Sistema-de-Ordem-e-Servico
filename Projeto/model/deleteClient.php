<?php

    require_once "../factory/connection.php";

    $id = $_GET["requestID"];

    $con = new Conection();

    $query = "DELETE FROM clientData WHERE requestID = :id";

    $delete = $conection = $con->GetConnect()->prepare($query);

    $delete->bindParam(":id", $id, PDO::PARAM_INT);

    if( $delete->execute() )
    {
        echo "
        <script>  
            alert('Cliente deletado com sucesso!');   
            window.location.href='../view/technicianRequest.php';
        </script>";
    }
    else
    {
        echo "
        <script>  
            alert('Erro ao deletar cliente!');
            window.location.href='../view/technicianRequest.php';
        </script>";
    }
    $delete->closeCursor();

?>