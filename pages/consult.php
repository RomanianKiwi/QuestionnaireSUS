<!DOCTYPE html>

<html>
	<style>	
	h1{
		text-align: center;
	}
	</style>

	<head>
	
		<meta charset="iso-8859-1" />
		<title>Consultation des résultats</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
		<script src="http://code.jquery.com/jquery-latest.min.js"></script>
		
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>		
	</head>
	<body>
		<?php include("menu.php"); ?>
		<h1>Consultation des résultats</h1>
		<div class="container">
			<div class="panel-group" id="accordion">
				<div class="panel panel-default">
					<div class="panel-heading">
					<h1 class="panel-title">
						<a class="accordeon" data-toggle="collapse" data-parent="#accordion" href="#collapse1">
							<span class='glyphicon glyphicon-plus'></span>Système 1
						</a>
					</h1>
					</div>
					<div id="collapse1" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="panel-group" id="accordionV1">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h2 class="panel-title">
											<a class="accordeonV1" data-toggle="collapse" data-parent="#accordionV1" href="#collapseV1">
												<span class='glyphicon glyphicon-plus'></span>Version 1
											</a>
										</h2>
									</div>
									<div id="collapseV1" class="panel-collapse collapse">
										<div class="panel-body">
											<p>Le score de cette version est de: 60,4.</p>
										</div>
									</div>
								</div>
							</div>
							<div class="panel-group" id="accordionV2">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h2 class="panel-title">
											<a class="accordeonV2" data-toggle="collapse" data-parent="#accordionV2" href="#collapseV2">
												<span class='glyphicon glyphicon-plus'></span>Version 2
											</a>
										</h2>
									</div>
									<div id="collapseV2" class="panel-collapse collapse">
										<div class="panel-body">
											<p>Le score de cette version est de: 70.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel-group" id="accordion2">
				<div class="panel panel-default">
					<div class="panel-heading">
					<h1 class="panel-title">
						<a class="accordeon2" data-toggle="collapse" data-parent="#accordion2" href="#collapse2">
							<span class='glyphicon glyphicon-plus'></span>Système 2
						</a>
					</h1>
					</div>
					<div id="collapse2" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="panel-group" id="accordionV2">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h2 class="panel-title">
											<a class="accordeon2V1" data-toggle="collapse" data-parent="#accordion2V1" href="#collapse2V1">
												<span class='glyphicon glyphicon-plus'></span>Version 1
											</a>
										</h2>
									</div>
									<div id="collapse2V1" class="panel-collapse collapse">
										<div class="panel-body">
											<p>Le score de cette version est de: 50.</p>
										</div>
									</div>
								</div>
							</div>
							<div class="panel-group" id="accordion2V2">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h2 class="panel-title">
											<a class="accordeon2V2" data-toggle="collapse" data-parent="#accordion2V2" href="#collapse2V2">
												<span class='glyphicon glyphicon-plus'></span>Version 2
											</a>
										</h2>
									</div>
									<div id="collapse2V2" class="panel-collapse collapse">
										<div class="panel-body">
											<p>Le score de cette version est de: 90,5.</p>
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
</html>