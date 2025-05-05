<?php
session_start();


class LoginController
{
    private $name;
    private $password;
    private $maxAttempts = 3;

    #region Get And Set
    public function setName($nm)
    {
        $this->name = $nm;
    }
    public function setPassword($psw)
    {
        $this->password = $psw;
    }
    public function getName() 
    {
        return $this->name;
    }
    public function getPassword()
    {
        return $this->password;
    }
    #endregion

    public function attemptLogin()
    {
        if (!isset($_SESSION["attempts"])) 
        {
            $_SESSION["attempts"] = 0;
        }

        $login = ["name" => "tecnico", "password" => "tecnico123"];

        if ($_SESSION["attempts"] >= $this->maxAttempts) 
        {
            $_SESSION["error"] = "Número máximo de tentativas atingido!";
            $_SESSION["maxAttemptsReached"] = true;
            header("Location: ../view/ITLoginScreen.php");
            exit();
        }

        if ($this->name === $login["name"] && $this->password === $login["password"]) 
        {
            $_SESSION["usuario"] = ["name" => $this->name];
            $_SESSION["attempts"] = 0;
            header("Location: ../view/technicianRequest.php");
            exit();
        }

        $_SESSION["attempts"]++;
        $_SESSION["error"] = "Usuário ou senha incorretos. Tente novamente.";

        header("Location: ../view/ITLoginScreen.php");
        exit();
    }
}
?>