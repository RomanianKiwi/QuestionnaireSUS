<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Example of Bootstrap 3 Static Navbar</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
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
<style type="text/css">
    .bs-example{
    	margin: 20px;
    }
</style>
</head> 
<body>
<div class="bs-example">
    <nav role="navigation" class="navbar navbar-default">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand">Brand</a>
        </div>
        <!-- Collection of nav links and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown"><a href="#">Home</a></li>
                <li class="dropdown"><a id ="ajoutQuest" href="AjoutQuestionnaire.php" class="dropdown-toggle" >Profile</a></li>
                <li class="dropdown"><a href="#">Messages</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Login</a></li>
            </ul>
        </div>
    </nav>
</div>
</body>
</html>    