<?php include("header/header-user_access.php"); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Edit product - <?php echo $web['title']; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php echo $web['description']; ?>">
		<meta name="author" content="Thibault Penin">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>


		<!-- Stylesheets -->
		<link rel="stylesheet" href="<?php echo $web['url']; ?>static/gen/elements.css">
		<link rel="stylesheet" href="<?php echo $web['url']; ?>static/gen/semantic.min.css">
		<link rel="stylesheet" href="<?php echo $web['url']; ?>static/gen/packed_global.css">
		<link rel="stylesheet" href="<?php echo $web['url']; ?>static/gen/packed_user.css">
		<!-- End Stylesheets -->

		<!-- Favicons -->
		<link rel="apple-touch-icon" sizes="57x57" href="<?php echo $web['url']; ?>static/favicons/apple-touch-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $web['url']; ?>static/favicons/apple-touch-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $web['url']; ?>static/favicons/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="144x144" href="<?php echo $web['url']; ?>static/favicons/apple-touch-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="60x60" href="<?php echo $web['url']; ?>static/favicons/apple-touch-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="120x120" href="<?php echo $web['url']; ?>static/favicons/apple-touch-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo $web['url']; ?>static/favicons/apple-touch-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="152x152" href="<?php echo $web['url']; ?>static/favicons/apple-touch-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="<?php echo $web['url']; ?>static/favicons/apple-touch-icon-180x180.png">
		<link rel="icon" type="image/png" href="<?php echo $web['url']; ?>static/favicons/favicon-96x96.png" sizes="96x96">
		<link rel="icon" type="image/png" href="<?php echo $web['url']; ?>static/favicons/favicon-16x16.png" sizes="16x16">
		<link rel="icon" type="image/png" href="<?php echo $web['url']; ?>static/favicons/favicon-32x32.png" sizes="32x32">
		<meta name="msapplication-TileColor" content="#2b5797">
		<meta name="msapplication-TileImage" content="<?php echo $web['url']; ?>static/favicons/mstile-144x144.png">
		<!-- End Favicons -->

