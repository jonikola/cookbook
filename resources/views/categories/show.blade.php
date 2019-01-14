@extends ('layouts.master')

@section ('styles')
<style>body {padding-top: 70px;}</style>
@endsection

@section ('content')
<div class="container">
	<h1 class="recipe-title">{{ ucfirst($category->name) }}</h1>
	<div class="row">
		@foreach ($recipes as $recipe)
		<div class="col-sm-6">
			<div class="row category">
				<div class="col-sm-7 cat-image">
					<img src="{{ asset('images/'.$recipe->category->name.'.jpg') }}">
				</div>
				<div class="col-sm-5 cat-recipe">
					<div>
						<span>{{ ucfirst($recipe->category->name) }}</span>
						<h2>{{ $recipe->title }}</h2>
						<a href="{{ route('display', $recipe) }}" class="btn btn-info">Pogledaj</a>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>
@endsection