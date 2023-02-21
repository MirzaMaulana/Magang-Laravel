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
                userDatatable.ajax.reload();
                $("#delete-modal").modal("hide");
                confirmButton
                    .html("Yes, delete", false)
                    .prop("disabled", false);
            })
            .fail(function (err) {
                confirmButton
                    .html("Yes, delete", false)
                    .prop("disabled", false);
            });
    });
}
$(document).ready(function () {
    $(".close-modal").click(function () {
        $("#delete-modal").modal("hide");
    });
});
