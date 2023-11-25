
var dados;
var linhasSelecionadas = [];
function toggleSelecao(idNota) {
    var index = linhasSelecionadas.indexOf(idNota);

    if (index === -1) {
        linhasSelecionadas.push(idNota);
    } else {
        linhasSelecionadas.splice(index, 1);
    }
}

// Função para lidar com o clique em uma linha
function handleCliqueLinha(idNota) {
    toggleSelecao(idNota);

    // Adicione ou remova a classe de seleção à linha clicada
    $('#' + idNota).toggleClass('selecionada');
    atualizarQtdLinhas();
}

function atualizarQtdLinhas() {
    var qtdLinhasSelecionadas = $('.linha.selecionada').length;
    $('#qtdLinhas').val(qtdLinhasSelecionadas);
}

$(document).ready(() => {
    // Função para adicionar ou remover ID da lista de linhas selecionadas
    $.ajax({
        url: 'consultaNotas.php',
        type: 'POST',
        data: {
            where: "teste"
        },
        success: (result) => {
            if (result === "none") {
                $("#table").html("<p style='text-align: center;'>O Banco não possui nenhuma nota sem monitoramento ativo</p>");
            } else {
                dados = JSON.parse(result);
                var confirm = "<table class='table'><thead><tr><th scope='col'>#</th><th scope='col'>N° Nota</th><th scope='col'>Cliente</th><th scope='col'>Município</th><th scope='col'>Fornecedor</th><th scope='col'>Peso_Bruto</th></tr></thead><tbody id='mytable'>";

                for (var i = 0; i < dados.length; i++) {
                    var idNota = dados[i]['n_nota'];

                    confirm += "<tr id='" + idNota + "' class='linha' onclick='handleCliqueLinha(\"" + idNota + "\")'>";
                    confirm += "<th scope='row'>" + (parseInt(i) + 1) + "</th>";
                    confirm += ("<td>" + idNota + "</td>");
                    confirm += ("<td>" + dados[i]['Cliente'] + "</td>");
                    confirm += ("<td>" + dados[i]['municipio'] + "</td>");
                    confirm += ("<td>" + dados[i]['fornecedor'] + "</td>");
                    confirm += ("<td>" + dados[i]['peso_bruto'] + "</td>");
                    confirm += "</tr>";
                }

                confirm += "</tbody></table>";
                $("#table").html(confirm);
            }
        }
    });

    // Função para enviar IDs das linhas selecionadas para outro arquivo PHP
    function enviarIdsSelecionados() {
        if (linhasSelecionadas.length > 0) {
            // Aqui você pode fazer uma requisição AJAX para enviar os IDs para outro arquivo PHP
            // Exemplo:
            // $.ajax({
            //     url: 'outroArquivo.php',
            //     type: 'POST',
            //     data: {
            //         ids: linhasSelecionadas.join(',')
            //     },
            //     success: function(response) {
            //         console.log(response);
            //     }
            // });

            // Para este exemplo, mostraremos os IDs no console
            console.log("IDs das linhas selecionadas: " + linhasSelecionadas.join(','));
        } else {
            console.log("Nenhuma linha selecionada.");
        }
    }

    $("#pesquisar").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#mytable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    $.ajax({
        url: '../elements/navbarDD.php',
        type: 'POST',
        data: {
            relative: '../' // Passe o ID desejado aqui
        },
        success: (result) => {
            $("#navbarSt").html(result);

            // Adicione a classe "active" ao elemento desejado
            // $('#home-tab').addClass('active');
        }
    });
    
});