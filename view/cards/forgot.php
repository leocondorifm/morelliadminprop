<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image">
                            <img src="view/assets/img/password.jpg" class="img-login" alt="...">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">¿Olvidó su contraseña?</h1>
                                        <p class="mb-4">Sólo tienes que introducir tu dirección de correo electrónico a continuación
                                        ¡Y te enviaremos un enlace para restablecer tu contraseña!!</p>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="emailreset" aria-describedby="emailHelp"
                                                placeholder="Ingrese su email..." onchange="resetPass()">
                                                <label class="custom-label-danger" for="emailreset" id="emailresetHelp"></label>
                                                <p id="procesing" style="display:none"><i class="fas fa-spinner fa-spin"></i></p>
                                        </div>
                                        <a href="javascript:changePass()" class="btn btn-primary btn-user btn-block" id="getReset" style="display:none">
                                            <i class="fas fa-unlock-alt"></i> Cambiar contraseña
                                        </a>
                                        
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="start"><i class="fas fa-exclamation-triangle"></i> ¿Ya tenés una cuenta? Entrá desde acá..</a>
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