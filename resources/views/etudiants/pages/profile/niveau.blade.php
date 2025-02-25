@extends('chercheur.layouts.master')


@section('title')
Formation | tableau de bords
@endsection





@section('styles')


<link rel="stylesheet" href="{{asset('user/css/select2.min.css')}}">

@endsection



@section('admin-content')

  <!-- page title area start -->
  <div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Utilisateur</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{route('chercheur.dashboard')}}">Tableau de Bord</a></li>
                    <li><span>Formation</span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">

            @include('chercheur.layouts.partials.logout')


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
                    <h4 class="header-title">Actualiser mes informations</h4>

                    @include('chercheur.layouts.partials.messages')
                    <div class="d-md-flex">
                        <div class="nav flex-column nav-pills mr-5 mb-5 mb-sm-0" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                            <a href="{{route('chercheur.profile.edit',Crypt::encrypt(Auth::guard('chercheur')->user()->id))}}" class="nav-link"  role="tab"  aria-selected="false">Information Generale</a>
                            <a class="nav-link active" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="true">Formations / Diplomes</a>
                            <a href="{{route('chercheur.sommaire.index')}}"class="nav-link"  role="tab" aria-selected="false">Competences</a>
                            
                             <a href="{{route('chercheur.langue.index')}}" class="nav-link"   role="tab" aria-selected="true">Langues parlées</a>  
                        
                            <a href="{{route('chercheur.experience.index')}}"class="nav-link"  role="tab" aria-selected="false">Experiences</a>
                            <a href="{{route('chercheur.profile.edite',Crypt::encrypt(Auth::guard('chercheur')->user()->id))}}" class="nav-link"  role="tab"  aria-selected="false">Profil</a>










                        </div>
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">


                            </div>
                            <div class="tab-pane fade show active" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">

                                <div class="col-12">
                                    <p style="color: #ffffff">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugiat blanditiis eaque ab qui accusamus laudantium perspiciatis sint quibusdam at eius consequatur quos possimus aspernatur debitis deleniti sed odit provident repudiandae suscipit officiis, tempora voluptas, excepturi perferendis. Quasi delectus tempora temporibus ipsa soluta mollitia, doloremque corrupti labore, quae voluptatem obcaecati consequuntur ad ipsum fugit impedit cum. Facere, ea? Eveniet quisquam ratione voluptate rerum tempora, consectetur assumenda. Porro temporibus suscipit corporis nulla?</p>

                                    <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-new-post">Ajouter formation</a>

                                    <table class="table table-bordered" id="laravel_crud">
                                     <thead>
                                        <tr>
                                           <td>Niveau d'etude</td>
                                           <td >Option(Specialité)</td>
                                           <td >Annee d'obtention</td>
                                           <td >Etablissement/ecole/centre de formation</td>
                                           <td>Action</td>

                                        </tr>
                                     </thead>
                                     <tbody id="posts-crud">
                                        @foreach($posts as $post)
                                        <tr id="id_{{ $post->id }}">
                                            <td>{{ $post->titre_niveau  }}</td>
                                            <td>{{ $post->option  }}</td>
                                             <td>{{ $post->annee  }}</td>
                                            <td>{{ $post->institution }}</td>
                                            <td>
                                                <a href="javascript:void(0)" id="edit-post" data-id="{{ $post->id }}" class="btn btn-info">Modifier</a>
                                                <a href="javascript:void(0)" id="delete-post" data-id="{{ $post->id }}" class="btn btn-danger delete-post">Supprimer</a>
                                            </td>

                                        </tr>
                                        @endforeach
                                     </tbody>
                                    </table>
                                    {{ $posts->links() }}
                                 </div>

                                 <div class="modal fade" id="ajax-crud-modal" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="postCrudModal"></h4>
                                        </div>
                                        <div class="modal-body">
                                            <form id="postForm" name="postForm" class="form-horizontal">
                                            <input type="hidden" name="id" id="id">
                                            <input type="hidden" name="user_id" id="user_id" value="{{Auth::guard('chercheur')->user()->id}}">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-4 control-label">Titre Diplomes</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="titre_niveau" name="titre_niveau" value="" required="">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Option (Specialité)</label>
                                                    <div class="col-sm-12">
                                                        <input class="form-control" id="option" name="option" value="" required="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Institution/Ecole/Centre de formation</label>
                                                    <div class="col-sm-12">
                                                        <input class="form-control" id="institution" name="institution" value="" required="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Annee d'obtention</label>
                                                    <div class="col-sm-12">
                                                        <input type="month" class="form-control" id="annee" name="annee" value="" required="">
                                                    </div>
                                                </div>
                                                <div class="col-sm-offset-4 col-sm-10">
                                                <button type="submit" class="btn btn-primary" id="btn-save" value="create">Sauvegarder
                                                </button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">

                                        </div>
                                    </div>
                                    </div>
                                </div>


                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- data table end -->

        <!-- Dark table end -->
    </div>
</div>



@endsection





@section('scripts')

   {{--@include('backend.pages.roles.partials.script')
   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>--}}
   <script src="{{asset('user/js/select2.min.js')}}"></script>

<script>
    $(document).ready(function() {
        $('.select2').select2();
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
          $('#btn-save').val("create-post");
          $('#postForm').trigger("reset");
          $('#postCrudModal').html("Ajouter une formation");
          $('#ajax-crud-modal').modal('show');
      });

      $('body').on('click', '#edit-post', function () {
        var post_id = $(this).data('id');
        $.get('Niveau/'+post_id+'/edit', function (data) {
           $('#postCrudModal').html("Edit post");
            $('#btn-save').val("edit-post");
            $('#ajax-crud-modal').modal('show');
            $('#id').val(data.id);
            $('#user_id').val(data.user_id);
            $('#titre_niveau').val(data.titre_niveau);
            $('#option').val(data.option);
            $('#institution').val(data.institution);
            $('#annee').val(data.annee);
        })
     });

      $('body').on('click', '.delete-post', function () {
          var post_id = $(this).data("id");
          confirm("Are You sure want to delete !");

          $.ajax({
              type: "DELETE",
              url: "{{ url('user/Niveau')}}"+'/'+post_id,
              success: function (data) {
                  $("#id_" + post_id).remove();
              },
              error: function (data) {
                  console.log('Error:', data);
              }
          });
      });
    });

   if ($("#postForm").length > 0) {
        $("#postForm").validate({

       submitHandler: function(form) {

        var actionType = $('#btn-save').val();
        $('#btn-save').html('Sending..');


        $.ajax({
            data: $('#postForm').serialize(),
            url: "{{ route('chercheur.niveau.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                var post = '<tr id="id_' + data.id + '"><td>' + data.titre_niveau + '</td>'+  '</td><td>' + data.option + '</td>'+ '</td><td>' + data.annee + '</td>'+ '</td><td>' + data.institution+ '</td>';
                post += '<td><a href="javascript:void(0)" id="edit-post" data-id="' + data.id + '" class="btn btn-info">Modifier</a><a href="javascript:void(0)" id="delete-post" data-id="' + data.id + '" class="btn btn-danger delete-post">Supprimer</a></td>';
                post += '</tr>';


                if (actionType == "create-post") {
                    $('#posts-crud').prepend(post);
                } else {
                    $("#id_" + data.id).replaceWith(post);
                }

                $('#postForm').trigger("reset");
                $('#ajax-crud-modal').modal('hide');
                $('#btn-save').html('Save Changes');

            },
            error: function (data) {
                console.log('Error:', data);
                $('#btn-save').html('Save Changes');
            }
        });
      }
    })
  }


</script>




@endsection
























































