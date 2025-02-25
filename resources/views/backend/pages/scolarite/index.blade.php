@extends('backend.layouts.master')


@section('title')
Scolarites| Tableau de Bord
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
                    <li><span>Scolarité</span></li>
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
                            $frais = \App\Frais::orderBy('id','desc')->get();
                            $mfrais = \App\MontantFrais::where('id','desc')->get();
                        @endphp
                          
        <div class="col-12 mt-5">
            
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Scolarite par annee </h4>
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
                                <th width="20%">matricule_etudiant</th>
                                <th width="20%">Nom Etudiant</th>
                                <th width="20%">classe</th>
                                <th width="20%">section</th>
                                <th width="20%">action</th>
      
      
                                </tr>
                            </thead>
                          
                        </table>
                    </div>



{{--mettre a jour les informations de la scolarite d'un etudiant--}}
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
                                                        
                                                        <input type="hidden"  class="form-control"  name="code_recu" id="code_recu">
                                                        <input type="hidden" class="form-control" id="id_classe" name="id_classe" value="" required="on" readonly>
                                                        <input type="hidden" class="form-control" id="id_section" name="id_section" value="" required="on" readonly>
                                                         
                                                        <div class="form-group col-md-9 col-sm-9">
                                                            
                                                            <label for="name"><b> Nom(s) & Prenom(s)</b></label>
                                                            <input type="text" class="form-control" id="nom_prenom" name="nom_prenom" value="" required="on" readonly>
                                                        </div>
                                                        <div class="form-group col-md-3 col-sm-3">
                                                                                                    
                                                            <label for="name"><b> Matricule</b></label>
                                                            <input type="text" class="form-control" id="matricule" name="matricule" value="" required="on" readonly>
                                                        </div>
     
                                                        
                                                        
                                                        <div class="form-group col-md-4 col-sm-4">
                                                            <label for="name"><b>Scolarite totale à payer <span class="text-danger">*</span></b></label>
                                                            <input type="number" class="form-control" id="scolarite_total" name="scolarite_total" value="" required="on" readonly>
                                                            
                                                        </div>
                                                        <div class="form-group col-md-4 col-sm-4">
                                                            <label for="name"><b>Reduction speciale <span class="text-danger">*</span></b></label>
                                                            <input type="number" class="form-control" id="reduction_scolarite" name="reduction_scolarite" value="0" required="on">
                                                             
                                                        </div>
                                                        <div class="form-group col-md-4 col-sm-4">
                                                            <label for="name"><b>Majoration speciale <span class="text-danger">*</span></b></label>
                                                            <input type="number" class="form-control" id="majoration_scolarite" name="majoration_scolarite" value="0" required="on">
                                                             
                                                        </div>

                                                        <div class="form-group col-md-4 col-sm-4">
                                                            <label for="name"><b>Scolarite Nette à payer <span class="text-danger">*</span></b></label>
                                                            <input type="number" class="form-control" id="scolarite_net_a_payer" name="scolarite_net_a_payer" value="0" required="on"readonly>
                                                             
                                                        </div>
                                                        
                                        




                                       
                                        

                                             

                                        </div>
                                    
            




                                </div>
                                <div class="modal-footer">

                                    <button type="submit" class="btn btn-primary" id="btn-save" value="create">Enregistrer</button>


                                    <button type="reset" class="btn btn-danger">Initialiser</button>

                                </div>
                        </form>
                            </div>
                        </div>
                    </div>
 {{--fin--}}

{{--ajouter payement de scolarite--}}

<div class="modal fade" id="ajax-crud-modale" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <form id="postForme" name="postForme" class="form-horizontal" enctype="multipart/form-data">
         <div class="modal-header">
            <h4 class="modal-title" id="postCrudModale"></h4>
            </div>
            <div class="modal-body">

           

                <div class="form-row">
                   

                                    @csrf
                                    <div class="alert-message" id="name_matiere_error"></div>
                                    <input type="hidden" name="ide" id="ide">
                                    <input type="hidden" name="id_ann" id="id_ann" value="">
                                    <input type="hidden" name="code_rec" id="code_rec">
                                    <input type="hidden" class="form-control" id="id_clas" name="id_clas" value="" required="on" readonly>
                                    <input type="hidden" class="form-control" id="id_sectione" name="id_sectione" value="" required="on" readonly>
                                     
                                    <div class="form-group col-md-9 col-sm-9">
                                        
                                        <label for="name"><b> Nom(s) & Prenom(s)</b></label>
                                        <input type="text" class="form-control" id="nom_preno" name="nom_preno" value="" required="on" readonly>
                                    </div>
                                    <div class="form-group col-md-3 col-sm-3">
                                                                                
                                        <label for="name"><b> Matricule</b></label>
                                        <input type="text" class="form-control" id="matriculee" name="matriculee" value="" required="on" readonly>
                                    </div>
 
                                    <div class="form-group col-md-3 col-sm-3">
                                        <label for="name"><b>Montant du jour <span class="text-danger">*</span></b></label>
                                        <input type="text"  inputmode="numeric" maxlength="6" class="form-control" id="montant_versement_jour" name="montant_versement_jour" value="0" required="on" >
                                         
                                    </div>
                                    {{-- <div class="form-group col-md-3 col-sm-4">
                                        <label for="name"><b>Intitulé <span class="text-danger">*</span></b></label>
                                       
                                        <select name="intitule_frais" id="intitule_frais" class="form-control" >
                                            <option value ="">Choisir l'intitulé du frais</option>
                                                @foreach ($frais as $frai)
                                                    <option value ="{{$frai->id}}">$frai->name_frais</option>
                        
                                                @endforeach
                                            </select>
                                    </div>
                                    --}}
                                    <div class="form-group col-md-3 col-sm-3">
                                        <label for="name"><b>Mode Reglement<span class="text-danger">*</span></b></label>
                                       
                                        <select name="etat_solde" id="etat_solde" class="form-control" >
                                          
                                                <option value ="Virement">Virement</option>
                                                <option value ="Espece">Espece</option>
                                                <option value ="MOMO/">Mobile Money</option>
                                                <option value ="CARTE">Carte</option>
                                            </select>
                                    </div>
                                    
                                    <div class="form-group col-md-2 col-sm-2">
                                        <label for="name"><b>Somme totale <span class="text-danger">*</span></b></label>
                                        <input type="number" class="form-control" id="scolarite_totale" name="scolarite_totale" value="" required="on" readonly>
                                        
                                    </div>
                                    <div class="form-group col-md-2 col-sm-2">
                                        <label for="name"><b>Reste à payer <span class="text-danger">*</span></b></label>
                                        <input type="number" class="form-control" id="reste_scolarite" name="reste_scolarite" value=""  readonly >
                                        
                                    </div>
                                    <div class="form-group col-md-2 col-sm-2">
                                        <label for="name"><b>Cumul à ce jour <span class="text-danger">*</span></b></label>
                                        <input type="number"  class="form-control" id="scolarite_cumule" name="scolarite_cumule" value=""  readonly>
                                        
                                    </div>
                                    
                    




                   
                    

                         

                    </div>
                
                            
                           
                       



            </div>
            <div class="modal-footer">

                <button type="submit" class="btn btn-primary" id="btn-sav" value="create">Enregistrer</button>

                
                <button type="reset" class="btn danger">Initialiser</button>

            </div>
    </form>
    
    
        </div>
    </div>
</div>

{{--fin--}}



{{--s'affiche si l'etudiant à soldé 
<div class="modal fade" id="ajax-crud-moda" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
   
         <div class="modal-header">
            </div>
            <div class="modal-body">

           

                <div class="form-row">
                   
                    <h4 class="modal-title" id="postCrudMle"></h4>

                                   
                         

                </div>
                





            </div>
            <div class="modal-footer">

             
                
                <!--button type="reset" class="btn btn-danger">Initialiser</button-->

            
  
    
        </div>
    </div>
</div>
--}}
{{--fin--}}

{{--voir les etats de payements de scolarite d'un etudiant--}}


<div class="modal fade" id="ajax-crud-mo" aria-hidden="true">
    <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="postCrudMo"></h4>
            </div>
            <div class="modal-body">

           

                   

                <div class="data-tables">
               <center><a href="{{  URL::to('/admin/recu_pdf') }}"  class="btn btn-info">  <b><i class="fa fa-print"> recu incrementiel</i></b><span></a></center> 
                        <table id="dataTab" class="text-center">
                            <thead class="bg-light text-capitalize">
                            
                                <tr>
                                <th width="10%">id </th>
                                    <th width="10%">code_recu</th>
                                    <th width="10%">scolarite_total</th>
                                    <th width="10%">scolarite_cumule</th>
                                    <th width="10%">montant_versmnt_jr</th>
                                    <th width="10%">reste_scolarité</th>
                                    <th width="10%">date_creation</th>
                                    <th width="10%">Action</th>

                                </tr>
                            </thead>
                    
                        </table>

                       
                   
                    

                         

                </div>
                





            </div>
            <div class="modal-footer">
            <button class="btn btn-primary" id="resete" >Fermer</button>
                           
                
              
    
    
        </div>
    </div>
</div>

{{--fin--}}

                    
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
//if ($('#dataT').length) {
   // $('#dataT').DataTable({
     //   responsive: true
    //});
//}
// get field


$('input').on('input propertychange', function(event){
  if(event.which==95){
    return false;
  }
})
</script>








<script>

    $(document).ready(function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      
      $('#edit-list').click(function () {
          $('#ajax-crud-modl').modal('show');
      });

      

       
     });
     




</script>
{{----}}




















<script type = "text/javascript">



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

function fill_datatable(id_class = '', id_sectio = '', id_anne = '')
{
    var dataTable = $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            url: "{{ route('admin.scolarites.index') }}",
            data:{id_class:id_class,id_sectio:id_sectio,id_anne:id_anne}
        },
        columns: [
                     //{data:'id',name:'id'},
                     {data:'DT_RowIndex',name:'DT_RowIndex',orderable:false,searchable:false},
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

    if(id_class != '' &&  id_sectio != '' && id_anne != '' )
    {
        $('#dataTable').DataTable().destroy();
        fill_datatable(id_class, id_sectio, id_anne );
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
     
            $('#postCrudModal').html("Configurer payement de l'etudiant");
            $('#btn-save').val("edit-post");
            $('#ajax-crud-modal').modal('show');
            $('#id').val(data.id);
            $('#code_recu').val(data.code_recu);
            $('#matricule').val(data.matricule);
            $('#nom_prenom').val(data.nom_prenom);
            $('#id_classe').val(data.id_classe);
            $('#id_section').val(data.id_section);
            $('#id_annee').val(data.id_annee);
            $('#scolarite_total').val(data.scolarite_total);
            $('#reduction_scolarite').val(data.reduction_scolarite);
            $('#majoration_scolarite').val(data.majoration_scolarite);
            $('#scolarite_net_a_payer').val(data.scolarite_net_a_payer);
      })

       
     });

/**************************liste des recu******************************* */

$(document).on('click', '#edit-list', function () {
   var id = $(this).data('id');
    $('#dataTab').dataTable({
        retrieve:true,
                "ajax":{
                    url:'/admin/scolarites/' + id +'/s_c',
                    dataSrc:""
                    
                },
                
                "columns":[
                   {  "data": "id"},
                   {  "data": "code_recu" },
                   {  "data": "scolarite_total" },
                   {  "data": "scolarite_cumul" },
                   {  "data": "montant_versement_jour" },
                   {  "data": "reste_scolarite" },
                   {  "data": "created_at" },
                   {  "data": "id","render":function(data,type,row,meta){ 
                    data= '<a href="/admin/scolarites/'+row.id+'/reu_pdf"  class="btn btn-info">  <b><i class="fa fa-print"></i></b><span>';
                      return data;}
                  },
                ],
                
            });
  //  $.get('/admin/scolarites/' + id +'/s_c', function (data) {
            $('#postCrudMo').html("Liste des reçus de l'etudiant");
            //$('#btn-s').val("print");
            
            $('#ajax-crud-mo').modal('show');

           




           /**************************liste des recu*******************************  
            $.each(data, function(key,item){
                var html = '';
                html +='<tr>';
                html +='</tr>'+ item.id +'</tr>';
                html +='</tr>'+ item.matricule +'</tr>';
                html +='</tr>'; 
                $("#pos-crud").append(html);
            });
            $('#pos-crud').dataTable(html);*/
           // $('#i_d').val(data.id);
            //$('#c_ode_recu').val(data.code_recu);
        //    $('#m_atricule').val(data.matricule);
          //  $('#n_om_prenom').val(data.nom_prenom);
            //$('#i_d_classe').val(data.id_classe);
        //    $('#i_d_section').val(data.id_section);
          //  $('#i_d_annee').val(data.id_annee);
     // })

       
     });
     


/**********************************fin liste recu************************* */



});









