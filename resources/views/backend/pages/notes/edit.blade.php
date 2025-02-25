@extends('backend.layouts.master')


@section('title')
Notes| Tableau de Bord
@endsection





@section('styles')
{{--
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
--}}
<link rel="stylesheet" href="{{asset('backend/css/jquery.dataTables.css')}}">



@section('admin-content')

  <!-- page title area start -->
  <div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Tableau de Bord</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{route('admin.dashboard')}}">Tableau de Bord</a></li>
                    <li><span>Notes</span></li>
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
                            $type_ex = \App\Type_Exams::all();
                            $evaluations = \App\Evaluations::all();
                        @endphp
                          
        <div class="col-12 mt-5">
            
            <div class="card">
                <div class="card-body">
                    <form id="postForm" name="postForm" class="form-horizontal" enctype="multipart/form-data">
                    <h4 class="header-title">Gestion des notes </h4>
                    @include('backend.layouts.partials.messages')
                    @if(Auth::guard('admin')->user()->can('notes.create'))
                    
                    

                    @endif

                    <div class="clearfix"></div>
                    <br>

                    @if(Auth::guard('admin')->user()->can('notes.view'))
                   {{-- <form action="{{route('admin.promotion.userlist')}}" method="GET" enctype="multipart/form-data" class="search-form">--}}
                    <div class="form-row">

                        @csrf
                        <input type="hidden" name="id" id="id">
                            <div class="form-group col-md-2 col-sm-2">
                                <label for="name"><b>Annee Academique <span class="text-danger">*</span></b></label>
                                    <select name="id_annee" id="id_annee" class="form-control" required="on">
                                     @foreach ($anns as $ans)
                                            <option value ="{{$ans->id}}">{{$ans->slug_annee}}</option>
                
                                        @endforeach
                                    </select>
                                
                            </div>
                            <div class="form-group col-md-2 col-sm-2">
                                <label for="name"><b>Classe d'admission <span class="text-danger">*</span></b></label>
                                    <select name="id_classe" id="id_classe" class="form-control" >
                                    <option value ="0">Choisir la classe d'admission</option>
                                        @foreach ($classes as $clas)
                                            <option value ="{{$clas->id}}">{{$clas->name_classes}}</option>
                
                                        @endforeach
                                    </select>
                                
                            </div>
                            <div class="form-group col-md-2 col-sm-2">
                                <label for="name"></b>Section d'admission  <span class="text-danger">*</span></b></label>
                                <select name="id_section" id="id_section" class="form-control"  >
                                
                                </select>
                            </div> 
                            <div class="form-group col-md-2 col-sm-2">
                                <label for="name"></b>Matiere  <span class="text-danger">*</span></b></label>
                                <select name="id_matiere" id="id_matiere" class="form-control"  >
                                
                                </select>
                            </div> 
                            <div class="form-group col-md-3 col-sm-3" style="display: none">
                                <label for="name"></b>GMatiere  <span class="text-danger">*</span></b></label>
                                <select name="id_gmatiere" id="id_gmatiere" class="form-control"  readonly="on">
                                
                                </select>
                            </div> 
                            <div class="form-group col-md-2 col-sm-2">
                                <label for="name"></b>Examen  <span class="text-danger">*</span></b></label>
                                 <select name="id_type_exams" id="id_type_exams" class="form-control"  >
                               
                                        @foreach ($type_ex as $tx)
                                            <option value ="{{$tx->id}}">{{$tx->name_type_exam}}</option>
                
                                        @endforeach
                               
                                </select>
                            </div> 
                            <div class="form-group col-md-2 col-sm-2">
                                <label for="name"></b>Evaluation  <span class="text-danger">*</span></b></label>
                                <select name="id_evaluation" id="id_evaluation" class="form-control"  >
                                    @foreach ($evaluations as $eva)
                                    <option value ="{{$eva->id}}">{{$eva->code_evaluation}}</option>
        
                                @endforeach
                                </select>
                            </div>  
                           {{-- <button class="button primary-bg" id="filter"><i class="fas fa-search"></i>Rechercher</button>--}}
                         {{--   <button  type="button" class="btn btn-default">effacer</button>
                        --}}
                        <div class="form-group col-md-12 col-sm-12">
                            <center>

                                <a  class="btn btn-success mb-2 text-white" name="filter" id="filter" onclick="setTimeout(not,3000)"> <b><i class="fa fa-search"></i></b><span>
                                </span></a>
                                <a  class="btn btn-primary mb-2 text-white" id="reset" name="reset"> <b>annuler</b><span>
                                </span></a>

                            </center>
                            
                           
                        </div> 
                       
                    </div>
                      {{--  </form>--}}
                      
                      <div class="data-tables">
                        <div class="alert-message" id="name_annee_error"></div>
                        <table id="dataTable" class="text-center" data-paging='false'>
                            <thead class="bg-light text-capitalize">
                                <tr>
                                
                                <th width="5%">id</th>
                                <th width="30%">Matricule</th>
                                <th width="50%">Nom Etudiant</th>
                               
                                <th width="15%">Note/20</th>
      
      
                                </tr>
                            </thead>
                           
                        </table>
                        <div>
                            <center>
                                <button type="submit" class="btn btn-primary" id="btn-save" value="create" >Update</button>
                                
                            </center>
                
                        </div>
                       
                    </div>

