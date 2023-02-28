$(document).ready(function () {
    $("form").submit(function () {
        $("button[type='submit']")
            .html('<i class="fa fa-spinner fa-spin"></i> Loading...')
            .attr("disabled", true);
    });
});
