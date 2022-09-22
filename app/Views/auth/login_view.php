<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/custom.css') ?>">
    <style>
        a {
            text-decoration: none;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card border-0 shadow rounded-3 my-5">
                    <div class="card-body p-4 p-sm-5">
                        <h5 class="card-title text-center mb-5 fw-light fs-5">Welcome back</h5>

                        <?php if (!empty(session()->getFlashdata('error'))) : ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <?php echo session()->getFlashdata('error'); ?>
                            </div>
                        <?php endif; ?>


                        <form method="post" action="<?= base_url(); ?>/login/process">
                            <?= csrf_field(); ?>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
                                <label for="floatingInput">Email address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                <label for="floatingPassword">Password</label>
                            </div>

                            <div class="d-grid">
                                <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit">Log
                                    in</button>
                            </div>
                            <hr class="my-4">
                            <div class="text-center">
                                <a class="small" href="<?= base_url(); ?>/register">Create an Account!</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>