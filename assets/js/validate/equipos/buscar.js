$( document ).ready( function () {
	
	jQuery.validator.addMethod("unCampo", function(value, element, param) {
		var numero_unidad = $('#numero_unidad').val();
		var fabricante = $('#fabricante').val();
		var modelo = $('#modelo').val();
		var numero_serial = $('#numero_serial').val();
		if ( numero_unidad == "" && fabricante == "" && modelo == "" && numero_serial == "" ) {
			return false;
		}else{
			return true;
		}
	}, "Debe indicar al menos un campo.");

	$( "#formBuscar" ).validate( {
		rules: {
			numero_unidad:	{ unCampo: true, maxlength: 10 },
			fabricante:	{ unCampo: true, maxlength: 20 },
			modelo:	{ unCampo: true, maxlength: 20 },
			numero_serial:	{ unCampo: true, maxlength: 10 }
		},
		errorElement: "em",
		errorPlacement: function ( error, element ) {
			// Add the `help-block` class to the error element
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
		}else
		{
			//alert('Error.');
		}
	});

});