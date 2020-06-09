<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Gerador</title>
        <link media="screen" type="text/css" rel="stylesheet" href="css/estilo.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">  
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>
    <body style="background-color: #eaf0f7; color: #50649c;">
        <div class="page-wrapper">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="col-12 align-self-center">
                        <div class="auth-page">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Gerador</h3>
                                    <form action="listaTabelas.php" method="post">
                                        <h5>Banco de Dados</h5>
                                        <p>Digite os dados de acesso ao banco de dados:</p>
                                        <div class="form-group">
                                            <b>Hostname:</b><br />
                                            <input type="text" name="hostname" class="form-control"/>
                                        </div>
                                        <div class="form-group">
                                            <b>Username:</b><br />
                                            <input type="text" name="username" class="form-control"/>
                                        </div>
                                        <div class="form-group">
                                            <b>Password:</b><br />
                                            <input type="text" name="password" class="form-control"/>
                                        </div>
                                        <div class="form-group">
                                            <b>Banco de Dados:</b><br />
                                            <input type="text" name="database" class="form-control"/> 
                                        </div>
                                        <div class="form-group" style="float:right">
                                            <input type="submit" class="btn btn-primary" value="Conectar!" />
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted" style="float:right;">Copyright <?php echo date("Y");?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <style type="text/css">
        .align-self-center {
            -ms-flex-item-align: center!important;
            align-self: center!important;
        }
        .auth-page {
            max-width: 460px;
            position: relative;
            margin: 0 auto;
            top: 2.5em;
        }
    </style>
</html>
