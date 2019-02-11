@extends( 'admin.layout.admin' )@section( 'breadcrumbs' )
	<!-- breadcrumbs -->
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-9">
			<h2>Usuários</h2>
			<ol class="breadcrumb">
				<li>
					<a href="/admin">Paínel de controle</a>
				</li>
				<li class="active">Usuários </li>
			</ol>
		</div>
		<div class="col-md-3 padding-btn-header text-right">


		</div>
	</div>
<div id="showError"></div>
@endsection @section( 'content' )
	<div class="row">

	 @if(!$user)
			 @include('admin.users.create', ['roles' => $roles])
	         @include('admin.users.list', ['data' => $data])
		@else
			@include('admin.users.edit', ['roles' => $roles, 'user' => $user, 'userRole' => $userRole])
		@endif


	</div>
@endsection @push( 'style' )
<!-- Adicional Styles -->
<link rel="stylesheet" href="{{ asset('assets/theme-admin/css/plugins/OLForm/OLForm.css') }}"> @endpush @push('script')
<!-- Adicional Scripts -->
<script src="{{ asset('assets/theme-admin/js/plugins/OLForm/OLForm.jquery.js') }}"></script>
<!-- exclude -->
<script src="{{ asset('assets/theme-admin/js/plugins/OLForm/OLExclude.jquery.js') }}"></script>
<script>
	/*Form*/
$("#form").OLForm({listErrorPosition: 'after', listErrorPositionBlock: '.page-heading', 'urlRetun' : '{{Route('users.index')}}'});
	/*Exclude*/
$("#results").OLExclude({'action' : "/admin/users/destroy/", 'inputCheckName' : 'exclude', 'inputCheckAll' : 'excludeAll'});
</script>
@endpush
