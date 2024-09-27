<!DOCTYPE html>
<html>
    <head>
        <title>  To Do App </title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
        <style type="text/css">
            @import url(https://fonts.googleapis.com/css?family=Raleway:300,400,600);
            body{
                margin: 0;
                font-size: .9rem;
                font-weight: 400;
                line-height: 1.6;
                color: #212529;
                text-align: left;
                background-color: #f5f8fa;
            }
            .navbar-laravel{
                box-shadow: 0 2px 4px rgba(0,0,0,.04);
            }
            .navbar-brand , .nav-link, .my-form, .login-form{
                font-family: Raleway, sans-serif;

            }
            .my-form{
                padding-top: 1.5rem;
                padding-bottom: 1.5rem;
            }
            .my-form .row{
                margin-left: 0;
                margin-right: 0;
            }
            .login-form{
                padding-top: 1.5rem;
                padding-bottom: 1.5rem;
            }
            .login-form .row{
                margin-left: 0;
                margin-right: 0;
            }

            .menu_ul {
                list-style-type: none;
                margin: 0;
                padding: 0;
                overflow: hidden;
                background-color: #333;
            }
            .menu_li {
                float: left;
            }
            .menu_li a {
                display: block;
                color: white;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
            }
            .menu_li a:hover:not(.active) {
                background-color: #111;
            }
            .active {
                background-color: #04AA6D;
            }
            .error{
                color: red;
                margin-top: 4px;
            }
            .card {
                margin-top: 30px !important;
            } 
          
        </style>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    </head>
    <body>

        <nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
            <div class="container">
            <a class="navbar-brand"  href="#" style="color:#000;text-align: center; margin-left:10%;font-weight: bold;">To Do App</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('logout')); ?>">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <section class="content" style="margin-top: 20px;">
                <div class="container-fluid">
                    <div class="row">
                       
                       
                    <div class="col-md-12">
                      
                        <div class="card card-primary">
                            
                           <?php echo $__env->yieldContent('content'); ?> 

                        </div>
                    </div>   
                    </div>
                </div>
            </section>    
        </div> 
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
        <?php echo $__env->yieldContent('scripts'); ?>
    </body>
</html><?php /**PATH C:\xampp\htdocs\projects\todo-app\resources\views/dashboard.blade.php ENDPATH**/ ?>