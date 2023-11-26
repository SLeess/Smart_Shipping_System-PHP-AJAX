var dados;
var linhasSelecionadas = [];
function toggleSelecao(idNota) {
    var index = linhasSelecionadas.indexOf(idNota);

    if (index === -1) {
        linhasSelecionadas.push(idNota);
    } else {
        linhasSelecionadas.splice(index, 1);
    }
    // =================APAGAR ISSO==============================
    qtd = 0;
    if (linhasSelecionadas.length > 0) {
        linhasSelecionadas.forEach(element => {
            qtd++;
        });
        console.log("Quantidade de linhas no array: "+ qtd);
    } else {
        console.log("Nenhuma linha selecionada.");
    }    
    // ===============================================
    atualizarQtdLinhas();
}

// Função para lidar com o clique em uma linha
function handleCliqueLinha(idNota) {
    toggleSelecao(idNota);
    // console.log(idNota+"\n");
    // Adicione ou remova a classe de seleção à linha clicada
    $('#' + idNota).toggleClass('table-primary');
    atualizarQtdLinhas();
}

function atualizarQtdLinhas() {
    var qtdLinhasSelecionadas = linhasSelecionadas.length;
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
                var confirm = "<table id='tabelaNotas' class='table table-bordered table-hover table-sm'><caption>Lista de notas sem monitoramento ativo</caption><thead><tr><th scope='col'>#</th><th scope='col'>N° Nota</th><th scope='col'>Cliente</th><th scope='col'>Município</th><th scope='col'>Fornecedor</th><th scope='col'>Peso_Bruto</th></tr></thead><tbody id='mytable'>";
                for (var i = 0; i < dados.length; i++) {
                    var idNota = dados[i]['n_nota'];

                    confirm += "<tr id='" + idNota + "' onclick='handleCliqueLinha(\"" + idNota + "\")'>";
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
                
                // Css básico para elementos do html a partir de ID com Ajax
                $("#tabelaNotas").css({
                    "box-shadow": "rgb(14 30 37 / 6%) 0px 2px 4px 0px, rgb(5 11 14 / 11%) 0px 2px 16px 0px"
                });

                // Inicialize a tabela como uma DataTable
                
                $('#tabelaNotas').DataTable({
                    "language": {
                        "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"
                    },
                    "pageLength": 10, // Defina o número de linhas por página
                    "searching": false // Desabilita a barra de pesquisa
                });
            }
        }
    });

    $('#btnSelecionarTodas').on('click', () => {
        selecionarTodasLinhasVisiveis();
    });

    // função para selecionar todas as linhas visíveis nessa page
    function selecionarTodasLinhasVisiveis() {
        var tabela = $("#tabelaNotas").DataTable();
        var linhas = tabela.rows({ 'search': 'applied', 'page': 'current' }).nodes(); //Comando pra obter as linhas visíveis da tabela no HTML
        var qtd = 0;

        var ArrayLinhas = Array.from(linhas);
        ArrayLinhas.forEach(element => {
            var idNota = $(element).find('td:eq(0)').text();
            if (!linhasSelecionadas.includes(idNota)) {
                handleCliqueLinha(idNota);
                qtd++;
            }
        });

        if (qtd === 0) {
            // Todas as linhas já estão selecionadas - desselecione todas
            ArrayLinhas.forEach(element => {
                var idNota = $(element).find('td:eq(0)').text();
                handleCliqueLinha(idNota);
            });
        }
        // console.log(qtd + " linhas atualizadas\n");
    }

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