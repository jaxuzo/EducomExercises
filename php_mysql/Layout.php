
<?php
function showHeader($title)
{
    echo "<div class = 'header'> 
            <h1>" . $title . "</h1>
          </div>";
}

function showMenu() {
    echo '<ul class="menu">';
    if (isset($_SESSION['user_id'])) {
        echo '
        <li><a href="?page=home">Home</a></li>
        <li><a href="?page=about">About</a></li>
        <li><a href="?page=contact">Contact</a></li>
        <li><a href="?page=logout">Uitloggen</a></li>
        <li><a href="?page=shop">Shop</a></li>
        <li><a href="?page=shoppingcart">Shoppingcart</a></li>
        ';
    } else {
        echo '
        <li><a href="?page=login">Login</a></li>
        <li><a href="?page=register">Register</a></li>
        <li><a href="?page=contact">Contact</a></li>
        <li><a href="?page=shop">Shop</a></li>
        ';
    }
    echo '</ul>';
}

function showAbout()
{
    echo "<div class='main'>
    <p>Autumn breeze whispers,<br>
    Golden leaves dance on the ground,<br>
    Silent sky turns gray. </p>
    </div>";
}

function showHome()
{
    echo '<div class="main">
        Welkom op mijn homepage! Wat leuk dat je meer over mij te weten wilt komen, navigeer naar de About pagina om meer over mij te weten te komen.
    </div>';
}

function showFooter()
 {
     echo "<footer>&copy;&nbsp;".date("Y")." Jasper's Website. All rights reserved. </footer>";
 }

function showContactForm(array $ErrorMessage = []) {

    $nameError = $ErrorMessage['name'] ?? '';
    $emailError = $ErrorMessage['email'] ?? '';
    $messageError = $ErrorMessage['message'] ?? '';
    
    echo '
    <div class="main">
      <h2>Contactformulier</h2>
      <p><span class="error">* required field</span></p>
      <form action="'. htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post">

          <input type="hidden" name="page" value="contact">'. //fix dat bij redirect ook de juist pagina wordt opgeslagen, staat nu hardcoded in

          '<label for="name">Naam:</label>
          <input type="text" id="name" name="name" value ="'.($_POST['name'] ?? '').'">
          <span class="error">* ' . $nameError . '</span><br>

          <label for="email">Email:</label>
          <input type="email" id="email" name="email" value ="'.($_POST['email'] ?? '').'">
          <span class="error">* ' . $emailError. '</span><br>

          <label for="bericht">Bericht:</label>
          <textarea id="bericht" name="bericht" rows="4" > '.($_POST['bericht'] ?? '').'</textarea>
          <span class="error">* ' . $messageError . '</span><br>

          <button type="submit">Verstuur</button>
      </form>
    </div>';
}

function showLoginForm(array $ErrorMessage = [])
{
    $emailErr = $ErrorMessage['email'] ?? '';
    $wwErr = $ErrorMessage['wachtwoord'] ?? '';

    echo '<div class="main">
    <form action="'. htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post">

        <input type="hidden" name="page" value="login">

        E-mail: <input type="text" name="email" value = "'.($_POST['email'] ?? '').'">
        <span class="error">*'. $emailErr . '</span><br>

        Wachtwoord: <input type="text" name="wachtwoord" value = "'.($_POST['wachtwoord'] ?? '').'">
        <span class="error">*'. $wwErr . '</span><br>
        <input type="submit" value="Login">
      </form>
    </div>';
}

function showRegisterForm(array $ErrorMessage = [])
{   
    $emailErr = $ErrorMessage['email'] ?? '';
    $wwErr = $ErrorMessage['wachtwoord'] ?? '';
    $nameErr = $ErrorMessage['name'] ?? '';

    echo '<div class="main">
      <form action="'. htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post">

        <input type="hidden" name="page" value="register">

        E-mail: <input type="text" name="email" value ="'.($_POST['email'] ?? '').'">
        <span class="error">*'. $emailErr . '</span><br>

        Naam: <input type="text" name="name" value ="'.($_POST['name'] ?? '').'">
        <span class="error">*'. $nameErr. '</span><br>

        Wachtwoord: <input type="text" name="wachtwoord" value ="'.($_POST['wachtwoord'] ?? '').'">
        <span class="error">*'. $wwErr . '</span><br>

        Herhaal wachtwoord: <input type="text" name="wachtwoord2" value ="'.($_POST['wachtwoord2'] ?? '').'">
        <span class="error">*</span><br>

        <input type="submit" value="Registreer">
      </form>
    </div>';
}

function printItem($product = []) {
    echo '<div class="main">
        <div class="product">
            <h3>'.$product['name'].'</h3>
            <a href="?page=itempage&id='.$product['product_id'].'"><img src='.$product['image_url'].' alt="" style="max-width:200px; height:auto;"></a>
            <p>Prijs: €'.$product['price'].'</p>
            '.showOrderOption($product).'
    </div>';
}

function showShopItems() {
    $conn = connectToDatabase();

    $query = "SELECT * FROM items";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            printItem($row);
        }
    } else {
        echo "Geen producten gevonden.";
    }
}

function getItemInformation($id) {
    echo 'Getting item information for id: '; // Debugging line
    $conn = connectToDatabase();

    $query = "SELECT * FROM items WHERE product_id = $id";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        echo "Product niet gevonden.";
        return [];
    }
}

