<?php


require '../functions.php';
$customCssPath = "http://localhost/KPTC/style.css";
createHeader('Edit Client', $customCssPath);

if (!isLoggedIn()) {
    header('Location: login_screen.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: clients_overview.php');
    exit;
}

$client = getClientById($_GET['id']);
if (!$client) {
    echo "Client not found.";
    exit;
}
?>

<div class="container mt-5">
    <form action="../logic/edit_client.php" method="POST">
        <input type="hidden" name="client_id" value="<?php echo $client['company_id']; ?>">
        <div class="mb-3">
            <label for="company_name" class="form-label">Company Name</label>
            <input type="text" class="form-control" id="company_name" name="company_name" value="<?php echo htmlspecialchars($client['company_name']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="contact_person" class="form-label">Contact Person</label>
            <input type="text" class="form-control" id="contact_person" name="contact_person" value="<?php echo htmlspecialchars($client['contact_person']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($client['phone']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($client['address']); ?>" required>
        </div>
        <button type="submit" class="btn btn-custom btn-primary">Save</button>
        <a href="clients_overview.php" class="btn btn-secondary ms-2">Cancel</a>
    </form>
</div>

<?php
createFooter("footer-custom");
?>