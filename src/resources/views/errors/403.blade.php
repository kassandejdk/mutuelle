@extends('layouts.error')
@section('content')
<div class="row w-100 mx-0 auth-page">
	<div class="col-md-8 col-xl-6 mx-auto d-flex flex-column align-items-center">
		<img src="{{ asset('admin/assets/images/others/404.svg')}}" class="img-fluid mb-2" alt="404">
		<h1 class="fw-bolder mb-22 mt-2 tx-80 text-muted">403</h1>
		<h4 class="mb-2">Page interdite</h4>
		<h6 class="text-muted mb-3 text-center">Oopps!! Vous n'avez pas les droits d'access a cette page.</h6>
		<a href="/">Quitter</a>
	</div>
</div>
@endsection