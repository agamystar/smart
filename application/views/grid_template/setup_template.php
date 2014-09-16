<!--this file is a general  template for grids add edit delete from any grid thanks to allah -->

<script>
var changed = false;
var last_input_focused = '';
var last_selected_row = '';
var last_page = '';
var page_params = '';
var editor_number = 0;
var row_edit='';
$(function () {

    $(window).on('beforeunload', function (e) {
        if (changed) {
            return false;
        }
        else {
            $(this).unload();
        }
    });

});
function start_edit(id) {
    $('#datagrid').datagrid('beginEdit', id);
}
function updateActions(index){
    $('#datagrid').datagrid('updateRow',{
        index: index,
        row:{}
    });
}
function getRowIndex(target){
    var tr = $(target).closest('tr.datagrid-row');
    return parseInt(tr.attr('datagrid-row-index'));
}
function editrow(target){
    $('#datagrid').datagrid('selectRow',target);
    $('#datagrid').datagrid('beginEdit', target);
}
function deleterow(index){
    $('#datagrid').datagrid('selectRow',index);

        $.messager.confirm(js_lang_object.sure_delete_title, js_lang_object.sure_delete, function (r) {
            if (r) {
                $('#datagrid').datagrid('deleteRow',index);
                var changes=$('#datagrid').datagrid('getChanges', 'deleted');
                var arr=[];
                arr.push(changes[changes.length-1]);
        $.post(
            js_var_object.current_link,
            {
                action: 'save',
                deleted: JSON.stringify(arr)
            },function(result){
                if(result[0]=="d"){
                    $.jGrowl(result[1], { sticky: false, theme: 'growl-error', header: js_lang_object.error });

                }else{
                    $.jGrowl(result[1], { sticky: false, theme: 'growl-success', header: js_lang_object.success });

                }

                $('#datagrid').datagrid("reload");
            },'json'
        );
            }
        });

    return false;
}
function delete_selected_rows(index){
    var selection=$('#datagrid').datagrid('getSelections');

    $.messager.confirm(js_lang_object.sure_delete_title, js_lang_object.sure_delete, function (r) {
        if (r) {
          $.post(
                js_var_object.current_link,
                {
                    action: 'save',
                    deleted: JSON.stringify(selection)
                },function(result){
                    if(result[0]=="d"){
                        $.jGrowl(result[1], { sticky: false, theme: 'growl-error', header: js_lang_object.error });

                    }else{
                        $.jGrowl(result[1], { sticky: false, theme: 'growl-success', header: js_lang_object.success });

                    }

                    $('#datagrid').datagrid("reload");
                },'json'
            );
        }
    });

    return false;
}
function saverow(index){


    $('#datagrid').datagrid('selectRow',index);
    $('#datagrid').datagrid('endEdit',index);
    var changes=$('#datagrid').datagrid('getChanges', 'updated');
    var new_rows=$('#datagrid').datagrid('getChanges', 'inserted');
/*
    var editors = $('#datagrid').datagrid('getEditors', index);
    if(editors[0].target.val().length<1){
        $('#datagrid').datagrid('beginEdit', index);
        $('#datagrid').datagrid('selectRow', index);
        $.jGrowl("Insert value in the first field", { sticky: false, theme: 'growl-error', header: js_lang_object.error });
    }*/
    var arr_upd=[];
    var arr_ins=[];
    if(new_rows.length>0){

        arr_ins.push(new_rows[new_rows.length-1]);

    }

    if(changes.length>0){
        arr_upd.push(changes[changes.length-1]);
    }
    if(changes.length>0 ||new_rows.length>0){
        $.post(
            js_var_object.current_link,
            {
                action: 'save',
                inserted:JSON.stringify(arr_ins),
                updated:JSON.stringify(arr_upd)
            },function(result){
                if(result[0]=="d"){
                    $.jGrowl(result[1], { sticky: false, theme: 'growl-error', header: js_lang_object.error });

                }else{
                    $.jGrowl(result[1], { sticky: false, theme: 'growl-success', header: js_lang_object.success });
                   if(arr_ins.length){$('#datagrid').datagrid("reload");}
                }
                $('#datagrid').datagrid('endEdit',index);

            },'json'
        );


    }
    else{

        $.jGrowl(js_lang_object.no_changes_found, { sticky: false, theme: 'growl-error', header: js_lang_object.error });

    }

    $('#datagrid').datagrid('uncheckAll');
    return false;
}
function undo(){
    $('#datagrid').datagrid('reload');
}

