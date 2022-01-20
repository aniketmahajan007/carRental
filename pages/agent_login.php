<?php
require_once "./header.php";
?>
<link rel="stylesheet" href="../assets/css/login.css">
<link rel="stylesheet" href="../assets/css/ajax.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/166fefca87.js" crossorigin="anonymous"></script>

<html>

<head>
    <script src="../js/my_javascript.js"></script>
    <script>
        $(document).on('click', '#signupBtn', function() {
            var name = $('#name').val();
            var email = $('#email').val();
            var pass = $('#pass').val();
            var repass = $('#re-pass').val();

            if (Empty_check('signup'))
                alert("Enter Required Details");
            else {
                if (ValidateEmail(email)) {
                    if (Pass_check(pass, repass)) {
                        $.ajax({
                            url: "../ajax_server/agent_register.php",
                            data: $("#signup").serialize(),
                            type: 'post',
                            success: function(response) {
                                alert(response);
                                if (response.trim() == "Registration Successful") {
                                    document.getElementById("signup").reset();
                                }
                            },
                        });

                    } else
                        alert("Passwords Don't Match");
                } else
                    alert("Enter Valid Email");
            }
        });


        $(document).on('click', '#loginBtn', function() {
            if (Empty_check('login'))
                alert("Enter Required Details");
            else {
                $.ajax({
                    url: "../ajax_server/agent_login.php",
                    data: $("#login").serialize(),
                    type: 'post',
                    success: function(response) {
                        if (response == 0)
                            alert("Enter Valid Login Details");
                        else
                            window.open("http://internshalacarrental.epizy.com/index.php", "_self");
                    }
                });
            }
        });
    </script>
</head>

<body>
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col text-center">
                <div class="forms">
                    <ul class="tab-group">
                        <li class="tab active"><a href="#login">Log In</a></li>
                        <li class="tab"><a href="#signup">Sign Up</a></li>
                    </ul>
                    <form id="login">
                        <h1>Agent Login</h1>
                        <div class="input-field">
                            <label for="email">Email</label>
                            <input type="email" name="email" required="email" />
                            <label for="password">Password</label>
                            <input type="password" name="password" required />
                            <input type="button" id="loginBtn" value="Login" class="button" />
                        </div>
                    </form>
                    <form id="signup">
                        <h1>Agent Registration</h1>
                        <div class="input-field">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" required="name" />
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required="email" />
                            <label for="password">Password</label>
                            <input type="password" id="pass" name="password" required />
                            <label for="re-password">Confirm Password</label>
                            <input type="password" id="re-pass" name="re-password" required />
                            <input type="button" id="signupBtn" value="Sign up" class="button" />
                        </div>
                    </form>
                </div>

                <script type="text/javascript">
                    $(document).ready(function() {
                        $('.tab a').on('click', function(e) {
                            e.preventDefault();

                            $(this).parent().addClass('active');
                            $(this).parent().siblings().removeClass('active');

                            var href = $(this).attr('href');
                            $('.forms > form').hide();
                            $(href).fadeIn(500);
                        });
                    });
                </script>
            </div>
        </div>

    </div>
</body>

</html>