{{--
<form id="postForm" name="postForm" class="form-horizontal" enctype="multipart/form-data"style="display: none">
                            

                                    <button type="submit" class="btn btn-primary" id="btn-save" value="create">Enregistrer</button>


                                    <button type="reset" class="btn danger">Initialiser</button>

                                
</form>
--}}
                   





                    
                    @endif
                  
                </form>
                </div>
            </div>{{--
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
                                                <input type="text" name="id" id="id" value="">
                                                <input type="text" name="id_annee" id="id_annee" value="">
                                                <div class="form-group col-md-9 col-sm-9">
                                                    
                                                    <label for="name"><b> Nom(s) & Prenom(s)</b></label>
                                                    <input type="text" class="form-control" id="nom_prenom" name="nom_prenom" value="" required="on" readonly>
                                                </div>
                                                <div class="form-group col-md-3 col-sm-3">
                                                                                            
                                                    <label for="name"><b> Matricule</b></label>
                                                    <input type="text" class="form-control" id="matricule" name="matricule" value="" required="on" readonly>
                                                </div>

                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label for="name"><b>Note/20 <span class="text-danger">*</span></b></label>
                                                    <input type="number" class="form-control" id="note_etudiant" name="note_etudiant" value="" required="on" readonly>
                                                  
                                                    
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
        </div>--}}
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
<script>
/*================================
datatable active
==================================*/
//if ($('#dataT').length) {
   // $('#dataT').DataTable({
     //   responsive: true
    //});
//}


</script>










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
                    url: "{{ route('admin.notes.updatestud') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
        
        
                swal({
        
                            icon: "sucess",
                            title: "Operation effectuée avec succès",
                            showconfirmButtonText: false,
                            timer: 2000
                      })
        
                
                       // $('#dataTable').DataTable().draw(true);
                        $('#postForm').trigger("reset");
                        $('#ajax-crud-modal').modal('hide');
                        $('#btn-save').html('Save Changes');
                        
                        //$('#dataTable').DataTable().destroy();
    
                        fill_datatable();
        
        
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
{{----}}



















<script>
    /*$(document).ready(function(){
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
        fill_datatable();
        
        function fill_datatable(id_annee ='',id_classe='',id_section=''){
            var dataTable =$('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax:{
                    url: '/admin/promotion',
                    type: 'GET',
                   // data:{id_annee:id_annee,id_classe:id_classe,id_section:id_section}
                    data: function (d) {
                   d.id_annee = $('#id_annee').val();
                   d.id_classe = $('#id_classe').val();
                   d.id_section = $('#id_section').val();
          }
                },
                columns:[
                    {data:'id_matricule_etudiant',name:'id_matricule_etudiant'},
                    {data:'id_classe',name:'id_classe'},
                    {data:'id_section',name:'id_section'},
                    {data:'id_annee',name:'id_annee'}
                ]
            });
        }
       
       $('#filter').click(function(){
     $('#dataTable').DataTable().draw(true);
  });
       
       $('#reset').click(function(){
        var id_annee = $('#id_annee').val('');
        var id_classe = $('#id_classe').val('');
        var id_section = $('#id_section').val(''); 
        $('#dataTable').DataTable().draw(true);
                    
        fill_datatable();
       });
    });
  */  
    </script>




<script type = "text/javascript">
   /* var $ = jQuery.noConflict();
    $(document).ready( function () {
        $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });
     $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: { 
            type: 'GET',
            url: './promotion/users-list',
            "dataSrc":"",
            
            
             data: function (d) {
             d.id_annee = $('#id_annee').val();
             d.id_classe = $('#id_classe').val();
             d.id_section = $('#id_section').val();
             }
            },
            columns: [
                     { data: 'id', name: 'id' },
                     { data: 'id_matricule_etudiant', name: 'id_matricule_etudiant' },
                     { data: 'id_classe', name: 'id_classe' },
                     { data: 'id_section', name: 'id_section' },
                     { data: 'id_annee', name: 'id_annee' }
                  ],
                  order:[[0,'desc']]
         });
      });
   
     $('#filter').click(function(){
        $('#dataTable').DataTable().draw(true);
     });*/

     /* 
     $(document).ready( function () {
        
        $("#filter").click(function(){
            var id_annee = $("#id_annee").val();
            var id_classe = $("#id_classe").val();
            var id_section = $("#id_section").val();

            $.ajax({
                type: 'get',
                url: './promotion/users_list',
               dataType: 'html',
                
                data: 'id_annee='+ id_annee + '&id_classe=' +id_classe+ '&id_section=' +id_section,
            success:function(data)  {
                console.log(data);
                $("#dataTable").html(data.html);
            }  
          });
     });

     });
  */










  $(document).ready(function(){

fill_datatable();

function fill_datatable(id_classe = '', id_section = '', id_annee = '', id_gmatiere = '', id_matiere = '', id_type_exams = '', id_evaluation = '')
{
    
    var dataTable = $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            url: "{{ route('admin.notes.editnote') }}",
            data:{id_classe:id_classe,id_section:id_section,id_annee:id_annee,id_gmatiere:id_gmatiere,id_matiere:id_matiere,id_type_exams:id_type_exams,id_evaluation:id_evaluation}
        },
        columns: [
                     {data:'DT_RowIndex',name:'DT_RowIndex',orderable:false,searchable:false},
                     {data:'matricule',name:'matricule'},
                     {data:'nom_prenom',name:'nom_prenom'},
                     {data:'action',name:'action',orderable:false,searchable:false},
                    
           
        ]

    });
   
}

