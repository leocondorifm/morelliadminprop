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
                            <img src="view/assets/img/updatepass.jpg" class="img-login" alt="...">
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
                                            <input 
                                                type="text" 
                                                class="form-control form-control-user"
                                                id="pass1" 
                                                aria-describedby="Password"
                                                placeholder="Ingrese tu contraseña"
                                                onclick="viewPass(1)"
                                            >
                                        </div>
                                        <div class="form-group">
                                            <input 
                                                type="text" 
                                                class="form-control form-control-user"
                                                id="pass2" 
                                                aria-describedby="Password"
                                                placeholder="Ingrese tu contraseña"
                                                onclick="viewPass(2)"
                                            >
                                        </div>
                                        
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <label class="custom-label-danger" for="setPass" id="infoSetPass" style="display:none"></label>
                                    </div>
                                    <div class="text-center">
                                        <a href="javascript:setPassword()" class="btn btn-primary btn-user btn-block" id="updateBtn">
                                            <i class="fas fa-unlock-alt"></i> Actualizar contraseña 
                                        </a>
                                        <a href="#" class="btn btn-primary btn-circle" id="number" style="display:none">
                                        
                                        </a>
                                        
                                    </div>
                                    <?php 
                                        $requestUri = $_SERVER['REQUEST_URI'];
                                        $uri_url = explode('=', $_SERVER['REQUEST_URI']);
                                        $hash = $uri_url[1];
                                        $mail = $uri_url[2];
                                    ?>
                                    <input type="hidden" id="uri_hash" value="<?php echo $hash; ?>">
                                    <input type="hidden" id="uri_mail" value="<?php echo $mail; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

<script>
    /*var n = 3;
    var l = document.getElementById("number");
    window.setInterval(function(){
        l.innerHTML = n;
        
        n--;
    },1000);*/
</script>

</body>