@extends('admin.layout.admin') @section( 'breadcrumbs' )
<!-- breadcrumbs -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2>Permissões</h2>
        <ol class="breadcrumb">
            <li>
                <a href="/admin">Paínel de controle</a>
            </li>
            <li class="active">Permissões </li>
        </ol>
    </div>
    <div class="col-md-3 padding-btn-header text-right">

    </div>
</div>

@endsection @section('content')
<div class="row">
    @if(!$role)

	    @include('admin.roles.list', ['roles' => $roles, 'permission_list' => $permission_list])
        @include('admin.roles.create', ['permission' => $permission])

	@else
	   @include('admin.roles.edit', ['permission' => $permission, 'role' => $role, 'rolePermissions' => $rolePermissions])
	@endif
</div>

@endsection
@push('style')
<!-- Adicional Styles -->
<link rel="stylesheet" href="{{ asset('assets/theme-admin/css/plugins/OLForm/OLForm.css') }}">
@endpush
@push('script')
<!-- Adicional Scripts -->
<!-- forms -->
<script src="{{ asset('assets/theme-admin/js/plugins/OLForm/OLForm.jquery.js') }}"></script>
<!-- exclude -->
<script src="{{ asset('assets/theme-admin/js/plugins/OLForm/OLExclude.jquery.js') }}"></script>
<script>
/*Form*/
$("#form").OLForm({listErrorPosition: 'after', listErrorPositionBlock: '.page-heading', 'urlRetun' : '{{Route('roles.index')}}'});
	@if(!$role)
/*Exclude*/
$("#results").OLExclude({'action' : "/admin/roles/destroy/", 'inputCheckName' : 'exclude', 'inputCheckAll' : 'excludeAll'});

@endif




</script> @endpush
