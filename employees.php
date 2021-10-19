<!doctype html>
<html lang="es_ES">
<?php 
require 'constants/settings.php'; 
require 'constants/check-login.php';

if (isset($_GET['page'])) {
$page = $_GET['page'];
if ($page=="" || $page=="1")
{
$page1 = 0;
$page = 1;
}else{
$page1 = ($page*16)-16;
}					
}else{
$page1 = 0;
$page = 1;	
}

 
$servidor= "localhost";
$usuario= "root";
$password = "root";
$nombreBD= "prueba";
$conexion = new mysqli($servidor, $usuario, $password, $nombreBD);
if ($conexion->connect_error) {
    die("la conexión ha fallado: " . $conexion->connect_error);
}
if (!isset($_POST['buscar'])){$_POST['buscar'] = '';}
if (!isset($_POST['buscadepartamento'])){$_POST['buscadepartamento'] = '';}
if (!isset($_POST['color'])){$_POST['color'] = '';}
if (!isset($_POST['buscafechadesde'])){$_POST['buscafechadesde'] = '';}
if (!isset($_POST['buscafechahasta'])){$_POST['buscafechahasta'] = '';}
if (!isset($_POST['buscapreciodesde'])){$_POST['buscapreciodesde'] = '';}
if (!isset($_POST['buscapreciohasta'])){$_POST['buscapreciohasta'] = '';}
if (!isset($_POST["orden"])){$_POST["orden"] = '';}

?>
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Platea21 - Employees</title>
	<meta name="description" content="Online Job Management / Job Portal" />
	<meta name="keywords" content="job, work, resume, applicants, application, employee, employer, hire, hiring, human resource management, hr, online job management, company, worker, career, recruiting, recruitment" />
	<meta name="author" content="BwireSoft">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta property="og:image" content="http://<?php echo "$actual_link"; ?>/images/banner.jpg" />
    <meta property="og:image:secure_url" content="https://<?php echo "$actual_link"; ?>/images/banner.jpg" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:width" content="500" />
    <meta property="og:image:height" content="300" />
    <meta property="og:image:alt" content="Bwire Jobs" />
    <meta property="og:description" content="Online Job Management / Job Portal" />

	<link rel="shortcut icon" href="images/ico/favicon.png">
	
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" media="screen">	
	<link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/component.css" rel="stylesheet">
	
	<link rel="stylesheet" href="icons/linearicons/style.css">
	<link rel="stylesheet" href="icons/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="icons/simple-line-icons/simple-line-icons.html">
	<link rel="stylesheet" href="icons/ionicons/css/ionicons.css">
	<link rel="stylesheet" href="icons/pe-icon-7-stroke/css/pe-icon-7-stroke.css">
	<link rel="stylesheet" href="icons/rivolicons/style.css">
	<link rel="stylesheet" href="icons/flaticon-line-icon-set/flaticon-line-icon-set.css">
	<link rel="stylesheet" href="icons/flaticon-streamline-outline/flaticon-streamline-outline.css">
	<link rel="stylesheet" href="icons/flaticon-thick-icons/flaticon-thick.css">
	<link rel="stylesheet" href="icons/flaticon-ventures/flaticon-ventures.css">

	<link href="css/style.css" rel="stylesheet">

	
</head>

  <style>
  
    .autofit2 {
	height:63px;
	width:63px;
    object-fit:cover; 
  }
  
  </style>

