@extends('backend.layouts.master')


@section('title')
liste  d'examens semestriels | Tableau de Bord
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
                    <li><span>Tous les types d'examens</span></li>
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
                    <h4 class="header-title">liste des examens</h4>
                    @include('backend.layouts.partials.messages')
                    @if(Auth::guard('admin')->user()->can('type_s_exams.create'))
                    <p class="float-right">{{--
                    <a class="btn btn-primary text-white" href="{{ route('admin.classes.create')}}">Creer une nouvelle Classes</a>--}}
                    <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-new-post"> <b><i class="fa fa-plus"></i></b><span>
                    </span>Creer un nouvel examen</a>

                    </p>
                    @endif

                    <div class="clearfix"></div>
                    <br>

                    @if(Auth::guard('admin')->user()->can('type_s_exams.view'))
                    <div class="data-tables">
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                   <th width="20%">Nom de l'examen</th>
                                    

                                    <th width="20%">Action</th>

                                </tr>
                            </thead>
                            <tbody id="posts-crud">

                                @foreach ($type_s_exams as $exams)

                              <tr id="id_{{ $exams->id }}">
                                    <td>{{$exams->name_s_type_exam}}</td>

                                    <td>

                                        @if(Auth::guard('admin')->user()->can('type_s_exams.edit'))

                                        <a href="javascript:void(0)" id="edit-post" data-id="{{ $exams->id }}" data_token="{{csrf_token()}}" class="btn btn-info">  <b><i class="fa fa-edit"></i></b><span>
                                        </span>Modifier</a>

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
                                   <div class="alert-message" id="name_exam_error"></div>

                                        <div class="form-row">

                                        <input type="hidden" name="id" id="id">
                         
                                            <div>
                                                    <label for="name">CYCLES  <span class="text-danger">*</span></label>
                                                        <select name="id_cycle" id="id_cycle" class="form-control" required="on">
                                                            @foreach ($cycles as $cycles)
                              
                                                                <option value ="{{$cycles->id}}">{{$cycles->nom_cycle}}</option>
                              
                                                            @endforeach
                                                        </select>
                                            </div>

                                            <div>
                                                    <label for="name">Niveaux  <span class="text-danger">*</span></label>
                                                        <select name="id_niveau" id="id_niveau" class="form-control" required="on">
                                                            @foreach ($levels as $cycles)
                              
                                                                <option value ="{{$cycles->id}}">{{$cycles->nom_niveau}}</option>
                              
                                                            @endforeach
                                                        </select>
                                            </div>
                                            <div class="form-group col-md-6 col-sm-12">
                                                <label for="">Nom de l'examen<span class="text-danger">*</span></label>
                                                
                                                <input type="text" class="form-control" id="name_s_type_exam" name="name_s_type_exam"  placeholder="ex: Semestre un " required="on" value="">
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
          $('#postCrudModal').html("Ajouter un examen semestriel");
          $('#ajax-crud-modal').modal('show');

     });

      $('body').on('click', '#edit-post', function () {
        var exam_id = $(this).data('id');
        $.get('type_s_exams/'+exam_id+'/edit', function (data) {
           $('#postCrudModal').html("Editer un examen semestriel");
            $('#btn-save').val("edit-post");
            $('#ajax-crud-modal').modal('show');
            $('#id').val(data.id);
            $('#name_s_type_exam').val(data.name_s_type_exam);
            $('#id_cycle').val(data.id_cycle);
            $('#id_niveau').val(data.id_niveau);
        })
     });

      $('body').on('click', '.delete-post', function () {
          var exam_id = $(this).data("id");

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
                                        url: "{{url('/admin/type_s_exams/delete')}}/" + exam_id,
                                        data: {_token: CSRF_TOKEN},
                                        dataType: 'JSON',
                                        success: function (results)
                                     {
                                            if (results.success === true)
                                            {
                                                swal("Done!", results.message, "succès");
                                                $("#id_" + exam_id).remove();
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
            url: "{{ route('admin.type_s_exams.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {


        swal({

                    icon: "sucess",
                    title: "Operation effectuée avec succès",
                    showconfirmButtonText: false,
                    timer: 2000
              })

                var annee = '<tr id="id_' +data.id+ '"><td>' +data.name_s_type_exam+ '</td>';
                    annee += '<td><a href="javascript:void(0)" id="edit-post"  data_token="{{csrf_token()}}" data-id="' + data.id + '" class="btn btn-info">Modifier</a></td>';
                    annee += '</tr>';


                if (actionType == "create-post") {
                    $('#posts-crud').prepend(annee);
                } else {
                    $("#id_" + data.id).replaceWith(annee);
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
                        $('#name_exam_error').addClass("alert alert-danger");
                        if($.isPlainObject(value))
                        {

                                        $.each(value,function(key,value){
                                    // console.log(key+" "+value);
                                    $('#name_exam_error').show().html(value).delay(2000).hide("slow");
                                    // $('#name_classes_error').show();
                                });
                        }
                        else
                        {

                            $('#name_exam_error').show().html(value).delay(2000).hide("slow");

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
