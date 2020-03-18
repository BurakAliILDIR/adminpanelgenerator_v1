$(document).on('click', '#multiple_delete', function () {
    let ids = [];
    $('[data-val="delete"]:checked').each(function () {
        ids.push($(this).val());
    });
    if (ids.length > 0) {
        if (confirm('Seçili kayıtları silmek istediğinize emin misiniz?')) {
            const url = $('#multiple_delete').data('url');
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: url,
                method: 'DELETE',
                data: {checked: ids},
                success: function (data) {
                    location.reload();
                }
            });
        }
    }
});

let control = 0;
$(document).on('click', '.checkbox-delete', function () {
    if (control % 2) {
        const id = $(this).attr('id');
        const checkbox = $('[data-delete="' + id + '"]');
        checkbox.attr("checked", !checkbox.attr("checked"));
    }
    control += 1;
});
