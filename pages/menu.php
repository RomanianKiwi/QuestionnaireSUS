
		<script type="text/javascript">
		$(document).ready(function() {
			function toggleNavbarMethod() {
				if ($(window).width() > 768) {
					$('.navbar .dropdown').on('mouseover', function(){
						$('.dropdown-toggle', this).trigger('click'); 
					}).on('mouseout', function(){
						$('.dropdown-toggle', this).trigger('click').blur();
					});
				}
				else {
					$('.navbar .dropdown').off('mouseover').off('mouseout');
				}
			}

			 // toggle navbar hover
				toggleNavbarMethod();
				
				// bind resize event
				$(window).resize(toggleNavbarMethod);
		});
		</script>

		<nav class="navbar navbar-default" role="navigation">
					<div class="container">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-menu">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand hidden-md hidden-lg" href="#">Menu</a>
						</div>

						<div class="collapse navbar-collapse" id="main-menu">
							<ul class="nav navbar-nav">
								<li class="dropdown">
									<a id ="ajoutQuest" href="/pages/AjoutQuestionnaire.php" class="dropdown-toggle" data-toggle="dropdown">Nouveau Formulaire </a>
									
								</li>
								<li class="dropdown"><a href="/pages/consult.php" class="dropdown-toggle" data-toggle="dropdown">Consultation résultat</a></li>
								<li class="dropdown">
									<a href="/pages/mailing.php" class="dropdown-toggle" data-toggle="dropdown">Invitation participant </a>
									
								</li>
								<li class="dropdown"><a href="/pages/AjoutAdminEval.php" class="dropdown-toggle" data-toggle="dropdown">Ajouter évaluateur</a></li>
							</ul>
							<ul class="nav navbar-nav navbar-right">
								<li class="dropdown"><a id="deco" class="dropdown-toggle" data-toggle="dropdown">Déconnexion</a></li>
							</ul>
						</div> 
					</div>
		</nav>