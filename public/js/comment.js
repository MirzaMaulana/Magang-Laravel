function destroy(event) {
    event.preventDefault();

    $("#delete-modal").modal("show");

    $("#confirm-delete").on("click", function () {
        const confirmButton = $(this);
        confirmButton
            .html('<i class="fa fa-spinner fa-spin"></i> Deleting...')
            .prop("disabled", true);

        $.ajax({
            url: event.target.action,
            type: event.target.method,
            data: $(event.target).serialize(),
        })
            .done(function (res) {
                $("#delete-modal").modal("hide");
                confirmButton
                    .html("Yes, delete", false)
                    .prop("disabled", false);
                location.reload();
            })
            .fail(function (err) {
                confirmButton
                    .html("Yes, delete", false)
                    .prop("disabled", false);
                // toastr.error(err.responseJSON.message);
            });
    });
}
$(document).ready(function () {
    $(".close-modal").click(function () {
        $("#delete-modal").modal("hide");
    });
});

$(document).ready(function () {
    $("form").submit(function () {
        $("#button").attr("disabled", true);
    });
});
$(document).ready(function () {
    $("form").submit(function () {
        $(".button").attr("disabled", true);
    });
});