//-------------------------------CHARGE SUM------------------------------

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
                            $('select[name="id_sectio"]').append('<option value="0"><b><span class="text-danger">Choisir la section d\'admission</span></b> </option>');
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

















<script>

    $(document).ready(function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $('#create-new-post').click(function () {
          $('#btn-sav').val("create-post");
          $('#postForme').trigger("reset");
          $('#postCrudModale').html("payer scolarite");
          $('#ajax-crud-modale').modal('show');
      });

       
    });



//---------------------------ADD SCOL-----------------------


$(document).on('click', '#edit-poste', function () {
    var id = $(this).data('id');
    //= val(data.code_recu)
   // $('#code_recue').val(data.code_recue)
    $.get("{{ route('admin.scolarites.index') }}" +'/' + id +'/edit', function (data) {
     
          
            //$('#ide').val(data.id);
           //$('#code_rec').val(data.code_recu); 
          //  $('#matriculee').val(data.matricule);
        //    $('#nom_preno').val(data.nom_prenom);
      //      $('#id_clas').val(data.id_classe);
    //        $('#id_sectione').val(data.id_section);
  //          $('#id_ann').val(data.id_annee);
           // $('#scolarite_totale').val(data.scolarite_net_a_payer);
         //   $('#montant_versement_jour').val(data.montant_versement_jour);
       //     
     //       $('#scolarite_cumule').val(data.scolarite_cumul);
   //         $('#scolarite_net_a_payere').val(data.scolarite_net_a_payer);<
      })
      $.get('/admin/scolarites/' + id +'/sc', function (data) {
     
         
            if(data.reste_scolarite <= 0)
            {
               
                $('#edit-poste').hide;
                
         // $('#postCrudMle').html("L'Etudiant a deja soldé sa scolarité aucune saisie n'est possible");


                if($data.reste_scolarite ==="")
            {

                $.get("{{ route('admin.scolarites.index') }}" +'/' + id +'/edit', function (data) {
                    
     
                      $('#postCrudModale').html("Payer Scolarité");
                      $('#btn-sav').val("edit-poste");
                      $('#ajax-crud-modale').modal('show');
                      $('#ide').val(data.id);
                      $('#code_rec').val(data.code_recu);
                      $('#matriculee').val(data.matricule);
                      $('#nom_preno').val(data.nom_prenom);
                      $('#id_clas').val(data.id_classe);
                      $('#id_sectione').val(data.id_section);
                      $('#id_ann').val(data.id_annee);
                      $('#scolarite_totale').val(data.scolarite_net_a_payer);
                      $('#montant_versement_jour').val(data.montant_versement_jour);
                      $('#scolarite_net_a_payere').val(data.scolarite_net_a_payer);
                })

            }





            }
            
            else{










        function findTotal(){
        var arr = document.getElementById("montant_versement_jour").value;
        var reste = document.getElementById("reste_scolarite").value;
        arr  = parseInt(arr);
        reste  = parseInt(reste);
       //var tot = document.getElementById("scolarite_totale").value;
       //var total = tot_cum + arr;
       //var totale = tot-tot_cum;
       
        if(arr > reste   ){
         //   var  vide = $('#montant_versement_jour').val('0');
      
        swal({

           icon: "sucess",
            title: "Votre Montant entré est superieure au reste de la scolarite ",
          showconfirmButtonText: true,

            })


        }
        //if(totale < 0){

          //  var  vide = $('#montant_versement_jour').val('0');
            //swal({

              //  icons: "sucess",
                //title: "Votre Montant est superieure à la valeur Restante",
                //showconfirmButtonText: true,

//})

  //      }


    
        //document.getElementById("scolarite_cumule").value = total ;
      // document.getElementById("reste_scolarite").value = totale ;
    }






















      $.get("{{ route('admin.scolarites.index') }}" +'/' + id +'/edit', function (data) {            
       $('#postCrudModale').html("Payer Scolarité");
       $('#btn-sav').val("edit-poste");
       $('#ajax-crud-modale').modal('show');
       $('#ide').val(data.id);
       $('#code_rec').val(data.code_recu); 
       $('#matriculee').val(data.matricule);
       $('#nom_preno').val(data.nom_prenom);
       $('#id_clas').val(data.id_classe);
       $('#id_sectione').val(data.id_section);
       $('#id_ann').val(data.id_annee);
       $('#scolarite_totale').val(data.scolarite_net_a_payer);
       $('#montant_versement_jour').val(data.montant_versement_jour);
       
       $('#scolarite_net_a_payere').val(data.scolarite_net_a_payer);
 })
                $('#scolarite_cumule').val(data.scolarite_cumul);      
                $('#reste_scolarite').val(data.reste_scolarite);
            }
     
})


       
     });
