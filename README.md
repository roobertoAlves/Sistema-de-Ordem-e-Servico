Claro! Aqui está a versão do `README.md` **sem emojis**, com uma estrutura clara e profissional:

---

# Sistema de Ordem de Serviço (PHP OO)

Este é um Sistema de Ordem de Serviço desenvolvido em **PHP Orientado a Objetos**, utilizando o padrão **MVC**. O sistema permite o **gerenciamento de chamados** de clientes e o acompanhamento técnico dos mesmos, com operações **CRUD** completas e interface estilizada com **CSS**.

---

## Funcionalidades

### 1. Tela de Chamado (Cliente)

* Criação de novos chamados por clientes.
* Interface intuitiva para registro de problemas.
* Validação de dados no frontend e backend.

### 2. Tela Técnica (Operador Técnico)

* Visualização completa dos chamados.
* Pesquisa por ID ou nome.
* Edição, exclusão e atualização de chamados.
* Atualização do status: Aberto, Em andamento, Ordem de espera, Liberado.
* Sincronização automática entre busca e lista geral.

### 3. Segurança

* Proteção contra SQL Injection utilizando prepared statements.
* Sanitização de dados contra XSS (Cross-Site Scripting).
* Controle de acesso para evitar ações não autorizadas.

### 4. Estrutura Orientada a Objetos

* Código modular e reutilizável.
* Separação clara entre lógica, visual e controle.

### 5. Padrão MVC

* **Model**: Lógica e acesso ao banco de dados.
* **View**: Interface com o usuário.
* **Controller**: Ponte entre Model e View.

### 6. Estilização com CSS

* Interface responsiva e limpa.
* Uso organizado de classes CSS.
* Design profissional.

---

## Tecnologias Utilizadas

* PHP – Backend
* MySQL – Banco de dados
* HTML5 – Estrutura das páginas
* CSS3 – Estilização
* JavaScript – Funcionalidades dinâmicas no frontend
* Font Awesome – Ícones

---

## Estrutura do Projeto

### Diretórios

* `model/` – Contém classes de acesso ao banco de dados.
* `view/` – Páginas HTML/PHP da interface com o usuário.
* `controller/` – Controladores responsáveis pelas requisições.
* `css/` – Arquivos de estilo.
* `js/` – Scripts JavaScript.

### Principais Arquivos

* `homeScreen.php` – Tela de seleção (Cliente ou Técnico).
* `technicianRequest.php` – Gerenciamento técnico dos chamados.
* `updateClient.php` – Atualização de dados no banco.
* `script.js` – Funções JavaScript para edição e sincronização.

---

## Como Executar o Projeto

### 1. Pré-requisitos

* Servidor local: XAMPP, WAMP ou Laragon.
* PHP 7.4 ou superior.
* MySQL.

### 2. Configuração

Clone o repositório:

```bash
git clone https://github.com/roobertoAlves/Sistema-de-Ordem-e-Servico
```

Configure o banco de dados:

* Crie um banco no MySQL.
* Importe o arquivo `clientData.sql`.

Configure a conexão com o banco:

* Edite o arquivo `connection.php` com suas credenciais.

### 3. Execução

* Inicie seu servidor local.
* Acesse o sistema pelo navegador:

```
http://localhost/Projeto/view/homeScreen.php
```

---

## Funcionalidades Técnicas

* **Pesquisa de Chamados**: Por ID ou nome, com resultados exibidos em tempo real.
* **Edição e Sincronização**: Atualização dos chamados com sincronização automática.
* **Exclusão e Atualização**: Exclusão com confirmação e atualização de status/dados.

---

## Melhorias Futuras

* Implementação de autenticação e controle de acesso.
* Notificações em tempo real para atualizações de chamados.
* Relatórios gerenciais com filtros e exportação.

---

## Observações

Desenvolvido com PHP OO, padrão MVC e foco em código limpo.
