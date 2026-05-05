<!-- Recupération de la liste des compétences -->
<?php 
  require_once("model/experiencesModel.php");
  $listesExperiences = getAllExperiences();

  // var_dump($listeSerReas);
  // die;
?> 
<section id="experiences" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Experiences</h2>
        <p>Pour mieux mettre en valeur mon expertise, je présente ci-dessous un aperçu des compétences que j'ai acquises tout au long de ma formation et à travers mes différents projets..</p>
      </div><!-- End Section Title -->

      <div class="container">
        <div class="row gy-4">
          <div class="row row-space-10">
            <?php if(!empty($listesExperiences)) : ?>
              <?php foreach($listesExperiences as $experiences) : ?>
                <div class="col-lg-3 col-md-4">
                  <!-- Service Item -->
                  <div class="service">
                    <div class="desc text-center">
                      <span class="desc-title fw-bold fs-4"><?= htmlspecialchars($experiences["nom"]) ?></span> <br>
                      <span class="desc-text fs-5"><?= htmlspecialchars($experiences["date_experiences"]) ?></span>
								    </div>
                  </div><!-- End Service Item -->
                </div>
              <?php endforeach; ?>
            <?php else : ?>
                <p class="alert alert-danger">
                  Aucune compétence n'est trouvée !
                </p>
            <?php endif; ?>
          </div>
        </div>

      </div>

    </section>