<?php

require_once ROOT.'Views/Body/ShopItem.php';
require_once ROOT.'Models/ShopModel.php';
require_once ROOT.'Views/Body/BaseBody.php';

class ShopBody extends BaseBody{

    protected Database $db;

    public function __construct(Database $db){
        $this->db = $db;
    }

    public function render(){
        echo $this->createHtml();
    }
    
    protected function itemListHtml(){
        $result = '';

        $shop_models = new ShopModel($this->db);
        $products = $shop_models->getShopItems();

        foreach($products as $product){
            $shop_item = new ShopItem($product);
            $result .= $shop_item->createHtml();
        }

        return $result;
    }

    protected function openShopHtml(){
        return '<div class="main"><h2>Onze producten</h2>';
    }

    protected function closeShopHtml(){
        return '</div>';
    }

    protected function createHtml(){
        return $this->openShopHtml()
                .$this->itemListHtml()
                .$this->closeShopHtml();
    }
}