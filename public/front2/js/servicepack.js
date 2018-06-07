$(function() {
    $.getJSON(base_url("/ajax/optionearchservice"), function(a) {
        $('[name="allspa[]"]').html(a.allspa), $('[name="currencies[]"]').html(a.currencies)
    }), search = function(a) {
        if (void 0 == a) var b = 1;
        else var b = a;
        var c = $('[name="allspa[]"]').val(),
            d = $('[name="currencies[]"]').val(),
            e = $('[name="types[]"]').val(),
            f = $('[name="src"]').val(),
            discount = $('[name="discount"]').prop('checked'),
            g = {
                spa: c,
                crc: d,
                src: f,
                types: e,
                discount : discount,
                page: b
            };
        $(".content-service").css("opacity", .3), $.getJSON(base_url("/ajax/searchservices"), g, function(a) {
            $(".content-service").html(a.content), $(".paging").html(a.pagination), $(".content-service").css("opacity", 1), $("div.paging > ul.pagination > li > a").click(function(a) {
                a.preventDefault();
                var b = $(this).attr("href"),
                    c = b.split("?page="),
                    d = c[1];
                search(d)
            })
        })
    }, $("div.paging > ul.pagination > li > a").click(function(a) {
        a.preventDefault();
        var b = $(this).attr("href"),
            c = b.split("?page="),
            d = c[1];
        search(d)
    })
});
