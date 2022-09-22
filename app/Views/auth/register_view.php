<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url('/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/css/custom.css') ?>">
    <style>
        a {
            text-decoration: none;
        }
    </style>
</head>

<body class="d-flex flex-column h-100">

    <!-- Begin page content -->
    <main class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5">Register Form</h1>
            Silahkan Daftarkan Identitas Anda
            <hr />
            <?php if (!empty(session()->getFlashdata('error'))) : ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <h4>Periksa Entrian Form</h4>
                    </hr />
                    <?php echo session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>
            <form method="post" action="<?= base_url(); ?>/register/process">
                <?= csrf_field(); ?>
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="password_conf" name="password_conf">
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
            <hr />
            <div>
                <a class="small" href="<?= base_url(); ?>/login">Already have an account? Login!</a>
            </div>

        </div>
    </main>

    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <span class="text-muted">Copyright &copy; M. Noval Hidayat <?= date('Y'); ?></span>
        </div>
    </footer>
</body>

</html>