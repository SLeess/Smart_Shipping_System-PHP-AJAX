$(document).ready(function() {
    $('#btnBuscar').click(function(event) {
        event.preventDefault();
        buscarProdutos();
    });
});

function buscarProdutos() {
    const dataLancamento = document.getElementById('dataLancamento').value;
    console.log('Data de Lançamento:', dataLancamento);

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'get_products.php', true);

    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            console.log('Status da Requisição:', xhr.status);
            console.log('Resposta do Servidor:', xhr.responseText);

            try {
                const dados = JSON.parse(xhr.responseText);
                console.log('Dados:', dados);

                var confirm;
                if (dados.message === "none") {
                    confirm = "<p style='text-align: center;'>O Banco não possui nenhuma nota sem monitoramento ativo</p>";
                } else {
                    // Exemplo de iteração sobre o JSON agrupado
                    for (const id_monitoramento in dados) {
                        confirm += `<h3>ID Monitoramento: ${id_monitoramento}</h3>`;
                        confirm += "<table id='tabelaMapa' class='tablemapa table table-bordered table-hover table-sm'><thead><tr><th scope='col'>#</th><th scope='col'>Operação</th><th scope='col'>Codigo</th><th scope='col'>Descricao</th><th scope='col'>Peso</th><th scope='col'>Quantidade</th><th scope='col'>Data Produção</th><th scope='col'>Data Validade</th></tr></thead><tbody>";

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
                        confirm += "</tbody></table>";
                    }
                }
                $("#resultado").html(confirm);
                $('#tabelaMapa').DataTable({
                    "language": {
                        "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"
                    },
                    "pageLength": 10, // Defina o número de linhas por página
                    // "searching": false 
                    // Desabilita a barra de pesquisa
                });
            } catch (error) {
                console.error('Erro ao analisar JSON:', error);
            }
        }
    };

    xhr.send('dataLancamento=' + encodeURIComponent(dataLancamento));
}