<?php
require_once 'connection.php';
try {
    $pdo = new PDO( DSN, DB_USR, DB_PWD );
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare(
        "SELECT DISTINCT (event),price FROM setting_of_prices"
    );
    
    $stmt->execute();    

    $price = '';

    while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ) {
        
        // Format the price with peso sign and ".00"
        $formatted_price = '₱' . number_format($row["price"], 2);

        $price .= '<option value="'.$row["price"].'" class="option-style">'.$row["event"].' - '.$formatted_price.'</option>';

    }
} catch( PDOException $e ) {
    echo $e->getMessage();
}   
$pdo = null;
?>

<style>
    .option-style {
        background-color: #f2f2f2;
        padding: 5px 10px;
        border-radius: 5px;
        color: black;
        font-weight: bold;
    }
</style>

<select name="price">
    <?php echo $price; ?>
</select>
