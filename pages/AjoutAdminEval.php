<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8" />
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <script src="http://code.jquery.com/jquery-latest.min.js"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

        <script type="text/javascript">

            $(document).ready(function () {

                function ajoutAdmin(nom, mdp, statut) {
                    $.ajax({
                        type: "POST",
                        url: "requeteAjoutAdmin.php",
                        data: {NomU: "'" + nom + "'", MdpU: "'" + mdp + "'", Statut: "'" + statut + "'"},
                        async: false,
                        dataType: 'json',
                        success: function (data)
                        {
                                console.log("insertion réussie");
                        }
                    });
                }
				
				//ajoutAdmin("Flavien", "laBOC","Evaluateur");
                
                /*
				T'as juste à faire appel à la fonction ajoutAdmin(nom, mdp);
				Et en paramètre tu mets l'identifiant et le mot de passe que l'admin que tu récupèreras dans 
				tes formulaires (avec les $.text() ).
				Et voilà
				*/
            });

        </script>

        <style type="text/css">
            .bs-example{
                margin: 20px;
            }

            li:hover {
                background-color: #D8D8D8;
            }
        </style>
    </head>

    <body>

        <?php include("menu.php"); ?>

        <!--<h3 style="text-align:center">Formulaire d'ajout d'un Admin/Evaluateur</h3>-->

        <form id="formAjout" class="form-horizontal" role="form">
            <div class="form-group">
                <label for="nom" class="col-sm-3 control-label">Nom</label>
                <div class="col-sm-4">
                    <input id="nom" type="text" class="form-control" placeholder="Nom" required>
                </div>
            </div>

            <div class="form-group">
                <label for="prenom" class="col-sm-3 control-label">PrÃ©nom</label>
                <div class="col-sm-4">
                    <input id="prenom" type="text" class="form-control" placeholder="PrÃ©nom" required>
                </div>
            </div>

            <div class="form-group">
                <label for="mail" class="col-sm-3 control-label">Email</label>
                <div class="col-sm-4">
                    <input id="email" type="text" class="form-control" placeholder="Email" required>
                </div>
            </div>

            <div class="form-group">
                <label for="tel" class="col-sm-3 control-label">TÃ©lÃ©phone</label>
                <div class="col-sm-4">
                    <input id="tel" type="text" class="form-control" placeholder="NumÃ©ro de tÃ©lÃ©phone" required>
                </div>
            </div>

            <div class="form-group">
                <label id="dateId" for="date" class="col-sm-3 control-label">Date Inscription</label>
                <div class="col-sm-4">
                    <input id="dateInsc"  class="form-control" placeholder="Date de l'inscription">
                </div>
            </div>

            <div class="form-group">
                <label for="statut" class="col-sm-3 control-label">Statut</label>
                <div class="col-sm-4">
                    <select id="statut" class="form-control" required>
                        <option>Ã©valuateur</option>
                        <option>admin</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-10">
                    <button id="ajouter" type="submit" class="btn btn-primary">Ajouter</button>

                </div>
            </div>


        </form>


    </body>

</html>