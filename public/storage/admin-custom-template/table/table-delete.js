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