</head>
<body>
	<!-- HEADER START -->
	<div class="sellfy-header-wrap">
	  <div class="ui two column grid full-width sellfy-header">
	   <div class="row">
		<div class="left aligned column">
		  <a style="color:#333!important;font-family:'Montserrat', sans-serif;font-weight:bold;font-size: 1.556em;" href="<?php echo $web['url']; ?>"><?php echo $web['home_title']; ?></a>
		</div>
		<div class="right aligned column connect-panel">
			<a class="menu-link dashboard" href="<?php echo $web['url']; ?>dashboard" data-pushstate="true" title="Go to my dashboard">Dashboard</a>
		 <div class="ui top right pointing dropdown text header-dropdown-right" tabindex="0">
			<span class="header-merchant-logo header-dropdown-url" style="background-image: url('<?php if(idinfo($_SESSION['ps_usern'],'avatar') !== NULL) { ?><?php echo idinfo($_SESSION['ps_usern'],'avatar'); ?><?php } ?><?php if(idinfo($_SESSION['ps_usern'],'avatar') == NULL) { ?><?php echo $web['url']; ?>static/img/profile-placeholder.png<?php } ?>')"></span> <i class="fa fa-angle-down"></i>

		  <div class="menu header-notification-dropdown" tabindex="-1">
			<div class="item">
			  <a id="profile_link" href="<?php echo $web['url']; ?>user/<?php echo $_SESSION['ps_usern']; ?>" title="My profile">My profile</a>
			</div>

			<div class="ui divider"></div>

			<div class="item">
			  <a href="<?php echo $web['url']; ?>upload" data-pushstate="true" title="Upload a product">Upload</a>
			</div>

			<div class="item">
			  <a href="<?php echo $web['url']; ?>products" data-pushstate="true" title="View my products" class="active">Products</a>
			</div>

			<div class="item">
			  <a href="<?php echo $web['url']; ?>account/purchases" data-pushstate="true" title="View my purchases">Purchases</a>
			</div>

			<div class="item">
			  <a href="<?php echo $web['url']; ?>account/offers" data-pushstate="true" title="View offers">Offers</a>
			</div>

			<?php if(idinfo($_SESSION['ps_usern'],"role") == 1) { ?>
			<div class="ui divider"></div>

			<div class="item">
			  <a href="<?php echo $web['url']; ?>admin/settings" data-pushstate="true" title="Edit my settings">Settings</a>
			</div>

			<div class="item">
			  <a href="mailto:hello@thibaultpenin.com" target="_blank" title="Contact Author">Help &amp; Support</a>
			</div>
			<?php } ?>

			<div class="ui divider"></div>

			<div class="item">
			  <a href="<?php echo $web['url']; ?>logout" title="Log out">Log out</a>
			</div>
		  </div>
		 </div>
		</div>
	   </div>
	  </div>
	</div>
	<!-- HEADER END -->
	<!-- BODY START -->
	<div class="body">
	<div class="body-content">
	<div id="container" class="main-content-wrap">
	<div class="user-area-wrap">
	<?php
			$custom_url = mysql_real_escape_string($_GET['custom_url']);
			$id = mysql_real_escape_string($_GET['id']);
			$sql = mysql_query("SELECT * FROM purchasify_items WHERE custom_url='$custom_url'");
			if(mysql_num_rows($sql)==0) { $redirect = $web['url']."not_found"; header("Location:$redirect"); }
			$row = mysql_fetch_array($sql);
			?>
			<?php
			if(isset($_POST['phps_update_info'])) {
				$name = mysql_real_escape_string($_POST['name']);
						$description = mysql_real_escape_string($_POST['description1']);
						$price_regular = mysql_real_escape_string($_POST['price_regular']);
						$price_extended = mysql_real_escape_string($_POST['price_extended']);
						$demo_url = mysql_real_escape_string($_POST['demo_url']);
						$screenshots_url = mysql_real_escape_string($_POST['screenshots_url']);
						$featured = mysql_real_escape_string($_POST['featured']);
						$membership = mysql_real_escape_string($_POST['membership']);
						$video_url = mysql_real_escape_string($_POST['video_url']);
						$category_id = mysql_real_escape_string($_POST['category_id']);

						if(empty($name) or empty($price_extended) or empty($description)) { echo '<div class="alert color red-color"><p align="center">Required fiels: Product name, description and price.</p></div>'; }
						else {
							$update = mysql_query("UPDATE purchasify_items SET name='$name',description='$description',price_regular='$price_regular',price_extended='$price_extended',demo_url='$demo_url',screenshots_url='$screenshots_url',featured='$featured',membership='$membership',video_url='$video_url',category_id='$category_id' WHERE custom_url='" . mysql_real_escape_string($row['custom_url']) . "'");
							$update = mysql_query("UPDATE purchasify_purchases SET name='$name' WHERE item_id='" . mysql_real_escape_string($row['custom_url']) . "'");
							$row = mysql_fetch_array(mysql_query("SELECT * FROM purchasify_items WHERE custom_url='" . mysql_real_escape_string($row['custom_url']) . "'"));
							echo '<div class="alert color blue">';
							echo '<p align="center"><span style="color:white">Your changes were saved successfully.</span></p>';
							echo '</div>';
						}
			}

			if(isset($_POST['phps_update_tpfiles'])) {
				$thumbnail = mysql_real_escape_string($_FILES['thumbnail_file']['name']);
						$preview = mysql_real_escape_string($_FILES['preview_file']['name']);
						$folder_name = $row['id'] * 2;
						$thumbnail_path = "uploads/".$folder_name."/".mysql_real_escape_string(basename($_FILES['thumbnail_file']['name']));
						$preview_path = "uploads/".$folder_name."/".mysql_real_escape_string(basename($_FILES['preview_file']['name']));

						if(empty($thumbnail) && empty($preview)) { echo '<div class="alert color red-color"><p align="center">Please select images.</p></div>'; }
						elseif(!empty($thumbnail) && empty($preview)) {
							@unlink($row['thumbnail']);
							if(@move_uploaded_file($_FILES['thumbnail_file']['tmp_name'], $thumbnail_path)) { $error = 0; } else { $error = 1; }

							if($error == 0) {
								$update = mysql_query("UPDATE purchasify_items SET thumbnail='$thumbnail_path' WHERE custom_url='$custom_url'");
								echo '<div class="alert color blue">';
								echo '<p align="center"><span style="color:white">Item thumbnail was changed successfully.</span></p>';
								echo '</div>';
							} else {
								echo '<div class="alert color red-color">';
								echo '<p align="center">Uploading error! Please try again.</p>';
								echo '</div>';
							}
						}
						elseif(!empty($preview) && empty($thumbnail)) {
							@unlink($row['preview']);
							if(@move_uploaded_file($_FILES['preview_file']['tmp_name'], $preview_path)) { $error = 0; } else { $error = 1; }

							if($error == 0) {
								$update = mysql_query("UPDATE purchasify_items SET preview='$preview_path' WHERE custom_url='$custom_url'");
								$update = mysql_query("UPDATE purchasify_purchases SET preview='$preview_path' WHERE item_id='" . mysql_real_escape_string($row['custom_url']) . "'");
								echo '<div class="alert color blue">';
								echo '<p align="center"><span style="color:white">Item preview was changed successfully.</span></p>';
								echo '</div>';
							} else {
								echo '<div class="alert color red-color">';
								echo '<p align="center">Uploading error! Please try again.</p>';
								echo '</div>';
							}
						}
						elseif(!empty($preview) && !empty($thumbnail)) {
							@unlink($row['thumbnail']);
							@unlink($row['preview']);
							if(@move_uploaded_file($_FILES['thumbnail_file']['tmp_name'], $thumbnail_path)) { $error = 0; } else { $error = 1; }
							if(@move_uploaded_file($_FILES['preview_file']['tmp_name'], $preview_path)) { $error = 0; } else { $error = 1; }

							if($error == 0) {
								$update = mysql_query("UPDATE purchasify_items SET thumbnail='$thumbnail_path',preview='$preview_path' WHERE custom_url='$custom_url'");
								$update = mysql_query("UPDATE purchasify_purchases SET preview='$preview_path' WHERE item_id='" . mysql_real_escape_string($row['custom_url']) . "'");
								echo '<div class="alert color blue">';
								echo '<p align="center"><span style="color:white">Item thumbnail and preview image was changed successfully.</span></p>';
								echo '</div>';
							} else {
								echo '<div class="alert color red-color">';
								echo '<p align="center">Uploading error! Please try again.</p>';
								echo '</div>';
							}
						} else {
							echo '<div class="alert color red-color">';
							echo '<p align="center">Uploading error! Please try again.</p>';
							echo '</div>';
						}
			}

			if(isset($_POST['phps_update_mfile'])) {
				$main = mysql_real_escape_string($_FILES['main_file']['name']);
						$check_dir = $web['main_folder_name'];
						if(!is_dir($check_dir)) { mkdir($check_dir); $contents = '<?php header("Location: ../"); ?>'; file_put_contents($check_dir."index.php",$contents); }
						$folder_name = $row['id'] * 2;
						$folder_name_2 = $folder_name * 5;
						$main_path = $check_dir."/".$folder_name_2."/".mysql_real_escape_string(basename($_FILES['main_file']['name']));
						$admin_email = $web['email'];

						if(empty($main)) { echo '<div class="alert color red-color"><p align="center">Please select main file.</p></div>'; }
						else {
							@unlink($row['main_file']);
							if(@move_uploaded_file($_FILES['main_file']['tmp_name'], $main_path)) { $error = 0; } else { $error = 1; }

							if($error == 0) {
								$update = mysql_query("UPDATE purchasify_items SET main_file='$main_path' WHERE custom_url='$custom_url'");
								$get_buyers = mysql_query("SELECT * FROM purchasify_purchases WHERE item_id='$custom_url'");
								if(mysql_num_rows($get_buyers)>0) {
									while($buyer = mysql_fetch_array($get_buyers)) {
										$buyer_email = $buyer['buyer_email'];
										$email_code = $buyer['code'];
										$to = $buyer_email;
										$headers  = "From: $web[email]\r\n";
										$headers .= "Content-type: text/html\r\n";
										$subject = "New update available for " . protect($row['name']);
										$username = protect($_SESSION['ps_usern']);
										$message = "<!DOCTYPE html>
<html hola_ext_inject=\"disabled\">
<head>
	<title></title>
	<meta name=\"charset\" content=\"utf-8\">
</head>
<body>
<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"color:#333;background:#fff;padding:0;margin:0;width:100%;font:15px/1.25em 'Helvetica Neue', Arial, Helvetica;\">
	<tbody>
		<tr width=\"100%\">
			<td align=\"left\" style=\"background:#f0f0f0;font:15px/1.25em 'Helvetica Neue', Arial, Helvetica;\" valign=\"top\">
			<table style=\"border:none;padding:0 18px;margin:50px auto;width:500px;\">
				<tbody>
					<tr height=\"57\" width=\"100%\">
						<td align=\"left\" style=\"border-top-left-radius:4px;border-top-right-radius:4px;background:#0079bf;padding:12px 18px;text-align:center;\" valign=\"top\">
						<div style=\"border-collapse:collapse;color:#ffffff;font-family:Montserrat, sans-serif;font-size:30px;font-weight:bold;line-height:100%;padding-top:10px;padding-right:0;padding-bottom:10px;padding-left:0;text-align:center;vertical-align:middle;\"><span style=\"color:#fff!important;\">$web[title]</span></div>
						</td>
					</tr>
					<tr width=\"100%\">
						<td align=\"left\" style=\"border-bottom-left-radius:4px;border-bottom-right-radius:4px;background:#fff;padding:18px;\" valign=\"top\">
						<h1 style=\"font-size:20px;margin:0;color:#333;\">Hey " . protect($buyer['name']) . ",</h1>

						<p style=\"font:15px/1.25em 'Helvetica Neue', Arial, Helvetica;color:#333;\">There is a new update available for a product you've purchased. Click here to download this update:</p>

						<p style=\"font:15px/1.25em 'Helvetica Neue', Arial, Helvetica;color:#333;\"><a href=\"$web[url]account/purchases\" style=\"border-radius:3px;background:#3aa54c;color:#fff;display:block;font-weight:700;font-size:16px;line-height:1.25em;margin:24px auto 24px;padding:10px 18px;text-decoration:none;width:180px;text-align:center;\" target=\"_blank\">View purchases</a></p>

						<p style=\"font:15px/1.25em 'Helvetica Neue', Arial, Helvetica;color:#939393;margin-bottom:0;\">If you didn't purchase a $web[title] product, just delete this email and everything will go back to the way it was.</p>
						</td>
					</tr>
				</tbody>
			</table>
			</td>
		</tr>
	</tbody>
</table>
</body>
</html>
";
										mail($to, $subject, $message, $headers);
									}
								}
								echo '<div class="alert color blue">';
								echo '<p align="center"><span style="color:white">Item main file was updated successfully. Download link is sent to buyers.</span></p>';
								echo '</div>';
							} else {
								echo '<div class="alert color red-color">';
								echo '<p align="center">Uploading error! Please try again.</p>';
								echo '</div>';
							}
						}
			}
			?>
		<?php if(idinfo($_SESSION['ps_usern'],"role") == 0) { ?>
			<?php if($_SESSION['ps_usern'] !== $row['author']) { $redirect = $web['url']."not_found"; header("Location:$redirect"); } ?>
		<?php } ?>
	  <div class="ui stackable grid">
	   <div class="column left-navigation" id="container_for_navigation">
		<div class="ui fluid vertical menu">
		  <a class="green item" href="<?php echo $web['url']; ?>dashboard" data-pushstate="true">Dashboard</a>

		  <div class="header item">
			Products
		  </div>

		  <div class="item submenu-wrap">
			<div class="menu submenu">

				<a class="green item " href="<?php echo $web['url']; ?>upload" data-pushstate="true">
				  Add new product
				</a>

				<a class="green item active" href="<?php echo $web['url']; ?>products" data-pushstate="true">
				  My products
				</a>

				<?php if(idinfo($_SESSION['ps_usern'],"role") == 1) { ?>
				<a class="green item " href="<?php echo $web['url']; ?>products/all" data-pushstate="true">
				  All products
				</a>
				<?php } ?>

			</div>
		  </div>

		  <div class="header item">
			My Account
		  </div>

		  <div class="item submenu-wrap">
			<div class="menu submenu">

				<a class="green item " href="<?php echo $web['url']; ?>account/profile" data-pushstate="true">
				  Edit Profile
				</a>

				<a class="green item " href="<?php echo $web['url']; ?>account/payment" data-pushstate="true">
				  Payment Options
				</a>

				<a class="green item " href="<?php echo $web['url']; ?>account/password" data-pushstate="true">
				  Change password
				</a>

				<a class="green item " href="<?php echo $web['url']; ?>account/purchases" data-pushstate="true">
				  Purchases
				</a>

				<a class="green item " href="<?php echo $web['url']; ?>account/offers" data-pushstate="true">
				  Offers
				</a>

			</div>
		  </div>

		  <?php if(idinfo($_SESSION['ps_usern'],"role") == 1) { ?>
		  <div class="header item">
			Settings
		  </div>

		  <div class="item submenu-wrap">
			<div class="menu submenu">
				<a class="green item " href="<?php echo $web['url']; ?>admin/settings" data-pushstate="true">System</a>
				<a class="green item " href="<?php echo $web['url']; ?>admin/options" data-pushstate="true">Additional</a>
				<a class="green item " href="<?php echo $web['url']; ?>admin/payments" data-pushstate="true">Payment</a>
			</div>
		  </div>
		  <?php } ?>

		  <a class="green item " href="<?php echo $web['url']; ?>logout" data-pushstate="true">Log out</a>
		</div>
	   </div>
	   <div class="column main-content" id="content_container">
		<div id="content">
  <div id="container_for_title"></div>
  <div id="container_for_page_body">
