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
		var post = $(evt.item).data('sortable');
		var page = $(evt.item).data('page');
		var position = evt.newIndex + 1 + page; // the current dragged HTMLElement
		$.ajax({
			type: 'POST',
			url: '/post/' + post + '/sortable',
			data: { _method: 'put', sortable: position},
			success: function(data){
				$(evt.item).find('.saved').text('Saved').delay(3000).fadeOut(400);
			}
		}).fail(function(jqXHR, status, thrownError) {
			$(evt.item).find('.fail').text('Error').delay(3000).fadeOut(400);
		});
	},
});