function cancelrow(target){
    var editors = $('#datagrid').datagrid('getEditors', target);
    if(editors[0]!=undefined){
        if(editors[0].target.val().length>0||editors[1].target.val().length>0){

        }else{
            $('#datagrid').datagrid('deleteRow',target);
        }
    }
    $('#datagrid').datagrid('cancelEdit',target);
    return false;
}
function save_all_updates () {

    $.each($('#datagrid').datagrid('getRows'), function (index, node) {
        $('#datagrid').datagrid('endEdit', index);
    });

    count_changes = 0;
    count_changes += $('#datagrid').datagrid('getChanges', 'inserted').length;
    count_changes += $('#datagrid').datagrid('getChanges', 'deleted').length;
    count_changes += $('#datagrid').datagrid('getChanges', 'updated').length;

    var del=$('#datagrid').datagrid('getChanges', 'deleted');
    var new_del=[];
    $.each(del,function(i,val){///to remove null values send by wrong way in jeasyui
        if(del[i]==undefined){}else{
            new_del[i]=del[i];
        }
    });
    if (count_changes > 0) {
        $.post(
            js_var_object.current_link,
            {
                action: 'save',
                inserted: JSON.stringify($('#datagrid').datagrid('getChanges', 'inserted')),
               // deleted: JSON.stringify(new_del),
                updated: JSON.stringify($('#datagrid').datagrid('getChanges', 'updated'))
            },function(result){
                if(result[0]=="d"){
                    $.jGrowl(result[1], { sticky: false, theme: 'growl-error', header: js_lang_object.error });

                }else{
                    $.jGrowl(result[1], { sticky: false, theme: 'growl-success', header: js_lang_object.success });
                    $('#datagrid').datagrid("reload");
                }

            },'json'
        );
    } else {
        $.messager.progress('close');
        $.jGrowl(js_lang_object.no_changes_found, { sticky: false, theme: 'growl-error', header: js_lang_object.error });
        changed = false;
    }

    $('#datagrid').datagrid('uncheckAll');

}
function new_row() {

    var count_inst= $('#datagrid').datagrid('getChanges', 'inserted').length;

    node = $('#datagrid').datagrid('getSelected');
    if (node) {
        current_index = $('#datagrid').datagrid('getRowIndex', node);
        var next_index = current_index + 1;
        var ed = $('#datagrid').datagrid('getEditors',current_index);
        if(count_inst>0){
            if(ed&&ed[0]!=undefined){
                if(ed[0].target.val()>0){
                    $('#datagrid').datagrid('insertRow',
                        {
                            index: next_index,
                            row: {

                            }
                        }
                    );
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            $('#datagrid').datagrid('insertRow',
                {
                    index: next_index,
                    row: {

                    }
                }
            );
        }




        $('#datagrid').datagrid('beginEdit', next_index);
        $('#datagrid').datagrid('clearSelections');
        $('#datagrid').datagrid('selectRow', next_index);
    }
    else {


        $('#datagrid').datagrid('appendRow',
            {

            });
        var last_rows_index = $('div#datagrid_container div.datagrid-body table:first tbody tr:last').attr('datagrid-row-index');

        if (last_rows_index != undefined) {

            $('#datagrid').datagrid('beginEdit', last_rows_index);
            $('#datagrid').datagrid('selectRow', last_rows_index);
            return false;
        }

    }
    $('#datagrid').datagrid('uncheckAll');

    changed = true;
}

<?php
////// include grid details  from assets/module folder for [display data ] =====> inside this template file [add+edit+delate]
 if(isset($jss)){
        foreach($jss as $js_file){
   require_once(".".DIRECTORY_SEPARATOR."assets"."module".DIRECTORY_SEPARATOR."js".DIRECTORY_SEPARATOR.$js_file);

}
}
?>

</script>