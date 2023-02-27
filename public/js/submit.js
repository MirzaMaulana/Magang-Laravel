$(document).ready(function () {
    $("form").submit(function () {
        $("button")
            .html('<i class="fa fa-spinner fa-spin"></i> Loading...')
            .attr("disabled", true);
    });
});
