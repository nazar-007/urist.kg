<!DOCTYPE html>
<html>

<head>
    <title>Uristkg</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>css/main.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>css/luxbar.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/main.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/media.css">
    <script>
        $(function() {
            $("#header").load("header.html");
            $("#footer").load("footer.html");
        });
    </script>
</head>

<body>
    <div id="header"></div>
	<!-- Page Container -->
	<div id="demo1" class="w3-content" style="max-width:1400px;">
		<div class="panel relative">
			<div class="forum-head">
				<div class="centered-text">
					<h1 class="text-center text-uppercase display-3 font-weight-bold" style="background: #ff0000bf;">Форум</h1>
					<ul class="nav justify-content-center">
						<li class="nav-item">
							<a href="#" class="nav-link text-lowercase active" style="background-color: #ff0000bf">Лучшие</a>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link text-lowercase ml-3" style="background-color: #ff0000bf">Популярные</a>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link text-lowercase ml-3" style="background-color: #ff0000bf">Новые</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="container mt-5">
			<div class="row">
				<div class="col-lg-3 col-xs-12 col-md-6">
					<div class="panel mb-3 relative">
						<div class="inline">
							<img src="images/rules.jpg" class="img-fluid" alt="">
							<div class="centered-text" style="background: #ff0000bf;padding: 5px">
								Правила
							</div>
							<div class="cover overlay"></div>
						</div>
					</div>
					<div class="input-group">
                        <input type="text" class="form-control" id="search" placeholder="Поиск...">
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
					<div class="nav flex-column nav-pills mt-3 pill-border" id="v-pills-tab" role="tablist" aria-orientation="vertical">
						<a href="#v-pills-home" class="nav-item nav-link active" id="v-pills-home-tab" role="tab" data-toggle="pill">Lorem ipsum.</a>
						<a href="#v-pills-home" class="nav-item nav-link" id="v-pills-home-tab" role="tab" data-toggle="pill">Lorem ipsum.</a>
						<a href="#v-pills-home" class="nav-item nav-link" id="v-pills-home-tab" role="tab" data-toggle="pill">Lorem ipsum.</a>
						<a href="#v-pills-home" class="nav-item nav-link" id="v-pills-home-tab" role="tab" data-toggle="pill">Lorem ipsum.</a>
						<a href="#v-pills-home" class="nav-item nav-link" id="v-pills-home-tab" role="tab" data-toggle="pill">Lorem ipsum.</a>
					</div>
				</div>
				<div class="col-lg-9 col-xs-12 col-md-6">
					<div class="container-fluid pill-border pl-3 mb-2 pb-2 bg-panel">
						<i class="fa fa-newspaper-o mt-2" style="font-size:2.3vw;color:red"></i>
						<div class="title">Lorem ipsum dolor.</div>
					</div>
					<table class="table table-hover pill-border">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Название категории</th>
								<th scope="col" class="d-sm-none d-md-block d-none d-xs-block">Посл.сообщение</th>
								<th scope="col">Коммент</th>
								<th scope="col">Просмотры</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row">
									<div><i class="fa fa-chevron-up"></i></div>
									<div class="d-flex justify-content-center">5</div>
									<div><i class="fa fa-chevron-down"></i></div>
								</th>
								<td>
									<p class="mt-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti, minus.</p>
								</td>
								<td class="d-sm-none d-md-block d-none d-xs-block">
									<p class="mt-2 d-flex justify-content-center">02-09-2018</p>
								</td>
								<td>
									<div class="d-flex justify-content-center mt-2">5</div>
								</td>
								<td>
									<div class="d-flex justify-content-center mt-2">
										<div><i class="fa fa-eye"></i></div>
										<div class="ml-2">56</div>
									</div>
								</td>
							</tr>
							<tr>
								<th scope="row">
									<div><i class="fa fa-chevron-up"></i></div>
									<div class="d-flex justify-content-center">5</div>
									<div><i class="fa fa-chevron-down"></i></div>
								</th>
								<td>
									<p class="mt-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti, minus.</p>
								</td>
								<td class="d-sm-none d-md-block d-none d-xs-block">
									<p class="mt-2 d-flex justify-content-center">02-09-2018</p>
								</td>
								<td>
									<div class="d-flex justify-content-center mt-2">5</div>
								</td>
								<td>
									<div class="d-flex justify-content-center mt-2">
										<div><i class="fa fa-eye"></i></div>
										<div class="ml-2">56</div>
									</div>
								</td>
							</tr>
							<tr>
								<th scope="row">
									<div><i class="fa fa-chevron-up"></i></div>
									<div class="d-flex justify-content-center">5</div>
									<div><i class="fa fa-chevron-down"></i></div>
								</th>
								<td>
									<p class="mt-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti, minus.</p>
								</td>
								<td class="d-sm-none d-md-block d-none d-xs-block">
									<p class="mt-2 d-flex justify-content-center">02-09-2018</p>
								</td>
								<td>
									<div class="d-flex justify-content-center mt-2">5</div>
								</td>
								<td>
									<div class="d-flex justify-content-center mt-2">
										<div><i class="fa fa-eye"></i></div>
										<div class="ml-2">56</div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- End Page Container -->
	</div>
	<div class="w3-dark-grey mt-5">
		<div class="w3-container w3-content w3-padding-64 container-fluid px-5" style="max-width: 800px;" id="contact">
			<h2 class="w3-wide w3-center">CONTACT</h2>
			<p class="w3-opacity w3-center"><i>Fan? Drop a note!</i></p>
			<div class="w3-row w3-padding-32">
				<div class="w3-col m6 w3-large w3-margin-bottom">
					<i class="fa fa-map-marker" style="width:30px"></i> Bishkek, KG<br>
					<i class="fa fa-phone" style="width:30px"></i> Phone: +00 151515<br>
					<i class="fa fa-envelope" style="width:30px"> </i> Email: mail@mail.com<br>
				</div>
				<div class="w3-col m6">
					<form action="/action_page.php" target="_blank">
						<div class="w3-row-padding" style="margin:0 -16px 8px -16px">
							<div class="w3-half">
								<input class="w3-input w3-border" type="text" placeholder="Name" required name="Name">
							</div>
							<div class="w3-half">
								<input class="w3-input w3-border" type="text" placeholder="Email" required name="Email">
							</div>
						</div>
						<input class="w3-input w3-border" type="text" placeholder="Message" required name="Message">
						<button class="w3-button w3-black w3-section w3-right" type="submit">SEND</button>
					</form>
				</div>
			</div>
		</div>
		<footer class="w3-container w3-padding-64 w3-center w3-opacity w3-light-grey w3-xlarge">
			<i class="fa fa-facebook-official w3-hover-opacity"></i>
			<i class="fa fa-instagram w3-hover-opacity"></i>
			<i class="fa fa-snapchat w3-hover-opacity"></i>
			<i class="fa fa-pinterest-p w3-hover-opacity"></i>
			<i class="fa fa-twitter w3-hover-opacity"></i>
			<i class="fa fa-linkedin w3-hover-opacity"></i>
			<p class="w3-medium">Powered by <a href="http://www.it-academy.kg" target="_blank">IT Academy</a></p>
		</footer>
	</div>

</body>
</html>