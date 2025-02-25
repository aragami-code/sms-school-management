@extends('backend.layouts.master')


@section('title')
creer un role
@endsection





@section('styles')
<style>
    .form-check-label{
        text-transform: capitalize;
    }
</style>

@endsection



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
                    <li><span>Editer un Role</span></li>
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
                <h4 class="header-title">Editer le  role du {{ $role->name}}</h4>

                    @include('backend.layouts.partials.messages')
                <form action="{{route('admin.roles.update', $role->id)}}" method="POST">
                    @method('PUT')
                    @csrf
                        <div class="form-group">
                            <label for="name">Nom du Role</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $role->name}}"  placeholder="Enter un role">

                        </div>
                        <div class="form-group">
                        <label for="name">les Permissions</label>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="checkPermissionAll" value="1" {{ App\User::roleHasPermissions($role, $all_permissions) ? 'checked' : '' }}>
                            <label class="form-check-label" for="ckeckPermissionAll">all</label>
                        </div>
                        <hr/>
                        @php $i = 1; @endphp
                       @foreach ($permission_groups as $group)

                       <div class="row">
                        @php

                        $permissions = App\User::getpermissionsByGroupName($group->name);
                        //$rolesHasPermission = App\User::checkRoleHasPermission();
                        $j = 1;

                        @endphp

                            <div class="col-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  id="{{$i}}Management" value="{{$group->name}}" onclick="checkPermissionByGroup('role-{{$i}}-management-checkbox', this)" {{App\User::roleHasPermissions($role, $permissions) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="ckeckPermission">{{$group->name}}</label>
                                </div>

                            </div>
                            <div class="col-9 role-{{ $i }}-management-checkbox">


                                @foreach ($permissions as $permission)
                                    <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  onclick="checkSinglePermission('role-{{ $i }}-management-checkbox', '{{$i}}Management', {{ count($permissions)}})" name="permissions[]" {{ $role->hasPermissionTo($permission->name) ? 'checked' : ''}} id="checkPermission{{$permission->id}}" value="{{$permission->name}}">
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

                        {{--
                            @foreach ($permissions as $permission)
                           <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission{{$permission->id}}" value="{{$permission->name}}">
                            <label class="form-check-label" for="ckeckPermission{{$permission->id}}">{{$permission->name}}</label>
                           </div>
                        @endforeach

                            --}}
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





    <script>
        $("#ckeckPermissionAll").click(function(){
            if($(this).is(':checked')) {

                //check all the chexkbox
                $('input[type=checkbox]').prop('checked',true);

            }else{

                // uncheck all the checkbox

                $('input[type=checkbox]').prop('checked',false);
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
