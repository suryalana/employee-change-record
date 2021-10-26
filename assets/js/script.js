function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {

                        $('#blah').attr('src',e.target.result);
                        alert($("#myName").val());
                        console.log($("#myName").val())
                    //$('#blah')
                       // .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah1').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgInp").change(function(){
    readURL(this);
});
 
function changeName(){
 $("#myName").on('change',function(){
var quantity=$("#myName").val();
//var discount=$("#discount").val();
if(quantity!=""){
alert("Abc")
}

}); 
}