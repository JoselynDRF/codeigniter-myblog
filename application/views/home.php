<!-- Login Form -->
<div class="container">
	<div class="row">
    <div class="col-md-6 wrap">

			<div class="well bs-component text-center">
				<?php  
				$attributes = array('class' => 'form-horizontal');
				echo form_open('home/getUser', $attributes);
				echo form_fieldset('Login'); ?>

				<div class="form-group">
					<?php
					$attributes = array('class' => 'col-md-3 col-lg-2 control-label');
					echo form_label('Username', 'username', $attributes); ?>

					<div class="col-md-9 col-lg-10">
						<?php 
						$data = array('class' => 'form-control', 'name' => 'username', 'id' => 'username', 'placeholder' => 'UserTest');  
						echo form_input($data); ?>
					</div>
				</div>

				<div class="form-group">
					<?php				
					$attributes = array('class' => 'col-md-3 col-lg-2  control-label');
					echo form_label('Password', 'password', $attributes); ?>

					<div class="col-md-9 col-lg-10">
						<?php 
						$data = array('class' => 'form-control', 'name' => 'password', 'id' => 'password', 'placeholder' => 'abcd'); 
						echo form_password($data); ?>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-12">
						<?php 
						$attributes = array('class' => 'btn btn-primary btn-block');
						echo form_submit('submit', 'Login', $attributes); ?>
					</div>
				</div>

				<?= form_fieldset_close(); ?>
				</form>
			</div>
		</div>

		<div class="col-md-6">
			<img src="assets/img/blog.jpg" class="images">
		</div>
		
	</div>
</div>

</body>
</html>
