@extends('backend.layouts.master')


@section('title')
creer un role
@endsection




<style>
    .form-check-label{
        text-transform: capitalize;
    }
</style>



@section('admin-content')

  <!-- page title area start -->
  <div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">ROLES</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{route('admin.dashboard')}}">Acceuil</a></li>
                    <li><a href="{{route('admin.roles.index')}}">Tous les Roles</a></li>
                    <li><span>Creer un role</span></li>
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
                    <h4 class="header-title">Ajouter un role</h4>

                    @include('backend.layouts.partials.messages')
                <form action="{{route('admin.roles.store')}}" method="POST">
                    @csrf
                        <div class="form-group">
                            <label for="name">Nom du Role</label>
                            <input type="text" class="form-control" id="name" name="name"  placeholder="Enter un role">

                        </div>
                        <div class="form-group">
                        <label for="name">Permissions</label>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="checkPermissionAll" value="1">
                            <label class="form-check-label" for="ckeckPermissionAll">all</label>
                        </div>
                        <hr/>
                        @php $i = 1; @endphp
                       @foreach ($permission_groups as $group)

                       <div class="row">
                            <div class="col-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  id="{{ $i }}Management" value="{{ $group->name }}" onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)">
                                    <label class="form-check-label" for="ckeckPermission">{{$group->name}}</label>
                                </div>

                            </div>
                            <div class="col-9 role-{{ $i }}-management-checkbox">

                                @php

                                $permissions = App\User::getpermissionsByGroupName($group->name);
                                $j = 1;

                                @endphp

                                @foreach ($permissions as $permission)
                                    <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission{{$permission->id}}" value="{{$permission->name}}">
                                    <label class="form-check-label" for="ckeckPermission{{$permission->id}}">{{$permission->name}}</label>
                                    </div>

                                    @php

                                    $j++

                                    @endphp

                                @endforeach
                                <br>

                            </div>

                       </div>

                       @php $i++; @endphp

                       @endforeach

                    </div>



                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- data table end -->

        <!-- Dark table end -->
    </div>
</div>



@endsection


@section('scripts')

    {{--@include('backend.pages.roles.partials.script')--}}
    <script>
        $("#ckeckPermissionAll").click(function(){
            if($(this).is(':checked')){

                //check all the chexkbox
                $('input[type=checkbox]').prop('checked', true);

            }else{

                // uncheck all the checkbox

                $('input[type=checkbox]').prop('checked', false);
            }
        });

        function checkPermissionByGroup(className, checkThis){

            const groupIdName = $("#"+checkThis.id);
            const classCheckBox = $('.'+className+' input');

            if(groupIdName.is(':checked')){

                classCheckBox.prop('checked', true);
            }else{
                classCheckBox.prop('checked', false);
            }

            implementAllChecked();

        }


    function checkSinglePermission(groupClassName, groupID, countTotalPermission){

const classCheckBox = $('.'+groupClassName+ 'input');
const groupIDCheckBox = $("#"+groupID);

// if there is any occurance where something is not selected then make selected =false

if($('.'+groupClassName+ ' input:checked').length == countTotalPermission){
    groupIDCheckBox.prop('checked', true);
}else{
    groupIDCheckBox.prop('checked', false)
}

implementAllChecked();

}
/**/
function implementAllChecked(){

const countPermissions = {{ count($all_permissions) }};
const countPermissionsGroups = {{ count($permission_groups) }};

if($('input[type="checkbox"]:checked').length >= (countPermissions + countPermissionsGroups)){
    $("#checkPermissionAll").prop('checked', true);
}else{
    $("#checkPermissionAll").prop('checked', false);
}

}

    </script>

@endsection
