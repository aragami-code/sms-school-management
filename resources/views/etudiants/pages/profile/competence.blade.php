@extends('chercheur.layouts.master')


@section('title')
Experiences | tableau de bords
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
                    <li><span>Experiences</span></li>
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
                        <div class="nav flex-column nav-pills mr-4 mb-3 mb-sm-0" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                           <a href="{{route('chercheur.profile.edit',Crypt::encrypt(Auth::guard('chercheur')->user()->id))}}" class="nav-link"  role="tab"  aria-selected="false">Information Generale</a>
                           <a href="{{route('chercheur.niveau.index')}}" class="nav-link"  role="tab"  aria-selected="false">Formations / Diplomes</a>
                           <a class="nav-link active" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="true">Competences</a>
                            
                             <a href="{{route('chercheur.langue.index')}}" class="nav-link"   role="tab" aria-selected="true">Langues parlées</a> 
                           
                           <a href="{{route('chercheur.experience.index')}}"class="nav-link"  role="tab" aria-selected="false">Experiences</a>
                           <a href="{{route('chercheur.profile.edite',Crypt::encrypt(Auth::guard('chercheur')->user()->id))}}" class="nav-link"  role="tab"  aria-selected="false">Profil</a>






                        </div>
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">


                            </div>
                            <div class="tab-pane fade show active" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">

                                <p style="color: #ffffff">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugiat blanditiis eaque ab qui accusamus laudantium perspiciatis sint quibusdam at eius consequatur quos possimus aspernatur debitis deleniti sed odit provident repudiandae suscipit officiis, tempora voluptas, excepturi perferendis. Quasi delectus tempora temporibus ipsa soluta mollitia, doloremque corrupti labore, quae voluptatem obcaecati consequuntur ad ipsum fugit impedit cum. Facere, ea? Eveniet quisquam ratione voluptate rerum tempora, consectetur assumenda. Porro temporibus suscipit corporis nulla?</p>

                                    <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-new-post">Ajouter</a>

                                    <table class="table table-bordered" id="laravel_crud">
                                     <thead>
                                        <tr>
                                           <td>Competence</td>
                                           <td >Niveau</td>
                                           <td>Action</td>

                                        </tr>
                                     </thead>
                                     <tbody id="posts-crud">
                                        @foreach($competences as $competence)
                                        <tr id="id_{{ $competence->id }}">
                                            <td>{{ $competence->competences_user }}</td>
                                            <td>{{ $competence->niveau  }}</td>
                                            <td>
                                                <a href="javascript:void(0)" id="edit-post" data-id="{{ $competence->id }}" class="btn btn-info">Edit</a>
                                                <a href="javascript:void(0)" id="delete-post" data-id="{{ $competence->id }}" class="btn btn-danger delete-post">Delete</a>
                                            </td>

                                        </tr>
                                        @endforeach
                                     </tbody>
                                    </table>
                                    {{ $competences->links() }}


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
                                                    <label for="name" class="col-sm-4 control-label">Competence que vous maitriser</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="competences_user" name="competences_user" value="" required="">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">niveau</label>
                                                    <select name="niveau" id="niveau" class="form-control" required='on'>
                                                        <option value ="Debutant">Débutant</option>
                                                        <option value ="Intermediaire">Intermediaire</option>
                                                        <option value ="Avancé">Avancé</option>
                                                        <option value ="Expert">Expert</option>
                                                      </select>
                                                </div>


                                                <div class="col-sm-offset-4 col-sm-10">
                                                <button type="submit" class="btn btn-primary" id="btn-save" value="create">Save
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
          $('#postCrudModal').html("ajouter une Competence");
          $('#ajax-crud-modal').modal('show');
      });

      $('body').on('click', '#edit-post', function () {
        var competences_id = $(this).data('id');
        $.get('Competence/'+competences_id+'/edit', function (data) {
           $('#postCrudModal').html("Edit post");
            $('#btn-save').val("edit-post");
            $('#ajax-crud-modal').modal('show');
            $('#id').val(data.id);
            $('#user_id').val(data.user_id);
            $('#competences_user').val(data.competences_user);
            $('#niveau').val(data.niveau);
        })
     });

      $('body').on('click', '.delete-post', function () {
          var competence_id = $(this).data("id");
          confirm("voulez voous vraiment supprimer cette info? !");

          $.ajax({
              type: "DELETE",
              url: "{{ url('user/Competence')}}"+'/'+competence_id,
              success: function (data) {
                  $("#id_" + competence_id).remove();
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
            url: "{{ route('chercheur.sommaire.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                var competences = '<tr id="id_' + data.id + '"><td>' + data.competences_user + '</td>'+'</td><td>' + data.niveau+ '</td>';
                    competences += '<td><a href="javascript:void(0)" id="edit-post" data-id="' + data.id + '" class="btn btn-info">Edit</a><a href="javascript:void(0)" id="delete-post" data-id="' + data.id + '" class="btn btn-danger delete-post">Delete</a></td>';
                    competences += '</tr>';


                if (actionType == "create-post") {
                    $('#posts-crud').prepend(competences);
                } else {
                    $("#id_" + data.id).replaceWith(competences);
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
























































