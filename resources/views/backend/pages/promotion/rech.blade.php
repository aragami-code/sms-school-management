
       @foreach ($pro as $prom)

                              <tr id="id_{{ $prom->id }}">
                                    <td>{{$prom->id_annee}}</td>
                                    <td>{{$prom->id_annee}}</td>
                                    <td>{{$prom->id_annee}}</td>
                                    <td>{{$prom->id_annee}}</td>

                                    <td>

                                        @if(Auth::guard('admin')->user()->can('annee.edit'))

                                        <a href="javascript:void(0)" id="edit-post" data-id="{{ $prom->id }}" data_token="{{csrf_token()}}" class="btn btn-info">  <b><i class="fa fa-edit"></i></b><span>
                                        </span>Modifier</a>

                                        @endif



                                    </td>
                                </tr>

                                @endforeach


    
    
                             
{{--

    @if(Auth::guard('admin')->user()->can('promotion.view'))
    <div id="pro">
              <div class="data-tables">
                  <table id="dataTable" class="text-center">
                      <thead class="bg-light text-capitalize">
                          <tr>
                          <th width="20%">id_matricule_etudiant</th>
                          <th width="20%">id_annee</th>
                          <th width="20%">id_classe</th>
                          <th width="20%">id_section</th>


                              <th width="15%">Action</th>

                          </tr>
                      </thead>
                      
                      <tbody id="posts-crud">

                          @foreach ($pro as $prom)

                      <tr id="id_{{ $prom->id }}">
                              <td>{{$prom->id_annee}}</td>
                              <td>{{$prom->id_annee}}</td>
                              <td>{{$prom->id_annee}}</td>
                              <td>{{$prom->id_annee}}</td>

                              <td>

                                  @if(Auth::guard('admin')->user()->can('annee.edit'))

                                  <a href="javascript:void(0)" id="edit-post" data-id="{{ $prom->id }}" data_token="{{csrf_token()}}" class="btn btn-info">  <b><i class="fa fa-edit"></i></b><span>
                                  </span>Modifier</a>

                                  @endif



                              </td>
                          </tr>

                          @endforeach



                      </tbody>
                  </table>

                      <div class="modal fade" id="ajax-crud-modal" aria-hidden="true">
                          <div class="modal-dialog">
                          <div class="modal-content">
                          <form id="postForm" name="postForm" class="form-horizontal">
                              <div class="modal-header">
                                  <h4 class="modal-title" id="postCrudModal"></h4>
                              </div>
                              <div class="modal-body">

                              @csrf
                              <div class="alert-message" id="name_annee_error"></div>

                                      <div class="form-row">

                                      <input type="hidden" name="id" id="id">
                                          <div class="form-group col-md-6 col-sm-12">
                                              <label for="">Nom de l'annee<span class="text-danger">*</span></label>
                                              <input type="number" class="form-control" id="name_annee" name="name_annee"  placeholder="Enter le nom de l'annee ex:2021 " required="on" value="" min="2000" max="2099">
                                              <br>

                                          </div>
                                          <div class="form-group col-md-6 col-sm-12">
                                              <label for="slug">Nom court <span class="text-danger">*</span></label>
                                              <input type="text" class="form-control" id="slug_annee" name="slug_annee"  placeholder="nom court ex: 2010-2011" required="on" value="">
                                              <div class="alert-message" ></div>

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
       
                  </div>
    </div>
  
  </div>
  @endif--}}