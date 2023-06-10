$(document).ready(function(){
    $('.btn-delete-project').click(function(){
        $(this).prop('disabled', true);

        let imageId = $(this).data('image-id')

        $.post('delete-image', {
            imageId: imageId
        })
        .done(function(result){
            let apiResult = JSON.parse(result);

            if (!apiResult.data) {
                $('.btn-delete-project').prop('disabled', false);
                $('#image-delete-error-'+imageId).text('Failed delete image');
            } else {
                $('#image-div-'+imageId).remove();
            }

            console.log(apiResult.data);
        })
    });
});