<!DOCTYPE html>
<html lang="en">

<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->

<!--[if !IE]><!-->
<!--<![endif]-->
<head>
    


<?php $this->load->view('templates/campaigns/campaign/head'); ?>
         <!--Facebook meta code -->
		 <?php $this->load->view('templates/includes/head'); ?>
       <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-PVHSWSS');</script>
        <!-- End Google Tag Manager -->
	
	
	<!-- Global site tag (gtag.js) - Google Ads: 322041909 -->
<!--<script async src="https://www.googletagmanager.com/gtag/js?id=AW-322041909"></script>-->
<!--<script>-->
<!--  window.dataLayer = window.dataLayer || [];-->
<!--  function gtag(){dataLayer.push(arguments);}-->
<!--  gtag('js', new Date());-->

<!--  gtag('config', 'AW-322041909');-->
<!--</script>-->
<meta name="facebook-domain-verification" content="inphomwxoqgdz1alheg2xkbuqeid7w" />
</head>
<body>

 <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PVHSWSS"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

	<!-- Preloader code goes here -->
	<!-- <div class="preloader">
		<div class="container">
		<div class="row">
		<div class="col-2 mx-auto">
		<img class="preloader__image" width="100%" src="assets/images/loader.png" alt="" />
		</div>
		</div>
		</div>
	</div> -->
	<div class="page-wrapper">
	<!-- Preloader code ends here -->
	<?php $this->load->view('templates/includes/topbar'); ?>
		<?php $this->load->view('templates/campaigns/campaign/navbar'); ?>
		<?php $this->load->view('templates/includes/banner'); ?>
		<?php $this->load->view($view_path); ?>

			<!-- Footer Code goes here -->
		<footer class="site-footer">
			<div class="site-footer-bg" style="background-image: url(assets/images/backgrounds/footer-bg.jpg)"></div>
			<div class="container">
				<?php $this->load->view('templates/includes/footer'); ?>
				<?php $this->load->view('templates/includes/bottom_footer'); ?>
			</div>
		</footer>

		<!-- Footer code end here -->
		<?php $this->load->view('templates/includes/mobile_nav'); ?>
		<?php $this->load->view('templates/includes/search_pop'); ?>
		<a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i class="fa fa-angle-up"></i></a>
	</div>	
	<?php $this->load->view('templates/includes/scripts'); ?>

	<?php if (!empty($scripts) && count($scripts) > 0) : ?>
		<?php foreach ($scripts as $script) : ?>
			<script src="<?php echo $script; ?>"></script>
		<?php endforeach ?>
	<?php endif ?>
	</body>

</html>
