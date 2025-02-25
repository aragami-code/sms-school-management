

@extends('backend.layouts.master')


@section('title')
liste des montants des Frais de scolarité par classes| Tableau de Bord
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
                    <li><span>frais de {{$mfrais->name_frais}} par classes</span></li>
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
                    <h4 class="header-title">liste des frais de  {{$mfrais->name_frais}}  par classe </h4>
                    @include('backend.layouts.partials.messages')
                    @if(Auth::guard('admin')->user()->can('mfrais.create'))
                    <p class="float-right">{{--
                    <a class="btn btn-primary text-white" href="{{ route('admin.mfrais.create')}}">Creer un nouveau frais</a>--}}
                    <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-new-post"> <b><i class="fa fa-plus"></i></b><span>
                    </span>Ajouter une {{$mfrais->name_frais}} pour une ou pluisieurs classe(s)</a>

                    </p>
                    @endif

                    <div class="clearfix"></div>
                    <br>

                    @if(Auth::guard('admin')->user()->can('mfrais.view'))
                        <div class="data-tables">
                            <table id="dataTable" class="text-center">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                    <th width="20%">Nom de la classe</th>
                                    <th width="30%">Intitulé du frais</th>
                                    <th width="30%">Montant</th>
                                    <th width="20%">Action</th>

                                    </tr>
                                </thead>
                                <tbody id="posts-crud">

                                    @foreach ($montant_frais as $mfrai)

                                <tr id="id_{{$mfrai->id}}">
                                        
                                    {{--<td>{{$mfrai['MFrais']['name_frais']}}</td>--}} 
                                      <td>{{$mfrai->name_classes}}</td>
                                        <td>{{$mfrai->name_frais}}</td>
                                        <td>{{$mfrai->montant}}</td>

                                        <td>

                                            @if(Auth::guard('admin')->user()->can('mfrais.edit'))

                                            {{--<a class="btn btn-primary text-white" href="{{ route('admin.mfrais.show',$mfrai->id_frais)}}" > <i class="fa fa-eye"></i> Voir</a>
                                   --}}

                                            <a href="javascript:void(0)" id="edit-post" data-id="{{ $mfrai->id}}"  class="btn btn-info">  <b><i class="fa fa-edit"></i></b><span>
                                            </span>Modifier</a>

                                            @endif
                                            @if(Auth::guard('admin')->user()->can('mfrais.delete'))

                                            <a href="javascript:void(0)" id="delete-post" data-id="{{ $mfrai->id }}" class="btn btn-danger delete-post"> <b><i class="fa fa-trash"></i></b><span>
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
                                                                                        <label for="name">Intitulé du Frais <span class="text-danger">*</span></label>
                                                                                                  <select name="id_frais" id="id_frais" class="form-control" required="on">
                                                                                                     
                                                                                                          <option value ="{{$frais->id}}">{{$frais->name_frais}}</option>
                                  
                                                                                                     
                                                                                                  </select>
                                                                                           
                                                                                    </div>
                                                                                    <div class="form-group col-md-10 col-sm-10">
                                                                                        <label for="name">Cycle <span class="text-danger">*</span></label>
                                                                                                  <select name="id_cycle" id="id_cycle" class="form-control" required="on">
                                                                                                      @foreach ($cycles as $cycles)
                                  
                                                                                                          <option value ="{{$cycles->id}}">{{$cycles->nom_cycle}}</option>
                                  
                                                                                                      @endforeach
                                                                                                  </select>
                                                                                           
                                                                                    </div>
                                                                                    <div class="form-group col-md-10 col-sm-10">
                                                                                        <label for="name">Niveau <span class="text-danger">*</span></label>
                                                                                                  <select name="id_niveau" id="id_niveau" class="form-control" required="on">
                                                                                                      @foreach ($levels as $levels)
                                  
                                                                                                          <option value ="{{$levels->id}}">{{$levels->nom_niveau}}</option>
                                  
                                                                                                      @endforeach
                                                                                                  </select>
                                                                                           
                                                                                    </div>
                                                                                    <div class="form-group col-md-2 col-sm-2">
                                                                                        
                                                                                                  
                                                                                                  <a href="#" class="btn btn-info addRow" id="add"> <i class="fa fa-plus-circle"></i></a>
            
                                                                                    </div>
                                                                                 
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody class="aragali">
                                                                                <tr>
                                                                                    <td>
                                                                                        <label for="name">Nom de la classe <span class="text-danger">*</span></label>
                                                                                        <select name="id_classe[]" id="id_classe" class="form-control" required='on'>
                                                                                            @foreach ($classe as $classes)
            
                                                                                                <option value ="{{$classes->id}}">{{$classes->name_classes}}</option>
            
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </td>
                                                                                    <td>
                                                                                      <label for="slug">Montant Assigné <span class="text-danger">*</span></label>
                                                                                      <input type="number" class="form-control" id="montant" name="montant[]"  placeholder="montant ex: 25000 FCFA" required="on" value="">
                                                                                      <div class="alert-message" ></div>
                                                                                    </td>
                                                                                   <td>
                                                                                    <a href="#" class="btn btn-danger movRow" id="mov"><i class="fa fa-minus-circle"></i></a>
                                                                                  </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                   

                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary" id="btn-save" value="create">Enregistrer</button>
                                                          
                                                    </form>
                                               


                                        </div>

                                        <div class="modal-footer">
                                                    <div>
                                                        <center>
                                                               <a href="#" class="btn btn-info addRow" id="addd"><i class="fa fa-plus-circle"></i></a>
                                                            <button type="reset" class="btn danger">Initialiser</button> 
                                                        </center>
                                                     
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
       var tr = '<tr>'+' <input type="hidden" name="id[]" id="id"><td><label for="name">Nom de la classe <span class="text-danger">*</span></label>'
                        +'<select name="id_classe[]" id="id_classe" class="form-control" required="on">'
                        +'@foreach ($classe as $classes)'
                        +'<option value ="{{$classes->id}}">{{$classes->name_classes}}</option>'
                        +'@endforeach'
                        +'</select>'+'</td><td><label for="slug">Montant Assigné <span class="text-danger">*</span></label>'
                        +'<input type="number" class="form-control" id="montant" name="montant[]"  placeholder="montant ex: 25000 FCFA" required="on" value="">'
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
          $('#postCrudModal').html("Ajouter Montant Frais");
          $('#ajax-crud-modal').modal('show');

     });

      $('body').on('click', '#edit-post', function () {
        var mfrais_id = $(this).data('id');
        $.get('./'+mfrais_id+'/edit', function (data) {
           $('#postCrudModal').html("Editer un frais");
            $('#btn-save').val("edit-post");
            $('#ajax-crud-modal').modal('show');
            $('#add').hide();
            $('#addd').hide();
            $('#mov').hide();
            $('#id').val(data.id);
            $('#id_classe').val(data.id_classe);
            $('#id_frais').val(data.id_frais);
            $('#id_cycle').val(data.id_cycle);
            $('#id_niveau').val(data.id_niveau);
            $('#montant').val(data.montant);
        })
     });

      $('body').on('click', '.delete-post', function () {
          var mfrais_id = $(this).data("id");

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
                                        url: "{{url('/admin/mfrais/delete')}}/" + mfrais_id,
                                        data: {_token: CSRF_TOKEN},
                                        dataType: 'JSON',
                                        success: function (results)
                                     {
                                            if (results.success === true)
                                            {
                                                swal("Done!", results.message, "succès");
                                                $("#id_" + mfrais_id).remove();
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
            url: "{{ route('admin.mfrais.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {


        swal({
                    icon: "sucess",
                    title: "Operation effectuée avec succès",
                    showconfirmButtonText: false,
                    timer: 2000
              })
                var classes = '<tr id="id_' + data.id + '"><td>' +data.name_classe + '</td><td>' + data.name_frais + '</td><td>'+ data.montant + '</td><td><a href="javascript:void(0)" id="edit-post" data-id="' + data.id + '" class="btn btn-info">Modifier</a></td>';
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
