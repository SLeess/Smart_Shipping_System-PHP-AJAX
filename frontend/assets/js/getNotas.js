$(document).ready(() => {
    $.ajax({
        url: '../app/api/endpoints/Usuario/GET_SessionUsuario.php',
        type: 'POST',
        data: {
            none: 0
        },
        success: (result) => {
            var resposta = JSON.parse(result);
            if(resposta.session == false){
                alert("Sessão inválida! Efetue login novamente");
                window.location.href = 'index.html';
            } else if(resposta.session == "desativado"){
                alert("Sessão inválida! Usuário desativado.");
                window.location.href = 'index.html';
            } else{
                gerarTituloPagina("Tabelas de Notas sem Monitoramento");
                gerarNavBar();

                if(resposta.session.permissao == 1){
                    //NÍVEL DE ADM É DIFERENTE
                    var buscador = "<div class='row'>"+
                                        "<p class='col-sm-8 offset-sm-2 col-md-11 offset-md-1' style='font-size: 1.5em;text-align: center;'>Selecione as notas desejadas para um novo monitoramento</p>"+
                                    "</div>"+
                                    "<div class='container'>"+
                                        "<div class='row justify-content-center'>"+
                                        "<button id= 'btnGerarMonitoramento' class='col-auto btn btn-outline-primary mt-3 mb-3'>Gerar monitoramento</button>"+
                                        "</div>"+
                                    "</div>"+
                                    "<div id='filtro' class='row'>"+
                                    "</div>";
                    document.getElementById("buscador").innerHTML = buscador;
                } 
            }
        }
    });

    $.ajax({
        url: '../app/api/endpoints/Negocio/GET_NotasSemMonitoramento.php',
        type: 'POST',
        data: {
            where: "teste"
        },
        success: (result) => {
            if (result === "none") {
                $("#table").html("<p style='text-align: center;'>O Banco não possui nenhuma nota sem monitoramento ativo</p>");
            } else {
                dados = JSON.parse(result);
                var confirm = "<table id='tabelaNotas' class='table-hover display nowrap'><caption>Lista de notas sem monitoramento ativo</caption><thead><tr><th scope='col'>#</th><th scope='col'>N° Nota</th><th scope='col'>Cliente</th><th scope='col'>Município</th><th scope='col'>Fornecedor</th><th scope='col'>Peso_Bruto</th><th scope='col'>Rota</th></tr></thead><tbody id='mytable'>";
                for (var i = 0; i < dados.length; i++) {
                    var idNota = dados[i]['n_nota'];

                    confirm += "<tr id='" + idNota + "' onclick='handleCliqueLinha(\"" + idNota + "\")'>";
                    confirm += "<th scope='row'></th>";
                    confirm += ("<td>" + idNota + "</td>");
                    confirm += ("<td>" + dados[i]['Cliente'] + "</td>");
                    confirm += ("<td>" + dados[i]['municipio'] + "</td>");
                    confirm += ("<td>" + dados[i]['fornecedor'] + "</td>");
                    confirm += ("<td>" + dados[i]['peso_bruto'] + "</td>");
                    confirm += ("<td>" + dados[i]['rota'] + "</td>");
                    confirm += "</tr>";
                }

                confirm += "</tbody></table>";
                $("#table").html(confirm);
                
                $("#tabelaNotas").css({
                    "box-shadow": "rgb(14 30 37 / 6%) 0px 2px 4px 0px, rgb(5 11 14 / 11%) 0px 2px 16px 0px",
                    "cursor": "pointer"
                });
                
                $('#tabelaNotas').DataTable({
                    language: {
                        url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"
                    },
                    pageLength: 10,
                    columnDefs: [
                        {
                            className: 'dtr-control',
                            orderable: false,
                            targets: 0
                        }
                    ],
                    order: [1, 'asc'],
                    responsive: {
                        details: {
                            type: 'column'
                        }
                    }
                });

                $('#tabelaNotas_filter label input').attr('id', 'meuId');
                gerarControle();
            }
        }
    });

    $('#btnGerarMonitoramento').on('click', function() {
        enviarIdsSelecionados();
    });
});

