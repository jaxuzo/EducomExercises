<?php 

require_once ROOT.'Views/Body/BaseBody.php';

class ShopItem extends BaseBody{

    protected array $product;

    public function __construct(array $product){
        $this -> product = $product;
    }


    public function render():void{
        echo $this->createHtml();
    }

    public function createHtml(): string{
        return $this->productTitleHtml()
            .$this->imageHtml()
            .$this->priceHtml()
            .$this->addToCartHtml();
    }

    protected function productTitleHtml(): string{
        return '<h3>'.$this->product['name'].'</h3>';
    }

    protected function imageHtml(string $max_width = '200px'): string{
        return '<a href="?page=itempage&id='.$this->product['product_id'].'"><img src="/EducomExercises/php_OOP/images/'.$this->product['product_id'].'.jpg" alt="" style="max-width:'.$max_width.'; height:auto;"></a>';
    }

    protected function priceHtml(): string{
        return '<p>Prijs: €'.$this->product['price'].'</p>';
    }

    protected function addToCartHtml(): string{
    // Button om te bestellen wordt nu alleen weergegeven als er een ingelogde user is. Als dat niet zo is verdwijnt deze en
    // kan de gebruiken enkel browsen.
    $string  = '';
    if (isset($_SESSION['user_id'])){
        $string = '<form method="post", action="'. htmlspecialchars($_SERVER["PHP_SELF"]).'">
                <input type="hidden" name="order" value="true">
                <input type="hidden" name="page" value="shop">
                <input type="hidden" name="product_id" value="' . $this->product["product_id"] . '">
                <input type="hidden" name="product_name" value="' . htmlspecialchars($this->product["name"]) . '">
                <input type="hidden" name="product_price" value="' . $this->product["price"] . '">
                <button type="submit" name="add_to_cart">Add to cart</button>
            </form>';
        }
    return $string;
    }


}