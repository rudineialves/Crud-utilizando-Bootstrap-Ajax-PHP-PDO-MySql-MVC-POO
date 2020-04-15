<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8"/>
        <title>Crud utilizando Bootstrap - Ajax - PHP - PDO - MySql - MVC - POO</title> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap/js/bootstrap.min.js"></script>
        <script src="js/toastr/toastr.min.js"></script>
        <script src="js/plugins.config.js"></script>

        <link type="text/css" rel="stylesheet" href="js/bootstrap/css/bootstrap.min.css"/>
        <link type="text/css" rel="stylesheet" href="js/toastr/toastr.min.css"/>
        <link type="text/css" rel="stylesheet" href="css/application.css" />
    </head>
    <body>        
        <div class="page">
            <div class="page-main">                
                <!-- conteúdo - pode ser carregado dinamicamente quando utilizando urls amigáveis -->
                <?php include_once('views/users.php'); ?>
            </div>
        </div>        
    </body>
</html>
