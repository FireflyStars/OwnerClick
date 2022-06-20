import {render} from "@fullcalendar/core";
import "bootstrap-fileinput/js/locales/tr";

window.fileinputs = {
    render: function (modalID, element) {
        let query = '';
        let url_list = $(element).attr('data-list');
        let url_upload = $(element).attr('data-upload');
        let url_delete = $(element).attr('data-delete');
        let type_id = $(element).attr('data-type_id');
        let contract_id = $(element).attr('data-contract_id');
        if (contract_id) {
            query += '&contract_id=' + contract_id
        }
        let note_id = $(element).attr('data-note_id');
        if (note_id) {
            query += '&note_id=' + note_id
        }

        let outgoing_id = $(element).attr('data-outgoing_id');
        if (outgoing_id) {
            query += '&outgoing_id=' + outgoing_id
        }

        let payment_id = $(element).attr('data-payment_id');
        if (payment_id) {
            query += '&payment_id=' + payment_id
        }

        let fixture_id = $(element).attr('data-fixture_id');
        if (fixture_id) {
            query += '&fixture_id=' + fixture_id
        }

        let person_id = $(element).attr('data-person_id');
        if (person_id) {
            query += '&person_id=' + person_id
        }

        let unit_id = $(element).attr('data-unit_id');
        if (unit_id) {
            query += '&unit_id=' + unit_id
        }

        let create = $(element).attr('data-create');
        if (create) {
            query += '&create=' + create
        }


        $.getJSON(url_list + "?type_id=" + type_id + query, function (data) {
                $(element).fileinput('destroy');
            let browseOnZoneClick = true;
            if ($(element).attr('data-onlyread')) {
                    browseOnZoneClick = false;
                } else {
                    browseOnZoneClick = true;
                }
                console.log(browseOnZoneClick)

                $(element).fileinput({
                    theme: 'fas',
                    language: user.locationIso2,
                    uploadUrl: url_upload + "?type_id=" + type_id,
                    deleteUrl: url_delete,
                    uploadAsync: true,

                    allowedFileTypes: ["image", "video", "text", "pdf", "office", "gdocs"],
                    fileActionSettings: {
                        showRemove: true,
                        showDrag: false,
                        showUpload: false,
                        showDownload: false,
                    },
                    // minFileCount: 2,
                    showCaption: false,
                    showRemove: false,
                    showUpload: false,
                    showClose: false,
                    showBrowse: false,
                    browseOnZoneClick: browseOnZoneClick,
                    maxFileCount: 20,
                    overwriteInitial: false,
                    initialPreview: data.fileList,
                    initialPreviewAsData: true, // identify if you are sending preview data only and not the raw markup
                    initialPreviewConfig: data.initialPreviewConfig,
                    // initialPreviewFileType: 'image', // image is the default and can be overridden in config below
                    // initialPreviewDownloadUrl: 'https://kartik-v.github.io/bootstrap-fileinput-samples/samples/{filename}', // includes the dynamic `filename` tag to be replaced for each config
                    // initialPreviewConfig: [
                    //     {caption: "Desert.jpg", size: 827000, width: "10px", url: "/file-upload-batch/2", key: 1},
                    //     {caption: "Lighthouse.jpg", size: 549000, width: "10px", url: "/file-upload-batch/2", key: 2},
                    //     {
                    //         type: "video",
                    //         size: 375000,
                    //         filetype: "video/mp4",
                    //         caption: "KrajeeSample.mp4",
                    //         url: "/file-upload-batch/2",
                    //         key: 3,
                    //         downloadUrl: 'https://kartik-v.github.io/bootstrap-fileinput-samples/samples/small.mp4', // override url
                    //         filename: 'KrajeeSample.mp4' // override download filename
                    //     },
                    //     {type: "office", size: 102400, caption: "SampleDOCFile_100kb.doc", url: "/file-upload-batch/2", key: 4},
                    //     {type: "office", size: 45056, caption: "SampleXLSFile_38kb.xls", url: "/file-upload-batch/2", key: 5},
                    //     {type: "office"},
                    //     {type: "gdocs", size: 811008, caption: "multipage_tiff_example.tif", url: "/file-upload-batch/2", key: 7},
                    //     {type: "gdocs", size: 375808, caption: "sample_ai.ai", url: "/file-upload-batch/2", key: 8},
                    //     {type: "office", size: 40960, caption: "sample_eps.eps", url: "/file-upload-batch/2", key: 9},
                    //     {type: "pdf", size: 8000, caption: "About.pdf", url: "/file-upload-batch/2", key: 10, downloadUrl: false}, // disable download
                    //     {type: "text", size: 1430, caption: "LoremIpsum.txt", url: "/file-upload-batch/2", key: 11, downloadUrl: false},  // disable download
                    //     {type: "html", size: 3550, caption: "LoremIpsum.html", url: "/file-upload-batch/2", key: 12, downloadUrl: false},  // disable download
                    //     {type: "office",key:13},
                    // ],
                }).on('filesorted', function (e, params) {
                    console.log('File sorted params', params);
                }).on('fileuploaded', function (e, params) {
                    console.log('File uploaded params', params);
                    console.log(params.response.data.id)
                    $(element).closest('form').append($('<input>').attr({
                        type: 'hidden',
                        id: 'files[]',
                        name: 'files[]',
                        value: params.response.data.id
                    }))
                    $('[aria-valuenow="100"]').closest('.progress').hide()
                }).on("filebatchuploadcomplete", function (event, files) {
                    let submitButton = $(element).closest('form').find('button[type="submit"]');
                    if ($(submitButton).attr('data-text-original')) {
                        $(submitButton).text($(submitButton).attr('data-text-original')).attr('disabled', false);
                    }
                }).on("filebatchselected", function (event, files) {
                    $(element).fileinput("upload");
                }).on('filepreajax', function (event, previewId, index) {
                    let submitButton = $(element).closest('form').find('button[type="submit"]');
                    if (!$(submitButton).attr('data-text-original')) {
                        $(submitButton).attr('data-text-original', submitButton.text());
                    }
                    submitButton.text('Dosya Yükleniyor...').attr('disabled', true);
                });
            }
        )
    },
    folderListener: function (modalID, element) {
        $(document).find('.file-folders-button').on('click', function () {
            console.log($(this));
            $(this).closest('.file-folders-button-area').find('.file-folders-button').removeClass('active')
            $(this).addClass('active')
            $(element).attr('data-type_id', ($(this).attr('data-type_id')))
            window.fileinputs.render(modalID, element)

        })

        $('.file-folders-button.active').click();
    }
}
