
<!-- ======================= Section Head =================== -->
<?php require_once("../sections/admin/head.php"); ?>

	<!-- Recupération de la liste des experiencess -->
	<?php 
		require_once("../../model/experiencesModel.php");
		$listesExperiences = getAllExperiences();
		$listesExperiencesSup = getAllExperiencesDeleted();

		// var_dump($listeSerReas);
		// die;
	?> 
	<!-- ======================= Section Loader =================== -->
	<?php require_once("../sections/admin/loader.php"); ?>
    
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
        
        <!-- ======================= Section Menu Haut =================== -->
        <?php require_once("../sections/admin/menuHaut.php"); ?>
		
		<!-- ======================= Section Menu Gauche =================== -->
        <?php require_once("../sections/admin/menuGauche.php"); ?>
		
		<!-- ======================= Section Base Content =================== -->
        <div id="content" class="content">
			<ol class="breadcrumb float-xl-right">
				<li class="breadcrumb-item">
				<a href="#modal-add-experiences" class="btn btn-sm btn-dark text-white" data-toggle="modal">Ajouter</a>
				</li>
				<li class="breadcrumb-item"><a id="btnCorbeille" href="javascript:;">Corbeille</a></li>
				<li class="breadcrumb-item"><a id="btnListe" href="javascript:;">Afficher liste</a></li>
			</ol>
			

			<h1 class="page-header"># Gestion experiences</h1>
			
			<!-- Liste -->
			<div id="sectionListesExperiences" class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">Liste experiencess</h4>
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
				</div>
				
				<div class="panel-body">
					<table id="data-table-default" class="table table-striped table-bordered table-td-valign-middle">
						<thead>
							<tr>
								<th class="text-center text-nowrap">Nom</th>
								<th class="text-center text-nowrap">Date Expérience</th>
								<th class="text-center text-nowrap">Créer le </th>
								<th class="text-center text-nowrap">Modifier le</th>
								<th class="text-center text-nowrap">Actions</th>
							</tr>
						</thead>
						<tbody>
							<!-- Si la liste n'est pas vide -->
							<?php if(!empty($listesExperiences)) : ?>
								<?php foreach($listesExperiences as $experiences) : ?>
									<tr class="odd gradeX">

										<td><?= htmlspecialchars($experiences["nom"]) ?></td>

										<td><?= htmlspecialchars($experiences["date_experiences"]) ?></td>
										
										<td><?= htmlspecialchars($experiences["created_at"]) ?></td>

										<td>
											<?php if($experiences["update_at"]) : ?>
												<?= htmlspecialchars($experiences["update_at"]) ?>
											<?php else : ?>
												<span class="text-danger f-w-700">Jamais modifié</span>
											<?php endif; ?>
										</td>

										<td>
											<!-- Edition -->
											<a href="experiencesController?action=editExperiences&idExperiencesToEdit=<?=$experiences["id"] ?>">
												<i class="fa fa-edit btn btn-success fw-bold"></i>
											</a>

											<!-- Supprimer -->
											<a href="experiencesController?action=deleteExperiences&idExperiencesToDelete=<?=$experiences["id"] ?>">
												<i class="fa fa-trash btn btn-danger fw-bold"></i>
											</a>
										</td>
										
									</tr>
								<?php endforeach; ?>
							<?php else : ?>
								<p class="alert alert-danger">
									La liste des experiencess est vide !
								</p>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
			</div>

			<!-- Corbeille -->
			<div id="sectionCorbeilleExperiences" class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">Liste Experiences Supprimés</h4>
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
				</div>
				
				<div class="panel-body">
					<table id="data-table-default" class="table table-striped table-bordered table-td-valign-middle">
						<thead>
							<tr>
								<th class="text-center text-nowrap">Nom</th>
								<th class="text-center text-nowrap">Date Expérience</th>
								<th class="text-center text-nowrap">Créer le </th>
								<th class="text-center text-nowrap">Modifier le</th>
								<th class="text-center text-nowrap">Actions</th>
							</tr>
						</thead>
						<tbody>
							<!-- Si la liste n'est pas vide -->
							<?php if(!empty($listesExperiencesSup)) : ?>
								<?php foreach($listesExperiencesSup as $experiences) : ?>
									<tr class="odd gradeX">

										<td><?= htmlspecialchars($experiences["nom"]) ?></td>

										<td><?= htmlspecialchars($experiences["date_experiences"]) ?></td>
										
										<td><?= htmlspecialchars($experiences["created_at"]) ?></td>

										<td>
											<?php if($experiences["update_at"]) : ?>
												<?= htmlspecialchars($experiences["update_at"]) ?>
											<?php else : ?>
												<span class="text-danger f-w-700">Jamais modifié</span>
											<?php endif; ?>
										</td>

										<td>
											<!-- Restaurer -->
											<a class="btn btn-danger" href="experiencesController?idExperiencesToRestore=<?=$experiences["id"]?>">
												Restaurer
											</a>
										</td>
										
									</tr>
								<?php endforeach; ?>
							<?php else : ?>
								<p class="alert alert-danger">
									La liste des experiences supprimés est vide !
								</p>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
				
			</div>

		</div>
		<!-- ======================= Section Config =================== -->
        <?php require_once("../sections/admin/config.php"); ?>
	
		<!-- ======================= Section Scroll To Top =================== -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
	</div>

	<!-- ======================= Section showHidePageExperiences =================== -->
	<script src="public/js/showHidePageExperiences.js"></script>
	
    <!-- ======================= Section Script =================== -->
    <?php require_once("../sections/admin/script.php"); ?>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<!-- ======================= Error / Success Message =================== -->
	<?php require_once("../sections/admin/errorSuccessMsg.php"); ?>

	<!--======================= Modal Add competences / experiences ================== -->
	<div class="modal fade" id="modal-add-experiences" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Ajout d'une experience</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
				<div class="container">
					<div class="card shadow rounded-4">
					<div class="card-header bg-dark text-white">
						<h4 class="mb-0">Ajouter une experience</h4>
					</div>
					<div class="card-body">
						<form action="experiencesController" method="POST" enctype="multipart/form-data">
							<!-- Nom -->
							<div class="mb-3">
								<label for="nom" class="form-label">Nom</label>
								<input type="text" class="form-control" id="nom" name="nom" >
							</div>

							<!-- Description -->
							<div class="mb-3">
								<label for="date_experiences" class="form-label">Date Experience</label>
    							<input type="date" name="date_experiences" required>
							</div>

							<!-- Bouton de soumission -->
							<div class="d-grid">
								<button type="submit" name="formAddExperiences" class="btn btn-dark">Enregistrer</button>
								<button class="btn btn-danger" type="reset">Annuler</button>
							</div>
						</form>
					</div>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>