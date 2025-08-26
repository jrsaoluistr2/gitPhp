<?php 


class Conexao{

	private static $local = 'localhost';
    private static $banco = 'testes';
    private static $usuario = 'root';
    private static $senha = '';
    private static $instance;

    // Método para obter a conexão
    public static function getConn() {
        try {
            if (!isset(self::$instance)) :
                self::$instance = new PDO('mysql:host=' . self::$local . ';dbname=' . self::$banco, self::$usuario, self::$senha);

                // Configurações para maior segurança
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            endif;

            return self::$instance;
        } catch (PDOException $ex) {
            echo "Não foi possível te conectar ao banco de dados: " . $ex->getMessage();
            die;
        }
    }

    // Método para fechar a conexão
    public static function closeConn() {
        if (self::$instance) {
            self::$instance = null;
        }
    }
}

?>