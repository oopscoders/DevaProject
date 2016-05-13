<div id="sliderp">
<div id="sync1<?php echo $module; ?>" class="owl-carousel">
        <?php foreach ($banners as $banner) { ?>
                <div class="item">
    <a href='<?php echo $banner['link']; ?>' target="_blank"/><img src="<?php echo $banner['image']; ?>"></a>                </div>
            <?php } ?>
        
        </div>
        <div id="sync2<?php echo $module; ?>" class="owl-carousel">
      <?php foreach ($banners as $banner) { ?>
                <div class="item">
        <span></span>
                    <h3><?php echo $banner['title']; ?></h3>
                        <i class="arrowbar"></i>
                </div>
      <?php }?> 
        </div>
  </div>      

<script><!--
$(document).ready(function() {
    $("#sliderp").each(function() {
        function e() {
            var e = this.currentItem;
            $("#sync2<?php echo $module; ?>").find(".owl-item").removeClass("synced").eq(e).addClass("synced"), $("#sync2<?php echo $module; ?>").find(".owl-item .item span").removeClass("arrowbarleft").eq(e).addClass("arrowbarleft"), void 0 !== $("#sync2<?php echo $module; ?>").data("owlCarousel") && o(e)
        }

        function o(e) {
            var o = i.data("owlCarousel").owl.visibleItems,
                a = e,
                s = !1;
            for (var l in o) a === o[l] && (s = !0);
            s === !1 ? a > o[o.length - 1] ? i.trigger("owl.goTo", a - o.length + 2) : (a - 1 == -1 && (a = 0), i.trigger("owl.goTo", a)) : a === o[o.length - 1] ? i.trigger("owl.goTo", o[1]) : a === o[0] && i.trigger("owl.goTo", a - 1)
        }
        var a = $("#sliderp").width();
        200 > a ? $("#sync2<?php echo $module; ?>").css("visibility", "hidden") : $("#sync2<?php echo $module; ?>").css("display", "block"), $("#sync2<?php echo $module; ?> .item:last-child i").removeClass("arrowbar");
        var s = $("#sync1<?php echo $module; ?>"),
            i = $("#sync2<?php echo $module; ?>"),
            l = $("#sync2<?php echo $module; ?> .item").length;
        if (l > 8) var t = 8;
        else var t = l;
        s.owlCarousel({
            autoPlay: 4000,
            singleItem: !0,
            slideSpeed: 500,
            transitionStyle : "<?php echo $effect;?>",
            navigation: !0,
            navigationText: ['<i class="fa fa-chevron-left fa-5x"></i>', '<i class="fa fa-chevron-right fa-5x"></i>'],
            pagination: !1,
            afterAction: e,
            responsiveRefreshRate: 200,
            stopOnHover: !0
        }), i.owlCarousel({
            items: t,
            itemsCustom: [
                [0, 2],
                [480, 2],
                [768, 4],
                [1024, t],
                [1200, t]
            ],
            pagination: !1,
            responsiveRefreshRate: 100,
            afterInit: function(e) {
                e.find(".owl-item").eq(0).addClass("synced")
            }
        }), $("#sync2<?php echo $module; ?>").on("click", ".owl-item", function(e) {
            var o, a;
            e.preventDefault(), o = $(this).data("owlItem"), s.trigger("owl.goTo", o), a = s.data("owlCarousel"), a.stop()
        })
    })
});
--></script>