$(function () {
    $(document).on("change", "#estado_endereco", function () {
        var id = $(this).val();
        $.ajax({
            method: 'get',
            url: "/sistema/endereco/get-cidades/" + id,
            success: function (response) {
                $("#cidade_endereco").html(response);
            }
        });
    });
});