(function ($) {
    'use strict';

    $(document).on('click', '.astrofy-select-image', function (e) {
        e.preventDefault();
        var button = $(this);
        var row = button.closest('.astrofy-repeater');
        var input = row.find('.astrofy-logo-id');
        var preview = row.find('.astrofy-logo-preview');
        var removeBtn = row.find('.astrofy-remove-image');

        var frame = wp.media({
            title: 'Select Logo',
            multiple: false,
            library: { type: 'image' }
        });

        frame.on('select', function () {
            var attachment = frame.state().get('selection').first().toJSON();
            input.val(attachment.id);
            preview.attr('src', attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url).show();
            removeBtn.show();
        });

        frame.open();
    });

    $(document).on('click', '.astrofy-remove-image', function (e) {
        e.preventDefault();
        var row = $(this).closest('.astrofy-repeater');
        row.find('.astrofy-logo-id').val('');
        row.find('.astrofy-logo-preview').attr('src', '').hide();
        $(this).hide();
    });
})(jQuery);
