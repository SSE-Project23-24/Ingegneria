<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin - Change Team Password</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin.css" rel="stylesheet">
    <style>
        .strength-weak {
            color: red;
        }
        .strength-medium {
            color: orange;
        }
        .strength-strong {
            color: green;
        }
    </style>
    <style>
        .password-container {
            position: relative;
        }
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>
<body class="bg-dark">
<div class="container">
    <div class="card card-register mx-auto mt-5">
        <div class="card-header">Cambia la password del team</div>
        <div class="card-body">
            <form action="registrateam.php" method="POST">
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email" required="required">
                        <label for="inputEmail">Email</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="password" name="old_password" id="oldPassword" class="form-control" placeholder="Vecchia Password" required="required" autocomplete="off">
                        <label for="oldPassword">Vecchia Password</label>
                        <i class="fas fa-eye password-toggle" id="toggleConfirmPassword" onclick="togglePasswordVisibility('oldPassword', 'toggleOldPassword')"></i>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group password-container">
                                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required="required" autocomplete="off">
                                <label for="inputPassword">Password</label>
                                <i class="fas fa-eye password-toggle" id="togglePassword" onclick="togglePasswordVisibility('inputPassword', 'togglePassword')"></i>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-label-group password-container">
                                <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm password" required="required" autocomplete="off">
                                <label for="confirmPassword">Conferma la password</label>
                                <i class="fas fa-eye password-toggle" id="toggleConfirmPassword" onclick="togglePasswordVisibility('confirmPassword', 'toggleConfirmPassword')"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="passwordStrength" class="mt-2"></div>
                <button type="submit" id="submit-button" class="btn btn-primary btn-block" disabled>Cambia Password</button>
            </form>
        </div>
    </div>
</div>

<script type="application/javascript">
    
    document.getElementById('inputPassword').addEventListener('input', function() {
        var password = this.value;
        var strengthText = '';
        var strengthClass = '';
        var strength = 0;

        if (password.length >= 8) strength++;
        if (password.length >= 12) strength++;
        if (password.match(/[a-z]/)) strength++;
        if (password.match(/[A-Z]/)) strength++;
        if (password.match(/[0-9]/)) strength++;
        if (password.match(/[^a-zA-Z0-9]/)) strength++;

        if (strength <= 2) {
            strengthText = 'Password debole';
            strengthClass = 'strength-weak';
        } else if (strength <= 4) {
            strengthText = 'Password media';
            strengthClass = 'strength-medium';
        } else {
            strengthText = 'Password forte';
            strengthClass = 'strength-strong';
        }

        var strengthDiv = document.getElementById('passwordStrength');
        strengthDiv.innerText = strengthText;
        strengthDiv.className = strengthClass;
    });

    document.getElementById('confirmPassword').addEventListener('input', function() {
        var confirmPassword = this.value;
        var password = document.getElementById('inputPassword').value;
        if (confirmPassword === password) {
            this.style.borderColor = 'green';
        } else {
            this.style.borderColor = 'red';
        }
    });
</script>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>
</html>

