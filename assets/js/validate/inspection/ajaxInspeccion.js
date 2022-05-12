/**
 * Validaciones
 * @author bmottag
 * @since  4/05/2022
 */

$(document).ready(function () {
	
    $('#activo').change(function () {
        $('#activo option:selected').each(function () {
            var activo = $('#activo').val();
            if ((activo > 0 || activo != '') ) {
				
				$("#div_razon").css("display", "none");
                $("#div_cual").css("display", "none");
                $("#razon").val("");
                $("#cual").val("");
				if(activo==2){
                    $("#hours").val(1);
                    $("#hdd_cuadro_1").val(1);
                    $("#hdd_cuadro_2").val(1);
                    $("#hdd_cuadro_3").val(1);

					$("#div_razon").css("display", "inline");
                    $("#div_kilometros").css("display", "none");
                    $("#div_second_box").css("display", "none");
                    $("#div_third_box").css("display", "none");
                    $("#div_fourth_box").css("display", "none");
                    $("#div_fifth_box").css("display", "none");
                    $("#div_sixth_box").css("display", "none");
                    $("#div_seventh_box").css("display", "none");
                    $("#div_eighth_box").css("display", "none");
				}else if(activo==1){
                    $("#div_razon").css("display", "none");
                    $("#div_kilometros").css("display", "inline");
                    $("#div_second_box").css("display", "inline");
                    $("#div_third_box").css("display", "inline");
                    $("#div_fourth_box").css("display", "inline");
                    $("#div_fifth_box").css("display", "inline");
                    $("#div_sixth_box").css("display", "inline");
                    $("#div_seventh_box").css("display", "inline");
                    $("#div_eighth_box").css("display", "inline");
                }
            }
        });
    });

    $('#razon').change(function () {
        $('#razon option:selected').each(function () {
            var razon = $('#razon').val();
            if ((razon > 0 || razon != '') ) {
                $("#div_cual").css("display", "none");
                $("#cual").val("");
                if(razon==4){
                    $("#div_cual").css("display", "inline");
                }
            }
        });
    });

    
});