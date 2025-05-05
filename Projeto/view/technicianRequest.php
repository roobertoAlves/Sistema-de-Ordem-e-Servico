<?php
require_once '../factory/connection.php';

$con = new Conection();

$query = "SELECT * FROM clientData";
$result = $con->GetConnect()->query($query);

$pesquisado = null;

if (isset($_GET['result']) && $_GET['result'] === 'success' && isset($_GET['id'])) 
{
    $pesquisaQuery = "SELECT * FROM clientData WHERE requestID = :id";
    $pesquisaStmt = $con->GetConnect()->prepare($pesquisaQuery);
    $pesquisaStmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $pesquisaStmt->execute();
    $pesquisado = $pesquisaStmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chamados - Técnico</title>
    <link rel="stylesheet" href="../css/request.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
</head>
<body>

    <div class="galaxy-background">
        <div class="stars"></div>
        <div class="dust"></div>
        <div class="fog"></div>
    </div>

    <div class="container">
        <a href="homeScreen.php" class="button back-button"><i class="fas fa-arrow-left"></i> Voltar</a>

        <!-- Campo para pesquisa de chamado -->
        <form class="search-id-form" action="../model/searchClientTechnician.php" method="POST">
            <h2>Pesquisar Chamado</h2>
            <label for="pesquisaChamado">Pesquisar ID ou Nome do Chamado:</label>
            <div class="search-container">
                <input type="text" id="clientNameSearchField" name="clientNameSearchField" placeholder="Digite o ID ou Nome do chamado">
                <button type="submit" id="searchButton" class="searchButton">Pesquisar</button>
            </div>
        </form>

        <!-- Resultado da pesquisa -->
        <div id="resultadoPesquisa">
            <?php if ($pesquisado): ?>
                <h3>Resultado da Pesquisa</h3>
                <div class="chamado-box">
                    <div class="header">
                        <div class="id-box">
                            <label>ID:</label>
                            <input type="text" value="<?= htmlspecialchars($pesquisado['requestID']) ?>" data-original-id="<?= htmlspecialchars($pesquisado['requestID']) ?>" readonly>
                        </div>
                        <div class="status-box">
                            <label>Status:</label>
                            <select name="statusBox" disabled>
                                <option value="Aberto" <?= $pesquisado['status'] === 'Aberto' ? 'selected' : '' ?>>Aberto</option>
                                <option value="Em andamento" <?= $pesquisado['status'] === 'Em andamento' ? 'selected' : '' ?>>Em andamento</option>
                                <option value="Ordem de espera" <?= $pesquisado['status'] === 'Ordem de espera' ? 'selected' : '' ?>>Ordem de espera</option>
                                <option value="Liberado" <?= $pesquisado['status'] === 'Liberado' ? 'selected' : '' ?>>Liberado</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid">
                        <div><label>Nome:</label><input type="text" name="clientName" value="<?= htmlspecialchars($pesquisado['clientName']) ?>" readonly></div>
                        <div><label>Email:</label><input type="email" name="clientEmail" value="<?= htmlspecialchars($pesquisado['email']) ?>" readonly></div>
                        <div><label>Telefone:</label><input type="tel" name="clientTelefone" value="<?= htmlspecialchars($pesquisado['telefone']) ?>" readonly></div>
                        <div><label>CPF:</label><input type="text" name="clientCPF" value="<?= htmlspecialchars($pesquisado['cpf']) ?>" readonly></div>
                        <div><label>Dispositivo:</label><input type="text" name="clientDispositive" value="<?= htmlspecialchars($pesquisado['dispositive']) ?>" readonly></div>
                        <div class="descricao">
                            <label>Descrição:</label>
                            <textarea name="problemDescription" readonly><?= htmlspecialchars($pesquisado['problemDescription']) ?></textarea>
                        </div>
                    </div>
                    <div class="chamado-footer">
                        <button class="alterar" onclick="enableEdit(this)"><i class="fas fa-edit"></i> Alterar</button>
                        <button class="salvar" onclick="saveChanges(this)" style="display: none;"><i class="fas fa-save"></i> Salvar</button>
                        <button class="excluir" onclick="deleteRequest('<?= htmlspecialchars($pesquisado['requestID']) ?>')"><i class="fas fa-trash"></i> Excluir</button>
                        <button class="liberar" onclick="releaseRequest('<?= htmlspecialchars($pesquisado['requestID']) ?>')"><i class="fas fa-check-circle"></i> Liberar</button>
                    </div>
                </div>
            <?php elseif (isset($_GET['result']) && $_GET['result'] === 'not_found'): ?>
                <p style="color: red;">Nenhum chamado encontrado.</p>
            <?php endif; ?>
        </div>

        <!-- Exibição de todos os chamados -->
        <div id="listaChamados">
            <div class="formulario">
                <h3>Todos os Chamados</h3>
                <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
                    <div class="chamado-box">
                        <div class="header">
                            <div class="id-box">
                                <label>ID:</label>
                                <input type="text" value="<?= htmlspecialchars($row['requestID']) ?>" data-original-id="<?= htmlspecialchars($row['requestID']) ?>" readonly>
                            </div>
                            <div class="status-box">
                                <label>Status:</label>
                                <select name="statusBox" disabled>
                                    <option value="Aberto" <?= $row['status'] === 'Aberto' ? 'selected' : '' ?>>Aberto</option>
                                    <option value="Em andamento" <?= $row['status'] === 'Em andamento' ? 'selected' : '' ?>>Em andamento</option>
                                    <option value="Ordem de espera" <?= $row['status'] === 'Ordem de espera' ? 'selected' : '' ?>>Ordem de espera</option>
                                    <option value="Liberado" <?= $row['status'] === 'Liberado' ? 'selected' : '' ?>>Liberado</option>
                                </select>
                            </div>
                        </div>
                        <div class="grid">
                            <div><label>Nome:</label><input type="text" name="clientName" value="<?= htmlspecialchars($row['clientName']) ?>" readonly></div>
                            <div><label>Email:</label><input type="email" name="clientEmail" value="<?= htmlspecialchars($row['email']) ?>" readonly></div>
                            <div><label>Telefone:</label><input type="tel" name="clientTelefone" value="<?= htmlspecialchars($row['telefone']) ?>" readonly></div>
                            <div><label>CPF:</label><input type="text" name="clientCPF" value="<?= htmlspecialchars($row['cpf']) ?>" readonly></div>
                            <div><label>Dispositivo:</label><input type="text" name="clientDispositive" value="<?= htmlspecialchars($row['dispositive']) ?>" readonly></div>
                            <div class="descricao">
                                <label>Descrição:</label>
                                <textarea name="problemDescription" readonly><?= htmlspecialchars($row['problemDescription']) ?></textarea>
                            </div>
                        </div>
                        <div class="chamado-footer">
                            <button class="alterar" onclick="enableEdit(this)"><i class="fas fa-edit"></i> Alterar</button>
                            <button class="salvar" onclick="saveChanges(this)" style="display: none;"><i class="fas fa-save"></i> Salvar</button>
                            <button class="excluir" onclick="deleteRequest('<?= $row['requestID'] ?>')"><i class="fas fa-trash"></i> Excluir</button>
                            <button class="liberar" onclick="releaseRequest('<?= $row['requestID'] ?>')"><i class="fas fa-check-circle"></i> Liberar</button>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>

    <script src="../js/script.js"></script>
</body>
</html>