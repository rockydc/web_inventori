<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>web-inventori</title>
    <link rel="stylesheet" href="<?= base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/mloureiro1973-login.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/mloureiro1973-login-1.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/untitled.compiled.css">
</head>

<body>
    <div class="login-card">
        <div>
            <h2 class="text-center"><img src="<?= base_url(); ?>assets/img/eureka.png">&nbsp;</h2>
        </div>
        <p class="profile-name-card"> </p>
        <form class="form-signin" action="<?= base_url() ?>Login/aksi_login" method="post"><input class="form-control" type="text" name="username" required="" placeholder="username" autofocus=""><input class="form-control" type="password" id="inputPassword" name="password" required="" placeholder="Password">
            <button class="btn btn-primary btn-block btn-lg btn-signin" name="login" type="submit">Login </button>
        </form>
        </form>
        <?php if ($this->session->flashdata('flash')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                username atau password <strong> salah</strong> <?php echo $this->session->flashdata('flash'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
    </div>
    <script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="<?= base_url(); ?>assets/js/theme.js"></script>
</body>

</html>