<script>
    document.getElementById('inputPassword').addEventListener('input', function() {
        var password = this.value;
        var strengthText = '';
        var strengthClass = '';
        var strength = 0;

        if (password.length >= 8) strength++;
        if (password.length >= 12) strength++;
        if (password.match(/[a-z]/)) strength++;
        if (password.match(/[A-Z]/)) strength++;
        if (password.match(/[0-9]/)) strength++;
        if (password.match(/[^a-zA-Z0-9]/)) strength++;

        if (strength <= 2) {
            strengthText = 'Password debole';
            strengthClass = 'strength-weak';
        } else if (strength <= 4) {
            strengthText = 'Password media';
            strengthClass = 'strength-medium';
        } else {
            strengthText = 'Password forte';
            strengthClass = 'strength-strong';
        }

        var strengthDiv = document.getElementById('passwordStrength');
        strengthDiv.innerText = strengthText;
        strengthDiv.className = strengthClass;
    });

    document.getElementById('confirmPassword').addEventListener('input', function() {
        var confirmPassword = this.value;
        var password = document.getElementById('inputPassword').value;
        if (confirmPassword === password) {
            this.style.borderColor = 'green';
        } else {
            this.style.borderColor = 'red';
        }
    });

    function checkRegistrationButton() {
        var email = document.getElementById('inputEmail').value;
        var oldPassword = document.getElementById('oldPassword').value;
        var password = document.getElementById('inputPassword').value;
        var confirmPassword = document.getElementById('confirmPassword').value;
        var submitButton = document.getElementById('submit-button');

        if (email && oldPassword && password && confirmPassword && password === confirmPassword) {
            submitButton.disabled = false;
        } else {
            submitButton.disabled = true;
        }
    }

    function togglePasswordVisibility(inputId, toggleId) {
        var inputField = document.getElementById(inputId);
        var toggleIcon = document.getElementById(toggleId);
        if (inputField.type === "password") {
            inputField.type = "text";
            toggleIcon.classList.remove("fa-eye");
            toggleIcon.classList.add("fa-eye-slash");
        } else {
            inputField.type = "password";
            toggleIcon.classList.remove("fa-eye-slash");
            toggleIcon.classList.add("fa-eye");
        }
    }

    document.getElementById('inputEmail').addEventListener('input', checkRegistrationButton);
    document.getElementById('oldPassword').addEventListener('input', checkRegistrationButton);
    document.getElementById('inputPassword').addEventListener('input', checkRegistrationButton);
    document.getElementById('confirmPassword').addEventListener('input', checkRegistrationButton);
</script>
</script>
<?php
$conn = mysqli_connect("localhost", "root", "", "civicsense") or die("Connessione non riuscita");

$email = isset($_POST['email']) ? $_POST['email'] : null;
$old_pass = isset($_POST['old_password']) ? $_POST['old_password'] : null;
$new_pass = isset($_POST['password']) ? $_POST['password'] : null;

if ($email && $old_pass && $new_pass !== null) {
    $stmt = $conn->prepare("SELECT codice, email_t, npersone, nomi, password FROM team WHERE email_t = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        exit('No rows');
    }

    $stmt->bind_result($codice, $stored_email, $npersone, $nomi, $stored_hash);
    $stmt->fetch();

    if (password_verify($old_pass, $stored_hash)) {
        if (validate_password($new_pass)) {
            $hashed_password = password_hash($new_pass, PASSWORD_DEFAULT);

            $update_stmt = $conn->prepare("UPDATE team SET password = ? WHERE email_t = ?");
            $update_stmt->bind_param("ss", $hashed_password, $email);
            $update_stmt->execute();

            if ($update_stmt->affected_rows > 0) {
                echo("<br><b><br><p> <center> <font color=white font face='Courier'> Password aggiornata! Clicca su <a href='login.php'>Login</a> per accedere. </b></center></p><br><br> ");
            } else {
                echo("<br><b><br><p> <center> <font color=white font face='Courier'> Errore nell'aggiornamento della password. </b></center></p><br><br> ");
            }
            $update_stmt->close();
        } else {
            echo("<br><b><br><p> <center> <font color=white font face='Courier'> La nuova password non è valida. </b></center></p><br><br> ");
        }
    } else {
        echo("<br><b><br><p> <center> <font color=white font face='Courier'> Vecchia password errata. </b></center></p><br><br> ");
    }

    $stmt->close();
}
$conn->close();

function validate_password($password): bool
{
    $strength = 0;

    if (strlen($password) >= 8) $strength++;
    if (strlen($password) >= 12) $strength++;
    if (preg_match('/[a-z]/', $password)) $strength++;
    if (preg_match('/[A-Z]/', $password)) $strength++;
    if (preg_match('/[0-9]/', $password)) $strength++;
    if (preg_match('/[^a-zA-Z0-9]/', $password)) $strength++;

    return $strength >= 3;
}
?>


<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

