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
