// Destroy
function destroy(element) {
	if (confirm("Delete ?")) {
		$.ajax({
			type: 'POST',
			url: $(element).data('url'),
			data: { _method: 'delete'},
			success: function(data){
				window.location.href = '/';
			}
		});
	}
}