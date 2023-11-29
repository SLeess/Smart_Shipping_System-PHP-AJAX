$(document).ready(() => {
    $.ajax({
        url: '../elements/navbarDD.php',
        type: 'POST',
        data: {
            relative: '../' // Passe o ID desejado aqui
        },
        success: (result) => {
            $("#navbarSt").html(result);

            // Adicione a classe "active" ao elemento desejado
            $('#mapa-tab').addClass('active');
        }
    });

    $("#btnBuscar").click(() => {
        $.ajax({
            url: "control_get_products.php",
            type: 'POST',
            data: {
                dataLancamento: $("#dataLancamento").val()
            },
            success: (dados) => {
                try {
                    var idMonitoramentos = []; // Array para armazenar os id_monitoramento

                    var confirm;
                    if (dados['message'] === "none") {
                        confirm = "<p style='text-align: center;'>O Banco não possui nenhuma nota sem monitoramento ativo</p>";
                    } else {
                        for (const id_monitoramento in dados) {
                            idMonitoramentos.push(id_monitoramento);
                            confirm += `<h3 class="m-2 mt-3">ID Monitoramento: ${id_monitoramento}</h3>`;
                            confirm += "<div class='table-responsive col-md-12 col-11 offset-1 offset-sm-0 p-2'><table id='tabelaMapa" + id_monitoramento + "' class='tablemapa table table-bordered table-hover mt-2'><thead><tr><th scope='col'>#</th><th scope='col'>Operação</th><th scope='col'>Codigo</th><th scope='col'>Descricao</th><th scope='col'>Peso</th><th scope='col'>Quantidade</th><th scope='col'>Data Produção</th><th scope='col'>Data Validade</th></tr></thead><tbody>";

                            for (let i = 0; i < dados[id_monitoramento].length; i++) {
                                confirm += "<tr>";
                                confirm += "<th scope='row'>" + (i + 1) + "</th>";
                                confirm += ("<td>" + dados[id_monitoramento][i]['fornecedor'] + "</td>");
                                confirm += ("<td>" + dados[id_monitoramento][i]['cod'] + "</td>");
                                confirm += ("<td>" + dados[id_monitoramento][i]['descricao'] + "</td>");
                                confirm += ("<td>" + dados[id_monitoramento][i]['Peso'] + "</td>");
                                confirm += ("<td>" + dados[id_monitoramento][i]['quantidade'] + "</td>");
                                confirm += ("<td>" + dados[id_monitoramento][i]['data_producao'] + "</td>");
                                confirm += ("<td>" + dados[id_monitoramento][i]['data_validade'] + "</td>");

                                confirm += "</tr>";
                            }
                            confirm += "</tbody></table></div>";
                        }
                    }
                    $("#resultado").html(confirm.replace("undefined", ""));
                    idMonitoramentos.forEach(id => {
                        $('#tabelaMapa' + id).DataTable({
                            "language": {
                                "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"
                            },
                            "pageLength": 5,
                            // Outras opções se necessário
                        });
                        // $("#tabelaMapa"+id).addClass("row");
                    });
                } catch (e) {
                    console.error("Erro ao analisar JSON:", e);
                }
            },
            error: function (xhr, status, error) {
                console.error("Erro na requisição Ajax:", status, error);
            }
        });
    });
});
