@extends('backend.layouts.master')


@section('title')
liste des Sections de classes| Tableau de Bord
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
                    <li><span>Toutes les Specialités {{--$_specialites['sf']['nom_filiere']--}}</span></li>
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
                    <h4 class="header-title">liste des Specialité {{--$SSpecialite['sf']['nom_filiere']--}}</h4>
                    @include('backend.layouts.partials.messages')
                    @if(Auth::guard('admin')->user()->can('specialites.create'))
                    <p class="float-right">{{--
                    <a class="btn btn-primary text-white" href="{{ route('admin.classes.create')}}">Ajouter une filiere</a>--}}
                    <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-new-post"> <b><i class="fa fa-plus"></i></b><span>
                    </span>Ajouter une Specialite {{--$specialite['sf']['nom_filiere']--}}</a>

                    </p>
                    @endif

                    <div class="clearfix"></div>
                    <br>

                    @if(Auth::guard('admin')->user()->can('filieres.view'))
                    <div class="data-tables">
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                   
                                    <th width="30%">Nom de la filiere</th>

                                    <th width="15%">Action</th>

                                </tr>
                            </thead>
                            <tbody id="posts-crud">

                                @foreach ($SSpecialites as $specialite)

                              <tr id="id_{{$specialite->id}}">
                                    <td>{{$specialite->nom_specialite}}</td>
                                   
                                    <td>

                                        @if(Auth::guard('admin')->user()->can('specialites.edit'))

                                        <a href="javascript:void(0)" id="edit-post" data-id="{{$specialite->id}}"  class="btn btn-info">  <b><i class="fa fa-edit"></i></b><span>
                                        </span>Modifier</a>
                                       

                                        @endif

                                        @if(Auth::guard('admin')->user()->can('specialites.delete'))

                                          <a href="javascript:void(0)" id="delete-post" data-id="{{ $specialite->id }}" class="btn btn-danger delete-post"> <b><i class="fa fa-trash"></i></b><span>
                                        </span>Suprimer</a>



                                        @endif


                                    </td>
                                </tr>

                                @endforeach



                            </tbody>
                        </table>

                        <div class="modal fade" id="ajax-crud-modal" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                            <form id="postForm" name="postForm" class="form-horizontal">
                                 <div class="modal-header">
                                    <h4 class="modal-title" id="postCrudModal"></h4>
                                </div>
                                <div class="modal-body">

                                   @csrf
                                   <div class="alert-message" id="name_classes_error"></div>
                                  
 
                                        <div class="form-row">

                                        <input type="hidden" name="id" id="id">
                                        <input type="hidden" name="id_filiere" id="id_filiere" value="{{$_specialites->id_filiere}}">

                                            <div class="form-group col-md-12 col-sm-12">
                                                <label for="name">Nom de la Filiere <span class="text-danger">*</span></label>
                            
                                                <input type="text" class="form-control" id="nom_specialite" name="nom_specialite"  placeholder="nom specialite ex: Genie Logiciel" required="on" value="">
                                                <div class="alert-message" ></div>
                                                

                                            </div>
                                            

                                        </div>





                                </div>
                                <div class="modal-footer">

                                        <button type="submit" class="btn btn-primary" id="btn-save" value="create">Enregistrer</button>


                                        <button type="reset" class="btn danger">Initialiser</button>

                                    </div>
                                </form>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    @endif


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
<script src="{{URL::asset('backend/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('backend/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('backend/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('backend/js/dataTable.responsive.min.js')}}"></script>
<script src="{{URL::asset('backend/js/responsive.bootstrap.min.js')}}"></script>
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








<script>

    $(document).ready(function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

     

      $('body').on('click', '#create-new-post', function () {
       $('#btn-save').val("create-post");
          $('#postForm').trigger("reset");
          $('#postCrudModal').html("Ajouter une specialité");
          $('#ajax-crud-modal').modal('show');

    });

      $('body').on('click', '#edit-post', function () {
        var specialite_id = $(this).data('id');
    
        $.get('../../specialites_edit/'+specialite_id+'/edit', function (data) {
           $('#postCrudModal').html("Editer une specialite");
            $('#btn-save').val("edit-post");
            $('#ajax-crud-modal').modal('show');
            $('#id').val(data.id);
            $('#nom_specialite').val(data.nom_specialite);
            $('#id_filiere').val(data.id_filiere);
        })
     });

      $('body').on('click', '.delete-post', function () {
          var filiere_id = $(this).data("id");

          swal({
                    title: "Voulez-vous supprimer cette information ?",
                    text: "Choisissez une action et valider!",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "Oui, supprimer!",
                    cancelButtonText: "Non, Annuler!",
                    reverseButtons: !0
              }).then(function (e)
                {
                                    if (e.value === true)
                                     {

                                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                                        $.ajax({
                                        type: 'POST',
                                        url: "{{url('/admin/specialites/delete')}}/" + filiere_id,
                                        data: {_token: CSRF_TOKEN},
                                        dataType: 'JSON',
                                        success: function (results)
                                     {
                                            if (results.success === true)
                                            {
                                                swal("Done!", results.message, "succès");
                                                $("#id_" + filiere_id).remove();
                                            } else {
                                                swal("Error!", results.message, "error");
                                                console.log('Error:', data);
                                            }
                                    }
                                    });
                                    } else {
                                    e.dismiss;
                                    }
                }, function (dismiss)
                 {
                     return false;
                 })

      });
    });

   if ($("#postForm").length > 0) {
        $("#postForm").validate({

       submitHandler: function(form) {

        var actionType = $('#btn-save').val();

 
        $('#btn-save').html('traitement...');



        $.ajax({
            data: $('#postForm').serialize(),
            url: "{{ route('admin.specialites.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {


        swal({
                    icon: "sucess",
                    title: "Operation effectuée avec succès",
                    showconfirmButtonText: false,
                    timer: 2000
              })
                /*
              var classes = '<tr id="id_' + data.id + '"><td>' +data.id_classe + '</td>'+'</td><td>' + data.nom_section + '</td>';
                    classes += '<td><a href="javascript:void(0)" id="edit-post" data-id="' + data.id + '" class="btn btn-info">Modifier</a><a href="javascript:void(0)" id="delete-post" data-id="' + data.id + '" class="btn btn-danger delete-post">Suprimer</a></td>';
                    classes += '</tr>';*/


                if (actionType == "create-post") {
                    $('#posts-crud').prepend(classes);
                } else {
                    $("#id_" + data.id).replaceWith(classes);
                }

                $('#postForm').trigger("reset");
                $('#ajax-crud-modal').modal('hide');
                $('#btn-save').html('Save Changes');

            },
            error: function (data) {


                if(data.status === 422)
                {
                    var errors = $.parseJSON(data.responseText);
                    $.each(errors,function(key, value)
                    {
                        $('#name_classes_error').addClass("alert alert-danger");
                        if($.isPlainObject(value))
                        {

                                        $.each(value,function(key,value){
                                    // console.log(key+" "+value);
                                    $('#name_classes_error').show().html(value).delay(2000).hide("slow");
                                    // $('#name_classes_error').show();
                                });
                        }
                        else
                        {

                            $('#name_classes_error').show().html(value).delay(2000).hide("slow");

                        }
                    });
                }
            }
        });
      }
    });
  }





</script>




@endsection
 