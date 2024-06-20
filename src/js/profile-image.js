$(document).ready(function imageUploadrun() {
    $(".image-upload__input").change(function() {
        $fileInputLabel = $(this).parent();
        $filePreview = $fileInputLabel.find('.image-upload__preview');
        $fileInputPath = $fileInputLabel.find('.image-upload__path');

        var path = $(this).val().split('\\').pop();
        $fileInputPath.html(path);
        var reader = new FileReader();
        reader.onload = function(e) {
            $filePreview.css('background-image', 'url(' + e.target.result + ')');
        };
        reader.readAsDataURL(this.files[0]);
    });

    $(".clear-form").click(function() {
        var entityID = "#" + $(this).attr("data-target");
        $fileInputLabel = $(entityID);
        $filePreview = $fileInputLabel.find('.image-upload__preview');
        $fileInputPath = $fileInputLabel.find('.image-upload__path');

        $fileInputPath.html("Choose file");
        $filePreview.removeAttr('style');

    });
});