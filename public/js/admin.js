jQuery(document).ready(function ($) {
    // Only show the "remove image" button when needed
    if (!$("#slider_thumbnail_id").val()) {
        $(".remove_image_button").hide();
    }

    // Uploading files
    var file_frame;

    $(document).on("click", "#slider_thumbnail", function (event) {
        event.preventDefault();

        // If the media frame already exists, reopen it.
        if (file_frame) {
            file_frame.open();
            return;
        }

        // Create the media frame.
        file_frame = wp.media.frames.downloadable_file = wp.media({
            title: "Choose an image",
            button: {
                text: "Select Slider",
            },
            multiple: false,
        });

        // When an image is selected, run a callback.
        file_frame.on("select", function () {
            var attachment = file_frame
                .state()
                .get("selection")
                .first()
                .toJSON();
            var attachment_thumbnail =
                attachment.sizes.thumbnail || attachment.sizes.full;

            $("#slider_thumbnail_id").val(attachment.id);
            $("#slider_thumbnail").css(
                "background-image",
                `url(${attachment_thumbnail.url})`
            );
            // $(".remove_image_button").show();
            $("#slider_thumbnail_placeholder").css("z-index", "-1");
        });

        // Finally, open the modal.
        file_frame.open();
    });

    $(document).on("click", ".remove_image_button", function () {
        $("#slider_thumbnail").find("img").attr("src", "");
        $("#slider_thumbnail_id").val("");
        $(".remove_image_button").hide();
        return false;
    });

    $(document).ajaxComplete(function (event, request, options) {
        if (
            request &&
            4 === request.readyState &&
            200 === request.status &&
            options.data &&
            0 <= options.data.indexOf("action=add-tag")
        ) {
            var res = wpAjax.parseAjaxResponse(
                request.responseXML,
                "ajax-response"
            );
            if (!res || res.errors) {
                return;
            }
            // Clear Thumbnail fields on submit
            $("#slider_thumbnail").find("img").attr("src", "");
            $("#slider_thumbnail_id").val("");
            $(".remove_image_button").hide();
            // Clear Display type field on submit
            $("#display_type").val("");
            return;
        }
    });
});
