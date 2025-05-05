<?php
require_once '../factory/connection.php';

$client = $_POST["clientNameSearchField"];

$con = new Conection();


if (is_numeric($client))
 {
    $query = "SELECT * FROM clientData WHERE requestID = :client";
    $outcome = $con->GetConnect()->prepare($query);
    $outcome->bindParam(':client', $client, PDO::PARAM_INT);
} 
else 
{
    $query = "SELECT * FROM clientData WHERE clientName = :client";
    $outcome = $con->GetConnect()->prepare($query);
    $outcome->bindParam(':client', $client, PDO::PARAM_STR);
}

$outcome->execute();

if ($outcome->rowCount() > 0) 
{
    $line = $outcome->fetch(PDO::FETCH_ASSOC);
    header("Location: ../view/technicianRequest.php?result=success&id={$line['requestID']}&status={$line['status']}&nome={$line['clientName']}&email={$line['email']}&telefone={$line['telefone']}&cpf={$line['cpf']}&dispositivo={$line['dispositive']}&descricao={$line['problemDescription']}");
    exit();
} 
else 
{
    header("Location: ../view/technicianRequest.php?result=not_found");
    exit();
}
?>