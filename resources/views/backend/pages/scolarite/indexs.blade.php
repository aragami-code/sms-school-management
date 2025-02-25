@extends('backend.layouts.master')


@section('title')
scolarité| Tableau de Bord
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
                    <li><span>Scolarite</span></li>
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
                         
                        
                        @php
                            $anns = \App\Annees::orderBy('id','desc')->get();
                            $classes = \App\Classes::all();
                        @endphp
                          
        <div class="col-12 mt-5">
            
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">gestion de la scolarité </h4>
                    @include('backend.layouts.partials.messages')
                    @if(Auth::guard('admin')->user()->can('scolarites.create'))
                    
                    

                    @endif

                    <div class="clearfix"></div>
                    <br>

                    @if(Auth::guard('admin')->user()->can('scolarites.view'))
                   {{-- <form action="{{route('admin.promotion.userlist')}}" method="GET" enctype="multipart/form-data" class="search-form">--}}
                    <div class="form-row">
                        @csrf
                            <div class="form-group col-md-3 col-sm-3">
                                <label for="name"><b>Annee Academique <span class="text-danger">*</span></b></label>
                                    <select name="id_anne" id="id_anne" class="form-control" required="on">
                                    <option value ="0">Choisir l'annee Academique</option>
                                         @foreach ($anns as $ans)
                                            <option value ="{{$ans->id}}">{{$ans->slug_annee}}</option>
                
                                        @endforeach
                                    </select>
                                
                            </div>
                            <div class="form-group col-md-3 col-sm-3">
                                <label for="name"><b>Classe d'admission <span class="text-danger">*</span></b></label>
                                    <select name="id_class" id="id_class" class="form-control" >
                                    <option value ="0">Choisir la classe d'admission</option>
                                        @foreach ($classes as $clas)
                                            <option value ="{{$clas->id}}">{{$clas->name_classes}}</option>
                
                                        @endforeach
                                    </select>
                                
                            </div>
                            <div class="form-group col-md-3 col-sm-3">
                                <label for="name"></b>Section d'admission  <span class="text-danger">*</span></b></label>
                                <select name="id_sectio" id="id_sectio" class="form-control"  >
                                
                                </select>
                            </div>  
                           {{-- <button class="button primary-bg" id="filter"><i class="fas fa-search"></i>Rechercher</button>--}}
                         {{--   <button  type="button" class="btn btn-default">effacer</button>
                        --}}
                        <div class="form-group col-md-3 col-sm-3">
                             <a  class="btn btn-success mb-2 text-white" name="filter" id="filter"> <b><i class="fa fa-search"></i></b><span>
                                </span></a>
                                <a  class="btn btn-primary mb-2 text-white" id="reset" name="reset"> <b>annuler</b><span>
                                </span></a>
                       
                        </div> 
                       
                    </div>
                      {{--  </form>--}}


                      <div class="data-tables">
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                
                                <th width="5%">id</th>
                                <th width="20%">matricule </th>
                                <th width="20%">Nom Etudiant</th>
                                <th width="20%">classe</th>
                                <th width="20%">section</th>
                                <th width="20%">action</th>
      
      
                                </tr>
                            </thead>
                          
                        </table>
                    </div>


