@extends ('layouts.master')

@section ('styles')
<style>body {padding-top: 70px;}</style>
@endsection

@section ('content')
<div class="container">
	@foreach ($recipes as $recipe)
	<div class="row">
		<div class="col-md-offset-1 col-md-4 recipe-photo">
			<img src="{{ asset('images/'.$recipe->category->name.'.jpg') }}" alt="recipe photo">
		</div>
		<div class="col-md-offset-1 col-md-5 recipe-info">
			<h2>{{ $recipe->title }}</h2>
			<span>{{ ucfirst($recipe->category->name) }}</span>
			<p>{{ str_limit($recipe->instructions, 150) }}</p>
			<a href="{{ route('display', $recipe) }}" class="btn btn-info">Pogledaj</a>
		</div>
	</div>
	@endforeach
</div>
@endsection