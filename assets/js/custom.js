// add padding top to show content behind navbar
$('body').css('padding-top', $('.navbar').outerHeight() + 'px')

// detect scroll top or down
if ($('.smart-scroll').length > 0) { // check if element exists
    var last_scroll_top = 0;
    $(window).on('scroll', function() {
        scroll_top = $(this).scrollTop();
        if (scroll_top < last_scroll_top) {
            $('.smart-scroll').removeClass('scrolled-down').addClass('scrolled-up');
        } else {
            $('.smart-scroll').removeClass('scrolled-up').addClass('scrolled-down');
        }
        last_scroll_top = scroll_top;
    });
}

$.getJSON('http://localhost/privatin/api/dataCity', function(data) {
    var city = data
    $("#city").autocomplete({
        source: city,
        minLength: 3
    });
})

$('#city').on('change', function() {
    var city = document.getElementById("city").value;
    $.getJSON('http://localhost/privatin/api/dataProvince?city=' + city, function(data) {
        var subject = data[0]
        document.getElementById("province").value = subject.province;
    })
})




// $.getJSON('http://localhost/privatin-protoype/api/dataFocus', function(data) {
//     var focus = data
//     $("#focus").autocomplete({
//         source: focus,
//         minLength: 3
//     });
// })

$('.custom-file-input').on('change', function() {
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
});