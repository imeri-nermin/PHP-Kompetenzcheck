<?php


require '../functions.php';
$customCssPath = "http://localhost/KPTC/style.css";
createHeader('Register', $customCssPath);
?>


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Register</h3>
                    <form action="../logic/register.php" method="POST">
                        <div class="mb-3">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email address" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-custom btn-primary btn-lg btn-block">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$footerClass = "footer-custom";
createFooter($customCssPath, $footerClass);
?>