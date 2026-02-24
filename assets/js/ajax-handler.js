(function ($) {
    // all vehicle information
    let vehicleInfo = {
        brands: [],
        min_price: null,
        max_price: null,
        body_types: [],
        colors: [],
        location: [],
        years: [],
        page_number: null,
        vehicle_condition: null,
    }

    // Add brand information
    $(document).on('click','.brand_checkbox',function () {
        if ($(this).is(":checked")) {
            vehicleInfo.brands.push($(this).val());
            handleFilterVehicle();
        } else {
            var brands = vehicleInfo.brands.filter(item => item !== $(this).val());
            vehicleInfo.brands = brands;
            handleFilterVehicle();
        };
    });

    // Add year information
    $(document).on( 'click', '.year_checkbox', function () {
        if ($(this).is(":checked")) {
            vehicleInfo.years.push($(this).val());
            handleFilterVehicle();
        } else {
            var years = vehicleInfo.years.filter(item => item !== $(this).val());
            vehicleInfo.years = years;
            handleFilterVehicle();
        };
    });

    // Add body-type information
    $(document).on( 'click', '.body_type_checkbox', function () {
        if ($(this).is(":checked")) {
            vehicleInfo.body_types.push($(this).val());
            handleFilterVehicle();
        } else {
            var body_types = vehicleInfo.body_types.filter(item => item !== $(this).val());
            vehicleInfo.body_types = body_types;
            handleFilterVehicle();
        };
    });

    // Vehicle condition
    $(document).on( 'change', '#vehicleCondition', function () {
        vehicleInfo.vehicle_condition = $(this).val();
        handleFilterVehicle();
    });

    // Add min and max year
    $(document).on( 'change', '#min_year', function () {
        vehicleInfo.min_year = $(this).val();
        handleFilterVehicle();
    });
    $(document).on( 'change', '#max_year', function () {
        vehicleInfo.max_year = $(this).val();
        handleFilterVehicle();
    });

    // Add color information
    $(document).on( 'change', '.color_checkbox', function () {
        if ($(this).is(":checked")) {
            vehicleInfo.colors.push($(this).val());
            handleFilterVehicle();
        } else {
            var colors = vehicleInfo.colors.filter(item => item !== $(this).val());
            vehicleInfo.colors = colors;
            handleFilterVehicle();
        };
    });

    // Add color information
    $(document).on( 'change', '.location_checkbox', function () {
        if ($(this).is(":checked")) {
            vehicleInfo.location.push($(this).val());
            handleFilterVehicle();
        } else {
            var location = vehicleInfo.location.filter(item => item !== $(this).val());
            vehicleInfo.location = location;
            handleFilterVehicle();
        };
    });

    var min_price_range = parseFloat($("#min_price").attr('min'));
    var max_price_range = parseFloat($("#max_price").attr('max'));
    $(function () {
        $("#eg-range-slider").slider({
            range: true,
            orientation: "horizontal",
            min: min_price_range,
            max: max_price_range,
            values: [min_price_range, max_price_range],
            step: 10,
            slide: function (event, ui) {
                if (ui.values[0] == ui.values[1]) {
                    return false;
                }
                $("#min_price").val(ui.values[0]);
                $("#max_price").val(ui.values[1]);
                vehicleInfo.min_price = $('#min_price').val();
                vehicleInfo.max_price = $('#max_price').val();
            },
            stop: function () {
                vehicleInfo.page_number = 1;
                handleFilterVehicle();
            }
        });
        $("#min_price").val($("#eg-range-slider").slider("values", 0));
        $("#max_price").val($("#eg-range-slider").slider("values", 1));
    });

    // Pagination
    jQuery('body').on('click', '#vehiclePagination ul li a', function (e) {
        e.preventDefault();
        var url = jQuery(this).attr('href');
        var pathname = new URL(url).pathname;
        var matches = pathname.match(/\/page\/(\d+)\/$/);
        if (matches && matches[1]) {
            var page_number = parseInt(matches[1]);
            page_number = parseInt(page_number);
            vehicleInfo.page_number = page_number;
            handleFilterVehicle();
        } else {
            vehicleInfo.page_number = 1;
            handleFilterVehicle();
        }
    });

    function handleFilterVehicle() {
        let data = {
            'action': 'egns_get_vehicle',
            'product_info': vehicleInfo,
        };
        $.ajax({ // you can also use $.post here
            url: egens_ajax_handler_params.ajaxurl, // AJAX handler
            data: data,
            type: 'GET',
            beforeSend: function () {
                jQuery('.circle-loader').parent('div').addClass('loading');
            },
            success: function (data) {
                $('#vehicle_wrapper').empty().html(data);
                jQuery('.circle-loader').parent('div').removeClass('loading');
            }
        });
    }



    // Bidding form handler 
    $('#biddingForm').submit(function (event) {
        event.preventDefault();
        let bidding_amount = jQuery('input[name="bidding_amount"]').val();
        let full_name = jQuery('input[name="full_name"]').val();
        let phone_number = jQuery('input[name="phone_number"]').val();
        let email_address = jQuery('input[name="email_address"]').val();
        let message = jQuery('textarea[name="message"]').val();

        if (bidding_amount && full_name && phone_number && email_address && message) {
            let formData = new FormData(this);
            const formDataArray = {};
            for (var key of formData.entries()) {
                formDataArray[key[0]] = key[1];
            }
            // Handle ajax request 
            let data = {
                'action': 'egns_submit_auction_data',
                'bidding_info': formDataArray,
            };
            $.ajax({
                url: egens_ajax_handler_params.ajaxurl,
                data: data,
                type: 'POST',
                success: function (data) {
                    jQuery('#biddingForm').empty().html('<h2>Bidding Successfull!!');
                    jQuery('.auction-error').addClass('d-none');
                }
            });
        } else {
            jQuery('.auction-error').removeClass('d-none');
        }
    });

    // Customer registration 
    $('#custom-registration-form').submit(function(event){
        event.preventDefault();
        let first_name    = jQuery('#custom-registration-form input[name="first_name"]').val();
        let last_name     = jQuery('#custom-registration-form input[name="last_name"]').val();
        let username      = jQuery('#custom-registration-form input[name="username"]').val();
        let email_address = jQuery('#custom-registration-form input[name="email_address"]').val();
        let password      = jQuery('#custom-registration-form input[name="password"]').val();
        if( first_name && last_name && username && email_address && password ) {
            let formData = new FormData(this);
            const formDataArray = {};
            for (var key of formData.entries()) {
                formDataArray[key[0]] = key[1];
            }
            // Handle ajax request 
            let customer_data = {
                'action': 'egns_register_customer',
                'customer_info': formDataArray,
            };
            $.ajax({ 
                url: egens_ajax_handler_params.ajaxurl,
                data: customer_data,
                type: 'POST',
                success: function (data) {
                    jQuery('.customer_registration_message').removeClass('d-none');
                    jQuery('.customer_registration_message').empty().html( JSON.stringify( data.data.message ) );
                    if( data.success ) {
                        let currentURL = window.location.href;
                        window.location.href = currentURL;
                    }
                }
            });
        }else{
            jQuery('.customer_registration_message').removeClass('d-none');
            jQuery('.customer_registration_message').empty().html( 'Something went wrong!!' );
        }
    });

    // Customer login 
    $('#custom-login-form').submit(function(event){
        event.preventDefault();
        let email_address = jQuery('#custom-login-form input[name="email_address"]').val();
        let password      = jQuery('#custom-login-form input[name="password"]').val();
        console.log(email_address,password);
        if( email_address && password ) {
            let formData = new FormData(this);
            const formDataArray = {};
            for (var key of formData.entries()) {
                formDataArray[key[0]] = key[1];
            }
            // Handle ajax request 
            let customer_data = {
                'action': 'egns_login_customer',
                'customer_login_info': formDataArray,
            };
            $.ajax({ 
                url: egens_ajax_handler_params.ajaxurl,
                data: customer_data,
                type: 'POST',
                success: function (data) {
                    jQuery('.customer_login_message').removeClass('d-none');
                    jQuery('.customer_login_message').empty().html( JSON.stringify( data.data.message ) );
                    if( data.success ) {
                        let currentURL = window.location.href;
                        window.location.href = currentURL;
                    }
                }
            });
        }else{
            jQuery('.customer_login_message').removeClass('d-none');
            jQuery('.customer_login_message').empty().html( 'Something went wrong!!' );
        }
    });
}(jQuery));