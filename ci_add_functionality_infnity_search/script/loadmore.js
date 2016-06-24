! function(i) {
    i.fn.scrollPagination = function(n) {
        var t = {
            nop: 10,
            offset: 0,
            error: "No more records",
            delay: 500,
            scroll: !0
        };
        return n && i.extend(t, n), this.each(function() {
            function n() {
                i.post("http://codeigniter.dev:88/product/productload", {
                    action: "scrollpagination",
                    number: $settings.nop,
                    offset: s
                }, function(i) {
                    $this.find(".loading-bar").html($initmessage), "" == i ? $this.find(".loading-bar").html($settings.error) : (s += $settings.nop, $this.find(".content").append(i), o = !1)
                })
            }
            $this = i(this), $settings = t;
            var s = $settings.offset,
                o = !1;
            1 == $settings.scroll ? $initmessage = "Scroll for more or click here" : $initmessage = "Click for more", $this.append('<div class="content"></div><div class="loading-bar">' + $initmessage + "</div>"), n(), 1 == $settings.scroll && i(window).scroll(function() {
                i(window).scrollTop() + i(window).height() > $this.height() && !o && (o = !0, $this.find(".loading-bar").html("Loading..."), setTimeout(function() {
                    n()
                }, $settings.delay))
            }), $this.find(".loading-bar").click(function() {
                0 == o && (o = !0, n())
            })
        })
    }
}(jQuery);