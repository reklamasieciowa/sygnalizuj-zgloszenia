@if ($errors->any())
	<div class="alert alert-danger">
		@foreach ($errors->all() as $error)
			<i class="fas fa-exclamation-triangle text-danger mr-2"></i>{{ $error }}
		@endforeach
	</div>
@endif