<?php
ob_start();
session_start();
include("includes/functions.php");

$step = protect($_GET['step']);

if($step == 1) {
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Step 1 — Install Purchasify Multi-Vendor</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="Thibault Penin">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		
		
		<!-- Stylesheets -->
		<link rel="stylesheet" href="static/gen/elements.css">
		<link rel="stylesheet" href="static/gen/semantic.min.css">
		<link rel="stylesheet" href="static/gen/packed_global.css">
		<!-- End Stylesheets -->
	    
		<!-- Favicons -->
		<link rel="apple-touch-icon" sizes="57x57" href="static/favicons/apple-touch-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="114x114" href="static/favicons/apple-touch-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="72x72" href="static/favicons/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="144x144" href="static/favicons/apple-touch-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="60x60" href="static/favicons/apple-touch-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="120x120" href="static/favicons/apple-touch-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="76x76" href="static/favicons/apple-touch-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="152x152" href="static/favicons/apple-touch-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="static/favicons/apple-touch-icon-180x180.png">
		<link rel="icon" type="image/png" href="static/favicons/favicon-96x96.png" sizes="96x96">
		<link rel="icon" type="image/png" href="static/favicons/favicon-16x16.png" sizes="16x16">
		<link rel="icon" type="image/png" href="static/favicons/favicon-32x32.png" sizes="32x32">
		<meta name="msapplication-TileColor" content="#2b5797">
		<meta name="msapplication-TileImage" content="static/favicons/mstile-144x144.png">
		<!-- End Favicons -->
		
		<style>
		@media only screen and (max-width: 760px){
		  .login-container {
		    width:80%!important;
			margin:auto!important;
		  }
		}
		
		@media only screen and (min-width: 800px){
		  .login-container {
		    width:40%!important;
			margin:auto!important;
		  }
		}
		</style>
		
</head>
<body>
	<!-- HEADER START -->
	<div class="sellfy-header-wrap">
	  <div class="ui two column grid full-width sellfy-header">
	   <div class="row">
		<div class="left aligned column">
		  <span style="color:#333!important;font-family:'Montserrat', sans-serif;font-weight:bold;font-size: 1.556em;" href="">Purchasify</span>
		</div>
		<div class="right aligned column connect-panel">
		  <a class="menu-link no-mobile login-link-button" target="_blank" href="mailto:hello@thibaultpenin.com">Contact Us</a>
          <a class="ui button tiny green" href="http://labs.thibaultpenin.com/docs/purchasify/" target="_blank" title="Help &amp; Support">Help &amp; Support</a>
		</div>
	   </div>
	  </div>
	</div>
	<!-- HEADER END -->
	<!-- BODY START -->
	<div class="body">
	<div class="body-content">
	<div id="login" style="padding-top: 6%;" class="content auth">
    <div class="ui header">Install Purchasify Multi-Vendor</div>
	<div class="login-container">
	<?php
		if(isset($_POST['do_install'])) {
		$mysql_host = protect($_POST['mysql_host']);
		$mysql_user = protect($_POST['mysql_user']);
		$mysql_pass = protect($_POST['mysql_pass']);
		$mysql_db = protect($_POST['mysql_db']);
		$title = protect($_POST['title']);
		$description = protect($_POST['description']);
		$keywords = protect($_POST['keywords']);
		$url = protect($_POST['url']);
		$usern = protect($_POST['usern']);
		$passwd = protect($_POST['passwd']);
		$email = protect($_POST['email']);
		$contact_email = protect($_POST['contact_email']);
		$sitename = protect($_POST['sitename']);
		$currency = protect($_POST['currency']);
		$paypal_email = protect($_POST['paypal_email']);
		$main_folder_name = protect($_POST['main_folder_name']);
		$home_title = protect($_POST['home_title']);
		$home_desc = protect($_POST['home_desc']);
		$footer_text = protect($_POST['footer_text']);
		
			if(empty($mysql_host) or empty($mysql_user) or empty($mysql_pass) or empty($mysql_db) or empty($title) or empty($description) or empty($keywords) or empty($main_folder_name) or empty($home_title) or empty($home_desc) or empty($footer_text) or empty($sitename) or empty($url) or empty($usern) or empty($passwd) or empty($email) or empty($contact_email)) { echo error("Error! All fields are required."); }
			elseif(!isValidUsername($usern)) { echo error("Error! Please enter valid username."); }
			elseif(!isValidURL($url)) { echo error("Error! Please enter valid website address."); }
			elseif(!isValidEmail($email)) { echo error("Error! Please enter valid e-mail address."); }
			else {
				$db = mysql_connect($mysql_host,$mysql_user,$mysql_pass);

				if($db) {
				$select_db = mysql_select_db($mysql_db,$db);
					if($select_db) {
						mysql_query("SET NAMES 'utf8'");

						$sql_filename = 'sql.sql';
						$sql_contents = file_get_contents($sql_filename);
						$sql_contents = explode(";", $sql_contents);

						foreach($sql_contents as $k=>$v) {
							mysql_query($v);
						}
						
						$insert = mysql_query("INSERT purchasify_settings (title,description,keywords,sitename,email,contact_email,url,main_folder_name,earnings,home_title,home_desc,footer_text,reg_quota,mem_quota) VALUES ('$title','$description','$keywords','$sitename','$email','$contact_email','$url','$main_folder_name','0','$home_title','$home_desc','$footer_text','10','10')");
						$passwd = md5($passwd);
						$insert = mysql_query("INSERT purchasify_users (usern,passwd,email,role,status,quotas) VALUES ('$usern','$passwd','$email','1','0','100000')");
						mkdir($main_folder_name);
						
						$current .= '<?php
						';
						$current .= '$sql["host"] = "'.$mysql_host.'";
						';
						$current .= '$sql["user"] = "'.$mysql_user.'";
						';
						$current .= '$sql["pass"] = "'.$mysql_pass.'";
						';
						$current .= '$sql["base"] = "'.$mysql_db.'";
						';
						$current .= '$connection = mysql_connect($sql["host"],$sql["user"],$sql["pass"]);
						';
						$current .= '$select_database = mysql_select_db($sql["base"], $connection);
						';
						$current .= 'mysql_query("SET NAMES utf8");
						';
						$current .= '?>
						';
						
						file_put_contents("includes/config.php", $current);
						
						$_SESSION['install_url'] = $url;
						$_SESSION['install_usern'] = $usern;
						$_SESSION['install_passwd'] = protect($_POST['passwd']);
						
						header("Location: ./install?step=2");

					} else {
						echo error("Error! MySQL database not exists.");
					}

				} else {
					echo error("Error! Failed to connect to MySQL server.");
				}
			}
		}
		?>
	</div>
    <form action="" method="post" accept-charset="utf-8" class="ui form login-container">
        <div class="field">
          <input name="mysql_host" type="text" value="<?php echo protect($_POST['mysql_host']); ?>" placeholder="MySQL hostname (e.g: localhost)" autocomplete="off" required>
        </div>
		
		<div class="field">
          <input name="mysql_user" type="text" value="<?php echo protect($_POST['mysql_user']); ?>" placeholder="MySQL username (e.g: root)" autocomplete="off" required>
        </div>
		
        <div class="field">
          <input name="mysql_pass" type="text" value="<?php echo protect($_POST['mysql_pass']); ?>" placeholder="MySQL password (e.g: rootpasswd)" autocomplete="off" required>
        </div>
		
		<div class="field">
          <input name="mysql_db" type="text" value="<?php echo protect($_POST['mysql_db']); ?>" placeholder="MySQL database (e.g: purchasify_database)" autocomplete="off" required>
        </div>
		
		<div class="ui horizontal divider">AND</div>
		
		<div class="field">
          <input name="title" type="text" value="<?php echo protect($_POST['title']); ?>" placeholder="Enter website title.." autocomplete="off" required>
        </div>
		
		<div class="field">
          <textarea name="description" placeholder="Enter website description.." autocomplete="off" required><?php echo protect($_POST['description']); ?></textarea>
        </div>
		
		<div class="field">
          <textarea name="keywords" placeholder="Enter website keywords.." autocomplete="off" required><?php echo protect($_POST['keywords']); ?></textarea>
        </div>
		
        <div class="field">
          <input name="contact_email" type="email" value="<?php echo protect($_POST['contact_email']); ?>" placeholder="Contact e-mail address.." autocomplete="off" required>
        </div>
		
		<div class="field">
          <input name="sitename" type="text" value="<?php echo protect($_POST['sitename']); ?>" placeholder="Enter company name (e.g: Company, Inc.)" autocomplete="off" required>
        </div>
		
		<div class="field">
          <input name="url" type="text" value="<?php echo protect($_POST['url']); ?>" placeholder="Enter website url (e.g: http://example.com/ with ending '/')" autocomplete="off" required>
        </div>
		
		<div class="field">
          <input name="main_folder_name" type="text" value="<?php echo protect($_POST['main_folder_name']); ?>" placeholder="Secured folder (e.g: v15u2vh512uvh215)" autocomplete="off" required>
        </div>
		
		<div class="ui horizontal divider">AND</div>
		
		<div class="field">
          <input name="home_title" type="text" value="<?php echo protect($_POST['home_title']); ?>" placeholder="Homepage title (e.g: Company)" autocomplete="off" required>
        </div>
		
		<div class="field">
          <textarea name="home_desc" placeholder="Homepage description (e.g: Over 1 billion digital products created by a global community of designers, developers, photographers, illustrators & producers around the world.)" autocomplete="off" required><?php echo protect($_POST['home_desc']); ?></textarea>
        </div>
		
		<div class="field">
          <input name="footer_text" type="text" value="<?php echo protect($_POST['footer_text']); ?>" placeholder="Copyright text (e.g: Thank you for visiting our website and we wish you much happiness with our products.)" autocomplete="off" required>
        </div>
		
		<div class="ui horizontal divider">AND</div>
		
		<div class="field">
          <input name="email" type="email" value="<?php echo protect($_POST['email']); ?>" placeholder="Notification Email Address" autocomplete="off" required>
        </div>
		
		<div class="field">
          <input name="usern" type="text" value="<?php echo protect($_POST['usern']); ?>" placeholder="Username" autocomplete="off" required>
        </div>
		
		<div class="field">
          <input name="passwd" type="password" value="<?php echo protect($_POST['passwd']); ?>" placeholder="Password" autocomplete="off" required>
        </div>

        <div class="field center aligned">
          <button type="submit" name="do_install" class="ui green button fluid submit">Install Purchasify</button>
        </div>
		
		<br><br><br><br>
        
    </form>
	</div>
	</div>
	</div>
	<!-- BODY END -->
	<!-- FOOTER CODE -->
	<script type="text/javascript" src="static/gen/scripts.min.js"></script>
	<script type="text/javascript" src="static/gen/packed_global.js?51b2b110"></script>
	<!-- FOOTER CODE -->
  
</body>
</html>

<?php
} elseif($step == 2) {
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Step 2 — Install Purchasify Multi-Vendor</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="Thibault Penin">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		
		
		<!-- Stylesheets -->
		<link rel="stylesheet" href="static/gen/elements.css">
		<link rel="stylesheet" href="static/gen/semantic.min.css">
		<link rel="stylesheet" href="static/gen/packed_global.css">
		<link rel="stylesheet" href="static/gen/packed_user.css">
		<!-- End Stylesheets -->
	    
		<!-- Favicons -->
		<link rel="apple-touch-icon" sizes="57x57" href="static/favicons/apple-touch-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="114x114" href="static/favicons/apple-touch-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="72x72" href="static/favicons/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="144x144" href="static/favicons/apple-touch-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="60x60" href="static/favicons/apple-touch-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="120x120" href="static/favicons/apple-touch-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="76x76" href="static/favicons/apple-touch-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="152x152" href="static/favicons/apple-touch-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="static/favicons/apple-touch-icon-180x180.png">
		<link rel="icon" type="image/png" href="static/favicons/favicon-96x96.png" sizes="96x96">
		<link rel="icon" type="image/png" href="static/favicons/favicon-16x16.png" sizes="16x16">
		<link rel="icon" type="image/png" href="static/favicons/favicon-32x32.png" sizes="32x32">
		<meta name="msapplication-TileColor" content="#2b5797">
		<meta name="msapplication-TileImage" content="static/favicons/mstile-144x144.png">
		<!-- End Favicons -->
		
</head>
<body>
	<!-- HEADER START -->
	<div class="sellfy-header-wrap">
	  <div class="ui one column grid full-width sellfy-header">
	   <div class="row">
		<div class="center aligned column">
		  <span style="color:#333!important;font-family:'Montserrat', sans-serif;font-weight:bold;font-size: 1.556em;" href="">Purchasify</span>
		</div>
	   </div>
	  </div>
	</div>
	<!-- HEADER END -->
	<!-- BODY START -->
	<div class="body">
	<div class="body-content">
      <div id="container" class="main-content-wrap">
		<div class="user-area-wrap wide">
		  <div class="ui stackable grid">
			<div class="column left-navigation" id="container_for_navigation"></div>
			<div class="column main-content" id="content_container">
			<div id="content">
				<br><br><br><br><br><br><div class="ui grid purchase-list">
					<div class="row purchases-default" style="display: none;">
						<div class="center aligned column">
							<div class="ui segment">
								<div class="ui active inline loader" style="display: none;"></div>
								<div class="no-purchases">
									Install Purchasify Multi-Vendor
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="column">
							<div style="background-color:#fff;" id="purchases_list">					
								<div class="ui segment download-page-content">
								  <div class="ui middle aligned grid download-product-block">
									<div class="row">
									  <div class="column">
										<div class="ui list product-meta">
										  <div class="item">
											<center><div class="content">
											  <div class="header">
												<span style="font-size:30px;text-decoration:none!important;color:#333!important;">Purchasify Installation Processed</span>
											  </div><br>
											  <span style="text-align:left!important;font-size:16px;">
											  <strong>Store URL:</strong> <a href="<?php echo $_SESSION['install_url']; ?>" target="_blank"><?php echo $_SESSION['install_url']; ?></a><br>
											  <br>
											  <strong>Admin username:</strong> <?php echo $_SESSION['install_usern']; ?><br>
											  <strong>Admin password:</strong> <?php echo $_SESSION['install_passwd']; ?><br>
											  </span>
											  <br><br><br>
											  <a style="color:#fff!important;" class="ui button normal twitter" href="<?php echo $_SESSION['install_url']; ?>account/login">Visit admin panel <i class="fa fa-arrow-right"></i></a>
											</div></center>
										  </div>
										</div>
									  </div>
									</div>
								  </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		  </div>
		</div>
		</div>
    </div>
	</div>
	<!-- BODY END -->
	<!-- FOOTER CODE -->
	<script type="text/javascript" src="static/gen/scripts.min.js"></script>
	<script type="text/javascript" src="static/gen/packed_global.js?51b2b110"></script>
	<script type="text/javascript" src="static/gen/packed_user.js"></script>
	<!-- FOOTER CODE -->
  
</body>
</html>

<?php
@unlink("install.php");
@unlink("sql.sql");
unset($_SESSION['install_url']);
unset($_SESSION['install_usern']);
unset($_SESSION['install_passwd']);
session_unset();
session_destroy();
} else {
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Install Purchasify Multi-Vendor</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="Thibault Penin">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		
		
		<!-- Stylesheets -->
		<link rel="stylesheet" href="static/gen/elements.css">
		<link rel="stylesheet" href="static/gen/semantic.min.css">
		<link rel="stylesheet" href="static/gen/packed_global.css">
		<link rel="stylesheet" href="static/gen/packed_user.css">
		<!-- End Stylesheets -->
	    
		<!-- Favicons -->
		<link rel="apple-touch-icon" sizes="57x57" href="static/favicons/apple-touch-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="114x114" href="static/favicons/apple-touch-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="72x72" href="static/favicons/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="144x144" href="static/favicons/apple-touch-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="60x60" href="static/favicons/apple-touch-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="120x120" href="static/favicons/apple-touch-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="76x76" href="static/favicons/apple-touch-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="152x152" href="static/favicons/apple-touch-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="static/favicons/apple-touch-icon-180x180.png">
		<link rel="icon" type="image/png" href="static/favicons/favicon-96x96.png" sizes="96x96">
		<link rel="icon" type="image/png" href="static/favicons/favicon-16x16.png" sizes="16x16">
		<link rel="icon" type="image/png" href="static/favicons/favicon-32x32.png" sizes="32x32">
		<meta name="msapplication-TileColor" content="#2b5797">
		<meta name="msapplication-TileImage" content="static/favicons/mstile-144x144.png">
		<!-- End Favicons -->
		
</head>
<body>
	<!-- HEADER START -->
	<div class="sellfy-header-wrap">
	  <div class="ui one column grid full-width sellfy-header">
	   <div class="row">
		<div class="center aligned column">
		  <span style="color:#333!important;font-family:'Montserrat', sans-serif;font-weight:bold;font-size: 1.556em;" href="">Purchasify</span>
		</div>
	   </div>
	  </div>
	</div>
	<!-- HEADER END -->
	<!-- BODY START -->
	<div class="body">
	<div class="body-content">
      <div id="container" class="main-content-wrap">
		<div class="user-area-wrap wide">
		  <div class="ui stackable grid">
			<div class="column left-navigation" id="container_for_navigation"></div>
			<div class="column main-content" id="content_container">
			<div id="content">
				<br><br><br><br><br><br><div class="ui grid purchase-list">
					<div class="row purchases-default" style="display: none;">
						<div class="center aligned column">
							<div class="ui segment">
								<div class="ui active inline loader" style="display: none;"></div>
								<div class="no-purchases">
									Install Purchasify Multi-Vendor
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="column">
							<div style="background-color:#fff;" id="purchases_list">					
								<div class="ui segment download-page-content">
								  <div class="ui middle aligned grid download-product-block">
									<div class="row">
									  <div class="column">
										<div class="ui list product-meta">
										  <div class="item">
											<center><div class="content">
											  <div class="header">
												<span style="font-size:30px;text-decoration:none!important;color:#333!important;">Purchasify needs installation!</span>
											  </div><br>
											  <span style="font-size:16px;">With this script you can sell your products without resellers commission takes half the cost of your product. All profits just for you just need to install the script and add your products.</span>
											  <br><br><br>
											  <a style="color:#fff!important;background-color: #333;" class="ui button normal twitter" href="./install?step=1">Start installation</a>
											</div></center>
										  </div>
										</div>
									  </div>
									</div>
								  </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		  </div>
		</div>
		</div>
    </div>
	</div>
	<!-- BODY END -->
	<!-- FOOTER CODE -->
	<script type="text/javascript" src="static/gen/scripts.min.js"></script>
	<script type="text/javascript" src="static/gen/packed_global.js?51b2b110"></script>
	<script type="text/javascript" src="static/gen/packed_user.js"></script>
	<!-- FOOTER CODE -->
  
</body>
</html>

<?php } ?>