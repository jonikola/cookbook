<form method="post" enctype="multipart/form-data" action="/">
	{{ csrf_field() }}
	<div class="form-group">
		<label for="title">Naziv</label>
		<input type="text" class="form-control" id="title" name="title" autocomplete="off">
	</div>
	<div class="form-group">
		<label for="category">Kategorija</label>
		<input type="text" class="form-control" id="category" name="category">
	</div>
	<div class="form-group">
		<label for="image">Izaberi sliku</label>
		<input type="file" id="image" name="image">
	</div>
	<div class="form-group ingredients">
		<h4>Sastojci</h4>
		<div class="form-inline inner">
			<input type="text" class="form-control" name="ing[type][]" autocomplete="off">
			<input type="text" class="form-control" name="ing[qty][]" autocomplete="off">
			<button id="add-more" class="btn btn-info">+</button>
		</div>
	</div>

	<div class="form-group inst">
		<label for="instructions">Priprema</label>
		<textarea name="instructions" id="instructions" class="form-control"></textarea>
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Dodaj</button>
	</div>
</form>