<?php
session_start();
$error = $_SESSION['login_error'] ?? null;
unset($_SESSION['login_error']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SIMON</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="/Silab-v3/public/admin_template/img/QC.png" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>

    <style>
        body {
            background: url('/Silab-v3/public/landing_template/img/kebonagung.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Montserrat', sans-serif;
        }
        .login-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-card {
            background: rgba(255,255,255,.92);
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,.25);
            padding: 30px;
            width: 100%;
            max-width: 420px;
        }
    </style>
</head>

<body>

<div class="login-container">
    <div class="login-card">
        <h3 class="text-center mb-0">SIMON</h3>
        <h6 class="text-center mb-4">Sistem Monitoring Dalam Pabrik</h6>

        <form method="POST" action="login_process.php">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control"
                       required autofocus>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" name="password" id="password"
                           class="form-control" required>
                    <span class="input-group-text" id="togglePassword">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
            </div>

            <button class="btn btn-info w-100 text-dark fw-semibold">
                <i class="fas fa-sign-in-alt me-2"></i> Login
            </button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
const toggle = document.getElementById('togglePassword');
const password = document.getElementById('password');

toggle.addEventListener('click', () => {
    const icon = toggle.querySelector('i');
    if (password.type === 'password') {
        password.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        password.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
});
</script>

<?php if ($error): ?>
<script>
Swal.fire({
    icon: 'error',
    title: 'Login gagal',
    text: '<?= htmlspecialchars($error) ?>'
});
</script>
<?php endif; ?>

</body>
</html>