{{--

                    <div class="modal fade" id="ajax-crud-modal" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        <form id="postForm" name="postForm" class="form-horizontal" enctype="multipart/form-data">
                             <div class="modal-header">
                                <h4 class="modal-title" id="postCrudModal"></h4>
                                </div>
                                <div class="modal-body">

                               
                               <div class="alert-message" id="name_matiere_error"></div>

                                    <div class="form-row">
                                       

                                                        @csrf
                                                        <input type="hidden" name="id" id="id">
                                                        <input type="hidden" name="id_annee" id="id_annee">
                                                        <div class="form-group col-md-9 col-sm-9">
                                                            
                                                            <label for="name"><b> Nom(s) & Prenom(s)</b></label>
                                                            <input type="text" class="form-control" id="nom_prenom" name="nom_prenom" value="" required="on" readonly>
                                                        </div>
                                                        <div class="form-group col-md-3 col-sm-3">
                                                                                                    
                                                            <label for="name"><b> Matricule</b></label>
                                                            <input type="text" class="form-control" id="id_matricule_etudiant" name="id_matricule_etudiant" value="" required="on" readonly>
                                                        </div>
     
                                                        <div class="form-group col-md-6 col-sm-6">
                                                            <label for="name"><b>choisir la Classe d'admission <span class="text-danger">*</span></b></label>
                                                                <select name="id_classe" id="id_classe" class="form-control" >
                                                                <option value ="0">Choisir la classe d'admission</option>
                                                                    @foreach ($classes as $clas)
                                                                        <option value ="{{$clas->id}}">{{$clas->name_classes}}</option>
                                            
                                                                    @endforeach
                                                                </select>
                                                            
                                                        </div>
                                                        <div class="form-group col-md-6 col-sm-6">
                                                            <label for="name"></b>choisir la Section d'admission  <span class="text-danger">*</span></b></label>
                                                            <select name="id_section" id="id_section" class="form-control"  >
                                                            
                                                            </select>
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

--}}



                    
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

    $(document).ready(function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      

     

     
    });

   if ($("#postForm").length > 0) {
        $("#postForm").validate({

       submitHandler: function(form) {

        var actionType = $('#btn-save').val();


        $('#btn-save').html('traitement...');



        $.ajax({
            data: $('#postForm').serialize(),
            url: "{{ route('admin.scolarites.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {


        swal({

                    icon: "sucess",
                    title: "Operation effectuée avec succès",
                    showconfirmButtonText: false,
                    timer: 2000
              })

        
                $('#dataTable').DataTable().draw(true);
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



<script type = "text/javascript">
    
 
 
 
 
 
 
 
 
 
 
   $(document).ready(function(){
 
 fill_datatable();
 
 function fill_datatable(id_anne = '',id_class = '', id_sectio = '' )
 {
     var dataTable = $('#dataTable').DataTable({
         processing: true,
         serverSide: true,
         ajax:{
             url: "{{ route('admin.scolarites.index') }}",
             data:{id_anne:id_anne,id_class:id_class,id_sectio:id_sectio}
         },
         columns: [
            {data:'DT_RowIndex',name:'DT_RowIndex',orderable:false,searchable:false},
          // {data:'id',name:'id'},
                      {data:'matricule',name:'matricule'},
                      {data:'nom_prenom',name:'nom_prenom'},
                      {data:'name_classes',name:'name_classes'},
                      {data:'nom_section',name:'nom_section'},
                      {data:'action',name:'action',orderable:false,searchable:false},
                     
            
         ]
     });
 }
 
 $('#filter').click(function(){
             
             var id_class = $("#id_class").val();
             var id_sectio = $("#id_sectio").val();
             var id_anne = $("#id_anne").val();
 
     if(id_anne != ''&& id_class != '' &&   id_sectio != '')
     {
         $('#dataTable').DataTable().destroy();
         fill_datatable(id_anne,id_sectio,id_class);
     }
     else
     {
         alert('Select Both filter option');
     }
 });
 
 $('#reset').click(function(){
     
         var id_class = $('#id_class').val('');
         var id_sectio = $('#id_sectio').val(''); 
         var id_anne = $('#id_anne').val('');
     
     $('#dataTable').DataTable().destroy();
     fill_datatable();
 });
 
 $(document).on('click', '#edit-post', function () {
     var id = $(this).data('id');
     $.get("{{ route('admin.scolarites.index') }}" +'/' + id +'/edit', function (data) {
      
           $('#postCrudModal').html("Changer de classe");
             $('#btn-save').val("edit-post");
             $('#ajax-crud-modal').modal('show');
             $('#id').val(data.id);
             $('#id_matricule_etudiant').val(data.matricule);
             $('#nom_prenom').val(data.nom_prenom);
             $('#id_classe').val(data.id_classe);
             $('#id_section').val(data.id_section);
             $('#id_annee').val(data.id_annee);
       })
 
        
      });
 
 });
   </script>











<script type="text/javascript">


    jQuery('select[name="id_class"]').on('change',function()
    {
        var classe_adm_id = $(this).val();

        if(classe_adm_id)
        {

            $.ajax(
                {

                    type:"GET",
                    url: '/admin/scolarites/scol/'+classe_adm_id,
                    dataType: "json",
                    success:function(data){
                    if (data)
                        {
                            jQuery('select[name="id_sectio"]').empty();
                            $('select[name="id_sectio"]').append('<option value="0">Choisir la section d\'admission </option>');
                            jQuery.each(data,function(key,value){
                            $('select[name="id_sectio"]').append('<option value="'+key+'">'+value+'</option>');
                            });
                        }
                    else
                        {
                            $('select[name="id_sectio"]').empty();
                        }
                }
            });

        }

        else
        {

            $('select[id="id_sectio"]').empty();

        }

    });

</script>



@endsection
