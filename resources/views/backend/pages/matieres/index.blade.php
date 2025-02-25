@extends('backend.layouts.master')


@section('title')
liste des Matieres| Tableau de Bord
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
                    <li><span>Toutes les Matieres</span></li>
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
                    <h4 class="header-title">liste des Matieres </h4>
                    @include('backend.layouts.partials.messages')
                    @if(Auth::guard('admin')->user()->can('matieres.create'))
                    <p class="float-right">{{--
                    <a class="btn btn-primary text-white" href="{{ route('admin.classes.create')}}">Creer une nouvelle Classes</a>--}}
                    <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-new-post"> <b><i class="fa fa-plus"></i></b><span>
                    </span>Ajouter une nouvelle Matiere</a>

                    </p>
                    @endif

                    <div class="clearfix"></div>
                    <br>

                    @if(Auth::guard('admin')->user()->can('matieres.view'))
                    <div class="data-tables">
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                   <th width="20%">Groupe  Matiere</th>
                                    
                                    <th width="15%">Action</th>

                                </tr>
                            </thead>
                            <tbody id="posts-crud">

                                @foreach ($matieres as $matiere)

                              <tr id="id_{{ $matiere->id }}">
                                    <td>{{$matiere['Mt']['name_gmatiere']}}</td>

                                    <td>

                                        @if(Auth::guard('admin')->user()->can('matieres.edit'))

                                        <a class="btn btn-primary text-white" href="{{ route('admin.matieres.show',Crypt::encrypt($matiere->id_gmatiere))}}" > <i class="fa fa-eye"></i> Voir</a>
                               

                                     
                                        @endif

                                        {{-- <a href="javascript:void(0)" id="edit-post" data-id="{{ $mfrai->id}}"  class="btn btn-info">  <b><i class="fa fa-edit"></i></b><span>
                                                                                </span>Modifier</a>

                                        @if(Auth::guard('admin')->user()->can('matieres.edit'))

                                        <a href="javascript:void(0)" id="edit-post" data-id="{{ $matiere->id }}" data_token="{{csrf_token()}}" class="btn btn-info">  <b><i class="fa fa-edit"></i></b><span>
                                        </span>Modifier</a>

                                        @endif--}}



                                    </td>
                                </tr>

                                @endforeach



                            </tbody>
                        </table>

                        <div class="modal fade" id="ajax-crud-modal" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                            <form id="postForm" name="postForm" class="form-horizontal">
                                 <div class="modal-header">
                                    <h4 class="modal-title" id="postCrudModal"></h4>
                                </div>
                                <div class="modal-body">

                                   @csrf
                                   <div class="alert-message" id="name_matiere_error"></div>

                                        <div class="form-row">
                                            <input type="hidden" name="id" id="id">


                                                 <table class="table table-bordered" >
                                                                            <thead>
                                                                                <tr>
                                                                                    <input type="hidden" name="id" id="id">
                                                                                    <div class="form-group col-md-10 col-sm-10">
                                                                                       
                                                                                           
                                                                                    </div>
                                                                                    <div class="form-group col-md-2 col-sm-2">
                                                                                        
                                                                                                  
                                                                                                  <a href="#" class="btn btn-info addRow"><i class="fa fa-plus-circle"></i></a>
            
                                                                                    </div>
                                                                                 
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody class="aragali">
                                                                                <tr>
                                                                                    <td>
                                                                                        <label for="name">Groupe d'allocation  <span class="text-danger">*</span></label>
                                                                                        <select name="id_gmatiere[]" id="id_gmatiere" class="form-control" required="on">
                                                                                            @foreach ($gpmatiere as $gmatiere)
                              
                                                                                                <option value ="{{$gmatiere->id}}">{{$gmatiere->name_gmatiere}}</option>
                              
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </td>
                                                                                    <td>
                                                                                        <label for="">Nom de la matiere<span class="text-danger">*</span></label>
                                                                                        <input type="text" class="form-control" id="name_matiere" name="name_matiere[]"  placeholder="Enter le nom de la matiere ex: INFORMATIQUE" required="on" value="">
                                                                                       <div class="alert-message" ></div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <label for="slug">Code Matiere <span class="text-danger">*</span></label>
                                                                                        <input type="text" class="form-control" id="code_matiere" name="code_matiere[]"  placeholder="code ex: INFO123" required="on" value="">
                                                                                        <div class="alert-message" ></div>
                                                                                    </td>
                                                                                   <td>
                                                                                    <a href="#" class="btn btn-danger movRow"><i class="fa fa-minus-circle"></i></a>
                                                                                  </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>






                                            

            
                                     
                           
                                         

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



