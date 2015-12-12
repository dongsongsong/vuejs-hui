(function ($) {
    $.fn.shake = function (s) {
        var t = { rangeX: 2, rangeY: 2, rangeRot: 1, rumbleSpeed: 10, rumbleEvent: 'hover', posX: 'left', posY: 'top' }, u = $.extend(t, s);
        return this.each(function () {
            var $obj = $(this)
           , f
           , g = u.rangeX * 2
            , h = u.rangeY * 2
            , i = u.rangeRot * 2
            , j = u.rumbleSpeed
           , k = $obj.css('position')
            , l = u.posX
            , m = u.posY
            , n
            , o
            , p
            , q = { 'position': k, '-webkit-transform': 'rotate(0deg)', '-moz-transform': 'rotate(0deg)', '-o-transform': 'rotate(0deg)', 'transform': 'rotate(0deg)' };
            if (l === 'left') {
                n = parseInt($obj.css('left'), 10)
            }
            if (l === 'right') {
                n = parseInt($obj.css('right'), 10)
            }
            if (m === 'top') {
                o = parseInt($obj.css('top'), 10)
            }
            if (m === 'bottom') {
                o = parseInt($obj.css('bottom'), 10)
            }
            function rumbler(a) {
                var b = Math.random()
                , c = Math.floor(Math.random() * (g + 1)) - g / 2
                , d = Math.floor(Math.random() * (h + 1)) - h / 2
                , e = Math.floor(Math.random() * (i + 1)) - i / 2;
                if (a.css('display') === 'inline') {
                    p = true;
                    a.css('display', 'inline-block')
                }
                if (c === 0 && g !== 0) {
                    c = b < .5 ? 1 : -1;
                }
                if (d === 0 && h !== 0) {
                    d = b < .5 ? 1 : -1;
                }
                if (k === 'absolute') {
                    a.css({ 'position': 'absolute', '-webkit-transform': 'rotate(' + e + 'deg)', '-moz-transform': 'rotate(' + e + 'deg)', '-o-transform': 'rotate(' + e + 'deg)', 'transform': 'rotate(' + e + 'deg)' });
                    a.css(l, n + c + 'px');
                    a.css(m, o + d + 'px')
                }
                if (k === 'fixed') {
                    a.css({ 'position': 'fixed', '-webkit-transform': 'rotate(' + e + 'deg)', '-moz-transform': 'rotate(' + e + 'deg)', '-o-transform': 'rotate(' + e + 'deg)', 'transform': 'rotate(' + e + 'deg)' });
                    a.css(l, n + c + 'px');
                    a.css(m, o + d + 'px')
                }
                if (k === 'static' || k === 'relative') {
                    a.css({ 'position': 'relative', '-webkit-transform': 'rotate(' + e + 'deg)', '-moz-transform': 'rotate(' + e + 'deg)', '-o-transform': 'rotate(' + e + 'deg)', 'transform': 'rotate(' + e + 'deg)' });
                    a.css(l, c + 'px');
                    a.css(m, d + 'px')
                }
            }
            if (u.rumbleEvent === 'hover') {
                $obj.hover(function () {
                    var a = $(this);
                    f = setInterval(function () {
                        rumbler(a)
                    }, j)
                }, function () {
                    var a = $(this);
                    clearInterval(f);
                    a.css(q);
                    a.css(l, n + 'px');
                    a.css(m, o + 'px');
                    if (p === true) {
                        a.css('display', 'inline')
                    }
                });
            }
            if (u.rumbleEvent === 'click') {
                $obj.toggle(function () {
                    var a = $(this);
                    f = setInterval(function () {
                        rumbler(a)
                    }, j)
                }, function () {
                    var a = $(this);
                    clearInterval(f);
                    a.css(q);
                    a.css(l, n + 'px');
                    a.css(m, o + 'px');
                    if (p === true) {
                        a.css('display', 'inline')
                    }
                });
            }
            if (u.rumbleEvent === 'mousedown') {
                $obj.bind({
                    mousedown: function () {
                        var a = $(this);
                        f = setInterval(function () {
                            rumbler(a)
                        }, j)
                    }, mouseup: function () {
                        var a = $(this);
                        clearInterval(f);
                        a.css(q);
                        a.css(l, n + 'px');
                        a.css(m, o + 'px');
                        if (p === true) {
                            a.css('display', 'inline')
                        }
                    }, mouseout: function () {
                        var a = $(this);
                        clearInterval(f);
                        a.css(q);
                        a.css(l, n + 'px');
                        a.css(m, o + 'px');
                        if (p === true) {
                            a.css('display', 'inline')
                        }
                    }
                });
            }
            if (u.rumbleEvent === 'constant') {
                var r = $(this);
                f = setInterval(function () {
                    rumbler(r)
                }, j);
            }
        });
    }
}(jQuery));