@extends('backend.layouts.master')


@section('title')
liste des Administrateurs| Tableau de Bord
@endsection





@section('styles')
{{--
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
--}}
<link rel="stylesheet" href="{{asset('backend/css/jquery.dataTables.css')}}">
<link rel="stylesheet" href="{{asset('backend/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/css/responsive.bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/css/responsive.jqueryui.min.css')}}">
@endsection



@section('admin-content')

  <!-- page title area start -->
  <div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Tableau de Bord</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{route('admin.dashboard')}}">Tableau de Bord</a></li>
                    <li><span>Tout les Administrateurs</span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">

            @include('backend.layouts.partials.logout')


        </div>
    </div>
</div>
<!-- page title area end -->

<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">liste des Administrateurs</h4>
                    @include('backend.layouts.partials.messages')
                    @if(Auth::guard('admin')->user()->can('admin.create'))

                    <p class="float-right">
                    <a class="btn btn-primary text-white" href="{{ route('admin.admins.create')}}">Ajouter un nouvel Administrateur</a>
                    </p>

                    @endif

                    <br>
                    <div class="clearfix"></div>
                    <div class="data-tables">
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th width="5%">SI</th>
                                    <th width="10%">Nom</th>
                                    <th width="10%">Email</th>
                                    <th width="40%">Roles</th>
                                    <th width="15%">Action</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($admins as $admin)

                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$admin->name}}</td>
                                    <td>{{$admin->email}}</td>
                                    <td>

                                      {{--  --}}@foreach ($admin->roles as $role)

                                            <span class="badge badge-info mr-2">
                                                {{$role->name}}
                                            </span>

                                        @endforeach

                                    </td>
                                    <td>

                                        @if(Auth::guard('admin')->user()->can('admin.edit'))
                                            <a class="btn btn-success text-white" href="{{ route('admin.admins.edit', $admin->id)}}" >Modifier </a>
                                        @endif

                                     @if(Auth::guard('admin')->user()->can('admin.delete'))
                                        @if(Auth::guard('admin')->user()->id == $admin->id)
                                        
                                    
                                            
                                        @else
                                             <a class="btn btn-danger text-white" href="{{ route('admin.admins.destroy', $admin->id) }}"
                                                onclick="event.preventDefault(); document.getElementById('delete-form-{{$admin->id}}').submit();">
                                                 Supprimer
                                             </a>  
                                        @endif 
                                     

                                           <form id="delete-form-{{ $admin->id}}" action="{{ route('admin.admins.destroy', $admin->id) }}" method="POST" style="display: none;">
                                              @method('DELETE')
                                               @csrf
                                             </form>
                                        @endif

                                    </td>
                                </tr>

                                @endforeach



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- data table end -->

        <!-- Dark table end -->
    </div>
</div>



@endsection


@section('scripts')

{{--
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>--}}
<script src="{{asset('backend/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('backend/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/js/dataTable.responsive.min.js')}}"></script>
<script src="{{asset('backend/js/responsive.bootstrap.min.js')}}"></script>
<script>
/*================================
datatable active
==================================*/
if ($('#dataTable').length) {
    $('#dataTable').DataTable({
        responsive: true
    });
}


</script>
@endsection
