<?php
    require_once '../factory/connection.php';

    if ($_POST['clientNameBox'] != "" && $_POST['clientEmailBox'] != "" && $_POST['clientTelefoneBox'] != "" && 
    $_POST['clientCPFBox'] != "" && $_POST['clientDispositiveBox'] != "" && $_POST['problemDescriptionBox'] != "") 
    {
        $requestID = uniqid("CHAMADO_");

        $con = new Conection();

        $query = "INSERT INTO clientData (requestID, clientName, dispositive, telefone, cpf,
        email, problemDescription)
        VALUES (:requestID, :clientName, :dispositive, :telefone, :cpf, :email, :problemDescription)"; 

        $register = $con->GetConnect()->prepare($query);

        $register->bindParam(":requestID", $requestID, PDO::PARAM_STR);
        $register->bindParam(":clientName", $_POST['clientNameBox'], PDO::PARAM_STR);
        $register->bindParam(":dispositive", $_POST['clientDispositiveBox'], PDO::PARAM_STR);
        $register->bindParam(":telefone", $_POST['clientTelefoneBox'], PDO::PARAM_STR);
        $register->bindParam(":cpf", $_POST['clientCPFBox'], PDO::PARAM_STR);
        $register->bindParam(":email", $_POST['clientEmailBox'], PDO::PARAM_STR);
        $register->bindParam(":problemDescription", $_POST['problemDescriptionBox'], PDO::PARAM_STR); 

        $register->execute();

        if ($register->rowCount() > 0)
        {
            echo "Dados cadastrados com sucesso";
        } 
        else 
        {
            echo "Dados não cadastrados";
        }
    } 
    else 
    {
        echo "Dados incompletos";
    }
?>
