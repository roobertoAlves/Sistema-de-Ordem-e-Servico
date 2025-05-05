<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login Técnico</title>
  <link rel="stylesheet" href="../css/ITLogin.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
</head>
<body>
  <div class="galaxy-background">
    <div class="stars"></div>
    <div class="dust"></div>
    <div class="fog"></div>
  </div>

  <a href="homeScreen.php" class="button back-button"><i class="fas fa-arrow-left"></i> Voltar</a>

  <div class="login-container">
    <div class="login-box">
      <h2><i class="fas fa-user-astronaut"></i> Login</h2>

      <form class="login-form" action="../model/User.php" method="POST">

      <?php
          if (isset($_SESSION["error"])) 
          {
            echo "<p style='color: red;'>" . $_SESSION["error"] . "</p>";
            unset($_SESSION["error"]); 
          }
      ?>

        <div class="input-group">
          <input type="text" name="userBox" placeholder="Usuário" required aria-label="Usuário">
        </div>
        <div class="input-group">
          <input type="password" name="passwordBox" placeholder="Senha" required aria-label="Senha">
        </div>
        <button type="submit" class="button"><i class="fas fa-sign-in-alt"></i> Entrar</button>
      </form>
    </div>
  </div>

<?php
    
    if (isset($_SESSION["maxAttemptsReached"]) && $_SESSION["maxAttemptsReached"] === true) 
    {
       
        unset($_SESSION["attempts"]);

        echo "
            <script type='text/javascript'>
                alert('Número máximo de tentativas atingido! O programa será fechado.');
                // Redireciona o usuário para uma página de erro ou qualquer outra página após o pop-up
                window.location.href = 'https://www.google.com'; // Você pode substituir este link com a URL desejada
            </script>
        ";
        unset($_SESSION["maxAttemptsReached"]); 
    }
    ?>

  <script src="../js/script.js"></script>
</body>
</html>