function gerarControle(){
    var result = "<div class='container'>"+
                    "<div class='row'>"+
                        "<div id='linh1'>"+
                            "<span>Qtd de notas selecionadas:</span>"+
                            "<input id='qtdLinhas' class='form-control' type='text' name='' value='0' disabled style='width: 60px; display: inline-block;'>"+
                        "</div>"+
                        "<div id='linh2'>"+
                            "<button id='btnSelecionarTodas' onclick='selecionarTodasLinhasVisiveis();'>Selecionar todas as linhas abaixo</button>"+
                        "</div>"+
                    "</div>"+
                    "<div id='linha3' class='row my-2'>"+
                        "<span id='pesoTotalSpan' style='text-align: start; width: 100px;'>Peso Total:</span>"+
                        "<input id='peso' class='form-control' type='text' name='' value='0' disabled style='width: 85px;  text-align: center;'>"+
                    "</div>"+
                "</div>"+
                "<br>";
    $("#filtro").html(result);
    $("#linh1").addClass('col-sm-7 col-md-6 col-lg-4 col-6 col-xl-4');
    $("#linh2").addClass('col-sm-4 offset-sm-1 col-md-5 offset-md-1 col-5 offset-1 col-lg-4 offset-lg-4 col-xl-3 offset-xl-5');
    $("#linh3").addClass('col-sm-3 col-lg-2 col-3 col-xl-3 col-md-2');
    $("#pesoTotalSpan").addClass('col-sm-2 col-lg-2 col-3 col-xl-3 col-md-2');
    $("#btnSelecionarTodas").addClass('btn btn-outline-primary col-md-auto');
}

//---------------------------------------------------------------------------------------------------
//                      PARTE DE GERAR MONITORAMENTO

var dados;
var linhasSelecionadas = [];
var pesoBrutoSelecionado = 0;

function calcularSomaPesoBruto() {
    pesoBrutoSelecionado = 0;

    for (var i = 0; i < linhasSelecionadas.length; i++) {
        var idNota = linhasSelecionadas[i];

        // Ajuste na indexação das colunas: 5 para a coluna correta (4 na indexação base 0)
        var pesoBrutoText = $("#" + idNota).find('td:eq(4)').text().trim();

        // Verificar se a string não está vazia antes de converter para float
        if (pesoBrutoText !== "") {
            var pesoBruto = parseFloat(pesoBrutoText);
            if (!isNaN(pesoBruto)) {
                pesoBrutoSelecionado += pesoBruto;
            }
        }
    }
    // Atualizar o valor no input de id "peso"
    atualizarPeso();
}


function toggleSelecao(idNota) {
    var index = linhasSelecionadas.indexOf(idNota);

    if (index === -1) {
        linhasSelecionadas.push(idNota);
        $('#' + idNota+ " td").css({
            "background-color":"#5B72B035"
        });
    } else {
        linhasSelecionadas.splice(index, 1);
        $('#' + idNota + " td").css({
            "background-color":"#5B72B000"
        });
    }
    atualizarQtdLinhas();
    calcularSomaPesoBruto();
}

function handleCliqueLinha(idNota) {
    toggleSelecao(idNota);

    // Adicione ou remova a classe de seleção à linha clicada
    $('#' + idNota).toggleClass('table-primary');
    atualizarQtdLinhas();
}

function atualizarQtdLinhas() {
    var qtdLinhasSelecionadas = linhasSelecionadas.length;
    $('#qtdLinhas').val(qtdLinhasSelecionadas);
}

function atualizarPeso() {
    var pesoFormatado = pesoBrutoSelecionado.toFixed(2);
    $('#peso').val(pesoFormatado);
}

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
        ArrayLinhas.forEach(element => {
            var idNota = $(element).find('td:eq(0)').text();
            handleCliqueLinha(idNota);
        });
    }
    calcularSomaPesoBruto();
}


function enviarIdsSelecionados() {
    if (linhasSelecionadas.length > 0) {
        $.ajax({
            url: 'gerarMonitoramento.php',
            type: 'POST',
            data: {
                linhasSelecionadas: linhasSelecionadas,
            },
            success: function(response) {
                var jsonResponse = JSON.parse(response);
                if (jsonResponse.success) {
                    // Após a resposta bem-sucedida, redirecionar para a view_gerar_monitoramento.php com o id_monitoramento
                    window.location.href = 'view_gerar_monitoramento.php?id_monitoramento=' + jsonResponse.id_monitoramento;
                } else {
                    console.log("Erro ao gerar monitoramento");
                }
            }
        });
        console.log("IDs das linhas selecionadas: " + linhasSelecionadas.join(','));
    } else {
        console.log("Nenhuma linha selecionada.");
    }
}