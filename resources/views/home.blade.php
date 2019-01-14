@extends ('layouts.master')

@section ('content')
<section id="home" class="parallax-section">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<form class="col-sm-12" id="searchForm" action="/pretraga" method="post">
					<div class="form-group col-lg-6 col-lg-offset-3">
						<div class="form-group has-feedback">
							{{ csrf_field() }}
							<input class="form-control sch1 input-lg" name="search" id="search" placeholder="Pretrazi recepte" type="text">
							<span class="glyphicon glyphicon-search form-control-feedback"></span>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>		
</section>

<section id="gallery" class="parallax-section">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-2 col-md-8 col-sm-12 text-center">
				<h1 class="heading">Novi Recepti</h1>
				<hr>
			</div>
			@foreach ($recipes as $recipe)
				<div class="col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="0.3s">
					@if (!empty($recipe->image))
						<img src="{{ asset('storage/recipes/' . $recipe->image) }}" alt="recipe photo">
					@else
						<img src="{{ asset('images/'.$recipe->category->name.'.jpg') }}" alt="recipe photo">
					@endif
					<div>
						<h3><a href="{{ route('display', $recipe) }}">{{ $recipe->title }}</a></h3>
						<span>{{ ucfirst($recipe->category->name) }}</span>
					</div>
				</div>
			@endforeach
		</div>
	</div>
</section>
@endsection

@section ('scripts')

@endsection