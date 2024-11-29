
$(document).ready(function () {
    function initSelect2() {
        $('.select2').select2({
            placeholder: "Add emails to send invitation link",
            tags: true,
            tokenSeparators: [',', ' '],
            width: '100%',
            dropdownParent: $('#addowner'),
            createTag: function (params) {
                var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                if (emailRegex.test(params.term)) {
                    return {
                        id: params.term,
                        text: params.term,
                        newOption: true
                    };
                }
                return null;
            },
            templateResult: function (data) {
                if (!data.id) {
                    return data.text;
                }
                var $option = $(
                    `<span><img src="assets/images/profile.jpg" alt="profile picture"> ${data.text}</span>`
                );
                return $option;
            },
            templateSelection: function (data) {
                if (!data.id) {
                    return data.text;
                }
                var $emailTag = $(
                    `<span><img src="assets/images/profile.jpg" alt="profile picture"> ${data.text}</span>`
                );
                return $emailTag;
            }
        }).on('select2:select', function () {
            // Disable searching but keep the X (remove) button
            $(this).data('select2').$container.find('.select2-search').hide();
        }).on('select2:unselect', function () {
            // Re-enable the search bar when the selection is removed
            $(this).data('select2').$container.find('.select2-search').show();
        });
    }

    // Re-initialize Select2 when the modal is shown
    $('#addowner').on('shown.bs.modal', function () {
        initSelect2();
    });
});