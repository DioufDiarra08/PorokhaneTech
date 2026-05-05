<!-- ======================= Section Head =================== -->
<?php require_once("view/sections/admin/head.php"); ?>

	<!-- ======================= Section Loader =================== -->
	<?php require_once("view/sections/admin/loader.php"); ?>
    
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
        
        <!-- ======================= Section Menu Haut =================== -->
        <?php require_once("view/sections/admin/menuHaut.php"); ?>
		
		<!-- ======================= Section Menu Gauche =================== -->
        <?php require_once("view/sections/admin/menuGauche.php"); ?>
		
		<!-- ======================= Section Base Content =================== -->
        <?php require_once("view/sections/admin/baseContent.php"); ?>
			
		<!-- ======================= Section Config =================== -->
        <?php require_once("view/sections/admin/config.php"); ?>
	
		<!-- ======================= Section Scroll To Top =================== -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
	</div>

	 <!--======================= Section Vendor JS Files ================== -->
	<script src="public/templates/templateAdmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="public/templates/templateAdmin/assets/vendor/php-email-form/validate.js"></script>
	<script src="public/templates/templateAdmin/assets/vendor/aos/aos.js"></script>
	<script src="public/templates/templateAdmin/assets/vendor/typed.js/typed.umd.js"></script>
	<script src="public/templates/templateAdmin/assets/vendor/waypoints/noframework.waypoints.js"></script>
	<script src="public/templates/templateAdmin/assets/vendor/purecounter/purecounter_vanilla.js"></script>
	<script src="public/templates/templateAdmin/assets/vendor/glightbox/js/glightbox.min.js"></script>
	<script src="public/templates/templateAdmin/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
	<script src="public/templates/templateAdmin/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
	<script src="public/templates/templateAdmin/assets/vendor/swiper/swiper-bundle.min.js"></script>
	
    <!-- ======================= Section Script =================== -->
    <?php require_once("view/sections/admin/script.php"); ?>

</body>
</html>
