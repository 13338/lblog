// Search
$("#searchinput").change(function() {
	$.ajax({
	    dataType: "json",
	    url: '/post/search',
	    data: {q: $('#searchinput').val()},
	    success: function (result) {
	        console.log(result);
	        $('#search').empty();
	        if (result.total > 0) {
	        	$.each(result.data, function(index, element) {
		            $('#search').append('<div class="col-md-8 mb-4"> <div class="card"> <div class="card-body"> <h5 class="card-title"> <a href="/post/' + element.id + '">' + element.name + '</a> </h5> ' + element.content + ' </div> <div class="card-footer text-muted"> <a href="/post/' + element.id + '" class="btn btn-sm btn-primary">Show</a> <span class="float-right"> ' + element.created_at + ' </span> </div> </div> </div>');
		        });
	        } else {
	        	$('#search').append('<p class="lead">No result :(</p>');
	        }
	        
	    },
	});
});
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