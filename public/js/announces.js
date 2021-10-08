function filterAds() {
    console.log(baseUrl)
    var search_filter = $('#search_filter').val();
    var categories = $(".catName").map(function() {
        return this.id;
    }).get();
    $.ajax({
        url: baseUrl + '/pro-user/filter-by-category',
        type: 'POST',
        data: {
            'search_filter': search_filter,
            'categories': categories,
        },
        success: function(response) {
            $("#announce_div").html(response);
        },
    })
}