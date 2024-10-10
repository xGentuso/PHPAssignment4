<?php include '../view/header.php'; ?>
<main>
    <p><?php echo isset($_SESSION['error_message']) ? htmlspecialchars($_SESSION['error_message']) : 'An unknown error occurred.'; ?></p>
</main>
<?php include '../view/footer.php'; ?>