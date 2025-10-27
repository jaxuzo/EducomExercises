<?php

require_once ROOT.'Views/Body/ShopItem.php';
require_once ROOT.'Models/ShopModel.php';

class ItemBody extends ShopItem{

    protected Database $db;

    public function __construct(Database $db){
        $this -> db = $db;
    }

    public function createHtml(): string{
        $this->getItemInfo();
        return $this->productTitleHtml()
            .$this->imageHtml($max_width = 800)
            .$this->descriptionHtml()
            .$this->priceHtml()
            .$this->addToCartHtml();
    }

    protected function getItemInfo(){
        $shop_model = new ShopModel($this->db);
        $this->product = $shop_model->getItemById($_GET['id']);
    }    

    protected function descriptionHtml(){
        return '<p>' . $this->product['description'] . '</p>';
    }
    
}