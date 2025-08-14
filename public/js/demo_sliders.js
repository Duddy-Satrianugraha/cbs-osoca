$(function(){
    /* ION Range Slider Samples */
    
    // -------- BOUNTIFY ----------
    
    //Default
    $("#ise_default").ionRangeSlider(
    { from_mark: true }
    );
    //End Default
    
    //Min Max Value
    $("#ise_min_max").ionRangeSlider({
        min: 100,
        max: 1000,
        from: 550,
        from_mark: true
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
        prefix: "$",
        
        from_mark: true,
        to_mark: true
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
    
    // Min-Max
    var slider_ise_prefix = $("#ise_prefix").data("ionRangeSlider");
    
    $('#ise_prefix_refresh').on('click', function (e) {
        e.preventDefault(); // prevent submit behaviour (and page refresh)
    
        slider_ise_prefix.reset();
    });
    $('#ise_prefix_edit').on('click', function (e) {
        e.preventDefault(); // prevent submit behaviour (and page refresh)
    
        slider_ise_prefix && slider_ise_prefix.destroy();
        $("#ise_prefix").spinner(); // turn the inputs into spinners
    });
    
    
    /* END ION Range Slider Samples */
});      