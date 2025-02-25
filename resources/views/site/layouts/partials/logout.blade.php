
<div class="user-profile pull-right">
    <img class="avatar user-thumb" src="{{asset('backend/images/author/avatar.png')}}" alt="avatar">
     <h4 class="user-name dropdown-toggle" data-toggle="dropdown">{{Auth::guard('admin')->user()->name}} <i class="fa fa-angle-down"></i></h4>
     <div class="dropdown-menu">
         <a class="dropdown-item" href="{{ route('admin.adminprofile.index')}}">Mon Profil</a>
         <a class="dropdown-item" href="#">Parametres</a>
         <a class="dropdown-item"  href="{{ route('admin.logout.submit') }}"
         onclick="event.preventDefault();
                       document.getElementById('admin-logout-form').submit();">Deconnection</a>
     </div>
     <form id="admin-logout-form" action="{{ route('admin.logout.submit') }}" method="POST" style="display: none;">
         @csrf
     </form>
 </div>
