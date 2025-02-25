

@extends('backend.layouts.master')


@section('title')
liste des matieres par groupes | Tableau de Bord
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
                    <li><span>liste des matieres du {{$infos_matiere->name_matiere}}</span></li>
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
                    <h4 class="header-title">liste des matieres du {{$infos_matiere->name_gmatiere}}</h4>
                    @include('backend.layouts.partials.messages')
                    @if(Auth::guard('admin')->user()->can('matieres.create'))
                    <p class="float-right">{{--
                    <a class="btn btn-primary text-white" href="{{ route('admin.mfrais.create')}}">Creer un nouveau frais</a>--}}
                    <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-new-post"> <b><i class="fa fa-plus"></i></b><span>
                    </span>Ajouter une matieres au {{$infos_matiere->name_gmatiere}} </a>

                    </p>
                    @endif

                    <div class="clearfix"></div>
                    <br>

                    @if(Auth::guard('admin')->user()->can('matieres.view'))
                        <div class="data-tables">
                            <table id="dataTable" class="text-center">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                    <th width="20%">Nom de la matiere</th>
                                    <th width="30%">code de la matiere</th>
                                    <th width="20%">Action</th>

                                    </tr>
                                </thead>
                                <tbody id="posts-crud">

                                    @foreach ($matiere as $matieres)

                                <tr id="id_{{$matieres->id}}">
                                        
                                    {{--<td>{{$mfrai['MFrais']['name_frais']}}</td>--}} 
                                      <td>{{$matieres->name_matiere}}</td>
                                        <td>{{$matieres->code_matiere}}</td>

                                        <td>

                                            @if(Auth::guard('admin')->user()->can('matieres.edit'))

                                            {{--<a class="btn btn-primary text-white" href="{{ route('admin.mfrais.show',$mfrai->id_frais)}}" > <i class="fa fa-eye"></i> Voir</a>
                                   --}}

                                            <a href="javascript:void(0)" id="edit-post" data-id="{{$matieres->id}}"  class="btn btn-info">  <b><i class="fa fa-edit"></i></b><span>
                                            </span>Modifier</a>

                                            @endif
                                            @if(Auth::guard('admin')->user()->can('matieres.delete'))

                                            <a href="javascript:void(0)" id="delete-post" data-id="{{$matieres->id}}" class="btn btn-danger delete-post"> <b><i class="fa fa-trash"></i></b><span>
                                          </span>Suprimer</a>
  
  
  
                                          @endif



                                        </td>
                                    </tr>

                                    @endforeach



                                </tbody>
                            </table>
                        </div>
                        <div class="modal fade" id="ajax-crud-modal" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                                <h4 class="modal-title" id="postCrudModal"></h4>
                                        </div>

                                        <div class="modal-body">
                                            
                                                <div class="alert-message" id="name_classes_error"></div>

                                                    <form id="postForm" name="postForm" class="form-horizontal">
                                                            @csrf
  
                                                                    <div class="form-row">

                                                                         <table class="table table-bordered" >
                                                                            <thead>
                                                                                <tr>
                                                                                    <input type="hidden" name="id" id="id">
                                                                                    <div class="form-group col-md-10 col-sm-10">
                                                                                        <label for="name">Intitulé du Groupe <span class="text-danger">*</span></label>
                                                                                                  <select name="id_gmatiere" id="id_gmatiere" class="form-control" required="on">
                                                                                                     
                                                                                                          <option value ="{{$infos_matiere->id}}">{{$infos_matiere->name_gmatiere}}</option>
                                  
                                                                                                     
                                                                                                  </select>
                                                                                           
                                                                                    </div>
                                                                                    <div class="form-group col-md-2 col-sm-2">
                                                                                        
                                                                                                  
                                                                                                  <a href="#" class="btn btn-info addRow"><i class="fa fa-plus-circle"></i></a>
            
                                                                                    </div>
                                                                                 
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody class="aragali">
                                                                                <tr>
                                                                                    
                                                                                    <td>
                                                                                      <label for="slug">Nom de la matiere<span class="text-danger">*</span></label>
                                                                                      <input type="text" class="form-control" id="name_matiere" name="name_matiere[]"  placeholder="nom de la matiere" required="on" value="">
                                                                                      <div class="alert-message" ></div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <label for="slug">Code de la matiere<span class="text-danger">*</span></label>
                                                                                        <input type="text" class="form-control" id="code_matiere" name="code_matiere[]"  placeholder="code de la matiere" required="on" value="">
                                                                                        <div class="alert-message" ></div>
                                                                                      </td>
                                                                                   <td>
                                                                                    <a href="#" class="btn btn-danger movRow"><i class="fa fa-minus-circle"></i></a>
                                                                                  </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                   

                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary" id="btn-save" value="create">Enregistrer</button>
                                                          
                                                    </form>
                                               


                                        </div>

                                        <div class="modal-footer">
                                                    <div align="center">
                                                        <a href="#" class="btn btn-info addRow"><i class="fa fa-plus-circle"></i></a>
                                                            <button type="reset" class="btn danger">Initialiser</button> 
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
    $('#edit-post').on('click',function(){
        $('.addRow').hide();
        $('.movRow').hide();
    });
</script>
<script type="text/javascript">
    $('#create-new-post').on('click',function(){
        $('.addRow').show();
        $('.movRow').show();
    });
</script>



<script type="text/javascript">
    $('.addRow').on('click',function(){
        addRow();
    });
    function addRow(){
       var tr = '<tr>'+' <input type="hidden" name="id[]" id="id">'
                        +'<td><label for="name">Nom de la matiere <span class="text-danger">*</span></label>'
                        +'<input type="text" class="form-control" id="name_matiere" name="name_matiere[]"  placeholder="nom de la matiere" required="on" value="">'
                        +'</td>' 
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
          $('#postCrudModal').html("Ajouter matiere");
          $('#ajax-crud-modal').modal('show');
          $('.addRow').show();
            $('.movRow').show();

     });

      $('body').on('click', '#edit-post', function () {
        var matiere_id = $(this).data('id');
        $.get('./'+matiere_id+'/edit', function (data) {
           $('#postCrudModal').html("Editer une matiere");
            $('#btn-save').val("edit-post");
            $('#ajax-crud-modal').modal('show');
            $('.addRow').hide();
            $('.movRow').hide();
            $('#id').val(data.id);
            $('#id_gmatiere').val(data.id_gmatiere);
            $('#name_matiere').val(data.name_matiere);
            $('#code_matiere').val(data.code_matiere);
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
                                                alert('Error:', data);
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
                var classes = '<tr id="id_' + data.id + '"><td>' +data.name_matiere + '</td><td>' + data.code_matiere + '</td>'+ '<td><a href="javascript:void(0)" id="edit-post" data-id="' + data.id + '" class="btn btn-info">Modifier</a></td>';
                    classes += '</tr>';
                

                   // $('#posts-crud').DataTable().ajax.reload(null,false);
         
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
