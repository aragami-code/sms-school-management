@extends('backend.layouts.master')


@section('title')
liste noire des Utilisateurs| Tableau de Bord
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
                    <li><span>Tous les Utilisateurs</span></li>
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
                    <h4 class="header-title">liste noire des Utilisateurs</h4>
                    @include('backend.layouts.partials.messages')
                    @if(Auth::guard('admin')->user()->can('user.create'))

                    @endif

                    <div class="clearfix"></div>
                    <br>
                    <div class="data-tables">
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th width="5%">SI</th>
                                    <th width="10%">Nom</th>
                                    <th width="10%">Email</th>
                                    <th width="40%"></th>
                                   <th width="20%">Action</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($users as $user)

                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$user->username}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>



                                    </td>

                                    <td>
                                        <div class="btn-group mb-xl-3" role="group" aria-label="Basic example">


                                         @if($user->bl == 0)

                                         <form action="{{route('admin.users.blackl', $user->id)}}" method="POST">
                                             @method('PUT')
                                             @csrf
                                             <button type="submit" class="btn btn-primary mt-3 pr-3 pl-3">Activer</button>
                                         </form>

                                         @else

                                         <form action="{{route('admin.users.unblackl', $user->id)}}" method="POST">
                                             @method('PUT')
                                             @csrf
                                             <button type="submit" class="btn btn-warning mt-3 pr-3 pl-3">Desactiver</button>
                                         </form>

                                         @endif













                                        </div>





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
