<body>

	<!-- Nav -->
	<nav class="navbar navbar-default" style="border-radius: 0">
		<div class="container">
		  <div class="navbar-header">
		    <a class="navbar-brand" href="#"> My Blog </a>
		  </div>

			<?php 
				if($this->session->userdata('username') != null): ?>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="<?= base_url() ?>/posts/logout"> Sair </a></li>
					</ul> <?php 
				endif; ?>

			<ul class="nav navbar-nav navbar-right">
				<li><a href="#"> <?= $this->session->userdata('username'); ?> </a></li>
			</ul>

		</div>
	</nav>
