<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/css/adminlte.min.css') ?>">
</head>
<body class="hold-transition login-page">

<div class="login-box">
    <div class="card">
        <div class="card-body">

            <h3 class="text-center">Forgot Password</h3>

            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= $this->session->flashdata('error') ?>
                </div>
            <?php endif; ?>

            <form method="post"
                  action="<?= base_url('auth/process_forgot_password') ?>">

                <div class="form-group">
                    <label>Email</label>
                    <input type="email"
                           name="email"
                           class="form-control"
                           required>
                </div>

                <button type="submit"
                        class="btn btn-primary btn-block">
                    Reset Password
                </button>

            </form>

            <br>

            <a href="<?= base_url('login') ?>">
                Kembali ke Login
            </a>

        </div>
    </div>
</div>

</body>
</html>