<?php include '../view/header.php'; ?>
<main>
    <h1>Error</h1>
    <div class="error-messages">
        <?php if (isset($errors) && !empty($errors)) : ?>
            <p>The following errors occurred:</p>
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <p><a href="?action=show_add_form">Go Back</a></p>
</main>
<?php include '../view/footer.php'; ?>