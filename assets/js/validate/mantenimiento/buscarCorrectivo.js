$( document ).ready( function () {
	
	jQuery.validator.addMethod("unCampo", function(value, element, param) {
		var fecha_inicio = $('#fecha_inicio').val();
		var numero_inventario = $('#numero_inventario').val();
		if ( fecha_inicio == "" && numero_inventario == "" ) {
			return false;
		} else {
			return true;
		}
	}, "Debe indicar al menos un campo.");

	$( "#formBuscar" ).validate( {
		rules: {
			fecha_inicio:		{ unCampo: true, maxlength: 10 },
			numero_inventario:	{ unCampo: true, maxlength: 10 }
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