@extends ('layouts.master')

@section ('styles')
<style>
	body {padding-top: 70px;}
</style>
@endsection

@section ('content')

<section id="main">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-7 recipe-info">
				<h1 class="recipe-title">{{ $recipe->title }}</h1>
				<span>{{ ucfirst($recipe->category->name) }}</span>
				<div class="btn-container">
					<span class="button">
						<a id="add" role="button">
							<img src="{{ asset('images/add.png') }}" alt="">Dodaj u listu
						</a>
					</span>
					<span class="button">
						<a id="print" role="button">
							<img src="{{ asset('images/print.png') }}" alt="">Stampaj
						</a>
					</span>
				</div>
			</div>
			<div class="col-sm-12 col-md-5">
				<div class="recipe-photo">
					@if (!empty($recipe->image))
						<img src="{{ asset('storage/recipes/' . $recipe->image) }}" alt="recipe photo">
					@else
						<img src="{{ asset('images/'.$recipe->category->name.'.jpg') }}" alt="recipe photo">
					@endif
				</div>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-sm-12 col-md-6">
				<div class="recipe-ingredients">
					<h2 class="subtitle">Sastojci</h2>
					<ul class="ing-list">
						@foreach($recipe->ingredients as $ing)
							<li>{{ $ing->pivot->qty }} {{ $ing->name }}</li>
						@endforeach
					</ul>
				</div>
			</div>
			<div class="col-sm-12 col-md-6">
				<div class="recipe-directions">
					<h2 class="subtitle">Priprema</h2>
					<p>{{ $recipe->instructions }}</p>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection

@section ('scripts')
<script src="{{ asset('js/show.js') }}"></script>
@endsection