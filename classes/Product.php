<?php

class Product
{
    private static $conn;

    public static function getConnection()
    {
        if (empty(self::$conn)) {
            $connection = parse_ini_file('config/books.ini');
            self::$conn = new PDO(
                "mysql:host={$connection['host']};port={$connection['port']};dbname={$connection['name']}",
                "{$connection['user']}",
                "{$connection['pass']}",
                [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8']
            );
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$conn;
    }

    public static function save($product)
    {
        var_dump($product);
        $conn = self::getConnection();
        if (empty($product['pdt_id'])) {
            $result = $conn->query("SELECT max(pdt_id) as next FROM products");
            $row = $result->fetch();
            $product['pdt_id'] = (int)$row['next'] + 1;


            $sql = "INSERT INTO products (pdt_id, pdt_name, pdt_descbreve, pdt_brand, pdt_unit, pdt_cod, pdt_link, pdt_depth, pdt_width, pdt_height, pdt_desc, pdt_profit, pdt_price, pdt_fullprice, pdt_weight, pdt_discount, pdt_endpromo, pdt_startpromo, pdt_pricepromo)
            VALUES (:pdt_id, :pdt_name, :pdt_descbreve, :pdt_brand, :pdt_unit, :pdt_cod, :pdt_link, :pdt_depth, :pdt_width, :pdt_height, :pdt_desc, :pdt_profit, :pdt_price, :pdt_fullprice, :pdt_weight, :pdt_discount, :pdt_endpromo, :pdt_startpromo, :pdt_pricepromo);";
        } else {
            $sql = "UPDATE products SET pdt_name = :pdt_name, pdt_descbreve = :pdt_descbreve, pdt_brand = :pdt_brand, pdt_unit = :pdt_unit, pdt_cod = :pdt_cod, pdt_link = :pdt_link, pdt_depth = :pdt_depth, pdt_width = :pdt_width, pdt_height = :pdt_height, pdt_desc = :pdt_desc, pdt_profit = :pdt_profit, pdt_price = :pdt_price, pdt_fullprice = :pdt_fullprice, pdt_weight = :pdt_weight, pdt_discount = :pdt_discount, pdt_endpromo = :pdt_endpromo, pdt_startpromo = :pdt_startpromo, pdt_pricepromo = :pdt_pricepromo WHERE pdt_id = :pdt_id;
            ";
        }

        $result = $conn->prepare($sql);

        return $result->execute(
            [
                ':pdt_id' => $product['pdt_id'],
                ':pdt_name' => $product['pdt_name'],
                ':pdt_descbreve' => $product['pdt_descbreve'],
                ':pdt_brand' => $product['pdt_brand'],
                ':pdt_unit' => $product['pdt_unit'],
                ':pdt_cod' => $product['pdt_cod'],
                ':pdt_link' => $product['pdt_link'],
                ':pdt_depth' => $product['pdt_depth'],
                ':pdt_width' => $product['pdt_width'],
                ':pdt_height' => $product['pdt_height'],
                ':pdt_desc' => $product['pdt_desc'],
                ':pdt_profit' => $product['pdt_profit'],
                ':pdt_price' => $product['pdt_price'],
                ':pdt_fullprice' => $product['pdt_fullprice'],
                ':pdt_weight' => $product['pdt_weight'],
                ':pdt_discount' => $product['pdt_discount'],
                ':pdt_endpromo' => $product['pdt_endpromo'],
                ':pdt_startpromo' => $product['pdt_startpromo'],
                ':pdt_pricepromo' => $product['pdt_pricepromo']
            ]
        );

        die;
    }

    /**
     * Busca uma Pessoa pelo seu $pdt_id
     * @param $pdt_id
     *
     * @return mixed
     */
    public static function find($id)
    {
        $conn = self::getConnection();
        $result = $conn->query("SELECT * FROM products WHERE pdt_id='{$id}'");

        return $result->fetch();
    }

    public static function delete($id)
    {
        $conn = self::getConnection();
        $result = $conn->query("DELETE FROM products WHERE pdt_id='{$id}'");

        return $result;
    }

    public static function all()
    {
        $conn = self::getConnection();
        $result = $conn->query("SELECT * FROM products");

        return $result;
    }
}
