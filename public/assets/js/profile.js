var $crop;

$(function () {

    $("#btn-modal-change-avatar").click(function(){
        $("#modal-change-avatar").modal();
    });

    $('#btn-file-avatar').change(function () {

        var oFReader = new FileReader();
        oFReader.readAsDataURL(this.files[0]);

        oFReader.onload = function (oFREvent) {
            if ($crop != undefined) {
                $crop.cropper('destroy');
            }

            $("#preview-img-avatar").attr("src", oFREvent.target.result);

            loadCropper();

        };


    });
});

function loadCropper() {

    $crop = $(".bootstrap-modal-cropper > img"),
        $dataX = $("#dataX"),
        $dataY = $("#dataY"),
        $dataHeight = $("#dataHeight"),
        $dataWidth = $("#dataWidth");

    $crop.cropper({
        multiple: true,
        aspectRatio: 1,
        done: function (data) {
            $dataX.val(Math.round(data.x));
            $dataY.val(Math.round(data.y));
            $dataHeight.val(Math.round(data.height));
            $dataWidth.val(Math.round(data.width));
        }
    });


    /*on("hidden.bs.modal", function () {
     originalData = $image.cropper("getData");
     $image.cropper("destroy");
     });*/
}