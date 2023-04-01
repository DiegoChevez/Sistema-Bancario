<?php
include "controller.php";

?>
<!doctype html>
<html lang="en">

<head>
	<title>Login 07</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="css/style.css">
	
	<link href="../Tools/SweetAlert/sweetalert2.min.css" rel="stylesheet">


</head>

<body>
	<section class="ftco-section">
		<div class="container">

			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
							<div class="text w-100">
								<h2>¡Bienvenido!</h2>
								<img src="../Images/logo+titulo(blanco).png" alt="" style="width: 80%; padding: 2% 2%;">
								<p>¿Aun no tienes una cuenta?</p>
								<a href="#" class="btn btn-white btn-outline-white">Consiguela</a>
							</div>
						</div>
						<div class="login-wrap p-4 p-lg-5">
							<div class="d-flex">
								<div class="w-100">
									<h3 class="mb-4">Acceso</h3>
								</div>
								<div class="w-100">
									<p class="social-media d-flex justify-content-end">
										<a href="#" class="social-icon d-flex align-items-center justify-content-center">
											<span class="fa fa-facebook"></span>
										</a>
										<a href="#" class="social-icon d-flex align-items-center justify-content-center">
											<span class="fa fa-twitter"></span>
										</a>
									</p>
								</div>
							</div>
							<form action="controller.php" method="post" class="signin-form">
								<div class="form-group mb-3">
									<label class="label" for="name">Mail</label>
									<input type="email" class="form-control" placeholder="mail@gmail.com" require name="mailUser">
								</div>
								<div class="form-group mb-3">
									<label class="label" for="password">Password</label>
									<input type="password" class="form-control" placeholder="Password" require name="passwdUser">
								</div>
								<div class="form-group">
									<input type="submit" class="form-control btn btn-primary submit px-3" value="Acceder" name="btn-access" id="btn-access">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	
	<script src="js/jquery.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>


	<script src="../Tools/SweetAlert/sweetalert2.all.min.js"></script>
	

	<?php
		if(isset($_GET['error1'])){
			echo "<script>Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: 'Existen Campos Vacios!'})
				</script>";
		}

		if(isset($_GET['error2'])){
			echo "<script>Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: 'Credenciales Incorrectas!'})
				</script>";
		}
	?>

</body>

</html>