//------------------------FIN ADD SCOL------------------------------




//---------------------------ADD SCOL-----------------------


$(document).on('click', '#editc-poste', function () {
    var id = $(this).data('id');
    //= val(data.code_recu)
   // $('#code_recue').val(data.code_recue)

   
   
       
     });
//------------------------FIN ADD SCOL------------------------------




   /*''''''''''''''''''''''''''''''''''''''''''''''''''''
    $('body').on('click', '#edit-post', function () {
        var etudiant_id = $(this).data('id');
        $.get('etudiants/'+etudiant_id+'/edit', function (data) {
           $('#postCrudModal').html("Editer Etudiant");
            $('#btn-save').val("edit-post");
            $('#ajax-crud-modal').modal('show');
            $('#id').val(data.id);
            $('#id_annee').val(data.id_annee);
            $('#nom_prenom').val(data.nom_prenom);
            $('#date_naiss').val(data.date_naiss);
            $('#lieux_naiss').val(data.lieux_naiss);
            $('#adresse').val(data.adresse);
            $('#genre').val(data.genre);
            $('#nationalite').val(data.nationalite);
            $('#telephone').val(data.telephone);
            $('#email').val(data.email);
            $('#class_adm').val(data.class_adm);
            $('#section_adm').val(data.section_adm);
            $('#nom_pere').val(data.nom_pere);
            $('#tel_pere').val(data.tel_pere);
            $('#nom_mere').val(data.nom_mere);
            $('#tel_mere').val(data.tel_mere);
            $('#dossier_inscript').val(data.dossier_inscript);
            $('#photo').val(data.photo);
        })
     });
*---------------------------------------------------------------------**/ 
   if ($("#postForme").length > 0) {
        $("#postForme").validate({

       submitHandler: function(form) {

        var actionType = $('#btn-sav').val();


        $('#btn-sav').html('traitement...');



        $.ajax({
            data: $('#postForme').serialize(),
            url: "{{ route('admin.scolarites.p_store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
             


        swal({

                    icon: "sucess",
                    title: "Operation effectuée avec succès",
                    showconfirmButtonText: false,
                    timer: 2000
              })

              


                $('#postForme').trigger("reset");
                $('#ajax-crud-modale').modal('hide');
                $('#btn-sav').html('Save Changes');

               // var id = $('#ide').val(data.id);
          
          var url = "{{  URL::to('/admin/reu_pdf') }}";
         // url= url.replace('$id',id);
          //location.href = url;
        var mp = window.open(url,'_blank');
         mp.focus();
        

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
