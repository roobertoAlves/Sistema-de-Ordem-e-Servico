<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Chamado - Cliente</title>
    <link rel="stylesheet" href="../css/request.css">
</head>
<body>
    <div class="galaxy-background">
        <div class="stars"></div>
        <div class="dust"></div>
        <div class="fog"></div>
    </div>

    <a href="homeScreen.php" class="button back-button" aria-label="Voltar para a tela inicial">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>

    <div class="container">
        <!-- Pesquisa de chamado -->
        <form class="search-id-form" action="../model/searchClient.php" method="POST">
            <h2>Pesquisar Chamado</h2>
            <label for="clientNameSearchField">Pesquisar ID ou Nome do Chamado:</label>
            <div class="search-container">
                <input type="text" id="clientNameSearchField" name="clientNameSearchField" 
                       placeholder="Digite o ID ou Nome do chamado" aria-label="Campo de pesquisa de chamado">
                <button type="submit" id="searchButton" class="searchButton" aria-label="Pesquisar chamado">
                    Pesquisar
                </button>
            </div>
        </form>

        <!-- Exibição do resultado da pesquisa -->
        <div id="resultadoPesquisa">
            <?php if (isset($_GET['result']) && $_GET['result'] === 'success'): ?>
                <div class="chamado-box">
                    <div class="header">
                        <div class="id-box">
                            <label for="id">ID:</label>
                            <input type="text" id="id" value="<?= htmlspecialchars($_GET['id']) ?>" readonly>
                        </div>
                        <div class="status-box">
                            <label for="status">Status:</label>
                            <select id="status" disabled>
                                <option selected><?= htmlspecialchars($_GET['status']) ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="grid">
                        <div>
                            <label>Nome:</label>
                            <input type="text" value="<?= htmlspecialchars($_GET['nome']) ?>" readonly>
                        </div>
                        <div>
                            <label>Email:</label>
                            <input type="email" value="<?= htmlspecialchars($_GET['email']) ?>" readonly>
                        </div>
                        <div>
                            <label>Telefone:</label>
                            <input type="tel" value="<?= htmlspecialchars($_GET['telefone']) ?>" readonly>
                        </div>
                        <div>
                            <label>CPF:</label>
                            <input type="text" value="<?= htmlspecialchars($_GET['cpf']) ?>" readonly>
                        </div>
                        <div>
                            <label>Dispositivo:</label>
                            <input type="text" value="<?= htmlspecialchars($_GET['dispositivo']) ?>" readonly>
                        </div>
                        <div class="descricao">
                            <label>Descrição:</label>
                            <textarea readonly><?= htmlspecialchars($_GET['descricao']) ?></textarea>
                        </div>
                    </div>
                </div>
            <?php elseif (isset($_GET['result']) && $_GET['result'] === 'not_found'): ?>
                <p style="color: red;">Nenhum chamado encontrado.</p>
            <?php endif; ?>
        </div>

        <!-- Formulário de abertura de chamado -->
        <form class="formulario" action="../model/insertClient.php" method="POST">
            <h2>Abertura de Chamado</h2>
            <div class="grid">
                <div>
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="clientNameBox" placeholder="Seu nome completo" required>
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="clientEmailBox" placeholder="seu@email.com" required>
                </div>
                <div>
                    <label for="telefone">Telefone</label>
                    <input type="tel" id="telefone" name="clientTelefoneBox" placeholder="(11) 91234-5678" required>
                </div>
                <div>
                    <label for="cpf">CPF</label>
                    <input type="text" id="cpf" name="clientCPFBox" placeholder="000.000.000-00" required>
                </div>
                <div>
                    <label for="dispositivo">Dispositivo com Problema</label>
                    <input type="text" id="dispositivo" name="clientDispositiveBox" placeholder="Ex: Notebook Dell XPS 13" required>
                </div>
                <div class="descricao">
                    <label for="descricao">Descrição do Problema</label>
                    <textarea id="descricao" name="problemDescriptionBox" placeholder="Descreva o problema com detalhes..." required></textarea>
                </div>
            </div>
            <button type="submit" aria-label="Enviar chamado">Enviar Chamado</button>
        </form>
    </div>

    <script src="../js/script.js"></script>
</body>
</html>
