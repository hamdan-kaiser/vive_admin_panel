$( document ).ready(function() {
    $('#addColumn').click(function (e) {
        e.preventDefault();
        column++;
        let url = config.routes.template;
        url = url.replace(':columns',column);
        $("#appendArea").append($('<div id="appendItem" style="padding-bottom: 2px;">').load(url));
        $('.js-example-basic-single').select2();
        $('.js-example-basic-multiple').select2();


    });
    $('#appendArea').sortable({placeholder: "ui-state-highlight",helper:'clone'});
});
$(document).on('click', '#deleteColumn', function(e) {
    e.preventDefault();
    $(this).parent().parent().parent().remove().fadeOut(300);
});
$(document).on('change', '.columnTypeSelector', function(e) {
    e.preventDefault();
    let cloneId = $(this).data('id');
    let target = 'columnEnumValueArea_'+cloneId;
    if($(this).val() == "enum"){
        $("#"+target).show();
    }else{
        $("#"+target).hide();
    }
});
$(document).on('change', '.columnInputTypeSelector', function(e) {
    e.preventDefault();
    let cloneId = $(this).data('id');
    let target = 'fileType_'+cloneId;
    if($(this).val() == "file"){
        $("#"+target).show();
        $('.js-example-basic-multiple').select2();
    }else{
        $("#"+target).hide();
    }
});
$(document).on('change', '.columnForeignKeySelector', function(e) {
    e.preventDefault();
    let cloneId = $(this).data('id');
    let columnName = $('#columnName_'+cloneId).val();
    let tableName = columnName.slice(0, columnName.lastIndexOf('_'));
    let target = 'foreignKeyColumnArea'+cloneId;
    let targetDropdown = 'foreign_key_column_'+cloneId;
    if ($(this).is(':checked')) {
        let url = config.routes.foreginKeyRoute;
        url = url.replace(':id', tableName);
        axios.get(url).then(res => {
            $('#'+targetDropdown).empty();
            $.each(res.data, function(key,optionValue) {
                $('#'+targetDropdown).append(`<option value="${optionValue}">
                                       ${optionValue}
                                  </option>`);
            });

        });
        $("#"+target).show();
    }else{
        $("#"+target).hide();
    }
});
$(document).on( "keyup", ".columnNameInput", function(){
    let inputValue = this.value;
    let targetId = $(this).data('id');
    let target = '#columnFlag'+targetId;
    $(target).html('');
    $(target).append(inputValue);
    //Generate Input Label

    let targetInputLabel = '#input_label_'+targetId;
    let labelValue = inputValue.replace(/_/g, " ");
        labelValue = inputValue.replace(/-/g, " ");
        labelValue = ucwords(labelValue);
    $(targetInputLabel).val(labelValue);

});
function ucwords (str) {
    return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
        return $1.toUpperCase();
    });
}
$("#generatorAssetForm").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var url = form.attr('action');

    $(".responseArea").show(1000);
    $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(), // serializes the form's elements.
        success: function(data)
        {
            $("#responseAssetArea").append(data);
            $('#responseAssetAreaBlock').show(1000);
        }
    });
});
$("#generatorCrudForm").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var url = form.attr('action');


    $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(), // serializes the form's elements.
        success: function(data)
        {
            $("#responseArea").append(data);
            $("#responseAreaBlock").show(1000);
        }
    });
});
function validateModelName(){
    if ($('#model_name').val() != ''){
        return true;
    }
    return false;
}
function validateColumnNumber(){
    if ($('#column_number').val() != ''){
        return true;
    }
    return false;
}
function validateColumnNumberValue(){
    if ($.isNumeric($('#column_number').val())){
        return true;
    }
    return false;
}
