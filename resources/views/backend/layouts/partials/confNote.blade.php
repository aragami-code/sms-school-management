                                  <!-- Modal -->
                                  @php
                                    $usr = Auth::guard('admin')->user();
                                   @endphp
                                    @if ($usr->can('notes.view')) 
                                 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel" align="center">Choisir le systeme d'annotation</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          ...
                                        </div>
                                        
                                        <div class="modal-footer">
                                            <center>
                                           
                                            
                                            <a href="{{ route('admin.note_eds.index')}}"><button type="button" class="btn btn-primary">Editer toute les notes</button></a>
                                            </center>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                              
                                  
  
  
                                 
                                  @endif






                                  @php
                                  $usr = Auth::guard('admin')->user();
                                 @endphp
                                 