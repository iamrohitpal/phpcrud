var $searchBox = $('#search-weeazer');
var $searchBtn = $('#search-btn');
var $userDivs = $('.jobcontainer div');

function performSearch() {
  var searchTerm = $searchBox.val().toLowerCase();

  if (!searchTerm || searchTerm === '') {
    $userDivs.show();
    return;
  }

  $userDivs.each(function(i, div) {
    var $div = $(div);
    $div.toggle($div.text().toLowerCase().indexOf(searchTerm) > -1);
  });
}

$searchBtn.on('click', function() {
  performSearch();
});