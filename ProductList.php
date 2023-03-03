<?php

    require_once __DIR__ . '/classes/Product.php';

class ProductList
{
    private $html;

    public function __construct()
    {
        $this->html = file_get_contents('html/list.html');
    }

    public function delete($param)
    {
        try {
            $id = (int)$param['id'];
            Product::delete($id);
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function load()
    {
        try {
            $rows = '';
            foreach (Product::all() as $product) {
                $row = file_get_contents('html/row.html');

                $row = str_replace(
                    ['{id}', '{product_name}', '{product_city}', '{product_state}','{product_phone}','{product_mail}'],
                    [
                        $product['id'],
                        $product['name'],
                        $product['city'],
                        $product['state'],
                        $product['phone'],
                        $product['mail']
                    ],
                    $row
                );

                $rows .= $row;
            }
            $this->html = str_replace(
                '{rows}',
                $rows,
                $this->html
            );
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function show()
    {
        $this->load();
        print $this->html;
    }
}
