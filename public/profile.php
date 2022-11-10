<?php
require $_SERVER['DOCUMENT_ROOT'] . '/app/core.php';

if (!isset($_SESSION['email'])) {
    setFlashMessage('danger', 'Необходима авторизация.');
    redirect("/public/authorization.php");
    exit;
}

if (empty($_GET)) {
    setFlashMessage('danger', 'Не выбран пользователь.');
    redirect("/public/users.php");
    exit;
}

$user = getUserById($pdo, $_GET['id']);

$title = "Профиль";

require $_SERVER['DOCUMENT_ROOT'] . '/public/templates/header.php';
?>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-user'></i><?= $user['name'] ?>
    </h1>
</div>
<div class="row">
    <div class="col-lg-6 col-xl-6 m-auto">
        <!-- profile summary -->
        <div class="card mb-g rounded-top">
            <div class="row no-gutters row-grid">
                <div class="col-12">
                    <div class="d-flex flex-column align-items-center justify-content-center p-4">
                        <img src="/upload/<?= $user['photo'] ?>" width="150" class="rounded-circle shadow-2 img-thumbnail" alt="">
                        <h5 class="mb-0 fw-700 text-center mt-3">
                            <?= $user['name'] ?>
                            <small class="text-muted mb-0"><?= $user['position'] ?></small>
                        </h5>
                        <div class="mt-4 text-center demo">
                            <a href="<?= $user['ig'] ?>" class="fs-xl" style="color:#C13584">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="<?= $user['vk'] ?>" class="fs-xl" style="color:#4680C2">
                                <i class="fab fa-vk"></i>
                            </a>
                            <a href="<?= $user['tg'] ?>" class="fs-xl" style="color:#0088cc">
                                <i class="fab fa-telegram"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="p-3 text-center">
                        <a href="tel:+13174562564" class="mt-1 d-block fs-sm fw-400 text-dark">
                            <i class="fas fa-mobile-alt text-muted mr-2"></i><?= $user['phone'] ?></a>
                        <a href="mailto:oliver.kopyov@marlin.ru" class="mt-1 d-block fs-sm fw-400 text-dark">
                            <i class="fas fa-mouse-pointer text-muted mr-2"></i><?= $user['email'] ?></a>
                        <address class="fs-sm fw-400 mt-4 text-muted">
                            <i class="fas fa-map-pin mr-2"></i><?= $user['address'] ?>
                        </address>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
</body>

<script src="js/vendors.bundle.js"></script>
<script src="js/app.bundle.js"></script>
<script>
    $(document).ready(function() {

    });
</script>

</html>