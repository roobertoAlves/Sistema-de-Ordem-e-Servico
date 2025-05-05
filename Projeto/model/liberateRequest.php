<?php
require_once '../factory/connection.php';

$con = new Conection();

if (isset($_POST['requestID'])) 
{
    $id = $_POST['requestID'];

    $query = "SELECT status FROM clientData WHERE requestID = :id";
    $stmt = $con->GetConnect()->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result['status'] === 'Liberado') 
    {
        echo "Este chamado já foi liberado!";
        exit();
    }

    $updateQuery = "UPDATE clientData SET status = 'Liberado' WHERE requestID = :id";
    $updateStmt = $con->GetConnect()->prepare($updateQuery);
    $updateStmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($updateStmt->execute()) 
    {
        echo "Chamado liberado com sucesso!";
    } 
    else 
    {
        echo "Erro ao liberar o chamado.";
    }
}
?>