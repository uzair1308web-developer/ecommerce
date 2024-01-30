
$("#hr-form").submit(function (event) {
    $('#hr-form-btn').html(`<div class="spinner-border spinner-border-sm text-light" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>`)
    event.preventDefault()

    var formData = {
        name: $("#hr_name").val(),
        email: $("#hr_email").val(),
        subject: $("#hr_subject").val(),
        number: $("#hr_number").val(),
        message: $("#hr_message").val(),
    };
    $.ajax({
        type: "post",
        url: "mail_for_hr.php",
        data: formData,

        success: function (response) {
            //   console.log(response)
            response = JSON.parse(response);
            if (response['status']) {
                document.querySelector('#hr-form').reset();
                $('#hr-form-btn').html(`SEND MESSAGE`);
                $('#form-submit-div').html(`<div class="position-relative ms-4 alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Thank You!</strong> Your form is submitted successfuly
                </div>`)
                setTimeout(removeAlert, 5000);
            }
        }
    })
});


$("#contact-form").submit(function (event) {
    $('#contact-form-btn').html(`<div class="spinner-border spinner-border-sm text-light" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>`)

    event.preventDefault()
    // alert('kk')
    var formData = {
        name: $("#contact_name").val(),
        email: $("#contact_mail").val(),
        subject: $("#contact_subject").val(),
        number: $("#contact_number").val(),
        message: $("#contact_message").val(),
    };
    // var form = document.getElementById('contact-form')
    // var form_data = new FormData();
    // console.log(form_data)
    // alert('hello')
    $.ajax({
        type: "post",
        url: "contact_mail.php",
        data: formData,

        success: function (response) {
            response = JSON.parse(response);
            if (response['status']) {
                document.querySelector('#contact-form').reset();
                $('#contact-form-btn').html(`SEND MESSAGE`);
                $('#form-submit-div').html(`<div class="position-relative ms-4 alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Thank You!</strong> Your form is submitted successfuly
                </div>`)
                setTimeout(removeAlert, 5000);
            }
        }
    })
});

function removeAlert() {
    $('#form-submit-div').html(``);
}