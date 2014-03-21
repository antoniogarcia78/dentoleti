
function ajax_reload(path) {
	alert(path);
	// When cp change
	$("#patient_postalCode").change(function() {
		var data = {
			cp_id: $(this).val()
		};
		$.ajax({
			type: 'POST',
			url: path,
			data: data,
			success: function(data) {
				$('#patient_postalCode').html(data);
			}
		});
	});
}