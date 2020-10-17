<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>SIGEL :. Inicia Sesión</title>

    <!-- Bootstrap core CSS -->
<link href="../assets/css/bootstrap.min.css" rel="stylesheet">

<meta name="theme-color" content="#563d7c">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="../resources/css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
      <div class="error">
                  <span>Usuario y/o contraseña incorrectos</span>
              </div>
              
    <form class="form-signin">
        <img class="mb-4" src="../resources/images/logo.png" alt="" width="200" height="200">
  <h1 class="h3 mb-3 font-weight-normal">Acceso al sistema</h1>
  <label for="inputEmail" class="sr-only">Email address</label>
  <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
  <label for="inputPassword" class="sr-only">Password</label>
  <input type="password" id="inputPassword" class="form-control" placeholder="Password" pattern="[A-Za-z0-9_-]{1,30}" required>
  <button class="btn btn-lg btn-primary btn-block" id="btn-ingresar">Sign in</button>
 
</form>
<p id="texto-actual"></p>
<script src="../resources/js/jquery.min.js"></script>
<script src="../resources/js/bootstrap.min.js"></script>
<script defer>
    //all javascript
    $('.form-signin').submit(function(e) {
        e.preventDefault();

        $.ajax({
            url: '../controllers/UsuarioController.php',
            type: 'post',
            data: {param1: 'checkUser', param2: $('#inputEmail').val(), param3:$('#inputPassword').val(), 
         },
          dataType: 'json',
        })
        .done(function(response) {
            if(response.success==true){
                       if(response.rol_id=="1"){
                    //Para el administrador
                    location.href='usuarioc/production/inicio.php';
                    }
            if(response.rol_id=="2"){
                    //Para el administrador
                    location.href='usuarioc/production/inicio.php';
                    }
            if(response.rol_id=="3"){
                    //Para el administrador
                    location.href='usuarioc/production/auditoriasDoumentos.php';
                    }
           if(response.rol_id=="4"){
                    //Para el administrador
                    location.href='usuarioc/production/no_conformidades.php';
                    }
            if(response.rol_id=="5"){
                    //Para el administrador
                    location.href='usuarioc/production/auditoriasDoumentos.php';
                    
                    }
                
            }
             else{
                        $('.error').slideDown('slow');
                    setTimeout(function (){
                          $('.error').slideUp('slow');
                    }, 3000);
                        
                    }
                    
        })
        .fail(function(response) {
            console.log("error"+response);
        });

    });
      
</script>


</body>
</html>




