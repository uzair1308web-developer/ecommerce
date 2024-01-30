// let table = new DataTable('#myTable');

$(document).ready(function () {
    $('#myTable').DataTable({
        dom: 'Bfrtip',
        // buttons: [
            //     'copy', 'csv', 'excel', 'pdf', 'print'
            // ]
        buttons: [
            {
                extend: 'copy',
                text: "<i class='bi bi-file-earmark-text-fill'></i>",
                className: 'btn btn-warning buttons-excel buttons-html5 DT_ExcelExport dt_copy_btn'
            },
            {
                extend: 'csv',
                text: "<i class='fa-solid fa-file-csv'></i>",
                className: 'btn btn-primary buttons-html5 DT_ExcelExport dt_csv_btn'
            },
            {
                extend: 'excel',
                text: "<i class='fa-solid fa-file-excel'></i>",
                className: 'btn btn-success buttons-html5 DT_ExcelExport dt_excel_btn'
            },
            {
                extend: 'pdf',
                text: "<i class='bi bi-file-pdf-fill'></i>",
                className: 'btn btn-danger  buttons-html5 DT_ExcelExport dt_pdf_btn'
            },
            
        ],
        "Pagination": "", 
    });
});



$(".image").on("click", function () {
    var inputName = $(this).find('input').val();
    console.log(inputName)
    show_modal('media-modal')
    localStorage.setItem("singleImg", inputName);
});

function show_modal(modal_id) {
    $("#" + modal_id).modal('show')
}




function setMediaSelection(final_input, img_box, multiple) {
    localStorage.setItem("finalInput", final_input);
    localStorage.setItem("img_box", img_box);
    localStorage.setItem("multiple", multiple);

    show_modal('media-modal-one')
}



function checkMedia(media_id) {
    let multiple = localStorage.getItem("multiple");
    let selected_img = $("[data-selected]")
    let next_selection;
    let selection_arr = []
    if (multiple == "false") {
        $(".modalone-checkbox").removeAttr('data-selected');

        if ($("#" + media_id).prop("checked") == true) {
            $("#" + media_id).prop("checked", false);
            $("#" + media_id).removeAttr('data-selected');
        } else if ($("#" + media_id).prop("checked") == false) {
            $(".modalone-checkbox").prop("checked", false);

            $("#" + media_id).prop("checked", true);
            $("#" + media_id).attr('data-selected', 1)
        }
    } else {
        if ($("#" + media_id).prop("checked")) {
            $("#" + media_id).prop("checked", false);
            $("#" + media_id).removeAttr('data-selected');
        } else {

            if (selected_img.length > 0) {
                $.each(selected_img, function () {
                    selection_arr.push($(this).attr('data-selected'))
                });

                selection_arr.sort((a, b) => b - a);
                next_selection = parseInt(selection_arr[0])

                next_selection++;

            } else {
                next_selection = 1;
            }
            $("#" + media_id).attr('data-selected', next_selection)
            $("#" + media_id).prop("checked", true);
        }
    }
}



function selectMedia(modal_id) {
    let final_input = localStorage.getItem("finalInput");
    let to = localStorage.getItem("img_box");

    $("#" + final_input).val("");
    $("#" + to)
        .find("img")
        .remove();

    let selectedMediaArr = [];
    let modalCheckbox = $(".modalone-checkbox");
    let dataSelection = []

    modalCheckbox.each(function () {
        if ($(this).prop("checked")) {
            let dataSelected = $(this).attr('data-selected')
            dataSelection.push(dataSelected)
        }
    });

    dataSelection.sort((a, b) => a - b)

    dataSelection.forEach(element => {
        let selected_img = $("input[data-selected=" + element + "]")
        let dataurl = selected_img.attr("data-url");
        let value = selected_img.val()

        $("#" + to).append(
            `<img src='${dataurl}' style='max-height:150px; width:150px;'>`
        );

        let jsonData = {
            file_id: value,
        };
        selectedMediaArr.push(jsonData);
    });


    $("#" + final_input).attr("value", JSON.stringify(selectedMediaArr));
    $(".modalone-checkbox").prop("checked", false);
    $("#" + modal_id).modal("hide");
}

function cancelMedia(modal_id) {
    let final_input = localStorage.getItem("finalInput");
    let to = localStorage.getItem("img_box");
    $("#" + final_input).val("");
    $("#" + to)
        .find("img")
        .remove();
    $(".modalone-checkbox").prop("checked", false);
    $("#" + modal_id).modal("hide");
}


// function getModalMedia() {
//     $.ajax({
//         type: "Post",
//         url: "/admin/ajax-request",
//         data: {
//             isset_get_modal_media: true,
//         },
//         success: function (response) {
//             let status = response["status"];
//             let media = response["media"];

//             if (status === true) {

//                 media.forEach((e) => {
//                     let id = e["id"];
//                     let url = e["url"];
//                     $("#media-modal-img-box").append(`
//                     <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-2 modal-col">
//                     <div class="modal-img modal-one-img">
//                         <input type="checkbox" name="media-img" class="form-check-input modalone-checkbox"
//                             value="${id}" id="mediaone${id}"
//                             data-url="${url}">
//                         <img src="${url}">
//                         <div class="media-overlay"
//                             onclick="checkMedia('mediaone${id}','img')"></div>
//                         <a href="#"
//                             onclick="modalImageViewer('${url}')"
//                             class="text-success view-media-btn"><i class="fa-solid fa-eye"></i></a>
//                      </div>
//                    </div>
//                       `);
//                 });
//                 modalMediaPage++;

//                 $('#media-modal-load-more').html(`
//                 <div class="col-12 my-2 text-center">
//                    <button type="button" class="btn btn-primary" onclick="getModalMedia()">Load More</button>
//                 </div>
//                 `)

//             } else {
//                 $('#media-modal-load-more').html(`
//                  <div class="col-12 my-2 text-center">
//                       <span>No more content</span>
//                  </div>
//                  `)
//             }
//             show_modal("media-modal-one");
//         },
//     });
// }