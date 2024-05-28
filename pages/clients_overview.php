<?php


require '../functions.php';
$customCssPath = "http://localhost/KPTC/style.css";
createHeader('Clients Overview', $customCssPath);


if (!isLoggedIn()) {
    header('Location: login_screen.php');
    exit;
}

$clients = getClients();
?>

<div class="container mt-5">
    <h2 class="heading-custom mb-4">Clients Overview</h2>
    <div class="row">
        <div class="col">
            <a href="create_client_screen.php" class="btn btn-lg btn-primary btn-custom mb-3">Create New Client</a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Company Name</th>
                        <th>Contact Person</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clients as $client): ?>
                    <tr>
                        <td><?= htmlspecialchars($client['company_name']) ?></td>
                        <td><?= htmlspecialchars($client['contact_person']) ?></td>
                        <td><?= htmlspecialchars($client['phone']) ?></td>
                        <td><?= htmlspecialchars($client['address']) ?></td>
                        <?php if($_SESSION['user_id'] === $client['created_by']):?>
                        <td>
                            <a href="edit_client_screen.php?id=<?= $client['company_id'] ?>" class="btn btn-warning btn-sm btn-custom">Edit</a>
                            <form action="../logic/delete_client.php" method="POST" style="display:inline;">
                                <input type="hidden" name="company_id" value="<?= $client['company_id'] ?>">
                                <button type="submit" class="btn btn-danger btn-sm btn-custom">Delete</button>
                            </form>
                        </td>
                        <?php endif;?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="container mt-3">
    <a href="../logic/logout.php" class="btn btn-danger">Logout</a>
</div>


<?php
$footerClass = "footer-custom";
createFooter($customCssPath, $footerClass);
?>