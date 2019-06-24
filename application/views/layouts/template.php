<html lang="en">
<head>
	<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.9/css/bootstrap-dialog.min.css" rel="stylesheet" type="text/css" />
		<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Varela+Round" rel="stylesheet">
		<link href='<?php echo base_url(); ?>assets/dist/core/main.css' rel='stylesheet' />
		<link href='<?php echo base_url(); ?>assets/dist/daygrid/main.css' rel='stylesheet' />
		<link href='<?php echo base_url(); ?>assets/dist/timegrid/main.css' rel='stylesheet' />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/form-elements.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css"/>

		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/countrySelect.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/demo.css">

		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/msdropdown/dd.css" />

		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/msdropdown/flags.css" />


	<title>Wellington Care | Payment<?php echo $title ?></title>

</head>
<body>
		<img src="<?php echo base_url(); ?>assets/img/WC-logo.png" width="300">


			<?php echo $contents ?>


				<div class="footer">
					<div class="row">
						<div class="col-md-6">
							<div class="contacts text-left">
								<ul>
									<li><b>Contact information</b>
									</li>
									<li><i class="fa fa-home"></i> 1st Floor/Level, Mukwano Courts - Plot 13 Buganda Road (Opposite Hotel Triangle)</li>
									<li><i class="fa fa-phone"></i> <a href="tel:+256392178769"> (+256) 039 2178769</a> </li>
									<li><i class="fa fa-envelope-o"></i><a href="mailto:info@wellingtonclinics.com"> info@wellingtonclinics.com</a></li>
								</ul>
							</div>
						</div>
						<div class="col-md-3 col-sm-offset-3">
							<div class="contacts text-left">
								<ul>
									<li><b>Clinical hours</b> </li>
									<li>We're available 6 days a week as follows: -</li>
									<li><b>Monday-Friday:</b> 9am to 5pm</li>
									<li><b>Saturday:</b> 10am to 2pm</li>
									<li><b>Sunday:</b> Closed</li>

								</ul>
							</div>
						</div>
					</div>
			</div>





    <!--end page-->
	<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.9/js/bootstrap-dialog.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/numeral.min.js"></script>
	<!-- <script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/payment.js"></script> -->

	<!-- Javascript -->
<!-- <script src="<?php echo base_url(); ?>assets/js/jquery.backstretch.min.js"></script> -->
<script src='<?php echo base_url(); ?>assets/dist/core/main.js'></script>
<script src='<?php echo base_url(); ?>assets/dist/interaction/main.js'></script>
<script src='<?php echo base_url(); ?>assets/dist/daygrid/main.js'></script>
<script src='<?php echo base_url(); ?>assets/dist/timegrid/main.js'></script>
<script src="<?php echo base_url(); ?>assets/js/retina-1.1.0.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>

<script src="<?php echo base_url(); ?>assets/js/msdropdown/jquery.dd.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/countrySelect.js"></script>
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
<?php if(isset($calender_script)){ ?>
	<script src="<?php echo base_url(); ?>assets/js/calender.js"></script>
<?php } ?>
<script>
	$("#country_selector").countrySelect({
		// defaultCountry: "jp",
		onlyCountries: ['ug', 'ke', 'tz'],
		// responsiveDropdown: true,
		// preferredCountries: ['ca', 'gb', 'us']
	});
	$(document).ready(function() {
		$("#countries").msDropdown();
	})
	$(function () {
	  $('[data-toggle="tooltip"]').tooltip()
	})


</script>
</body>
</html>
