$(function () {
    'use strict';

    let codeMirrors = CodeMirror.fromTextArea(document.getElementById("editor"), {
        mode: "text/x-java",
        indentWithTabs: true,
        smartIndent: true,
        lineNumbers: true,
        lineWrapping: true,
        matchBrackets: true,
        autofocus: true,
        theme: "duotone-dark",
    });

    codeMirrors.setSize(null, 700);

    $('.btn-validate').on('click', function () {
        let btnValidate = $(this);
        let editorContainer = $('.editor-container');

        btnValidate.prop('disabled', true);
        editorContainer.block({
            message: '<div class="spinner-grow text-light" role="status"><span class="sr-only">Loading...</span></div>',
            css: {
                backgroundColor: 'transparent',
                color: '#fff',
                border: '0'
            },
            overlayCSS: {
                opacity: 0.5
            }
        });

        $.post(global.doTask, {
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'code': codeMirrors.getValue()
        }, function (response) {
            if (Object.hasOwn(response, 'data')) {
                let data = response.data;
                console.log(data);
                if (Object.hasOwn(data, 'history_appends')) {
                    let appends = data.history_appends;
                    let status = '';

                    if (appends.status === 'FAILURE') {
                        btnValidate.prop('disabled', false);
                        status = '<span class="right badge badge-danger">'+appends.status+'</span>'
                    } else {
                        status = '<span class="right badge badge-success">'+appends.status+'</span>'
                    }

                    $('.no-history').remove();
                    $('.datatable-taskHistory tbody').append(
                        '<tr>' +
                        '<td>' + appends.created_id + '</td>' +
                        '<td>' + appends.raw + '</td>' +
                        '<td>' + status + '</td>' +
                        '<td>' + appends.report + '</td>' +
                        '</tr>'
                    );
                }
            } else {
                alert('Something went wrong.')
            }
        }).done(function (data) {
            editorContainer.unblock();
        });
    });
});


