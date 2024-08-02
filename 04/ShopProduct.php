<?php

// Listing 4.5
class ShopProduct
{
    public $title;
    public $producerFirstName = "";
    public $producerMainName = "";
    public $price = 0;
    private int $id = 0;

    public function __construct(
        string $title,
        string $producerFirstName,
        string $producerMainName,
        float $price = 0
    ) {
        $this->title = $title;
        $this->producerFirstName = $producerFirstName;
        $this->producerMainName = $producerMainName;
        $this->price = $price;
    }

    public function getProducer()
    {
        return $this->producerFirstName . " " . $this->producerMainName;
    }

    public function setID(int $id): void
    {
        $this->id = $id;
    }

    public static function getInstance(int $id, \PDO $pdo): ShopProduct
    {
        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
        $result = $stmt->execute([$id]);

        if (empty($row)) {
            return null;
        }

        if ($row['type'] === 'book') {
            $product = new ShopBook(
                $row['title'],
                $row['producerFirstName'],
                $row['producerMainName'],
                (float) $row['price'],
                (int) $row['numpages']
            );
        } elseif ($row['type'] === 'cd') {
            $product = new CDProduct(
                $row['title'],
                $row['producerFirstName'],
                $row['producerMainName'],
                (float) $row['price'],
                (int) $row['playtime']
            );
        } else {
            $firstName = (is_null($row['producerFirstName'])) ? '' : $row['producerFirstName'];
            $product = new ShopProduct(
                $row['title'],
                $firstName,
                $row['producerMainName'],
                (float) $row['price']
            );
        }

        $product->setID((int) $row[$id]);
        $product->setDiscount((int) $row['discount']);
        return $product;
    }
}

//Listing 4.6
// Usage
$dsn = "sqlite:shop.db";
$pdo = new PDO($dsn, null, null);
$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
$obj = ShopProduct::getInstance(1, $pdo);
