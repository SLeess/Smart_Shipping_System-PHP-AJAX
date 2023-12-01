$(document).ready(() => {
    $.ajax({
        url: 'elements/E_navbar.php',
        type: 'POST',
        data: {
            relative: '' // Passe o ID desejado aqui
        },
        success: (result) => {
            $("#navbarSt").html(result);

            // Adicione a classe "active" ao elemento desejado
            $('#perfis-tab').addClass('active');
        }
    });
});