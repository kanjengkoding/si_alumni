<!-- Datepicker -->
<script type="text/javascript" src="./assets/js/vendor/datepicker/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="./assets/css/vendor/datepicker/bootstrap-datepicker.min.css">
<script type="text/javascript">
	$('.datepicker').datepicker({
	    format: "yyyy/mm/dd",
	    weekStart: 1,
	    todayBtn: "linked",
	    daysOfWeekHighlighted: "0,6",
	    orientation: "bottom right",
	    autoclose: true,
	    todayHighlight: true,
	    toggleActive: true,
	    language: "id"
	});
</script>


<!-- Datatables -->
<link rel="stylesheet" type="text/css" href="./assets/js/vendor/datatables/media/css/dataTables.bootstrap.min.css">
<script type="text/javascript" src="./assets/js/vendor/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="./assets/js/vendor/datatables/media/js/dataTables.bootstrap.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.datatable').DataTable( {
			"language": {
	            "url": "http://cdn.datatables.net/plug-ins/1.10.11/i18n/Indonesian.json"
	        }
			// "order": [[ 0, "desc" ]]
		} );
	} );
</script>

<!-- TinyMCE -->
<script type="text/javascript" src="./assets/js/vendor/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
	tinymce.init({
	  selector: 'textarea',
	  height: 100,
	  plugins: [
	    'advlist autolink lists link charmap preview',
	    'searchreplace visualblocks code fullscreen',
	    'insertdatetime contextmenu paste code'
	  ],
	  toolbar: 'insertfile undo redo | bold italic | bullist numlist outdent indent'
	});
</script>


<!-- Show Hide Password -->
<script type="text/javascript">
	jQuery(document).ready(function($) {
		//Place this plugin snippet into another file in your application
		(function ($) {
		    $.toggleShowPassword = function (options) {
		        var settings = $.extend({
		            field: "#password",
		            control: "#show_password",
		        }, options);

		        var control = $(settings.control);
		        var field = $(settings.field)

		        control.bind('click', function () {
		            if (control.is(':checked')) {
		                field.attr('type', 'text');
		            } else {
		                field.attr('type', 'password');
		            }
		        })
		    };
		}(jQuery));

		//Here how to call above plugin from everywhere in your application document body
		$.toggleShowPassword({
		    field: '#password',
		    control: '#show_password'
		});
	});
</script>