$('#filter').click(function(){
            
             var id_classe = $("#id_classe").val();
            var id_section = $("#id_section").val();
            var id_annee = $("#id_annee").val();
            var id_classe = $("#id_classe").val();
            var id_gmatiere = $("#id_gmatiere").val();
            var id_matiere = $("#id_matiere").val();
            var id_type_exams = $("#id_type_exams").val();
            var id_evaluation = $("#id_evaluation").val();
            

    /*        function not() {
    if(noteetu != ''){
            
            $('#btn-save').hide();
        
    }else{
        
        $('#btn-save').show();



    }

}*/
            
 

            /*if(noteetu != ''){
            
                $('#btn-save').hide();
            
        }else{
            
            $('#btn-save').show();



        }*/
          
          

    if(id_classe != '' &&  id_section != '' && id_annee != '' &&  id_gmatiere != ''&&  id_matiere != ''&&  id_type_exams != ''&&  id_evaluation != '')
    {
       $('#dataTable').DataTable().destroy();
        fill_datatable(id_classe, id_section, id_annee, id_gmatiere , id_matiere , id_type_exams , id_evaluation);
       
        
    }
    else
    {
        alert('Select Both filter option');
    }
});

$('#reset').click(function(){
    
        var id_classe = $('#id_classe').val('');
        var id_section = $('#id_section').val(''); 
        var id_annee = $('#id_annee').val('');
        var id_matiere = $('#id_matiere').val('');
        var id_gmatiere = $('#id_gmatiere').val('');
        var id_type_exams = $('#id_type_exams').val('');
        var id_evaluation = $('#id_evaluation').val('');
        //$('#btn-save').hide();
        //var noteetu = $("#note_etudiant").val('');
    
    $('#dataTable').DataTable().destroy();
    
        fill_datatable();
    
        
        
});



});


  </script>

































<script type="text/javascript">


    jQuery('select[name="id_classe"]').on('change',function()
    {
        var classe_adm_id = $(this).val();

        if(classe_adm_id)
        {

            $.ajax(
                {

                    type:"GET",
                    url: '/admin/notes/promotions/'+classe_adm_id,
                    dataType: "json",
                    success:function(data){
                    if (data)
                        {
                            jQuery('select[name="id_section"]').empty();
                            $('select[name="id_section"]').append('<option value="0">Choisir la section d\'admission </option>');
                            jQuery.each(data,function(key,value){
                            $('select[name="id_section"]').append('<option value="'+key+'">'+value+'</option>');
                            });
                        }
                    else
                        {
                            $('select[name="id_section"]').empty();
                        }
                }
            });


            $.ajax(
                {

                    type:"GET",
                    url: '/admin/notes/assmatiereas/'+classe_adm_id,
                    dataType: "json",
                    success:function(data){
                    if (data)
                        {
                            jQuery('select[name="id_matiere"]').empty();
                            $('select[name="id_matiere"]').append('<option value="0">Choisir la section d\'admission </option>');
                            jQuery.each(data,function(key,value){
                            $('select[name="id_matiere"]').append('<option value="'+key+'">'+value+'</option>');
                            });





    jQuery('select[name="id_matiere"]').on('change',function()
    {
        var classe_adm_id = $(this).val();

        if(classe_adm_id)
        {

            $.ajax(
                {

                    type:"GET",
                    url: '/admin/notes/gassmatiereas/'+classe_adm_id,
                    dataType: "json",
                    success:function(data){
                    if (data)
                        {
                            jQuery('select[name="id_gmatiere"]').empty();
                            jQuery.each(data,function(key,value){
                            $('select[name="id_gmatiere"]').append('<option value="'+key+'">'+value+'</option>');
                            
                            });
                        }
                    else
                        {
                            $('select[name="id_gmatiere"]').empty();
                        }
                }
            });

        }

        else
        {

            $('select[id="id_section"]').empty();

        }

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

            $('select[id="id_section"]').empty();

        }

    });

















    /*    if(actionType = $('#btn-save').val();){

                $('#btn-save').html('traitement...');
                
                $.ajax({
                    data: $('#postForm').serialize(),
                    url: "{{ route('admin.notes.store') }}",
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

            }else{
                var actionTypedit = $('#btn-edit').val();

                $('#btn-edit').html('traitement...');
                
                $.ajax({
                    data: {$('#postForm').serialize(),_method:'PUT'},
                    url: "{{ route('admin.notes.index') }}" +'/' + id_matiere,
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
*/

</script>






@endsection
