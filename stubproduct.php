<?php
// Check to make sure the id parameter is specified in the URL
if (isset($_GET['id'])) {
    // Prepare statement and execute, prevents SQL injection
    $stmt = $pdo->prepare('SELECT * FROM stubble WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    // Fetch the product from the database and return the result as an Array
    $stubble = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if (!$stubble) {
        // Simple error to display if the id for the product doesn't exists (array is empty)
        exit('Product does not exist!');
    }
} else {
    // Simple error to display if the id wasn't specified
    exit('Product does not exist!');
}
?>
<?=template_header('Product')?>

<div class="product content-wrapper">
    <img src="imgs/<?=$stubble['img']?>" width="500" height="500" alt="<?=$stubble['name']?>">
    <div>
        <h1 class="name"><?=$stubble['name']?></h1>
        <span class="price">
            &dollar;<?=$stubble['price']?>
            <?php if ($stubble['rrp'] > 0): ?>
            <span class="rrp">&dollar;<?=$stubble['rrp']?></span>
            <?php endif; ?>
        </span>
        <form action="stubindex.php?page=stubcart" method="post">
            <input type="number" name="quantity" value="1" min="1" max="<?=$stubble['quantity']?>" placeholder="Quantity" required>
            <input type="hidden" name="product_id" value="<?=$stubble['id']?>">
            <input type="submit" value="Add To Cart">
        </form>
        <div class="description">
            <?=$stubble['desc']?>
        </div>
    </div>
</div>

<?=template_footer()?>