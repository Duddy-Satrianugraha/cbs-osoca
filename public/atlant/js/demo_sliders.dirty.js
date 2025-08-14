$(function(){
    /* ION Range Slider Samples */
    
    // BOUNTIFY
    
    var createDefaultMark = function(id) {
        console.log("createDefaultMark: " + id);
    
        var $old_mark = $(id).prev().find(".irs-slider");
        console.log("old_mark: %o, position: %o", $old_mark, $old_mark.position());

        var $new_mark = $("<span />").attr({'id': id + '_default_mark'});
        var new_mark_style = {
          "position": "absolute",
          "display": "block",
          "z-index": "0",
          "background": "red",
          "height": $old_mark.height(),
          "width": "2px",
          "top": $old_mark.position().top,
          "left": $old_mark.position().left
          //"left": $old_mark.position().left + $old_mark.width()/2
        };
        $new_mark.css(new_mark_style);

        $(id).prev().find(".irs-line").before($new_mark);
    };
    
    // var createDefaultSlider = function(id) {
        // var $target = $(id);
        // if (!$target)
            // return null;
        
        // $target.ionRangeSlider({from: 30});
        
        // createDefaultMark(id);
        
        // return $target.data("ionRangeSlider");
    // };
    
    // var slider_ise_default = createDefaultSlider("#ise_default");
    
    // $('#ise_default_refresh').on('click', function (e) {
        // e.preventDefault(); // prevent submit behaviour (and page refresh)
    
        // slider_ise_default.reset();
        // createDefaultMark("#ise_default");
    // });
    // $('#ise_default_edit').on('click', function (e) {
        // e.preventDefault(); // prevent submit behaviour (and page refresh)
    
        // // slider_ise_default && slider_ise_default.destroy();
        // if (slider_ise_default) {
            // slider_ise_default.destroy();
            // slider_ise_default = null;
            // $("#ise_default").spinner(); // turn the inputs into spinners
        // }
        // else {
            // $("#ise_default").spinner("destroy"); 
            // slider_ise_default = createDefaultSlider("#ise_default");
        // }
    // });
    
    // var $old_mark = $("#ise_default").prev().find(".irs-slider");
    // console.log("XXX old_mark: %o, position: %o", $old_mark, $old_mark.position());
    
    
    
    
    
    
    
    //Default
    $("#ise_default").ionRangeSlider();
    //End Default
    
    //Min Max Value
    $("#ise_min_max").ionRangeSlider({
        min: 100,
        max: 1000,
        from: 550,
        
        // onStart: function (obj) {
            // var $input = $("#ise_min_max");
            // var $bar = $input.prev().find(".irs-line");
            // var $old_mark = $input.prev().find(".irs-slider");

            // console.log( "onStart: %o", $old_mark.position() );
            
            // var $new_mark = $("<span />").attr({'id':'default-mark'});
            // var new_mark_style = {
              // "position": "absolute",
              // "display": "block",
              // "z-index": "0",
              // "background": "red",
              // "height": $old_mark.height(),
              // "width": "2px",
              // "top": $old_mark.position().top,
              // "left": $old_mark.position().left// + $old_mark.width()/2
            // };
            // $new_mark.css(new_mark_style);

            // $bar.before($new_mark);
        // }
    });
    //End Min Max Value
    
    //Prefix
    $("#ise_prefix").ionRangeSlider({
        type: "double",
        grid: true,
        min: 0,
        max: 1000,
        from: 200,
        to: 800,
        prefix: "$"
    });
    //End Prefix
    
    //Step
    $("#ise_step").ionRangeSlider({
        type: "double",
        grid: true,
        min: 0,
        max: 10000,
        from: 3000,
        to: 7000,
        step: 250
    });
    //End Step
    
    //Custom Values
    $("#ise_custom_values").ionRangeSlider({
        grid: true,
        from: 3,
        values: [
            "January", "February", "March",
            "April", "May", "June",
            "July", "August", "September",
            "October", "November", "December"
        ]
    });    
    //End Custom Values
    
    //Decorate
    $("#ise_decorate").ionRangeSlider({
        type: "double",
        min: 100,
        max: 200,
        from: 145,
        to: 155,
        prefix: "Weight: ",
        postfix: " million pounds",
        decorate_both: false
    });
    //End Decorate
    
    //Disabled
    $("#ise_disabled").ionRangeSlider({
        min: 0,
        max: 100,
        from: 30,
        disable: true
    });
    //End Disabled
    
    
    // -------- BOUNTIFY ----------
    
    // Default
    var slider_ise_default = $("#ise_default").data("ionRangeSlider");
    
    $('#ise_default_refresh').on('click', function (e) {
        e.preventDefault(); // prevent submit behaviour (and page refresh)
    
        slider_ise_default.reset();
    });
    $('#ise_default_edit').on('click', function (e) {
        e.preventDefault(); // prevent submit behaviour (and page refresh)
    
        slider_ise_default && slider_ise_default.destroy();
        $("#ise_default").spinner(); // turn the inputs into spinners
    });
    
    // Min-Max
    var slider_ise_min_max = $("#ise_min_max").data("ionRangeSlider");
    
    $('#ise_min_max_refresh').on('click', function (e) {
        e.preventDefault(); // prevent submit behaviour (and page refresh)
    
        slider_ise_min_max.reset();
    });
    $('#ise_min_max_edit').on('click', function (e) {
        e.preventDefault(); // prevent submit behaviour (and page refresh)
    
        slider_ise_min_max && slider_ise_min_max.destroy();
        $("#ise_min_max").spinner(); // turn the inputs into spinners
    });
    
    
    /* END ION Range Slider Samples */
});      