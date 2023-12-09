var i = setInterval(function () {
    clearInterval(i);

    // O código desejado é apenas isto:
    document.getElementById("loader").classList.remove("loader");
    document.getElementById("loader").classList.add("hide");
    document.getElementById("conteudo").classList.remove("hide");
}, 1500);

$(document).ready(() => {
    $(document).on('input', '#usuario', function () {
        const nomeUsuario = $(this).val().replace(/[^A-Za-z0-9._`´À-ÖØ-öø-ÿ ]+/g, '');
        $(this).val(nomeUsuario);
    });

    $(document).on('input', '#senha', function () {
        const nomeUsuario = $(this).val().replace(/[^A-Za-z0-9 ]+/g, '');
        $(this).val(nomeUsuario);
    });
});