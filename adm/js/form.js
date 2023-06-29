
jQuery.datetimepicker.setLocale('ru');
$('.datetimepicker').datetimepicker({
    scrollInput: false,
    format: 'd.m.Y H:i:s'
});
$('.datepicker').datetimepicker({
    timepicker: false,
    scrollInput: false,
    format: 'd.m.Y',
});
$('.timepicker').datetimepicker({
    format: 'H:i',
    datepicker: false,
    step: 15,
});