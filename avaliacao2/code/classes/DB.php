<?php 
/**
 * Classe responsável por gerenciar dados no MySQL via PDO.
 */
class bd { 
    private $host = "localhost";
    private $dbname = "artesanato_db";
    private $username = "root";
    private $password = "";
    private $pdo;

    public function __construct() {
        try {
            $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=utf8";
            $this->pdo = new PDO($dsn, $this->username, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        } catch (PDOException $e) {
            die("Erro ao conectar: " . $e->getMessage());
        }
    }

    public function __destruct() {
        $this->pdo = null; 
    }

    public function getAllProducts() {
        $stmt = $this->pdo->query("SELECT * FROM produtos_artesanais ORDER BY id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

public function cadastrarProduto($nome,$preco,$descricao,$categoria){
        $sql="INSERT INTO produtos_artesanais(nome_produto,preco,descricao,categoria)VALUES(:nome,:preco,:descricao,:categoria)";
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute([':nome'=>$nome,':preco'=>$preco,':descricao'=>$descricao,':categoria'=>$categoria]);
    }
    public function removeProduct($id) {
        $sql = "DELETE FROM produtos_artesanais WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]); 
    }
    public function removerVaga($id) {
        $sql = "DELETE FROM produtos_artesanais WHERE id = ?";   
        $stmt = $this->pdo->prepare($sql); 
        return $stmt->execute([$id]);  

    }
}
