	<!-- ======================= Error Message =================== -->
	<?php if (isset($_GET['error'])) : ?>	
		<script>
			Swal.fire({
				icon: "error",
				title: "<?php echo htmlspecialchars($_GET['title']); ?>",
				text: "<?php echo htmlspecialchars($_GET['message']); ?>",
			});
		</script>
	<?php endif ?>

	<!-- ======================= Error Message =================== -->
	<?php if (isset($_GET['success'])) : ?>	
		<script>
		Swal.fire({
			position: "top-end",
			icon: "success",
			title: "<?php echo htmlspecialchars($_GET['title']); ?>",
			text: "<?php echo htmlspecialchars($_GET['message']); ?>",
			showConfirmButton: false,
			timer: 1500
		});
		</script>
	<?php endif ?>