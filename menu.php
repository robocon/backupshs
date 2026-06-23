<?php 
$page_index = (PAGE==='index') ? 'active' : '' ;
$page_drug = (PAGE==='drug') ? 'active' : '' ;
$page_lab = (PAGE==='lab') ? 'active' : '' ;
?>
<nav class="navbar navbar-expand-lg custom-color" style="background-color: #20c997;">
	<div class="container-fluid">
		<a class="navbar-brand" href="#">Home</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link <?=$page_index;?>" href="index.php">ทะเบียน</a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?=$page_drug;?>" href="drug.php">ห้องยา</a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?=$page_lab;?>" href="lab.php">LAB</a>
				</li>
			</ul>
		</div>
	</div>
</nav>
<style>
	.custom-color{
		background-color: #20c997;
	}
	.navbar-brand, 
	.custom-color .nav-link{
		color: #ffffff;
	}
	a.nav-link.active {
		background-color: #d5d5d5;
	}
</style>