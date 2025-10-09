<?php
function connectToDatabase()
{

    $servername = "localhost";
    $username = "root";
    $password = "mysqlpassword";
    $dbname = "userdb";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    // echo "Connected successfully <br>";

    return $conn;
}

// close connection
function closeDatabaseConnection($conn)
{
    mysqli_close($conn);
    echo "Connection closed.";
}

function writeToDatabase($conn, $data)
{

    $conn = connectToDatabase();

    $email = $data['email'];
    $name = $data['name'];
    $wachtwoord = $data['wachtwoord'];

    $query = "INSERT INTO users (email, name, password) VALUES ( ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sss", $email, $name, $wachtwoord);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    closeDatabaseConnection($conn);
}

function saveOrderToDatabase($data)
{
    echo'Saving order to database...<br>';
    $conn = connectToDatabase();
    mysqli_begin_transaction($conn);

    try {
        $user_id = $data['user_id'];
        $total_price = $data['total_price'];
        $datetime = $data['datetime'];
        $items = $_SESSION['cart'];

        echo'Query voorbereiden...<br>';
        $queryorder = "INSERT INTO orders (customer_id, total_price, created_at) VALUES ( ?, ?, ?)";

        echo 'Query uitvoeren...<br>';
        $stmt = mysqli_prepare($conn, $queryorder);
        mysqli_stmt_bind_param($stmt, "ids", $user_id, $total_price, $datetime);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        echo 'Order toegevoegd aan database';
        $order_id = mysqli_insert_id($conn);

        $queryorderitem = "INSERT INTO orderitems (order_id, product_id, quantity) VALUES ( ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $queryorderitem);

        var_dump($items);
        
        foreach ($items as $item) {
            var_dump($item);
            $stmt = mysqli_prepare($conn, $queryorderitem);
            mysqli_stmt_bind_param($stmt, "iii", $order_id, $item['product_id'], $item['quantity']);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }

        mysqli_commit($conn);

        closeDatabaseConnection($conn);
        // Als er een error is, rollback en sluit de connectie
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        mysqli_rollback($conn);
        mysqli_close($conn);
        throw $e;
    }
}
