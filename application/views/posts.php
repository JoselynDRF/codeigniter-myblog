<div class="container">
	<div class="row">
    <div class="col-md-12">

			<!-- Posts tabs -->
			<ul class="nav nav-tabs">
			  <li class="active"><a href="#postsList" data-toggle="tab" aria-expanded="true"> Posts </a></li>
			  <li class=""><a href="#newPost" data-toggle="tab" aria-expanded="false"> Criar Post </a></li>
			</ul>

			<div id="myTabContent" class="tab-content wrap">
			  <div class="tab-pane fade active in" id="postsList">

			  	<!-- Search post -->
  				<div class="col-sm-4 col-md-3">
						<div class="well bs-component search">
							<?php  
							$attributes = array('method' => 'get', 'class' => 'form-horizontal');
							echo form_open(base_url('posts'), $attributes);
							?>
							  <fieldset>
							    <legend class="text-center"> Pesquisar </legend>
									
									<div class="col-md-12">
								    <div class="form-group">
										  <label class="control-label" for="title"> Título </label>
										  <input type="text" class="form-control" name="title" id="title"  value="<?= $dataPosts['title'] ?>">
										</div>

								    <div class="form-group">
								      <label for="date" class="control-label"> Data </label>
								       <input type="date" class="form-control"  name="date" id="date" value="<?= $dataPosts['date'] ?>">
								    </div>

										<div class="form-group">
										  <label for="state" class="control-label"> Estado </label>
									    <select class="form-control" name="state" id="state">
									      <option></option>
												<?php foreach ($options as $option): ?>
													<option> <?= $option->description; ?> </option>
												<?php endforeach; ?>
									    </select>
										</div>

								    <div class="form-group wrap">
								      <button type="submit" class="btn btn-block btn-primary"> Pesquisar </button>
								    </div>
									</div>
							  </fieldset>
							</form>
						</div>
					</div>

					<!-- Posts table -->
					<div class="col-sm-8 col-md-9">
						<table class="table table-striped table-hover">
						  <thead>
						    <tr>
                  <th> Título </th>
                  <th> Estado </th>
									<th> Data </th>
									<th></th>
						    </tr>
						  </thead>
						  <tbody>
								<?php foreach ($posts as $post): ?>
								<tr>
                  <td> <?= $post->title ?> </td>
                  <td> <?= $post->description ?> </td>
									<td> <?= $post->date ?> </td>
									
									<td>
										<button 
											type="button" 
											class="btn btn-danger btn-xs" 
											data-toggle="modal" 
					    				data-target="#deleteModal"
					    				onclick="confirmDelete('<?= $post->id_post ?>', '<?= $post->title ?>', '<?= $post->content ?>')">
											<span class="glyphicon glyphicon-remove"></span>
										</button>
									</td>
								</tr>

							<?php endforeach ?>
						  </tbody>
						</table>

						<!-- Pagination -->
						<div class="text-center">
			      	<?= $links ?>
			 			</div>

				 	</div>
				</div>

				<!-- Create new post -->
			  <div class="tab-pane fade" id="newPost">
			  	<?php  
					$attributes = array('class' => 'form-horizontal');
					echo form_open(base_url('posts/newPost'), $attributes);
					?>
						<div class="form-group">
				      <label for="titlePost" class="col-md-1 control-label"> Título: </label>
				      <div class="col-md-6">
				        <input type="text" class="form-control" id="titlePost" name="title">
				      </div>
				    </div>

						<div class="form-group">
						  <label for="state" class="col-md-1 control-label"> Estado: </label>
						  <div class="col-md-6">
						    <select class="form-control" name="state" id="state">
									<?php foreach ($options as $option): ?>
										<option value="<?= $option->id_state ?>"> <?= $option->description; ?> </option>
									<?php endforeach; ?>
						    </select>
					  	</div>
					  </div>

						<div class="col-md-10 col-md-offset-1">
							<div class="form-group">
					    	<textarea name="content" id="content"></textarea>
					    </div>

					    <div class="form-group wrap">
					    	<button 
					    		type="button" 
					    		class="btn btn-default" 
					    		data-toggle="modal" 
					    		data-target="#previewModal"
					    		onclick="showPreview()"> Vista prévia
					    	</button>
				      	<button type="submit" class="btn btn-primary pull-right"> Criar </button>
				    	</div>
				    </div>

					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- MODALS -->

<!-- Modal Preview -->
<div class="modal fade" id="previewModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"> Vista Prévia </h4>
      </div>

      <div class="modal-body">
        <h3 id="previewTitle" class="text-center"></h3>
        <div id="previewContent"></div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal"> Aceitar </button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Delete Post -->
<div class="modal fade" id="deleteModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"> Tem certeza que pretende eliminar este post? </h4>
      </div>

      <div class="modal-body">
        <h4 id="deleteTitle" class="text-center"></h4>
        <div id="deleteContent"></div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"> Cancelar </button>
        <a class="btn btn-primary" id="buttonDelete" role="button"> Eliminar </a>
      </div>
    </div>
  </div>
</div>

<script>
  function showPreview() {
		var title = $("#titlePost").val();
		$("#previewTitle").html(title);

		var content = tinymce.activeEditor.getContent();
		$("#previewContent").html(content);
  }

	function confirmDelete(id, title, content) {
		$("#deleteTitle").html(title);
		$("#deleteContent").html(content);
		$('#buttonDelete').attr('href',"posts/deletePost/" + id);
  }
</script>

</body>
</html>