<body class="not-transparent-header">

	<div class="container-wrapper">

		<header id="header">
			<nav class="navbar navbar-default navbar-fixed-top navbar-sticky-function">

				<div class="container">
					
					<div class="logo-wrapper">
						<div class="logo">
							<a href="./"><img src="images/logo.png" alt="Logo" /></a>
						</div>
					</div>
					
					<div id="navbar" class="navbar-nav-wrapper navbar-arrow">
					
						<ul class="nav navbar-nav" id="responsive-menu">
						
							<li>
							
								<a href="./">Inicio</a>
								
							</li>
							
							<li>
								<a href="job-list.php">Lista de empleos</a>

							</li>
							
							<li>
								<a href="employers.php">Empresas</a>
							</li>
							
							<li>
								<a href="employees.php">Personas</a>
							</li>
							
							<li>
								<a href="contact.php">Contacto</a>
							</li>

						</ul>
				
					</div>

					<div class="nav-mini-wrapper">
						<ul class="nav-mini sign-in">
						<?php
						if ($user_online == true) {
						print '
						    <li><a href="logout.php">Cerrar Sesión</a></li>
							<li><a href="'.$myrole.'">Perfil</a></li>';
						}else{
						print '
							<li><a href="login.php">ingresar</a></li>
							<li><a data-toggle="modal" href="#registerModal">registrate</a></li>';						
						}
						
						?>

						</ul>
					</div>
				
				</div>
				
				<div id="slicknav-mobile"></div>
				
			</nav>
			<div id="registerModal" class="modal fade login-box-wrapper" tabindex="-1" style="display: none;" data-backdrop="static" data-keyboard="false" data-replace="true">
			
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title text-center">Crea tu cuenta gratis</h4>
				</div>
				
				<div class="modal-body">
				
					<div class="row gap-20">
					
						<div class="col-sm-6 col-md-6">
							<a href="register.php?p=Employer" class="btn btn-facebook btn-block mb-5-xs">Registro Empresa</a>
						</div>
						<div class="col-sm-6 col-md-6">
							<a href="register.php?p=Employee" class="btn btn-facebook btn-block mb-5-xs">Registro Personal</a>
						</div>

					</div>
				
				</div>
				
				<div class="modal-footer text-center">
					<button type="button" data-dismiss="modal" class="btn btn-primary btn-inverse">Cerrar</button>
				</div>
				
			</div>

			
		</header>

        <div class="col-12 row">

            <div class="mb-3">
                    <label  class="form-label">Nombre a buscar</label>
                    <input type="text" class="form-control" id="buscar" name="buscar" value="<?php echo $_POST["buscar"] ?>" >
            </div>

            <h4 class="card-title">Filtro de búsqueda</h4>  
            
            <div class="col-11">

                        <table class="table">
                                <thead>
                                        <tr class="filters">
                                                <th>
                                                        Departamento
                                                        <select id="assigned-tutor-filter" id="buscadepartamento" name="buscadepartamento" class="form-control mt-2" style="border: #bababa 1px solid; color:#000000;" >
                                                                <?php if ($_POST["buscadepartamento"] != ''){ ?>
                                                                <option value="<?php echo $_POST["buscadepartamento"]; ?>"><?php echo $_POST["buscadepartamento"]; ?></option>
                                                                <?php } ?>
                                                                <option value="">Todos</option>
                                                                <option value="Compras">Compras</option>
                                                                <option value="Ventas">Ventas</option>
                                                                <option value="Alquileres">Alquileres</option>
                                                        </select>
                                                </th>
                                                <th>
                                                        Precio desde:
                                                        <input type="number" id="buscapreciodesde" name="buscapreciodesde" class="form-control mt-2" value="<?php echo $_POST["buscapreciodesde"]; ?>" style="border: #bababa 1px solid; color:#000000;" >
                                                </th>
                                                <th>
                                                        Precio hasta:
                                                        <input type="number" id="buscapreciohasta" name="buscapreciohasta" class="form-control mt-2" value="<?php echo $_POST["buscapreciohasta"]; ?>" style="border: #bababa 1px solid; color:#000000;" >
                                                </th>
                                         
                                                <th>
                                                        Fecha desde:
                                                        <input type="date" id="buscafechadesde" name="buscafechadesde" class="form-control mt-2" value="<?php echo $_POST["buscafechadesde"]; ?>" style="border: #bababa 1px solid; color:#000000;" >
                                                </th>
                                                <th>
                                                        Fecha hasta:
                                                        <input type="date" id="buscafechahasta" name="buscafechahasta" class="form-control mt-2" value="<?php echo $_POST["buscafechahasta"]; ?>" style="border: #bababa 1px solid; color:#000000;" >
                                                </th>
                                                <th>
                                                        Color
                                                        <select id="subject-filter" id="color" name="color" class="form-control mt-2" style="border: #bababa 1px solid; color:#000000;" >
                                                                <?php if ($_POST["color"] != ''){ ?>
                                                                <option value="<?php echo $_POST["color"]; ?>"><?php echo $_POST["color"]; ?></option>
                                                                <?php } ?>
                                                                <option value="">Todos</option>
                                                                <option style="color: blue;" value="Azul">Azul</option>
                                                                <option style="color: red;" value="Rojo">Rojo</option>
                                                                <option style="color: orange;" value="Amarillo">Amarillo</option>
                                                        </select>
                                                </th>
                                        </tr>
                                </thead>
                        </table>
                </div>


                <h4 class="card-title">Ordenar por</h4>  
            
            <div class="col-11">

                        <table class="table">
                                <thead>
                                        <tr class="filters">
                                                <th>
                                                        Selecciona el orden
                                                        <select id="assigned-tutor-filter" id="orden" name="orden" class="form-control mt-2" style="border: #bababa 1px solid; color:#000000;" >
                                                                <?php if ($_POST["orden"] != ''){ ?>
                                                                <option value="<?php echo $_POST["orden"]; ?>">
                                                                <?php 
                                                                if ($_POST["orden"] == '1'){echo 'Ordenar por nombre';} 
                                                                if ($_POST["orden"] == '2'){echo 'Ordenar por departamento';} 
                                                                if ($_POST["orden"] == '3'){echo 'Ordenar por color';} 
                                                                if ($_POST["orden"] == '4'){echo 'Ordenar por precio de menor a mayor';} 
                                                                if ($_POST["orden"] == '5'){echo 'Ordenar por precio de mayor a menor';} 
                                                                if ($_POST["orden"] == '6'){echo 'Ordenar por fecha de reciente';} 
                                                                if ($_POST["orden"] == '7'){echo 'Ordenar por fecha de antigua';} 
                                                                ?>
                                                                </option>
                                                                <?php } ?>
                                                                <option value=""></option>
                                                                <option value="1">Ordenar por nombre</option>
                                                                <option value="2">Ordenar por departamento</option>
                                                                <option value="3">Ordenar por color</option>
                                                                <option value="4">Ordenar por precio de menor a mayor</option>
                                                                <option value="5">Ordenar por precio de mayor a menor</option>
                                                                <option value="6">Ordenar por fecha de reciente</option>
                                                                <option value="7">Ordenar por fecha de antigua</option>
                                                        </select>
                                                </th>
                                          
                                              
                                      
                                        </tr>
                                </thead>
                        </table>
                </div>


                <div class="col-1">
                        <input type="submit" class="btn " value="Ver" style="margin-top: 38px; background-color: purple; color: white;">
                </div>
        </div>
		<div class="main-wrapper">

			<div class="breadcrumb-wrapper">
			
				<div class="container">
				
					<ol class="breadcrumb-list booking-step">
						<li><a href="./">Inicio</a></li>
						<li><span>Employees</span></li>
					</ol>
					
				</div>
				
			</div>
			
			<div class="section sm">
			
				<div class="container">
				
					<div class="sorting-wrappper">
			
						<div class="sorting-header">
							<h3 class="sorting-title">Alumnos</h3>
						</div>
						
		
					</div>
					
					<div class="employee-grid-wrapper">
					
						<div class="GridLex-gap-15-wrappper">
						
							<div class="GridLex-grid-noGutter-equalHeight">
							<?php
							require 'constants/db_config.php';
							
							try {
                            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $stmt = $conn->prepare("SELECT * FROM tbl_users WHERE role = 'employee' ORDER BY first_name LIMIT $page1,16");
                            $stmt->execute();
                            $result = $stmt->fetchAll();
                            foreach($result as $row)
                            {
								$empavatar = $row['avatar'];
								?>
																<div class="GridLex-col-3_sm-4_xs-6_xss-12">
								
									<div class="employee-grid-item">
									
										<div class="action">
												
											<div class="row gap-10">
											
												<div class="col-xs-6 col-sm-6">
													<div class="text-left">
														<button class="btn"><i class="icon-heart"></i></button> 
													</div>
												</div>
												
												<div class="col-xs-6 col-sm-6">
													<div class="text-right">
														<a class="btn text-right" href="employee-detail.html"><i class="icon-action-redo"></i></a> 
													</div>
												</div>
												
											</div>
											
										</div>
										
										<a target="_blank" href="employee-detail.php?empid=<?php echo $row['member_no']; ?>" class="clearfix">
											
											<div class="image clearfix">
										    <?php 
										    if ($empavatar == null) {
									        print '<center><img class="img-circle autofit2" src="images/default.jpg" alt="image"  /></center>';
										    }else{
										    echo '<center><img class="img-circle autofit2" alt="image" src="data:image/jpeg;base64,'.base64_encode($empavatar).'"/></center>';	
										    }
										    ?>
											
							

											</div>
											
											<div class="content">
											
												<h4><?php echo $row['first_name'] ?> <?php echo $row['last_name'] ?></h4>
												<p class="location"><i class="fa fa-map-marker"></i> <?php echo $row['country'] ?></p>
												
												<h6 class="text-primary">Education : <?php echo $row['education'] ?></h6>
												
                                                <h6 class="text-primary"><?php echo $row['title'] ?></h6>
												
											</div>
										
										</a>
										
									</div>
								
								</div>
								<?php
 
                         	}

					  
	                        }catch(PDOException $e)
                            {
 
                            }
							
							?>
	
							
							</div>
						
						</div>

					</div>
					
								<div class="pager-wrapper">
								
						        <ul class="pager-list">
							<?php
							require 'constants/db_config.php';
							$total_records = 0;
							try {
                            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	
                            $stmt = $conn->prepare("SELECT * FROM tbl_users WHERE role = 'employee' ORDER BY first_name");
                            $stmt->execute();
                            $result = $stmt->fetchAll();

                            foreach($result as $row)
                            {
                            $total_records++;
	
	                        }

	                        }catch(PDOException $e)
                             {
    
                             } ?>
							 
								<?php
								$records = $total_records/16;
                                $records = ceil($records);
				                if ($records > 1 ) {
								$prevpage = $page - 1;
								$nextpage = $page + 1;
								
								print '<li class="paging-nav" '; if ($page == "1") { print 'class="disabled"'; } print '><a '; if ($page == "1") { print ''; } else { print 'href="employees.php?page='.$prevpage.'"';} print '><i class="fa fa-chevron-left"></i></a></li>';
					            for ($b=1;$b<=$records;$b++)
                                 {
                                 
		                        ?><li  class="paging-nav" ><a <?php if ($b == $page) { print ' style="background-color:#33B6CB; color:white" '; } ?>  href="employees.php?page=<?php echo "$b"; ?>"><?php echo $b." "; ?></a></li><?php
                                 }	
								 print '<li class="paging-nav"'; if ($page == $records) { print 'class="disabled"'; } print '><a '; if ($page == $records) { print ''; } else { print 'href="employees.php?page='.$nextpage.'"';} print '><i class="fa fa-chevron-right"></i></a></li>';
					             }

								
								?>

						        </ul>	
					
					            </div>

				</div>
			
			</div>

			<footer class="footer-wrapper">
			
				<div class="main-footer">
				
					<div class="container">
					
						<div class="row">
						
							<div class="col-sm-12 col-md-9">
							
								<div class="row">
								
									<div class="col-sm-6 col-md-4">
									
										<div class="footer-about-us">
											<h5 class="footer-title">Sobre Platea21</h5>
											<p>platea21 es un portal dedicado a la programacion web y escritorio 2018.</p>
										
										</div>

									</div>
									
									<div class="col-sm-6 col-md-5 mt-30-xs">
										<h5 class="footer-title">Enlaces Rapidos</h5>
										<ul class="footer-menu clearfix">
											<li><a href="./">Inicio</a></li>
											<li><a href="job-list.php">Lista de empleos</a></li>
											<li><a href="employers.php">Empresas</a></li>
											<li><a href="employees.php">Personas</a></li>
											<li><a href="contact.php">Contacto</a></li>
											<li><a href="#">Ir Arriba</a></li>

										</ul>
									
									</div>

								</div>

							</div>
							
							<div class="col-sm-12 col-md-3 mt-30-sm">
							
								<h5 class="footer-title">Contacto Platea21</h5>
								
								<p>Dirección : Tacna - Perú</p>
								<p>Correo Electrónico : <a href="mailto:gorchor@gmail.com">gorchor@gmail.com</a></p>
								<p>Teléfono: <a href="tel:+51948445199">+51948445199</a></p>
								

							</div>

							
						</div>
						
					</div>
					
				</div>
				
				<div class="bottom-footer">
				
					<div class="container">
					
						<div class="row">
						
							<div class="col-sm-4 col-md-4">
					
								<p class="copy-right">&#169; Copyright <?php echo date('Y'); ?> Platea21</p>
								
							</div>
							
							<div class="col-sm-4 col-md-4">
							
								<ul class="bottom-footer-menu">
									<li><a >Desarrollado por @gorchor</a></li>
								</ul>
							
							</div>
							
							<div class="col-sm-4 col-md-4">
								<ul class="bottom-footer-menu for-social">
									<li><a href="<?php echo "$tw"; ?>"><i class="ri ri-twitter" data-toggle="tooltip" data-placement="top" title="twitter"></i></a></li>
									<li><a href="<?php echo "$fb"; ?>"><i class="ri ri-facebook" data-toggle="tooltip" data-placement="top" title="facebook"></i></a></li>
									<li><a href="<?php echo "$ig"; ?>"><i class="ri ri-instagram" data-toggle="tooltip" data-placement="top" title="instagram"></i></a></li>
								</ul>
							</div>
						
						</div>

					</div>
					
				</div>
			
			</footer>
			
		</div>


	</div> 
 
 

