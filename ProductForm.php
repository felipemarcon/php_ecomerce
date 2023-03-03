<?php

    require_once __DIR__ . '/classes/Product.php';

class ProductForm
{
    private $html;
    private $data;

    public function __construct()
    {
        $this->html = file_get_contents('html/form.html');
        $this->data = [
        'pdt_id' => null,
        'pdt_tag' => null,
        'pdt_name' => null,
        'pdt_descbreve' => null,
        'pdt_brand' => null,
        'pdt_unit' => null,
        'pdt_cod' => null,
        'pdt_link' => null,
        'pdt_depth' => null,
        'pdt_width' => null,
        'pdt_height' => null,
        'pdt_desc' => null,
        'pdt_profit' => null,
        'pdt_price' => null,
        'pdt_fullprice' => null,
        'pdt_weight' => null,
        'pdt_discount' => null,
        'pdt_endpromo' => null,
        'pdt_startpromo' => null,
        'pdt_pricepromo' => null


        ];
    }

    public function edit($param)
    {
        try {
            $id = (int)$param['id'];
            $product = Product::find($id);
            $this->data = $product;
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function save($param)
    {
        try {
            Product::save($param);
            $this->data = $param;
            print "<div class='trigger trigger-sucess center'><p>Pessoa salva com Sucesso!</p></div>";
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function show()
    {
        $this->html = str_replace(
            ['{pdt_id}', '{pdt_name}','{pdt_tag}', '{pdt_descbreve}', '{pdt_brand}', '{pdt_unit}', '{pdt_cod}', '{pdt_link}', '{pdt_depth}', '{pdt_width}', '{pdt_height}', '{pdt_desc}', '{pdt_profit}', '{pdt_price}', '{pdt_fullprice}', '{pdt_weight}', '{pdt_discount}', '{pdt_endpromo}', '{pdt_startpromo}', '{pdt_pricepromo}'],
            [
                $this->data['pdt_id'],
                $this->data['pdt_name'],
                $this->data['pdt_tag'],
                $this->data['pdt_descbreve'],
                $this->data['pdt_brand'],
                $this->data['pdt_unit'],
                $this->data['pdt_cod'],
                $this->data['pdt_link'],
                $this->data['pdt_depth'],
                $this->data['pdt_width'],
                $this->data['pdt_height'],
                $this->data['pdt_desc'],
                $this->data['pdt_profit'],
                $this->data['pdt_price'],
                $this->data['pdt_fullprice'],
                $this->data['pdt_weight'],
                $this->data['pdt_discount'],
                $this->data['pdt_endpromo'],
                $this->data['pdt_startpromo'],
                $this->data['pdt_pricepromo']
            ],
            $this->html
        );

        //$this->html = str_replace($search, $this->data, $this->html);

        print  $this->html;
    }
}
