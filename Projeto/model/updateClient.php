<?php
require_once '../factory/connection.php';

$con = new Conection();

if (isset($_POST['updateData'])) 
{
    $id = $_POST['codeBox']; 
    $newId = $_POST['newCodeBox']; 
    $name = $_POST['clientBox']; 
    $dispositive = $_POST['dispositiveBox'];
    $telefone = $_POST['telefoneBox']; 
    $cpf = $_POST['cpfBox']; 
    $email = $_POST['emailBox']; 
    $problemDescription = $_POST['problemDescriptionBox'];
    $status = $_POST['statusBox']; 

    if ($id !== $newId) 
    {
        $checkQuery = "SELECT COUNT(*) FROM clientData WHERE requestID = :newId";
        $checkStmt = $con->GetConnect()->prepare($checkQuery);
        $checkStmt->bindParam(':newId', $newId, PDO::PARAM_INT);
        $checkStmt->execute();

        if ($checkStmt->fetchColumn() > 0) {
            echo "Erro: O novo ID já está em uso.";
            exit();
        }
    }

    $query = "UPDATE clientData SET requestID = :newId, clientName = :name, dispositive = :dispositive, telefone = :telefone, 
              cpf = :cpf, email = :email, problemDescription = :problemDescription, status = :status 
              WHERE requestID = :id";

    $update = $con->GetConnect()->prepare($query);

    $update->bindParam(':id', $id, PDO::PARAM_INT);
    $update->bindParam(':newId', $newId, PDO::PARAM_INT);
    $update->bindParam(':name', $name, PDO::PARAM_STR);
    $update->bindParam(':dispositive', $dispositive, PDO::PARAM_STR);
    $update->bindParam(':telefone', $telefone, PDO::PARAM_STR);
    $update->bindParam(':cpf', $cpf, PDO::PARAM_STR);
    $update->bindParam(':email', $email, PDO::PARAM_STR);
    $update->bindParam(':problemDescription', $problemDescription, PDO::PARAM_STR);
    $update->bindParam(':status', $status, PDO::PARAM_STR);

    if ($update->execute()) 
    {
        echo "Chamado atualizado com sucesso!";
    } 
    else 
    {
        echo "Erro ao atualizar o chamado.";
    }
}
?>
