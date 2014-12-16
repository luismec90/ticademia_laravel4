$.datepicker.regional['es'] = {
    closeText: 'Cerrar',
    prevText: '<Ant',
    nextText: 'Sig>',
    currentText: 'Hoy',
    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
    weekHeader: 'Sm',
    dateFormat: 'dd/mm/yy',
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: ''
};
$.datepicker.setDefaults($.datepicker.regional['es']);
$(function () {
    $('.datepickerBirthday').datepicker({
        dateFormat: 'yy-mm-dd',
        changeYear: true,
        changeMonth: true,
        maxDate: 0,
        yearRange: 'c-100:c'
    });


    $('form.validate-form').submit(function () {

        var invalidForm = false;

        $(':input[required]').popover('destroy');

        $(':input[required]', $(this)).each(function () {
            if (this.value.trim() == '') {
                $(this).focus().popover({
                    'trigger': 'manual',
                    'placement': 'bottom',
                    'content': 'Campo obligatorio'
                }).popover('show').focus();
                invalidForm = true;
                return false;
            }

        });

        if (!invalidForm) {
            $(':checkbox[required]', $(this)).each(function () {
                console.log($(this).is(':checked'))
                if (!$(this).is(':checked')) {
                    $(this).focus().popover({
                        'trigger': 'manual',
                        'placement': 'top',
                        'content': 'Debes aceptar los términos y condiciones de uso para proceder con el registro'
                    }).popover('show').focus();
                    invalidForm = true;
                    return false;
                }
            });
        }

        if (!invalidForm) {
            var regexpDate = /^\d{4}-\d{2}-\d{2}$/;
            $('.date:input[required]', $(this)).each(function () {
                var check = this.value.trim();
                if (!check.match(regexpDate)) {
                    $(this).focus().popover({
                        'trigger': 'manual',
                        'placement': 'bottom',
                        'content': 'Fecha inválida'
                    }).popover('show').focus();
                    invalidForm = true;
                    return false;
                }
            });
        }

        if (!invalidForm) {
            var regexpEmail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            $('.email:input[required]', $(this)).each(function () {
                var check = this.value.trim();
                if (!check.match(regexpEmail)) {
                    $(this).focus().popover({
                        'trigger': 'manual',
                        'placement': 'bottom',
                        'content': 'Correo electrónico inválido'
                    }).popover('show').focus();
                    invalidForm = true;
                    return false;
                }
            });
        }

        if (invalidForm) {
            return false;
        }

        coverOn();
    });

    $('form.validate-form :input[required]').change(function (e) {
        $(this).popover('destroy');
    });

    $('.btn-file :file').change(function () {
        var input = $(this);
        var label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.parent().parent().siblings("input").val(label);
    });
});

function coverOn() {
    $("#cover-display").css({
        "opacity": "1",
        "width": "100%",
        "height": "100%"
    });
}

function coverOff() {
    $("#cover-display").css({
        "opacity": "0",
        "width": "0",
        "height": "0"
    });
}
