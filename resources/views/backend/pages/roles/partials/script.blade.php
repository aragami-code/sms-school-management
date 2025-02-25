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

        const groupIdName =$("#"+checkThis.id);
        const classCheckBox = $('.'+className+'input');

        if(groupIdName.is(':checked')){

            classCheckBox.prop('checked', true);
        }else{
            classCheckBox.prop('checked', false);
        }

        implementAllChecked();

    }
    function checkSinglePermission(groupClassName, groupID, countTotalPermission){

        const classCheckBox = $('.'+groupClassName+ 'input');
        const groupIDcheckBox = $("#"+groupID);

        // if there is any occurance where something is not selected then make selected =false

        if($('.'+groupClassName+' input:checked').length == countTotalPermission){
            groupIDcheckBox.prop('checked', true);
        }else{
            groupIDcheckBox.prop('checked', false)
        }

        implementAllChecked();

    }

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
