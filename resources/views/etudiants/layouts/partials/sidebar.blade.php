
@php
$usr = Auth::guard('etudiants')->user();
@endphp


<div class="sidebar-menu">
    <div class="sidebar-header">
        <div>
        <a href="{{route('etudiants.dashboard')}}"><h4 class="text-white">SMS</h4></a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">

                     <center><img class="avatar user-thumb" src="{{asset('user/images/etudiants')}}/{{Auth::guard('etudiants')->user()->photo}}" alt="avatar" style="border-radius: 50%; width: 200px; height: 200px;"></center>


                       {{--/////////////////////////////////////////////////gestion des types d'emplos////////////////////////////////////  --}}


                       <li class="{{Route::is('etudiants.dashboard') ? 'active' : ''}}">
                           <a href="{{route('etudiants.dashboard')}}" aria-expanded="true"><i class="ti-new-window"></i><span>Consulter les offres
                               </span></a>

                        </li>


                        <form id="admin-logout-form" action="{{ route('etudiants.logout.submit') }}" method="POST" style="display: none;">
                            @csrf
                        </form>



                        <li class="{{--Route::is('etudiants.postemplois.emploispostule') ? 'active' : ''--}}"> <a href="{{--route('etudiants.postemplois.emploispostule',Crypt::encrypt(Auth::guard('etudiants')->user()->id))--}}" aria-expanded="true"> <i class="ti-heart"></i><span>
                        </span>Emplois postulés</a></li>

                        <li class="{{-- Route::is('admin.postemplois.index') || Route::is('admin.postemplois.edit') ? 'active' : ''--}}"><a href="{{route('etudiants.profile.edit',Crypt::encrypt(Auth::guard('etudiants')->user()->id))}}"> <i class="ti-user"></i><span>
                        </span>Mon profil</a></li>
                        <li class="{{-- Route::is('admin.postemplois.index') || Route::is('admin.postemplois.edit') ? 'active' : ''--}}"><a  href="{{route('etudiants.profile.index')}}"   href="{{-- route('admin.postemplois.index')--}}"> <i class="ti-notepad"></i><span>
                        </span>Mes informations</a></li>
                       <li> <a href="{{ route('etudiants.logout.submit') }}" aria-expanded="true" onclick="event.preventDefault();
                                document.getElementById('admin-logout-form').submit();"> <i class="ti-lock"></i><span>
                            </span>Déconnection</a></li>














                </ul>
            </nav>
        </div>
    </div>
</div>
