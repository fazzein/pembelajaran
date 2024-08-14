var Siswa = function () {
    var Trans = {
        'materi.required': 'Materi harus diisi',
    };

    var handleForm = function () {
        const $form = $('#form-siswa');

        $form.off('submit').on('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                text: 'Please wait a moment',
                icon: 'info',
            });

            var formData = new FormData(this);

            $.ajax({
                url: $form.attr('action'),
                type: 'post',
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                success: (res) => {
                    Swal.fire({
                        title: res.message || 'Data saved.',
                        icon: 'success',
                    }).then(() => {
                        if(res.redirect) {
                            window.location.href = res.redirect;
                        }
                    });
                },
                error: (e) => {
                    const res = e.responseJSON || {};
                    if(res.errors) {
                        const message = Object.values(res.errors)[0] || [];
                        Swal.fire({
                            title: 'Error!',
                            text: message[0],
                            icon: 'error',
                        });
                        for(let key of Object.keys(res.errors)) {
                            const messages = res.errors[key];
                            $('[name="' + key + '"]', $form).toggleError(true, messages[0])
                        }
                    } else {
                        Swal.fire({
                            title: res.message || 'Unknown Error!',
                            icon: 'error',
                        });
                    }
                },
                complete: () => {},
            });
            return false;
        });
    };

    var handleSelect = function () {
        // Add any select handling logic if required
    };

    return {
        init: function () {
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')},
                error : function (data) {
                    const resJson = data.responseJSON || {};
                    if(data.status === 422) {
                        var errors = resJson.errors || [];
                        $('.errorTxt1').remove();
                        $.each(errors, function (key, value) {
                            let $inputField = $(':input[name='+ key +']').closest('.input-field'),
                                $html = '<small class="errorTxt1"><div id="'+ key +'-error" class="invalid-feedback">'+ value +'</div></small>';
                            $inputField.append($html);
                        });
                    } else if(resJson.message) {
                        Swal.fire({icon: 'error', text: resJson.message});
                    }
                },
                complete: function () {
                    // Any completion logic if required
                }
            });
        },
        initForm: function () {
            handleForm();
        },
        initSelect: function(){
            handleSelect();
        }
    };
}();

$(document).ready(function(){
    Siswa.init();
});