function showShop(){
    echo '<div class="main">
        <h2>Onze producten</h2>';
        showShopItems();
    echo '</div>';
}

function showItemPage() {
    echo 'loading item page'; //debugging line
    $product = getItemInformation($_GET['id'] );

    echo '<div class="main">
        <div class="product">
            <h3>' . htmlspecialchars($product['name']) . '</h3>
            <a href="?page=itempage"><img src="' . $product['image_url'] . '" alt="" style="max-width:600px; height:auto;"></a>
            <p>Prijs: €' . $product['price'] . '</p>
            <p>' . $product['description'] . '</p>
            <p>
            '.showOrderOption($product).'
            </p>
        </div>
    </div>';
}

function showOrderOption($product){
    // Button om te bestellen wordt nu alleen weergegeven als er een ingelogde user is. Als dat niet zo is verdwijnt deze en
    // kan de gebruiken enkel browsen.
    if (isset($_SESSION['user_id'])){
        $string = '<form method="post", action="'. htmlspecialchars($_SERVER["PHP_SELF"]).'">
                <input type="hidden" name="order" value="true">
                <input type="hidden" name="page" value="shop">
                <input type="hidden" name="product_id" value="' . $product["product_id"] . '">
                <input type="hidden" name="product_name" value="' . htmlspecialchars($product["name"]) . '">
                <input type="hidden" name="product_price" value="' . $product["price"] . '">
                <button type="submit" name="add_to_cart">Add to cart</button>
            </form>';
        
        return $string;
    }
}

function addToCart($data){
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];  // start as empty array if it doesn't exist yet
    }

    $item_exists = false;

    foreach ($_SESSION['cart'] as &$item){ // if this item is already added to shopping cart, add one more to the quantity, no need to create a new item
        if ($item['product_id'] == $data['product_id']){
            $item['quantity']++;
            $item_exists = true;
            unset($item);
            return;
        }
    }

    unset($item);
    
    if (!$item_exists){ // If the product isn't present yet you create a new array which holds all the information
        $_SESSION['cart'][] = [
        'product_id' => $data['product_id'],
        'name' => $data['product_name'],
        'price' => $data['product_price'],
        'quantity' => 1];
    }
}

function itemShoppingCart($array){
    $product = getItemInformation($array['product_id']);
    $quantity = $array['quantity'];
    $total_price = $quantity * $product['price'];

    return
    '<div class="cart-item">
    <div class="item-info">
      <img src='.$product['image_url'].' alt="">
      <div>
        <h3>'.$product['name'].'</h3>
      </div>
    </div>
    <div class="item-price">€ '.$product['price'].'</div>
    <div class="item-quantity">
      <span>'.$quantity.'</span>
    </div>
    <div class="item-total">€ '.$total_price.'</div>
  </div><br>'
  ;
}

function totalCartList(){

    $result = "";
    foreach($_SESSION['cart'] as $item){
        $result .= itemShoppingCart($item);
    }
    return $result;
}

function showEmptyCartMessage(){
    echo '<div class="main">
        <h2>Je winkelwagen is leeg</h2>
        <p>Ga naar de <a href="?page=shop">shop</a> om producten toe te voegen aan je winkelwagen.</p>
    </div>';
}

function showCartPage(){
    echo 'checking cart page <br>'; //debugging line
    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0){
        echo 'cart is not empty<br>';
        showShoppingCart();
    }
    else {
        showEmptyCartMessage();
    }
}   

function showShoppingCart(){

$total_price = totalPrice();

echo
'<div class="cart-container">
  <h2>Jouw winkelwagen ('.count($_SESSION['cart']).' producten)</h2>

  <div class="cart-header">
    <span>Product</span>
    <span>Prijs</span>
    <span>Aantal</span>
    <span>Totaal</span>
  </div>
  '.totalCartList().'

  <div class="cart-summary">
    <div class="summary-row"><span>Totaal:</span><span>€ '.$total_price.'</span></div>
    <form method ="post" action="'. htmlspecialchars($_SERVER["PHP_SELF"]).'">
        <input type= "hidden" name ="order_list" value="'.htmlspecialchars(json_encode($_SESSION['cart'])).'">
        <input type= "hidden" name ="check_out" value="true">
        <input type="hidden" name="total_price" value="'.htmlspecialchars($total_price).'">
        <input type="hidden" name="user_id" value="'.htmlspecialchars($_SESSION['user_id']).'">
        <input type="hidden" name="datetime" value="'.htmlspecialchars(date("Y-m-d H:i:s")).'">
        <input type="hidden" name="page" value="shoppingcart">
        <button class="checkout-btn">Check out</button></a><br><br>
    </form>
  </div>
</div>';
}

function totalPrice(){
    $totalprice = 0;
    
    foreach($_SESSION['cart'] as $item){
        $totalprice += $item['quantity']*$item['price'];
    }

    return $totalprice;
}

function showOrderConfirmation(){
    echo '<div class="main">
        <h2>Bedankt voor je bestelling!</h2>
        <p>Je bestelling is succesvol geplaatst. We nemen zo snel mogelijk contact met je op.</p>
        <p><a href="?page=shop">Ga terug naar de shop</a></p>
    </div>';
}
?>