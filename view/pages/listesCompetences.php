
<!-- ======================= Section Head =================== -->
<?php require_once("../sections/admin/head.php"); ?>

	<!-- Recupération de la liste des compétences -->
	<?php 
		require_once("../../model/competencesModel.php");
		$listesCompetences = getAll();
		$listesCompetencesSup = getAllDeleted();

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
				<a href="#modal-add-competences" class="btn btn-sm btn-dark text-white" data-toggle="modal">Ajouter</a>
				</li>
				<li class="breadcrumb-item"><a id="btnCorbeille" href="javascript:;">Corbeille</a></li>
				<li class="breadcrumb-item"><a id="btnListe" href="javascript:;">Afficher liste</a></li>
			</ol>
			

			<h1 class="page-header"># Gestion Compétences</h1>
			
			<!-- Liste -->
			<div id="sectionListesCompetences" class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">Liste Compétences</h4>
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
								<th class="text-center text-nowrap" width="1%" data-orderable="false">Photo</th>
								<th class="text-center text-nowrap">Nom</th>
								<th class="text-center text-nowrap">Description</th>
								<th class="text-center text-nowrap">Créer le </th>
								<th class="text-center text-nowrap">Modifier le</th>
								<th class="text-center text-nowrap">Actions</th>
							</tr>
						</thead>
						<tbody>
							<!-- Si la liste n'est pas vide -->
							<?php if(!empty($listesCompetences)) : ?>
								<?php foreach($listesCompetences as $competences) : ?>
									<tr class="odd gradeX">

										<td width="1%" class="with-img">
											<img src="public/images/<?= $competences["photo"] ?>" class="img-rounded height-30" />
										</td>

										<td><?= htmlspecialchars($competences["nom"]) ?></td>

										<td><?= htmlspecialchars($competences["description"]) ?></td>
										
										<td><?= htmlspecialchars($competences["created_at"]) ?></td>

										<td>
											<?php if($competences["update_at"]) : ?>
												<?= htmlspecialchars($competences["update_at"]) ?>
											<?php else : ?>
												<span class="text-danger f-w-700">Jamais modifié</span>
											<?php endif; ?>
										</td>

										<td>
											<!-- Edition -->
											<a href="competencesController?action=edit&idCompetencesToEdit=<?=$competences["id"] ?>">
												<i class="fa fa-edit btn btn-success fw-bold"></i>
											</a>

											<!-- Supprimer -->
											<a href="competencesController?action=delete&idCompetencesToDelete=<?=$competences["id"] ?>">
												<i class="fa fa-trash btn btn-danger fw-bold"></i>
											</a>
										</td>
										
									</tr>
								<?php endforeach; ?>
							<?php else : ?>
								<p class="alert alert-danger">
									La liste des compétences est vide !
								</p>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
			</div>

			<!-- Corbeille -->
			<div id="sectionCorbeilleCompetences" class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">Liste compétences Supprimés</h4>
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
								<th class="text-center text-nowrap" width="1%" data-orderable="false">Photo</th>
								<th class="text-center text-nowrap">Nom</th>
								<th class="text-center text-nowrap">Descriptiopn</th>
								<th class="text-center text-nowrap">Créer le </th>
								<th class="text-center text-nowrap">Modifier le</th>
								<th class="text-center text-nowrap">Actions</th>
							</tr>
						</thead>
						<tbody>
							<!-- Si la liste n'est pas vide -->
							<?php if(!empty($listesCompetencesSup)) : ?>
								<?php foreach($listesCompetencesSup as $competences) : ?>
									<tr class="odd gradeX">

										<td width="1%" class="with-img">
											<img src="public/images/<?= $competences["photo"] ?>" class="img-rounded height-30" />
										</td>

										<td><?= htmlspecialchars($competences["nom"]) ?></td>

										<td><?= htmlspecialchars($competences["description"]) ?></td>
										
										<td><?= htmlspecialchars($competences["created_at"]) ?></td>

										<td>
											<?php if($competences["update_at"]) : ?>
												<?= htmlspecialchars($competences["update_at"]) ?>
											<?php else : ?>
												<span class="text-danger f-w-700">Jamais modifié</span>
											<?php endif; ?>
										</td>

										<td>
											<!-- Restaurer -->
											<a class="btn btn-danger" href="competencesController?idCompetencesToRestore=<?=$competences["id"]?>">
												Restaurer
											</a>
										</td>
										
									</tr>
								<?php endforeach; ?>
							<?php else : ?>
								<p class="alert alert-danger">
									La liste des compétences supprimés est vide !
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

	<!-- ======================= Section showHidePageCompetences =================== -->
	<script src="public/js/showHidePageCompetences.js"></script>
	
    <!-- ======================= Section Script =================== -->
    <?php require_once("../sections/admin/script.php"); ?>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<!-- ======================= Error / Success Message =================== -->
	<?php require_once("../sections/admin/errorSuccessMsg.php"); ?>

	<!--======================= Modal Add Service / Réalisation ================== -->
	<div class="modal fade" id="modal-add-competences" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Ajout d'une compétence</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
				<div class="container">
					<div class="card shadow rounded-4">
					<div class="card-header bg-dark text-white">
						<h4 class="mb-0">Ajouter une compétence</h4>
					</div>
					<div class="card-body">
						<form action="competencesController" method="POST" enctype="multipart/form-data">
							<!-- Nom -->
							<div class="mb-3">
								<label for="nom" class="form-label">Nom</label>
								<input type="text" class="form-control" id="nom" name="nom" >
							</div>

							<!-- Description -->
							<div class="mb-3">
								<label for="description" class="form-label">Description</label>
								<textarea class="form-control" id="description" name="description" rows="4" ></textarea>
							</div>

							<!-- Photo -->
							<div class="mb-3">
								<label for="photo" class="form-label">Photo</label>
								<input type="file" class="form-control" id="photo" name="photo" accept="image/*" >
							</div>

							<!-- Bouton de soumission -->
							<div class="d-grid">
								<button type="submit" name="formAddCompetences" class="btn btn-dark">Enregistrer</button>
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