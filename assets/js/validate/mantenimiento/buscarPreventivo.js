$( document ).ready( function () {
	
	jQuery.validator.addMethod("unCampo", function(value, element, param) {
		var tipo_equipo = $('#tipo_equipo').val();
		var frecuencia = $('#frecuencia').val();
		if ( tipo_equipo == "" && frecuencia == "" ) {
			return false;
		} else {
			return true;
		}
	}, "Debe indicar al menos un campo.");

	$( "#formBuscar" ).validate( {
		rules: {
			tipo_equipo:	{ unCampo: true, maxlength: 1 },
			frecuencia:		{ unCampo: true, maxlength: 10 }
		},
		errorElement: "em",
		errorPlacement: function ( error, element ) {
			error.addClass( "help-block" );
			error.insertAfter( element );
		},
		highlight: function ( element, errorClass, validClass ) {
			$( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
		},
		unhighlight: function (element, errorClass, validClass) {
			$( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
		},
		submitHandler: function (form) {
			return true;
		}
	});
	
	$("#btnBuscar").click(function(){		
		if ($("#formBuscar").valid() == true){
			var form = document.getElementById('form');
			form.submit();
		} else {
			//alert('Error.');
		}
	});
});