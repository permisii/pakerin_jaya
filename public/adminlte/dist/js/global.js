$(function () {
    $('.select2').select2()

    var todates = new Date();
    $('.datepicker.maxtoday').datepicker({
        // format: "dd/mm/yyyy",
        format: "yyyy-mm-dd",
        autoclose: true,
        todayBtn: false,
        endDate: todates,
        clearBtn: true,
    })

    $('.datepicker').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayBtn: false,
        clearBtn: true,
    })

    $('.year-picker').each(function () {
        $(this).datepicker({
            autoclose: true,
            format: " yyyy",
            viewMode: "years",
            minViewMode: "years"
        });
    });


    $('.datepicker').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('YYYY/MM/DD'));
    });

    $('.reservationtime').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('YYYY/MM/DD H:mm') + ' - ' + picker.endDate.format('YYYY/MM/DD H:mm'));
    });

    $('.reservationtime, .datepicker').on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('');
    });

    $(".datepicker").each(function () {
        $(this).prop('readonly', true);
    });


    // $(".elm-num").priceFormat({
    //     prefix: "",
    //     thousandsSeparator: '.',
    //     centsSeparator: ',',
    //     centsLimit: 0,
    //     clearPrefix: true,
    //     allowNegative: false
    // });

    $(".elm-int").inputmask({
        alias: 'integer',
        removeMaskOnSubmit: true,
        groupSeparator: ".",
        autoGroup: true,
        allowMinus: false
    })

    $(".elm-decimal").inputmask({
        alias: "percentage",
        integerDigits: 3,
        digits: 3,
        max: 100,
        allowMinus: false,
        digitsOptional: false,
        placeholder: "0"
    })

});
