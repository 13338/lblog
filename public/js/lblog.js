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
// Sortable
var sortable = document.getElementById("sortable");
var sort = Sortable.create(sortable, {
	animation: 150, // ms, animation speed moving items when sorting, `0` — without animation
	handle: ".drag-handle", // Restricts sort start click/touch to the specified element
	onUpdate: function (evt/**Event*/){
	   var item = evt.item; // the current dragged HTMLElement
	}
});