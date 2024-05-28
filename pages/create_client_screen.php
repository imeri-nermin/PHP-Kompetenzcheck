<?php
require '../functions.php';
$customCssPath = "http://localhost/KPTC/style.css";
createHeader('Create Client', $customCssPath);

if (!isLoggedIn()) {
    header('Location: login_screen.php');
    exit;
}
?>

<div class="container mt-5">
    <form action="../logic/create_client.php" method="POST">
        <div class="mb-3">
            <label for="company_name" class="form-label">Company Name</label>
            <input type="text" class="form-control" id="company_name" name="company_name" required>
        </div>
        <div class="mb-3">
            <label for="contact_person" class="form-label">Contact Person</label>
            <input type="text" class="form-control" id="contact_person" name="contact_person" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <button type="submit" class="btn btn-custom btn-primary">Create Client</button>
        <a href="clients_overview.php" class="btn btn-secondary ms-2">Cancel</a>
    </form>
</div>


<?php
$customCssPath = "http://localhost/KPTC/style.css";
$footerClass = "footer-custom";
createFooter($customCssPath, $footerClass);
?>