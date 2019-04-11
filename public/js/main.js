var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};


$('#chooseFile').bind('change', function () {
    var filename = $("#chooseFile").val();
    if (/^\s*$/.test(filename)) {
        $(".file-upload").removeClass('active');
        $("#noFile").text("No file chosen...");
    }
    else {
        $(".file-upload").addClass('active');
        $("#noFile").text(filename.replace("C:\\fakepath\\", ""));
    }
});

$(function(){
    $('#addRecordForm').on('submit', function(e){
        e.preventDefault();
        var $that = $(this),
            formData = new FormData($that.get(0)); // создаем новый экземпляр объекта и передаем ему нашу форму (*)
        $.ajax({
            url: '/record/add',
            type: 'POST',
            contentType: false, // важно - убираем форматирование данных по умолчанию
            processData: false, // важно - убираем преобразование строк по умолчанию
            dataType: 'json',
            data: formData,
            success: function(data){
                if(data.status === 'success'){
                    UIkit.modal('#addRecord').hide();
                    $('#table-body').load(" .records")
                }
                if(data.status === 'error'){
                    UIkit.notification({
                    	message: data.message,
                    	status: data.status,
                    	pos: 'top-right',
                    	timeout: 4000
                	});
                    grecaptcha.reset();
                }
               
            }
        });
    });
});

var sort = getUrlParameter('sort');

function page(){
    if(getUrlParameter('page') === undefined){
        return 1;
    }else{
        return getUrlParameter('page');
    }
}

if (sort === 'desc') {
    $('#for_name').attr('href','?ord=name&sort=asc&page='+page());
    $('#for_email').attr('href','?ord=email&sort=asc&page='+page());
    $('#for_date').attr('href','?ord=date&sort=asc&page='+page());
} else {
    $('#for_name').attr('href','?ord=name&sort=desc&page='+page());
    $('#for_email').attr('href','?ord=email&sort=desc&page='+page());
    $('#for_date').attr('href','?ord=date&sort=desc&page='+page());
}

