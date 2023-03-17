$(document).ready(function(){
$("#tipo_retiro").change(function () {
        if ($(this).val() == 1) {
            $(".table_caja").hide();
            $(".table_banco").show();
        }
        else if ($(this).val() == 2)
        {
            $(".table_caja").show();
            $(".table_banco").hide();
        }
    });
});