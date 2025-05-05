<?php
    class Conection
    {
        public static $user = "root";
        public static $password = "";
        public static $connect = null;

        private static function Connect()
        {
            try
            {
                if( self::$connect == null ) 
                {
                    self::$connect = new PDO( 'mysql:host=localhost;dbname=techRequest;', self::$user, self::$password );   
                }
            }
             catch (Exception $e)
            {
                echo 'Erro: '. $e -> getMessage();
                die;
            }
            
            return self::$connect;
            
        }   
    
        public function GetConnect()
        {
            return self::Connect();
        }   
    }
?>