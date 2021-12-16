function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {

            $('#blah').attr('src', e.target.result);
            alert($("#employee_name").val());
            console.log($("#employee_name").val())
            //$('#blah')
            // .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function changeName() {
    $("#employee_name").on('change', function () {
        var quantity = $("#employee_name").val();
        //var discount=$("#discount").val();
        if (quantity != "") {
            alert("Abc")
        }

    });
}