<div id="container_for_title">
  <div class="head-description">
    <div class="ui grid full-width">
      <div class="equal height two column row">
        <div class="column">
          <h2 class="ui header">
              Edit Product
          </h2>
        </div>

        <div class="right aligned column">
          <a class="ui tiny blue button product-share" href="<?php echo $web['url']; ?>delete/<?php echo protect($row['custom_url']); ?>">
            Delete product
          </a><!--
       --><a class="ui tiny basic button" href="<?php echo $web['url']; ?>p/<?php echo protect($row['custom_url']); ?>" target="_blank">
            View product
          </a>
        </div>

      </div>

    </div>
  </div>
</div>

<div id="container_for_page_body">
			<form action="" method="POST">
				<div id="new_product_container" class="boxtop new-product-container">
					<div id="product-basic" class="product-tab">

						<div class="ui grid form full-width product-upload-form-wrap  editing">
							<!-- INFORMATION -->
							<div class="row">
								<div class="column">
								<?php if(idinfo($_SESSION['ps_usern'],"role") == 1) { ?>
								  <div class="ui ignored info message visible">
									<b>As an administrator you can view all files uploaded:</b>
									<br><br>
									Preview image: <a target="_blank" href="<?php echo $web['url']; ?><?php echo protect($row['preview']); ?>">view</a><br>
									Thumbnail image: <a target="_blank" href="<?php echo $web['url']; ?><?php echo protect($row['thumbnail']); ?>">view</a><br>
									Main file: <a target="_blank" href="<?php echo $web['url']; ?><?php echo protect($row['main_file']); ?>">download</a>
								  </div>
								<?php } ?>
									<div class="field">
										<label for="name">Product name</label>
										<input type="text" placeholder="Product name..." value="<?php echo protect($row['name']); ?>" name="name" id="name" required>
									</div>
									<!-- <center><a href="mailto:hello@thibaultpenin.com11-why-i-can-t-use-discount-field-on-upload" target="_blank"> Why DISCOUNT field is disabled?</a></center> -->
									<center>To make a free product please put <strong>0.00</strong> in the field <strong>PRICE</strong></center>
									<span>&nbsp;</span>
									<!-- <div class="two fields">
									<div class="field">
									  <div class="ui input join" disabled>
                                        <div class="ui dropdown selection product-currency" tabindex="0">
                                            <center><div class="text"><s>DISCOUNT</s></div></center>
                                        </div>
                                        <input class="join" type="text" placeholder="0.00" value="<?php echo protect($row['price_regular']); ?>" name="price_regular" id="price_regular" disabled>
                                      </div>
									</div> -->
									<div class="field">
									  <div class="ui input join">
                                        <div class="ui dropdown selection product-currency" tabindex="0">
                                            <center><div class="text">PRICE</div></center>
                                        </div>
                                        <input class="join" type="text" placeholder="1.00" value="<?php echo protect($row['price_extended']); ?>" name="price_extended" id="price_extended" required>
                                      </div>
									</div>
									<!-- </div> -->
									<br>
									<div class="field">
										<label for="description1">Product description</label>
										<textarea placeholder="Description..." name="description1" id="description1" required><?php echo protect($row['description']); ?></textarea>
									</div>
									<?php if(idinfo($_SESSION['ps_usern'],"role") == 0) { ?>
									<div class="ui grid">
									  <div class="two column row fields">
										<div class="equal height two column row fields product-upload-price-field">
											<label for="demo_url">Demo URL (optional)</label>
											<input type="text" placeholder="http://demo.yoursite.com/" value="<?php echo protect($row['demo_url']); ?>" name="demo_url" id="demo_url">
										</div>
										<div class="equal height two column row fields product-upload-price-field">
											<label for="screenshots_url">Screenshots URL (optional)</label>
											<input type="text" placeholder="http://yoursite.com/screenshots" value="<?php echo protect($row['screenshots_url']); ?>" name="screenshots_url" id="screenshots_url">
										</div>
									  </div>
									</div>
									<div class="ui grid">
									  <div class="two column row fields">
										<div class="equal height two column row fields product-upload-price-field">
											<label for="video_url">YouTube Video ID (optional)</label>
											<input type="text" placeholder="e.g: Lg-WPNpBhp4" value="<?php echo protect($row['video_url']); ?>" name="video_url" id="video_url">
										</div>
										<div class="equal height two column row fields product-upload-price-field">
											<label for="custom_url">Custom URL (you can't edit this field)</label>
											<input type="text" placeholder="ol8Hw" maxlength="5" value="<?php echo protect($row['custom_url']); ?>" id="custom_url" disabled>
										</div>
									  </div>
									</div>
									<?php } ?>
									<?php if(idinfo($_SESSION['ps_usern'],"role") == 1) { ?>
									<div class="ui grid">
									  <div class="two column row fields">
										<div class="equal height two column row fields product-upload-price-field">
											<label for="video_url">YouTube Video ID (optional)</label>
											<input type="text" placeholder="e.g: Lg-WPNpBhp4" value="<?php echo protect($row['video_url']); ?>" name="video_url" id="video_url">
										</div>
										<div class="equal height two column row fields product-upload-price-field">
											<label for="custom_url">Custom URL (you can't edit this field)</label>
											<input type="text" placeholder="ol8Hw" maxlength="5" value="<?php echo protect($row['custom_url']); ?>" id="custom_url" disabled>
										</div>
									  </div>
									</div>
									<div class="ui grid">
									  <div class="two column row fields">
									    <div class="equal height two column row fields product-upload-price-field">
											<label for="demo_url">Demo URL (optional)</label>
											<input type="text" placeholder="https://demo.yoursite.com/" value="<?php echo protect($row['demo_url']); ?>" name="demo_url" id="demo_url">
										</div>
									    <div class="equal height two column row fields product-upload-price-field">
											<label for="screenshots_url">Screenshots URL (optional)</label>
											<input type="text" placeholder="https://yoursite.com/screenshots" value="<?php echo protect($row['screenshots_url']); ?>" name="screenshots_url" id="screenshots_url">
										</div>
									  </div>
									</div>
									<div class="ui grid">
									  <div class="two column row fields">
										<div class="equal height two column row fields public-switch-row">
											<div class="ui toggle checkbox store-page-checkbox checked">
												<input type="checkbox" name="featured" <?php if($row['featured'] == on) { ?>checked=""<?php } ?> id="featured">
												<label id="store_page" for="featured" class="public_label">Visible on homepage ?</label>
											</div>
										</div>
										<div class="equal height two column row fields public-switch-row">
											<div class="ui toggle checkbox store-page-checkbox checked">
												<input type="checkbox" name="membership" <?php if($row['membership'] == on) { ?>checked=""<?php } ?> id="membership">
												<label id="store_page" for="membership" class="public_label">Membership plan product ?</label>
											</div>
										</div>
									  </div>
									</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
					<br>
				</div>
				<div class="setting-button-holder editing">
            <div class="ui three column grid">
                <div class="row equal height">

                    <div class="middle aligned three wide column">
                        <a id="delete-product" class="ui basic button" href="<?php echo $web['url']; ?>delete/<?php echo protect($row['custom_url']); ?>">
                            Delete product
                        </a>
                    </div>

                    <div class="right aligned two wide column">
                        <input type="submit" name="phps_update_info" value="Update information" class="ui button green submit_product is-edit">
                    </div>
                </div>
            </div>
        </div>
			</form>
		<form action="" method="POST" enctype="multipart/form-data">
				<div id="new_product_container" class="boxtop new-product-container">
					<div id="product-basic" class="product-tab">
						<div class="ui grid form full-width product-upload-form-wrap  editing">
							<!-- PRODUCT IMAGES -->
							<div class="two column row marginless">
							  <div class="column">
								<label class="product-add-picture" id="add_product_picture">Update product preview</label>
							  </div>
							  <div class="right aligned column">
								<label id="recommended_picture_size">(JPEG recommended)</label>
							  </div>
							</div>
							<div class="row">
								<div class="column product-images">
									<div style="width:100%" class="product-images-thumbnail placeholder drop-area no-images">
										<br><i class="fa fa-cloud-upload fa-5x"></i><br>
										<input class="ui basic button" name="preview_file" type="file"/>
									</div>
								</div>
							</div>
							<div class="two column row marginless">
							  <div class="column">
								<label class="product-add-picture" id="add_product_picture">Update product thumbnail</label>
							  </div>
							  <div class="right aligned column">
								<label id="recommended_picture_size">(80x80 &amp; JPEG recommended)</label>
							  </div>
							</div>
							<div class="row">
								<div class="column product-images">
									<div style="width:100%" class="product-images-thumbnail placeholder drop-area no-images">
										<br><i class="fa fa-cloud-upload fa-5x"></i><br>
										<input class="ui basic button" name="thumbnail_file" type="file"/>
									</div>
								</div>
							</div>
						</div>
					</div>
					<br>
				</div>
				<div class="setting-button-holder editing">
            <div class="ui three column grid">
                <div class="row equal height">
                    <div class="center aligned two wide column">
                        <input type="submit" name="phps_update_tpfiles" value="Update images" class="ui button green submit_product is-edit">
                    </div>
                </div>
            </div>
        </div>
			</form>
		<form action="" method="POST" enctype="multipart/form-data">
				<div id="new_product_container" class="boxtop new-product-container">
					<div id="product-basic" class="product-tab">
						<div class="ui ignored warning message visible">
							An email will be sent to all buyers of this product if you update the main file.
						</div>
						<div class="ui grid form full-width product-upload-form-wrap  editing">
							<!-- PRODUCT MAIN FILE -->
							<div class="two column row marginless">
							  <div class="column">
								<label class="product-add-picture" id="add_product_picture">Update product file</label>
							  </div>
							  <div class="right aligned column">
								<label id="recommended_picture_size">(Recommended filetype .ZIP)</label>
							  </div>
							</div>
							<div class="row">
								<div class="column product-images">
									<div style="width:100%" class="product-images-thumbnail placeholder drop-area no-images">
										<br><i class="fa fa-cloud-upload fa-5x"></i><br>
										<input name="main_file" class="ui basic button" type="file"/>
									</div>
								</div>
							</div>
						</div>
					</div>
					<br>
				</div>
				<div class="setting-button-holder editing">
					<div class="ui three column grid">
						<div class="row equal height">
							<div class="center aligned two wide column">
								<input type="submit" name="phps_update_mfile" value="Update main file" class="ui button green submit_product is-edit"/>
							</div>
						</div>
					</div>
				</div>
			</form>
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
	<!-- FOOTER START -->
	<div class="centered footer">
	  <a class="icon-sellfy-logo" href="<?php echo $web['url']; ?>"></a>
	  <p>
		<span class="item">
		  <?php echo $web['footer_text']; ?>
		</span>
	  </p>
	  <p class="footer-copyright">
		<span class="item">
		  &copy; <?php echo date("Y"); ?> <?php echo $web['sitename']; ?>, All rights reserved | Made with <i style="color:#ea6052;" class="fa fa-heart"></i> by <strong>Thibault Penin</strong>
		</span>
	  </p>
	</div>
	<!-- FOOTER END -->

	<!-- FOOTER CODE -->
	<script type="text/javascript">
	tinymce.init({
		selector: "textarea",
		toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
	});
	</script>
	<script type="text/javascript" src="<?php echo $web['url']; ?>static/gen/scripts.min.js"></script>
	<script type="text/javascript" src="<?php echo $web['url']; ?>static/gen/packed_global.js?51b2b110"></script>
	<script type="text/javascript" src="<?php echo $web['url']; ?>static/gen/packed_user.js?0a5e83c1"></script>
	<!-- FOOTER CODE -->

</body>
</html>