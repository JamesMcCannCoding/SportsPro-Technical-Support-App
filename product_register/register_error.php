<?php
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
?>

<?php include '../view/header.php'; ?>
<main>
    <h1>error</h1>
    <p>The registration failed.</p>

    <nav>
        <p>
            <a href="index.php?action=register_product_form" class="btn btn-primary">Go back</a>
        </p>
    </nav>
   
</main>
<?php include '../view/footer.php'; ?>
