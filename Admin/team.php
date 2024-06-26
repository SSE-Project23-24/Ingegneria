<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Tables</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
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
            display: inline-block;
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
<body id="page-top">

<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href=""> Area riservata</a>
    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>
    <div class="titolo"><b> GESTIONE TEAM </b> </a>

        <style>
            .titolo {
                font-size: 30px;
                color: white;
                margin-left: 30%;
            }
        </style>
    </div>

    <!-- INIZIO LOGOUT -->

    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" title="Logout" id="userDropdown" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user-circle fa-fw"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="login.html" data-toggle="modal" data-target="#logoutModal">
                        Logout </a>
                </div>
            </li>
        </ul>
    </form>

</nav>

<!-- finestra avviso-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sei sicuro di voler lasciare il sito?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Clicca "Logout" per uscire dal sito.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Annulla</button>
                <a class="btn btn-primary" href="login.php">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- FINE LOGOUT-->

<div id="wrapper">


    <!-- INIZIO SIDEBAR -->

    <ul class="sidebar navbar-nav">
        <br>
        <li class="nav-item dropdown">
            <a class="nav-link" href="index.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Home</span>
            </a>
        </li>


        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="pagesDropdown" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false" href="#">
                <i class="fas fa-fw fa-folder"></i>
                <span>Segnalazioni</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                <a class="dropdown-item" href="segnalazionii.php">
                    <center><b>INDICE SEGNALAZIONI</b></center>
                </a>
                <a class="dropdown-item" href="segnalazioniverde.php">Segnalazione su aree verdi</a>
                <a class="dropdown-item" href="segnalazionirifiuti.php">Rifiuti e pulizia stradale</a>
                <a class="dropdown-item" href="segnalazionistrade.php">Strade e marciapiedi</a>
                <a class="dropdown-item" href="segnalazionisemafori.php">Segnaletica e semafori</a>
                <a class="dropdown-item" href="segnalazioniilluminazione.php"> Illuminazione pubblica </a>
            </div>
        </li>

        <li class="nav-item active">
            <a class="nav-link " href="team.php">
                <i class="fas fa-fw fa-folder"></i>
                <span>Team</span>
            </a>
        </li>

    </ul>

    <!-- FINE SIDEBAR -->


    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            Tabella team
        </div>
        <div class="card-body">

            <div class="table-responsive" style="overflow-x: scroll;">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>CODICE TEAM</th>
                        <th>E-MAIL</th>
                        <th>COMPONENTI</th>
                    </tr>
                    </thead>

                    <?php include("php/team.php"); ?>


                </table>


                <br><br><br>

                <!-- TABELLA SEGNALAZIONI SENZA TEAM -->


                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Segnalazioni senza team
                </div>

                <br><br><br>
                <!-- Tabella -->
                <div class="table-responsive" style="overflow-x: scroll; ">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>CODICE SEGNALAZIONE</th>
                            <th>VIA</th>
                            <th>GRAVITA'</th>
                            <th>TIPO</th>
                        </tr>
                        </thead>

                        <?php include("php/team2.php"); ?>


                    </table>


                    <!-- MODIFICA TEAM -->

                    <br><br><br>

                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        Assegna una segnalazione ad un team
                    </div>

                    <form method="post" action="team.php" style="margin-top:5%; margin-left:5%">
                        <b>CODICE SEGNALAZIONE: <input type="text" name="id"><br><br></b>
                        <b>SELEZIONA L'EMAIL DEL TEAM: </b>
                        <select class="text" name="team">

                            <?php
                            $conn = mysqli_connect("localhost", "root", "", "civicsense") or die("Connessione non riuscita");

                            $selezione = mysqli_query($conn, "SELECT email_t, codice FROM team") or die(mysqli_error($conn));

                            if ($selezione) {
                                while ($array = mysqli_fetch_assoc($selezione)) {
                                    $email = htmlspecialchars($array["email_t"], ENT_QUOTES, 'UTF-8');
                                    $codice = htmlspecialchars($array["codice"], ENT_QUOTES, 'UTF-8');

                                    // da qui c'è il menù a discesa riempito con i valori del database
                                    echo "
          <option value='$codice'>$email</option>
          ";
                                }
                            }
                            ?>
                        </select>
                        <input type="submit" name="submit" class="btn btn-primary btn-block"
                               style="width:15%; margin-top:5%;">
                    </form>

                    <br><br><br>


                    <!-- ELIMINA TEAM -->

                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        Elimina un team
                    </div>

                    <form method="post" action="team.php" style=" margin-top:5%; margin-left:5%">
                        <b>CODICE TEAM DA ELIMINARE: <input type="text" name="cod"><br><br></b>
                        <input type="submit" name="submit2" class="btn btn-primary btn-block"
                               style="width:15%; margin-top:5%;">
                    </form>
                    <?php include("php/cancellateam.php"); ?>

                    <br><br><br>


                    <!-- INSERIMENTO TEAM -->

                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        Inserisci un nuoto team
                    </div>

                    <form method="post" action="team.php" style="margin-top:5%; margin-left:5%">
                        <b>E-MAIL TEAM:</b> <input type="email" id="inputEmail" name="email"><br><br>
                        <b>NOMI E COGNOMI DEI COMPONENTI:</b> <input type="text" id="nomi" name="nomi"><br><br>
                        <b>NUMERO DI COMPONENTI: </b> <input type="number" id="numero" name="numero"><br><br>
                        <b>PASSWORD:</b>
                        <div class="password-container">
                            <input type="password" id="inputPassword" name="inputPassword" autocomplete="off">
                            <i class="fas fa-eye password-toggle" id="togglePassword" onclick="togglePasswordVisibility('inputPassword', 'togglePassword')"></i>
                        </div>
                        <br>
                        <div id="passwordStrength" class="mt-2"></div>

                        <b>CONFIRM PASSWORD:</b>
                        <div class="password-container">
                            <input type="password" id="confirmPassword" name="confirmPassword" autocomplete="off">
                            <i class="fas fa-eye password-toggle" id="toggleConfirmPassword" onclick="togglePasswordVisibility('confirmPassword', 'toggleConfirmPassword')"></i>
                        </div>
                        <br>
                        <input type="submit" name="submit3" id="submit-button" class="btn btn-primary btn-block" style="width:15%; margin-top:5%;" disabled>
                    </form>

                    <?php

                    $conn = mysqli_connect("localhost", "root", "", "civicsense") or die("Connessione non riuscita");

                    $email = (isset($_POST['email'])) ? $_POST['email'] : null;
                    $nomi = (isset($_POST['nomi'])) ? $_POST['nomi'] : null;
                    $numeri = (isset($_POST['numero'])) ? $_POST['numero'] : null;
                    $pass = (isset($_POST['inputPassword'])) ? $_POST['inputPassword'] : null;

                    if (isset($_POST['submit3'])) {
                        if ($email && $nomi && $numeri && $pass !== null) {
                            $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

                            $stmt = $conn->prepare("INSERT INTO team (email_t, npersone, nomi, password) VALUES (?, ?, ?, ?)");
                            $stmt->bind_param("siss", $email, $numeri, $nomi, $hashedPass);
                            $stmt->execute();

                            if ($stmt->affected_rows > 0) {
                                echo("<b><br><p> <center> <font color=black font face='Courier'> Inserimento avvenuto correttamente! Ricarica la pagina per vedere la tabella aggiornata!</p></b></center>");
                            } else {
                                echo("<p> <center> <font color=black font face='Courier'>Errore nell'inserimento dei dati.</p></b></center>");
                            }
                        } else {
                            echo("<p> <center> <font color=black font face='Courier'>Compila tutti i campi.</p></b></center>");
                        }
                    }

                    ?>
                </div>

                <!-- Bootstrap core JavaScript-->
                <script src="vendor/jquery/jquery.min.js"></script>
                <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

                <!-- Core plugin JavaScript-->
                <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

                <!-- Page level plugin JavaScript-->
                <script src="vendor/datatables/jquery.dataTables.js"></script>
                <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

                <!-- Custom scripts for all pages-->
                <script src="js/sb-admin.min.js"></script>

                <!-- Demo scripts for this page-->
                <script src="js/demo/datatables-demo.js"></script>
                <script type="application/javascript">
                    document.getElementById('inputPassword').addEventListener('input', function () {
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

                    document.getElementById('confirmPassword').addEventListener('input', function () {
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
                        var nomi = document.getElementById('nomi').value;
                        var numero = document.getElementById('numero').value;
                        var password = document.getElementById('inputPassword').value;
                        var confirmPassword = document.getElementById('confirmPassword').value;
                        var submitButton = document.getElementById('submit-button');

                        if (email && nomi && numero && password && confirmPassword && password === confirmPassword) {
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
                    document.getElementById('nomi').addEventListener('input', checkRegistrationButton);
                    document.getElementById('numero').addEventListener('input', checkRegistrationButton);
                    document.getElementById('inputPassword').addEventListener('input', checkRegistrationButton);
                    document.getElementById('confirmPassword').addEventListener('input', checkRegistrationButton);
                </script>
</body>

</html>
