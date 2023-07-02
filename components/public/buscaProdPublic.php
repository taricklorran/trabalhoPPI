<?php

require_once "../../services/conexaoMysql.php";
$pdo = mysqlConnect();

class Product
{
  public $id;
  public $name;
  public $price;
  public $imagePath;

  function __construct($id, $name, $price, $imagePath)
  {
    $this->id = $id;
    $this->name = $name; 
    $this->price = $price;
    $this->imagePath = $imagePath;
  }
}

try {

  $products = <<<SQL
              SELECT a.id as codigo, a.titulo as titulo, a.preco as preco, f.nomeFoto as nomearqfoto
              FROM foto f,
                  anuncio a
              where a.id = f.codAnuncio
              order by a.dataHora desc
              LIMIT 6

SQL;

  $stmt = $pdo->query($products);

}

catch (Exception $e) {

  exit("Ocorreu uma falha: " . $e->getMessage());
  
}

while ($row = $stmt->fetch()) {

  $codigo = htmlspecialchars($row['codigo']);
  $titulo = htmlspecialchars($row['titulo']);
  $preco = htmlspecialchars($row['preco']);
  $nomearqfoto = htmlspecialchars($row['nomearqfoto']);

  $produto = new Product($codigo, $titulo, $preco, $nomearqfoto);
  $listProds[] = $produto;

}

header('Content-type: application/json');
echo json_encode($listProds);
