<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>

    <title>Accueil Administrateur</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="../js/fonctionsUtiles.js"></script>

    <style>

        body {
            background-color: #F7F7F9;
        }

        #wrapper {
            position: absolute;
            top: 25%;
            width: 100%;
        }

        form {
            border: 2px solid lightgrey;
            padding-top: 40px;
            padding-bottom: 20px;
            padding-left: 40px;
        }
    </style>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#formAjout').on('submit', function(e) {
                //e.preventDefault();
                //console.log($('#user').val());
                $.ajax({
                    type: "POST",
                    url: "adminAccueil.php",
                    data : { login : "'"+$('#user').val()+"'", mdp : "'"+$('#mdp').val()+"'", statut : "'"+$('#statut').val()+"'"},

                    async: false,
                    dataType: 'json',
                    success: function (data)
                    {
                        //Mauvais identifiants
                        if(data.length == 0){
                            $('#accueil').append("<p>Mauvais identifiants </p>");
                            $('#echec').show().delay(1000).fadeOut(500);
                            console.log("erreur de mdp ou id");
                            console.log(data);
                        }
                        //Bons identifiants
                        else{
                            console.log(data);
                            $('#succes').show().delay(1000).fadeOut(500);
                            $('#accueil').append("<p>"+data[0].UserName+" , mdp : "+data[0].Password+"</p>");
                            //window.location.href="index.php";
                        }
                    }
                });


            });
            $('.alert').hide();
        });


    </script>

</head>

<body>
<div class="container" id="wrapper">

        <form id="formAjout" class="form-horizontal" role="form" method="post" action="../index.php">
            <div class="form-group" >
                <div class="col-sm-8">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input id ="user" name="login" type="text" class="form-control" placeholder="Utilisateur">
                    </div>
                </div>


            </div>
            <div class="form-group">
                <div class="col-sm-8">
                    <div class="input-group">

                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <input id ="mdp" name="password" type="password" class="form-control" placeholder="Mot de passe">
                    </div>
                </div>


            </div>

            <div class="form-group">
                <div class="col-sm-8">
                    <div class="input-group">
                        <select id="statut" name="statut" class="form-control">
                            <option>Administrateur</option>
                            <option>Evaluateur</option>
                        </select>
                    </div>
                </div>

            </div>

            <input Type="submit" name="submit" Value="Connexion" class="btn btn-primary">


        </form>

        <div id="echec" class="alert alert-danger">Echec de la connexion.</div>

        <div id="succes" class="alert alert-success">Connexion valide !</div>
</div>
</body>

</html>