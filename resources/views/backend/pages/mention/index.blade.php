@extends('backend.layouts.master')


@section('title')
liste des Mentions| Tableau de Bord
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
                    <li><span>Toutes les Classes</span></li>
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
                    <h4 class="header-title">liste des Mentions Academiques </h4>
                    @include('backend.layouts.partials.messages')
                    @if(Auth::guard('admin')->user()->can('mention.create'))
                    <p class="float-right">{{--
                    <a class="btn btn-primary text-white" href="{{ route('admin.classes.create')}}">Creer une nouvelle Classes</a>--}}
                    <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-new-post"> <b><i class="fa fa-plus"></i></b><span>
                    </span>Creer une mention</a>

                    </p>
                    @endif

                    <div class="clearfix"></div>
                    <br>

                    @if(Auth::guard('admin')->user()->can('mention.view'))
                    <div class="data-tables">
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                   <th width="20%">Nom de la mention</th>
                                   <th width="30%">Code_mention</th>
                                   <th width="5%">Valeur_mention</th>
                                   <th width="20%">Intervale_mention</th>

                                    <th width="30%">Action</th>

                                </tr>
                            </thead>
                            <tbody id="posts-crud">

                                @foreach ($mentions as $mention)

                              <tr id="id_{{ $mention->id }}">
                                    <td>{{$mention->nom_mention}}</td>
                                    <td>{{$mention->code_mention}}</td>
                                    <td>{{$mention->valeur_mention}}</td>
                                    <td>[{{$mention->intervale_debut_mention}}-{{$mention->intervale_fin_mention}}]</td>

                                    <td>

                                        @if(Auth::guard('admin')->user()->can('mention.edit'))

                                        <a href="javascript:void(0)" id="edit-post" data-id="{{ $mention->id }}" data_token="{{csrf_token()}}" class="btn btn-info">  <b><i class="fa fa-edit"></i></b><span>
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
                                   <div class="alert-message" id="name_annee_error"></div>

                                        <div class="form-row">

                                        <input type="hidden" name="id" id="id">
                                            <div class="form-group col-md-8 col-sm-12">
                                                <label for="">Nom de la mention<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="nom_mention" name="nom_mention"  placeholder="Enter le nom de la mention ex Excellent " required="on" value="" >
                                                <br>

                                            </div>
                                            <div class="form-group col-md-4 col-sm-12">
                                                <label for="slug">Code de la mention <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="code_mention" name="code_mention"  placeholder="code de la mention ex: A+" required="on" value="">
                                                <div class="alert-message" ></div>

                                            </div>

                                            <div class="form-group col-md-4 col-sm-12">
                                                <label for="slug">Valeur de la mention <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="valeur_mention" name="valeur_mention"  placeholder="valeur de la mention ex: 5.00" required="on" value="">
                                                <div class="alert-message" ></div>

                                            </div>
                                            <div class="form-group col-md-4 col-sm-12">
                                                <label for="slug">Intervale debut  <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="intervale_debut_mention" name="intervale_debut_mention"  placeholder="intervale de debut de la mention ex: 5.00" required="on" value="">
                                                <div class="alert-message" ></div>

                                            </div>
                                            <div class="form-group col-md-4 col-sm-12">
                                                <label for="slug">Intervale Fin  <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="intervale_fin_mention" name="intervale_fin_mention"  placeholder="intervale de fin mention ex: 5.00" required="on" value="">
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
          $('#postCrudModal').html("Ajouter une Mention");
          $('#ajax-crud-modal').modal('show');

     });

      $('body').on('click', '#edit-post', function () {
        var mention_id = $(this).data('id');
        $.get('mention/'+mention_id+'/edit', function (data) {
           $('#postCrudModal').html("Editer une mention");
            $('#btn-save').val("edit-post");
            $('#ajax-crud-modal').modal('show');
            $('#id').val(data.id);
            $('#nom_mention').val(data.nom_mention);
            $('#code_mention').val(data.code_mention);
            $('#valeur_mention').val(data.valeur_mention);
            $('#intervale_debut_mention').val(data.intervale_debut_mention);
            $('#intervale_fin_mention').val(data.intervale_fin_mention);
        })
     });

      $('body').on('click', '.delete-post', function () {
          var annee_id = $(this).data("id");

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
                                        url: "{{url('/admin/mention/delete')}}/" + annee_id,
                                        data: {_token: CSRF_TOKEN},
                                        dataType: 'JSON',
                                        success: function (results)
                                     {
                                            if (results.success === true)
                                            {
                                                swal("Done!", results.message, "succès");
                                                $("#id_" + annee_id).remove();
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
            url: "{{ route('admin.mention.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {


        swal({

                    icon: "sucess",
                    title: "Operation effectuée avec succès",
                    showconfirmButtonText: false,
                    timer: 2000
              })

                var mention = '<tr id="id_' +data.id+ '"><td>' +data.nom_mention+ '</td>'+'<td>' +data.code_mention+ '</td>'+'<td>' +data.valeur_mention+ '</td>'+'<td>[' +data.intervale_debut_mention+' - '+data.intervale_fin_mention+ ']</td>';
                    mention += '<td><a href="javascript:void(0)" id="edit-post"  data_token="{{csrf_token()}}" data-id="' + data.id + '" class="btn btn-info">Modifier</a></td>';
                    mention += '</tr>';


                if (actionType == "create-post") {
                    $('#posts-crud').prepend(mention);
                } else {
                    $("#id_" + data.id).replaceWith(mention);
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
                        $('#name_annee_error').addClass("alert alert-danger");
                        if($.isPlainObject(value))
                        {

                                        $.each(value,function(key,value){
                                    // console.log(key+" "+value);
                                    $('#name_annee_error').show().html(value).delay(2000).hide("slow");
                                    // $('#name_classes_error').show();
                                });
                        }
                        else
                        {

                            $('#name_annee_error').show().html(value).delay(2000).hide("slow");

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
