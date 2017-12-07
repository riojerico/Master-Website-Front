

						<?php
						session_start();
						require_once("sys/class.login.php");
						$login = new Login();

						if($login->is_loggedin()!="")
						{
							//$login->redirect('index.php');
						}

						if(isset($_POST['btn-login']))
						{
						  $uname = strip_tags($_POST['username']);
							$upass = strip_tags($_POST['password']);

							if($login->doLogin($uname,$upass))
							{
								$login->redirect('index');
							}
							else
							{
								$error = "Username dan password tidak cocok!";
							}
						}
?>

					<!-- Section -->
						<section>
							<div class="inner">
								<header>
									<h1>LOGIN</h1>
								</header>

								<section class="columns double">

								</section>
							</div>
						</section>

					<!-- Contact -->
						<section id="contact">

							<!-- Form -->
								<div class="column">
									<h3></h3>
									<?php echo $error ?>
									<form action="" method="post">
										<div class="field first">
											<label for="name">Username</label>
											<input name="username" type="text" placeholder="Username">
										</div>
										<div class="field ">
											<label for="email">Password</label>
											<input name="password" type="password" placeholder="Password">
										</div>
										<ul class="actions">
											<li><input value="Login" name="btn-login" class="button" type="submit"></li>
										</ul>
									</form>
								</div>

						</section>
