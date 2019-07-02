$(document).ready(function () {
    var datepickers = $('.is-date-picker');
    datepickers.daterangepicker({
        open: 'right',
        singleDatePicker: true,
        minDate: moment().format('DD/MM/YYYY'),
        locale: {
            format: 'DD/MM/YYYY'
        }
    });
    var $list_items = $(".infos-create-list .list-group-item");
    $list_items.each(function () {
        var num = $(this).data('number');
        $(this).find('.is-date-picker').val(moment().add(num, 'd').format('DD/MM/YYYY'));
    });

    $('.add-info-btn').click(function (e) {
        e.preventDefault();
        var $last = $(".infos-create-list .list-group-item").last();
        addItemAfter($last);
    });
    $('.add-info-multiple').click(function (e) {
        e.preventDefault();
        var num_items = prompt("أدخل عدد المعلومات التي تريد إضافتها");
        console.log(typeof num_items);
        if (typeof parseInt(num_items) !== 'number') return;

        var $last = $(".infos-create-list .list-group-item").last();
        for (var i = num_items; i > 0; i--) {
            addItemAfter($last, i);
        }
    });
});

function addItemAfter($el, number) {
    var num, old_num = parseInt($el.data('number'));
    if (number === undefined)
        num = old_num + 1;
    else
        num = old_num + parseInt(number);
    console.log(number, num, old_num);
    var date = moment().add(num, 'd').format('DD/MM/YYYY');
    var html = '<li class="list-group-item" data-number="' + num + '">\n' +
        '                                        <div class="form-group col-md-auto mb-0">\n' +
        '                                            <span>' + num + '</span>\n' +
        '                                        </div>\n' +
        '                                        <div class="form-group col-sm-5 mb-0">\n' +
        '                                            <textarea class="form-control" name="content[]"\n' +
        '                                                      placeholder="اكتب المعلومة..."></textarea>\n' +
        '                                        </div>\n' +
        '                                        <div class="form-group col-sm-3 mb-0">\n' +
        '                                            <input type="file" class="form-control" name="image[]">\n' +
        '                                        </div>\n' +
        '                                        <div class="form-group col-sm-3 mb-0">\n' +
        '                                            <input type="text" class="form-control is-date-picker" name="send_date[]" value="' + date + '">\n' +
        '                                        </div>\n' +
        '                                    </li>';
    $el.after(html);
}