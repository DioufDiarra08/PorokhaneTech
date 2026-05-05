<!-- Recupération de la liste des compétences -->
<?php 
  require_once("model/competencesModel.php");
  $listesCompetences = getAll();

  // var_dump($listeSerReas);
  // die;
?> 
<section id="competences" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Compétences</h2>
        <p>À travers mes expériences et les projets réalisés durant ma formation, 
          j'ai pu développer et renforcer un ensemble de compétences techniques et pratiques que je mets aujourd'hui en valeur..</p>
      </div><!-- End Section Title -->

      <div class="container">
        <div class="row gy-4">
          <div class="row row-space-10">
            <?php if(!empty($listesCompetences)) : ?>
              <?php foreach($listesCompetences as $competences) : ?>
                <div class="col-lg-3 col-md-4">
                  <!-- Service Item -->
                  <div class="service">
                    <div class="image">
                      <a href="#"><img width="150" class="mx-auto d-block" src="public/images/<?= $competences["photo"] ?>" alt="" /></a>
                    </div>
                    <div class="desc text-center">
                      <span class="desc-title fw-bold"><?= htmlspecialchars($competences["nom"]) ?></span> <br>
                      <span class="desc-text"><?= htmlspecialchars($competences["description"]) ?></span>
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