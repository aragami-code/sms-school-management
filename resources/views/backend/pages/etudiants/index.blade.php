@extends('backend.layouts.master')


@section('title')
liste des etudiants| Tableau de Bord
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
                    <li><span>Tous les étudiants</span></li>
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
                    <h4 class="header-title">Enregistrer un nouvel Etudiant</h4>
                    @include('backend.layouts.partials.messages')
                    <div class="form-row">
                        
                    {{--                     
                    <div class="form-group col-md-3 col-sm-3">
                        <label for="name"><b>Annee Academique <span class="text-danger">*</span></b></label>
                            <select name="id_annee" id="id_annee" class="form-control" required="on">
                            <option value ="0">Choisir l'annee Academique</option>
                                 @foreach ($anns as $ans)
                                    <option value ="{{$ans->id}}">{{$ans->slug_annee}}</option>
    
                                @endforeach
                            </select>
                        
                    </div>
                    <div class="form-group col-md-3 col-sm-3">
                        <label for="name"><b>Classe d'admission <span class="text-danger">*</span></b></label>
                            <select name="classe_admi" id="classe_admi" class="form-control" >
                            <option value ="0">Choisir la classe d'admission</option>
                                @foreach ($classes as $clas)
                                    <option value ="{{$clas->id}}">{{$clas->name_classes}}</option>
    
                                @endforeach
                            </select>
                        
                    </div>
                    <div class="form-group col-md-3 col-sm-3">
                        <label for="name"></b>Section d'admission  <span class="text-danger">*</span></b></label>
                        <select name="section_admi" id="section_admi" class="form-control"  >
                        
                        </select>
                    </div>  <button  type="button" id="filter" name="filter " class="btn btn-info">Filtrer</button>
                    <button  type="button" id="filter" name="filter"class="btn btn-default">Filtrer</button>
                           --}}         
        
                    </div>
                    @if(Auth::guard('admin')->user()->can('etudiants.create'))
                    {{--<p class="float-right">
                    <a class="btn btn-primary text-white" href="{{ route('admin.etudiants.create')}}">Creer une nouvelle Classes</a>
                    <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-new-poste"> <b><i class="fa fa-search"></i></b><span>
                    </span></a>

                    </p>--}}
                    <p class="float-right">
                        {{--<a class="btn btn-primary text-white" href="{{ route('admin.etudiants.create')}}">Creer une nouvelle Classes</a>--}}
                        <a href="javascript:void(0)" class="btn btn-primary mb-2" id="create-new-post"> <b><i class="fa fa-plus"></i></b><span>
                        </span></a>
    
                        </p>
                    @endif

                    <div class="clearfix"></div>
                    <br>

                    @if(Auth::guard('admin')->user()->can('etudiants.view'))
                    <div class="data-tables" >
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                   <th width="20%">Noms & Prenoms</th>
                                    
                                    <th width="20%">Action</th>

                                </tr>
                            </thead>
                            <div  id=" updateDiv"></div>
                            <tbody id="posts-crud">

                                @foreach ($etudiants as $etu)

                              <tr id="id_{{ $etu->id }}">
                                    <td>{{$etu->nom_prenom}}</td>

                                    <td>

                                        @if(Auth::guard('admin')->user()->can('etudiants.edit'))

                                        <a href="javascript:void(0)" id="edit-post" data-id="{{ $etu->id}}"  class="btn btn-info">  <b><i class="fa fa-edit"></i></b><span>
                                        </span></a>

                                        @endif
                                        {{-- 
                                        @if(Auth::guard('admin')->user()->can('etudiants.delete'))

                                          <a href="javascript:void(0)" id="delete-post" data-id="{{ $etu->id}}" class="btn btn-danger delete-post"> <b><i class="fa fa-trash"></i></b><span>
                                        </span>Suprimer</a>



                                        @endif

                                        <a href="javascript:void(0)" id="edit-post" data-id="{{ $mfrai->id}}"  class="btn btn-info">  <b><i class="fa fa-edit"></i></b><span>
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
                            <form id="postForm" name="postForm" class="form-horizontal" enctype="multipart/form-data">
                                 <div class="modal-header">
                                    <h4 class="modal-title" id="postCrudModal"></h4>
                                </div>
                                <div class="modal-body">

                                   @csrf
                                   <div class="alert-message" id="name_matiere_error"></div>

                                        <div class="form-row">
                                            <input type="hidden" name="id" id="id">
                                            
                                            <input type="hidden" name="id_annee" id="id_annee" value="{{$annees->id}}">


                                                 <table class="table table-bordered" >
                                                                            <thead>
                                                                                <tr>
                                                                                    
                                                                                    
                                                                                    <div class="form-group col-md-2 col-sm-2">
                                                                                        
                                                                                           
                                                                                           <div class="alert-message" ></div>
                                                                                       
                                                                                                  
                                                                                                  
            
                                                                                    </div>
                                                                                 
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody class="aragali">
                                                                                <tr>

                                                                                    
                                                                                    <div class="form-group col-md-12 col-sm-12">
                                                                                        
                                                                                        <label for="name"><b> Nom(s) & Prenom(s)</b></label>
                                                                                         <input type="text" class="form-control" id="nom_prenom" name="nom_prenom" value="" required="on">
                                                                                    </div>
                                                                                        <div class="form-group col-md-4 col-sm-4">
                                                                                            <label for="name"><b> Date de naissance</b></label>
                                                                                            <input type="date" class="form-control" id="date_naiss" name="date_naiss" value="" required="on">
                                                                                        </div>
                                                                                        <div class="form-group col-md-4 col-sm-4">
                                                                                            <label for="name"><b> Lieux de naissance</b></label>
                                                                                            <input type="text" class="form-control" id="lieux_naiss" name="lieux_naiss" value="" required="on">
                                                                                        
                                                                                        </div>
                                                                                        <div class="form-group col-md-4 col-sm-4">
                                                                                            <label for="name"><b> adresse de residence</b></label>
                                                                                            <input type="text" class="form-control" id="adresse" name="adresse" value="" required="on">
                                                                                        
                                                                                        </div>
                                                                                        <div class="form-group col-md-2 col-sm-2">
                                                                                            <label for="name"><b> Genre<span class="text-danger">*</span></b></label>
                                                                                            
                                                                                        <select name="genre" id="genre" class="form-control" required="on">
                                                                                                <option value="M">Masculin</option>
                                                                                                <option value="F">Feminin</option>
                                                                                        </select>
                                                                                        
                                                                                       <div class="alert-message" ></div>
                                                                                            </div>
                                                                                        <div class="form-group col-md-5 col-sm-5">
                                                                                            <label for="name"><b> Nationalité</b></label>
                                                                                            <input type="text" class="form-control" id="nationalite" name="nationalite" value="" required="on">
                                                                                        
                                                                                        </div>
                                                                                        <div class="form-group col-md-5 col-sm-5">
                                                                                            <label for="name"><b> Telephone</b></label>
                                                                                            <input type="number" onKeyPress="if(this.value.length==9) return false;" class="form-control" id="telephone" name="telephone" value="" required="on">
                                                                                        </div>
                                                                                        <div class="form-group col-md-4 col-sm-4">
                                                                                            <label for="name"><b> Email</b></label>
                                                                                            <input type="text" class="form-control" id="email" name="email" value="" required="on" multiple>
                                                                                        
                                                                                        </div>
                                                                                        <div class="form-group col-md-4 col-sm-4">
                                                                                            <label for="name"><b>Classe d'admission <span class="text-danger">*</span></b></label>
                                                                                                <select name="classe_adm" id="classe_adm" class="form-control" required="on">
                                                                                                   <option value ="0">Choisir la classe d'admission</option>
                                                                                                     @foreach ($classes as $clas)
                                                                                                        <option value ="{{$clas->id}}">{{$clas->name_classes}}</option>
                                      
                                                                                                    @endforeach
                                                                                                </select>
                                                                                               
                                                                                        </div>
                                                                                        <div class="form-group col-md-4 col-sm-4">
                                                                                        <label for="name"></b>Section d'admission  <span class="text-danger">*</span></b></label>
                                                                                        <select name="section_adm" id="section_adm" class="form-control" required="on">
                                                                                           
                                                                                        </select>
                                                                                        </div>
                                                                                        
                                                                                        <div class="form-group col-md-6 col-sm-6">
                                                                                            <label for="name"><b> Nom Complet du Pere ou Tuteur</b></label>
                                                                                             <input type="text" class="form-control" id="nom_pere" name="nom_pere" value="" required="on">
                                                                                        </div>
                                                                                        <div class="form-group col-md-6 col-sm-6">
                                                                                            <label for="name"><b> Telephone</b></label>
                                                                                             <input type="text" class="form-control" id="tel_pere" name="tel_pere" value="" required="on" onKeyPress="if(this.value.length==9) return false;" >
                                                                                        </div>
                                                                                        <div class="form-group col-md-6 col-sm-6">
                                                                                            <label for="name"><b> Nom Complet de la  Mere ou Tutrice</b></label>
                                                                                             <input type="text" class="form-control" id="nom_mere" name="nom_mere" value="" required="on">
                                                                                        </div>
                                                                                        <div class="form-group col-md-6 col-sm-6">
                                                                                            <label for="name"><b> Telephone</b></label>
                                                                                             <input type="text" class="form-control" id="tel_mere" name="tel_mere" value="" required="on" onKeyPress="if(this.value.length==9) return false;" >
                                                                                        </div>
                                                                                        <div class="form-group col-md-12 col-sm-12">
                                                                                            <input type="hidden" class="form-control" id="bl" name="bl" value="" placeholder="0 FCFA">
                                                                                        </div>
                                                                                   
                                                                                   
                                                                                        {{--<div class="form-group col-md-6 col-sm-6">
                                                                                            <label for="name"><b> Dossier numerique d'inscription</b></label>
                                                                                             <input type="file" class="form-control" id="dossier_inscript" name="dossier_inscript" value="" accept="application/pdf">
                                                                                            
                                                                                             <label for="name"><b> photo de l'étudiant</b></label>
                                                                                             <input type="file" class="form-control" id="photo" name="photo" value="f.jpg"  onchange="onFileSelected(event)">
                                                                                             <div class="form-group col-md-6 col-sm-6">
                                                                                            
                                                                                            <img src="#" id="imgshow"  width="70" height="40">
                                                                                            
                                                                                               </div>
                                                                                        </div>--}}
                                                                                     
                                                                                        
                                                                                       
                                                                                       
                                                                                   
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



                        <div class="modal fade" id="ajax-crud-modale" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                   <form id="postForme" name="postForme" class="form-horizontal">
                                 <div class="modal-header">
                                    <h4 class="modal-title" id="postCrudModale"></h4>
                                </div>
                                <div class="modal-body">

                                   @csrf
                                   <div class="alert-message" id="name_matiere_error"></div>

                        




                                </div>
                                <div class="modal-footer">

                                        <button type="submit" class="btn btn-primary" id="btn-search" value="create">chercher</button>


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

//var uploadField = document.getElementById("dossier_inscript");
//var uploadFieldim = document.getElementById("photo");
//uploadField.onchange = function() {
  //  if(this.files[0].size > 300000){
    //   alert("Document Trop lourd votre document doit etre inferieur ou egal à 3MB");
      // this.value = "";
    //};
//};
//uploadFieldim.onchange = function() {
  //  if(this.files[0].size > 100000){
    //   alert("Photo Trop lourde votre photo doit etre inferieur ou egal à 1MB");
   //    this.value = "";
    //};
//};
//$('document').ready(function () {
  //  $("#photo").change(function () {
    //    if (this.files && this.files[0]) {
      //      var reader = new FileReader();
        //    reader.onload = function (e) {
          //      $('#imgshow').attr('src', e.target.result);
            //}
            //reader.readAsDataURL(this.files[0]);
     //   }
    //});
//});
</script>










<script>

    $(document).ready(function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $('#create-new-post').click(function () {
          $('#btn-save').val("create-post");
          $('#postForm').trigger("reset");
          $('#postCrudModal').html("Ajouter un Etudiant");
          $('#ajax-crud-modal').modal('show');
      });

       
    });
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

   if ($("#postForm").length > 0) {
        $("#postForm").validate({

       submitHandler: function(form) {

        var actionType = $('#btn-save').val();


        $('#btn-save').html('traitement...');



        $.ajax({
            data: $('#postForm').serialize(),
            url: "{{ route('admin.etudiants.store') }}",
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

                var annee = '<tr id="id_' +data.id+ '"><td>{{--$etu->nom_prenom--}}</td>';
                    
                    annee +=  '<td><a href="javascript:void(0)" id="edit-post" data-id="' + data.id + '" class="btn btn-info">Modifier</a><a href="javascript:void(0)" id="delete-post" data-id="' + data.id + '" class="btn btn-danger delete-post">Suprimer</a></td>';
                    
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


    jQuery('select[name="classe_adm"]').on('change',function()
    {
        var classe_adm_id = $(this).val();

        if(classe_adm_id)
        {

            $.ajax(
                {

                    type:"GET",
                    url: '/admin/etudiants/etudiants/'+classe_adm_id,
                    dataType: "json",
                    success:function(data){
                    if (data)
                        {
                            jQuery('select[name="section_adm"]').empty();
                            $('select[name="section_adm"]').append('<option value="0">Choisir la section d\'admission </option>');
                            jQuery.each(data,function(key,value){
                            $('select[name="section_adm"]').append('<option value="'+key+'">'+value+'</option>');
                            });
                        }
                    else
                        {
                            $('select[name="section_adm"]').empty();
                        }
                }
            });

        }

        else
        {

            $('select[id="section_adm"]').empty();

        }

    });

</script>







<script type="text/javascript">


    jQuery('select[name="classe_admi"]').on('change',function()
    {
        var classe_adm_id = $(this).val();

        if(classe_adm_id)
        {

            $.ajax(
                {

                    type:"GET",
                    url: '/admin/etudiants/etudiants/'+classe_adm_id,
                    dataType: "json",
                    success:function(data){
                    if (data)
                        {
                            jQuery('select[name="section_admi"]').empty();
                            $('select[name="section_admi"]').append('<option value="0">Choisir la section d\'admission </option>');
                            jQuery.each(data,function(key,value){
                            $('select[name="section_admi"]').append('<option value="'+key+'">'+value+'</option>');
                            });
                        }
                    else
                        {
                            $('select[name="section_admi"]').empty();
                        }
                }
            });

        }

        else
        {

            $('select[id="section_admi"]').empty();

        }

    });

</script>





<script>
/*
$(document).ready(function(){

    fill_datatable();
    
    function fill_datatable(id_annee ='',classe_admi='',section_admi=''){
        var datatab =$('#ze').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url:"{{route('admin.etudiants.index')}}",
                data:{id_annee:id_annee,classe_admi:classe_admi,section_admi:section_admi}
            },
            columns:[
                {
                    data:'id_annee',
                    name:'id_annee',
                },
                {
                    data:'classe_admi',
                    name:'classe_admi',
                },
                {
                    data:'section_admi',
                    name:'section_admi',
                },
            ]
        });
    }
   $('#filter').click(function(){
    var id_annee = $('#id_annee').val();
    var classe_admi = $('#classe_admi').val();
    var section_admi = $('#section_admi').val();
    if(id_annee !='' && classe_admi !='' && section_admi!=''){
        var latable = $('#dataTable').DataTable({
                    "bDestroy":true
                });
                latable.ajax.reload;
        fill_datatable(id_annee,classe_admi,section_admi);

    }else{
        alert('select option')
    }
   });
   $('#reset').click(function(){
    var id_annee = $('#id_annee').val('');
    var classe_admi = $('#classe_admi').val('');
    var section_admi = $('#section_admi').val(''); 
    var latable = $('#dataTable').DataTable({
                    "bDestroy":true
                });
                latable.ajax.reload;
    fill_datatable();
   });
});
*/
</script>






@endsection
