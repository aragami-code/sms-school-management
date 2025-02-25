@extends('chercheur.layouts.master')


@section('title')
Résultat de la recherche| tableau de bords
@endsection





@section('styles')


<link rel="stylesheet" href="{{asset('backend/css/select2.min.css')}}">

@endsection



@section('admin-content')

  <!-- page title area start -->
  <div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Acceuil</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{route('chercheur.dashboard')}}">Acceuil</a></li>
                    
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

        <!-- data table start -->

       <center> <h1> Résultat des recherches</h1></center>

       <br><br>


        <div class="row">
            <h5 class="title"><i class="ti-briefcase"></i><b> Résultat des recherches</b></h5>


            @foreach ($cher as $chert)


              <div class="row"{{$loop->index+1}}>
                 <div class="col-lg-12 col-md-12">
                     {{----}} <img class="avatar user-thumb" src="{{asset('user/images/Chercheur')}}/" alt="avatar" style="border-radius: 50%; width: 50px; height: 50px;">


                  </div>
                  <div class="col-lg-9 col-md-9">
                      <h5 class="title"><i class="ti-user"></i><b>Titre de l'offre :{{$chert->titre_post_emploi}}</b></h5>

                      <br>




                {{----}}       <a href="{{route('chercheur.postemplois.edit',Crypt::encrypt($chert->id))}}" class="btn btn-primary"><i class="ti-eye"></i> Consulter</a>
              </div>
              </div>

              @endforeach
          {{$cher->links()}} </div>

        <!-- Dark table end -->

</div>



@endsection


@section('scripts')

   {{--@include('backend.pages.roles.partials.script')
   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>--}}
   <script src="{{asset('backend/js/select2.min.js')}}"></script>

   <script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
<script type="text/javascript">


    jQuery('select[name="id_region_post_emploi"]').on('change',function(){

        var RegionID = $(this).val();

        if(RegionID){

            $.ajax({

                type:"GET",
                url: 'findRegions/'+RegionID,
                dataType: "json",
                success:function(data){


                if (data) {

                    jQuery('select[name="id_ville_post_emploi"]').empty();
                    jQuery.each(data,function(key,value){
                    $('select[name="id_ville_post_emploi"]').append('<option value="'+key+'">'+value+'</option>');
                    });

                }else{
                     $('select[name="id_ville_post_emploi"]').empty();
                }


                }
            });

        }

        else{

            $('select[name="id_ville_post_emploi"]').empty();

        }





    });









</script>


@endsection