<script type="text/javascript">
    $('.addRow').on('click',function(){
        addRow();
    });
    function addRow(){
       var tr = '<tr>'+' <input type="hidden" name="id[]" id="id">'
                        +'<td><label for="name">Groupe d allocation  <span class="text-danger">*</span></label>'
                        +' <select name="id_gmatiere[]" id="id_gmatiere" class="form-control" required="on">@foreach ($gpmatiere as $gmatiere)<option value ="{{$gmatiere->id}}">{{$gmatiere->name_gmatiere}}</option>'
                        +'@endforeach</select></td>'
                        +'<td><label for="name">Nom de la matiere <span class="text-danger">*</span></label>'
                        +'<input type="text" class="form-control" id="name_matiere" name="name_matiere[]"  placeholder="nom de la matiere" required="on" value="">'
                         
                        +'<td><label for="slug">code de la matiere <span class="text-danger">*</span></label>'
                        +'<input type="text" class="form-control" id="code_matiere" name="code_matiere[]"  placeholder="code de la matiere" required="on" value="">'
                        +'<div class="alert-message" ></div></td><td> <a href="#" class="btn btn-danger movRow"><i class="fa fa-minus-circle"></i></a></td>'+'</tr>';
                              
                                                                                            
                        $('.aragali').append(tr);                                                                                                  
    };

    $('.aragali').on('click','.movRow',function(){

        $(this).parent().parent().remove();

    });
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
          $('#postCrudModal').html("Ajouter une Matiere");
          $('#ajax-crud-modal').modal('show');

     });
     
  

      $('body').on('click', '#edit-post', function () {
        var matiere_id = $(this).data('id');
        $.get('matieres/'+matiere_id+'/edit', function (data) {
           $('#postCrudModal').html("Editer une Matiere");
            $('#btn-save').val("edit-post");
            $('#ajax-crud-modal').modal('show');
            $('#id').val(data.id);
            $('#name_matiere').val(data.name_matiere);
            $('#code_matiere').val(data.code_matiere);
            $('#id_gmatiere').val(data.id_gmatiere);
        })
     });

      $('body').on('click', '.delete-post', function () {
          var matiere_id = $(this).data("id");

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
                                        url: "{{url('/admin/matieres/delete')}}/" + matiere_id,
                                        data: {_token: CSRF_TOKEN},
                                        dataType: 'JSON',
                                        success: function (results)
                                     {
                                            if (results.success === true)
                                            {
                                                swal("Done!", results.message, "succès");
                                                $("#id_" + matiere_id).remove();
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
            url: "{{ route('admin.matieres.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                var latable = $('#dataTable').DataTable({
                    "bDestroy":true
                });
                latable.ajax.reload;


        swal({

                    icon: "sucess",
                    title: "Operation effectuée avec succès",
                    showconfirmButtonText: false,
                    timer: 2000
              })

                var annee = '<tr id="id_' +data.id+ '"><td>{{$matiere["Mt"]["name_gmatiere"]}}</td>';
                    
                    annee += '<td><a href="{{ route("admin.matieres.show",Crypt::encrypt($matiere->id_gmatiere))}}" id="edit-post"  data_token="{{csrf_token()}}" data-id="' + data.id + '" class="btn btn-info"><i class="fa fa-eye"></i>voir</a></td>';
                    
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
                        $('#name_matiere_error').addClass("alert alert-danger");
                        if($.isPlainObject(value))
                        {

                                        $.each(value,function(key,value){
                                    // console.log(key+" "+value);
                                    $('#name_matiere_error').show().html(value).delay(2000).hide("slow");
                                    // $('#name_classes_error').show();
                                });
                        }
                        else
                        {

                            $('#name_matiere_error').show().html(value).delay(2000).hide("slow");

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
