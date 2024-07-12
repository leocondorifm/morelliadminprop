<body class="bg-gradient-dark">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                                <img src="view/assets/img/molino.jpg" class="img-login" alt="...">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"><i class="fas fa-building"></i> Morelli</h1>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="text" onchange="checkUser()" class="form-control form-control-user"
                                                id="usuariologin" aria-describedby="userHelp"
                                                placeholder="Ingrese su usuario..." value="" autocomplete="off">
                                                <label class="custom-label-danger" for="userHelp" id="userHelp"></label>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="passlogin" placeholder="Contraseña" value="" onclick="showPass()" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="loginCheck">
                                                <label class="custom-control-label" for="loginCheck">Recordar en este navegador</label>
                                            </div>
                                        </div>
                                        <a id="btn-in" onclick="login()"class="btn btn-primary btn-user btn-block">
                                            <i class="fas fa-sign-in-alt"></i> Ingresar 
                                        </a>
                                    </form>
                                    <label class="custom-label-danger" for="txthelp" id="txthelp"></label>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot"><i class="fas fa-exclamation-circle"></i> ¿Olvidó su contraseña?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</body>

<script>

    document.addEventListener("DOMContentLoaded", function() {
        console.log(window.localStorage.getItem('remember'));
        if(window.localStorage.getItem('remember')===null){
            console.log('No quiere que lo recuerde');
        }else{
            console.log('Quisiera que me recuerden');
            $("#usuariologin").val(window.localStorage.getItem('user'));
            $("#passlogin").val(window.localStorage.getItem('pass'));
            $("#loginCheck").prop("checked", true);
        }
    });

</script>