<div id="back-to-top">
   <a href="#"><i class="ion-ios-arrow-up"></i></a>
</div>

<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrap-modalmanager.js"></script>
<script type="text/javascript" src="js/bootstrap-modal.js"></script>
<script type="text/javascript" src="js/smoothscroll.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/jquery.waypoints.min.js"></script>
<script type="text/javascript" src="js/wow.min.js"></script>
<script type="text/javascript" src="js/jquery.slicknav.min.js"></script>
<script type="text/javascript" src="js/jquery.placeholder.min.js"></script>
<script type="text/javascript" src="js/bootstrap-tokenfield.js"></script>
<script type="text/javascript" src="js/typeahead.bundle.min.js"></script>
<script type="text/javascript" src="js/bootstrap3-wysihtml5.min.js"></script>
<script type="text/javascript" src="js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="js/jquery-filestyle.min.js"></script>
<script type="text/javascript" src="js/bootstrap-select.js"></script>
<script type="text/javascript" src="js/ion.rangeSlider.min.js"></script>
<script type="text/javascript" src="js/handlebars.min.js"></script>
<script type="text/javascript" src="js/jquery.countimator.js"></script>
<script type="text/javascript" src="js/jquery.countimator.wheel.js"></script>
<script type="text/javascript" src="js/slick.min.js"></script>
<script type="text/javascript" src="js/easy-ticker.js"></script>
<script type="text/javascript" src="js/jquery.introLoader.min.js"></script>
<script type="text/javascript" src="js/jquery.responsivegrid.js"></script>
<script type="text/javascript" src="js/customs.js"></script>


</body>


</html>
