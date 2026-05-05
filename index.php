<!--======================= Section Structure Doctype ================== -->
<?php require_once "view/sections/vitrine/structureDoctype.php"; ?>

<body class="index-page">

    <!--======================= Section Header ================== -->
    <?php require_once "view/sections/vitrine/header.php"; ?>

  <main class="main">

    <!--======================= Section Accueil ================== -->
    <?php require_once "view/sections/vitrine/accueil.php"; ?>

    <!--======================= Section Profil ================== -->
    <?php require_once "view/sections/vitrine/profil.php"; ?>

    <!--======================= Section Résumé ================== -->
    <?php require_once "view/sections/vitrine/resume.php"; ?>

    <!--======================= Section Compétences ================== -->
    <?php require_once "view/sections/vitrine/competences.php"; ?>

    <!--======================= Section Projets ================== -->
    <?php require_once "view/sections/vitrine/experiences.php"; ?>
    
    <!--======================= Section Contact ================== -->
    <?php require_once "view/sections/vitrine/contact.php"; ?>

  </main>

  <!--======================= Section Footer ================== -->
  <?php require_once "view/sections/vitrine/footer.php"; ?>

  <!--======================= Section Scroll-Top ================== -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!--======================= Section Preloader ================== -->
  <div id="preloader"></div>

  <!--======================= Section Vendor JS Files ================== -->
  <script src="public/templates/templateVitrine/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="public/templates/templateVitrine/assets/vendor/php-email-form/validate.js"></script>
  <script src="public/templates/templateVitrine/assets/vendor/aos/aos.js"></script>
  <script src="public/templates/templateVitrine/assets/vendor/typed.js/typed.umd.js"></script>
  <script src="public/templates/templateVitrine/assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="public/templates/templateVitrine/assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="public/templates/templateVitrine/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="public/templates/templateVitrine/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="public/templates/templateVitrine/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="public/templates/templateVitrine/assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!--======================= Section Main JS File ================== -->
  <script src="public/templates/templateVitrine/assets/js/main.js"></script>

  <!-- ======================= Error / Success Message =================== -->
	<?php require_once("view/sections/admin/errorSuccessMsg.php"); ?>

</body>

</html>
