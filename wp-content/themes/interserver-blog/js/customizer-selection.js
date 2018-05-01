
alert(jQuery("#customize-control-featured_cat > select option:selected").length);

    if (jQuery("#customize-control-featured_cat + select option:selected").length > 2) {
    alert("test");
        //jQuery(this).removeAttr("selected");
        // alert('You can select upto 3 options only');
    }

