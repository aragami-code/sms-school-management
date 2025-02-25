@extends('backend.layouts.master')


@section('title')
liste des matieres par classe| Tableau de Bord
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
                    <h4 class="header-title">Assigner une nouvelle Matiere</h4>
                    @include('backend.layouts.partials.messages')
                    @if(Auth::guard('admin')->user()->can('assmatiereas.create'))
                    <p class="float-right">{{--
                    <a class="btn btn-primary text-white" href="{{ route('admin.classes.create')}}">Creer une nouvelle Classes</a>--}}
                    <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-new-post"> <b><i class="fa fa-plus"></i></b><span>
                    </span>Assigner une nouvelle Matiere</a>

                    </p>
                    @endif

                    <div class="clearfix"></div>
                    <br>

                    @if(Auth::guard('admin')->user()->can('assmatiereas.view'))
                    <div class="data-tables">
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                   <th width="20%">Classes</th>
                                    
                                    <th width="20%">Action</th>

                                </tr>
                            </thead>
                            <tbody id="posts-crud">

                                @foreach ($classes as $classe)

                              <tr id="id_{{ $classe->id }}">
                                    <td>{{$classe->name_classes}}</td>

                                    <td>

                                        @if(Auth::guard('admin')->user()->can('assmatiereas.edit'))

                                        <a class="btn btn-primary text-white" href="{{ route('admin.assmatiereas.show',Crypt::encrypt($classe->id ))}}" > <i class="fa fa-eye"></i> Voir</a>
                               

                                     
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
                                                                                    
                                                                                    
                                                                                    <div class="form-group col-md-2 col-sm-2">
                                                                                        
                                                                                           
                                                                                           <div class="alert-message" ></div>
                                                                                       
                                                                                                  
                                                                                                  <a href="#" class="btn btn-info addRow"><i class="fa fa-plus-circle"></i></a>
            
                                                                                    </div>
                                                                                 
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody class="aragali">
                                                                                <tr>
                                                                                    <div class="form-group col-md-5 col-sm-5">
                                                                                        <label for="">Nom de la Classe<span class="text-danger">*</span></label>
                                                                                            <select name="id_classe" id="id_classe" class="form-control" required="on">
                                                                                                @foreach ($classes as $clas)
                                  
                                                                                                    <option value ="{{$clas->id}}">{{$clas->name_classes}}</option>
                                  
                                                                                                @endforeach
                                                                                            </select>
                                                                                           
                                                                                    </div>
                                                                                    <div class="form-group col-md-5 col-sm-5">
                                                                                    <label for="name">Groupe d'allocation  <span class="text-danger">*</span></label>
                                                                                    <select name="id_gmatiere" id="id_gmatiere" class="form-control" required="on">
                                                                                        <option value ="0">Choisissez groupe de matiere</option>
                                                                                        @foreach ($gpmatiere as $gmatiere)
                          
                                                                                            <option value ="{{$gmatiere->id}}">{{$gmatiere->name_gmatiere}}</option>
                          
                                                                                        @endforeach
                                                                                    </select>
                                                                                    </div>
                                                                                    <td width="30%">
                                                                                        <label for="">Nom matiere<span class="text-danger">*</span></label>
                                                                                        <select name="id_matiere[]" id="id_matiere" class="form-control" required="on">
                                                      
                                                                                        </select>
                                                                                        
                                                                                       <div class="alert-message" ></div>
                                                                                    </td>
                                                                                    <td width="20%">
                                                                                        <label for="slug">note maximale <span class="text-danger">*</span></label>
                                                                                        <select name="note_max_auth[]" id="note_max_auth" class="form-control" required="on">
                                                                                           <option value ="20">20/20</option>  
                                                                                            
                                                                                        </select>
                                                                                         
                                                                                    </td>
                                                                                    <td width="20%">
                                                                                        <label for="slug">Note eliminatoire <span class="text-danger">*</span></label>
                                                                                       
                                                                                         <select name="note_el[]" id="note_el" class="form-control" required="on" value="">
                                                                                         
                                                                                            <option value ="5">5</option>
                                                                                                     <option value ="6">6</option>
                                                                                                     <option value ="7">7</option>
                                                                                                     <option value ="8">8</option>
                                                                                                     <option value ="9">9</option>
                                                                                                     <option value ="10">10</option>
                                                                                            
                                                                                        </select>
                                                                                    </td>
                                                                                    
                                                             
                                                                                    
                                                                                    <td width="20%">
                                                                                        <label for="slug">Coef/Credit(s) <span class="text-danger">*</span></label>
                                                                                        <select name="credits[]" id="credits" class="form-control" required="on" value="">
                                                                                            <option value ="1">1</option>
                                                                                            <option value ="2">2</option>
                                                                                            <option value ="3">3</option>
                                                                                            <option value ="4">4</option>
                                                                                            <option value ="5">5</option>
                                                                                            <option value ="6">6</option> 
                                                                                            <option value ="7">7</option>
                                                                                            <option value ="8">8</option>
                                                                                            <option value ="9">9</option>
                                                                                            <option value ="10">10</option>
                                                                                            <option value ="11">11</option>
                                                                                            <option value ="12">12</option>  
                                                                                            
                                                                                        </select>
                                                                                        <div class="alert-message" ></div>
                                                                                    </td>
                                                                                   
                                                                                   <td>
                                                                                    <a href="#" class="btn btn-danger movRow"><i class="fa fa-minus-circle"></i></a>
                                                                                  </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>

                                        </div>
                                        <a href="#" class="btn btn-info addRow"><i class="fa fa-plus-circle"></i></a>
            




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
         var tr = '<tr>'+'<input type="hidden" name="id[]" id="id">'
            +'<td width="30%"><label for="name">Nom de la matiere <span class="text-danger">*</span></label><select name="id_matiere[]" id="id_matiere" class="form-control" required="on"></select><div class="alert-message" ></div></td>' 
            +'<td width="20%"><label for="name">note maximale  <span class="text-danger">*</span></label><select name="note_max_auth[]" id="note_max_auth" class="form-control" required="on"><option value ="20">20/20</option></select><div class="alert-message" ></div></td>' 
            +'<td width="20%"><label for="name">Note eliminatoire  <span class="text-danger">*</span></label><select name="note_el[]" id="note_el" class="form-control" required="on" value=""><option value ="8">8</option></select><div class="alert-message" ></div></td>' 
            +'<td width="20%"><label for="name">Coef/credit  <span class="text-danger">*</span></label><select name="credits[]" id="credits" class="form-control" required="on" value=""><option value ="1">1</option><option value ="2">2</option><option value ="3">3</option><option value ="4">4</option><option value ="5">5</option><option value ="6">6</option><option value ="7">7</option><option value ="8">8</option><option value ="9">9</option><option value ="10">10</option><option value ="11">11</option><option value ="12">12</option></select><div class="alert-message" ></div></td>' 
            +'<td> <a href="#" class="btn btn-danger movRow"><i class="fa fa-minus-circle"></i></a></td>'+'</tr>';                                                                    
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
          $('#postCrudModal').html("Assigner une Matiere");
          $('#ajax-crud-modal').modal('show');

     });

     
    });

   if ($("#postForm").length > 0) {
        $("#postForm").validate({

       submitHandler: function(form) {

        var actionType = $('#btn-save').val();


        $('#btn-save').html('traitement...');



        $.ajax({
            data: $('#postForm').serialize(),
            url: "{{ route('admin.assmatiereas.store') }}",
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

                var annee = '<tr id="id_' +data.id+ '"><td>{{$classe->name_classes}}</td>';
                    
                    annee += '<td><a href="{{ route("admin.assmatiereas.show",Crypt::encrypt($classe->id))}}" id="edit-post"  data_token="{{csrf_token()}}" data-id="' + data.id + '" class="btn btn-info"><i class="fa fa-eye"></i>voir</a></td>';
                    
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






<script type="text/javascript">


    jQuery('select[name="id_gmatiere"]').on('change',function()
    {
        var id_gpmatiere = $(this).val();

        if(id_gpmatiere)
        {

            $.ajax(
                {

                    type:"GET",
                    url: '/admin/assmatiereas/assmatiereas/'+id_gpmatiere,
                    dataType: "json",
                    success:function(data){
                    if (data)
                        {
                            jQuery('select[name="id_matiere[]"]').empty();
                            $('select[name="id_matiere[]"]').append('<option value="0">CHOISIR MATIERE</option>');
                            jQuery.each(data,function(key,value){
                            $('select[name="id_matiere[]"]').append('<option value="'+key+'">'+value+'</option>');
                            });
                        }
                    else
                        {
                            $('select[name="id_matiere"]').empty();
                        }
                }
            });

        }

        else
        {

            $('select[id="id_gmatiere"]').empty();

        }

    });

</script>










@endsection
