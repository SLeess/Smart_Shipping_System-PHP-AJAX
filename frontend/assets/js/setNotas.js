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
            }
            if(resposta.session.permissao != 1){
                alert("Acesso negado! Permissão de administrador necessária para acessar esse arquivo.");
                window.location.href = 'home.html';
            }
            gerarTituloPagina("Escaner de Notas Fiscais");
            gerarNavBar(1, resposta.session.usuario);
        }
    });
    
    $("#btnSelecionar").on('click', function() {
        Exibir();
    });

    var dataAtual = new Date();
    var ano = dataAtual.getFullYear();
    var mes = (dataAtual.getMonth() + 1).toString().padStart(2, '0'); // Adiciona zero à esquerda se for menor que 10
    var dia = dataAtual.getDate().toString().padStart(2, '0');

    var dataFormatada = ano + '-' + mes + '-' + dia;

    document.getElementById('dataAurora').value = dataFormatada;
    document.getElementById('dataCruzeiro').value = dataFormatada;
    document.getElementById('dataSuinco').value = dataFormatada;
    document.getElementById('dataPlena').value = dataFormatada;
});

function Exibir() {
    var valor = document.getElementById('inputGroupSelect03').value;

    // Verifica se algum dos elementos já teve a classe "hide" removida
    var elementos = ['Aurora', 'Cruzeiro', 'Plena', 'Suinco'];
    var algumElementoExibido = elementos.some(function (elemento) {
        var el = document.getElementById(elemento);
        return el && el.classList.contains('hide');
    });

    // Adiciona a classe "hide" aos elementos que já foram exibidos
    if (algumElementoExibido) {
        elementos.forEach(function (elemento) {
            var el = document.getElementById(elemento);
            if (el && elemento !== valor) {
                el.classList.add('hide');
            }
        });
        document.getElementById("hr").classList.add('hide');
        op = document.getElementById('output');
    }

    // Remove a classe "hide" do elemento atual
    var elementoAtual = document.getElementById(valor);
    if (elementoAtual) {
        elementoAtual.classList.remove('hide');
        document.getElementById("hr").classList.remove('hide');
    }
}

//------------------------------MANIPULAÇÃO DE NOTAS EM XMLS E XSLS--------------------------------

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('scanButtonAurora').addEventListener('click', function () {
        // console.log('Botão foi clicado.');

        const xmlForm = document.getElementById('xmlForm');
        const outputDiv = document.getElementById('outputAurora');
        const loadingDiv = document.getElementById('loadingAurora');
        const progressBar = document.getElementById('progressBarAurora');
        const dataAuroraInput = document.getElementById('dataAurora');

        const formData = new FormData(xmlForm);

        // Adicione o valor do campo de data ao FormData
        formData.append('dataAurora', dataAuroraInput.value);

        // Verifique se existem arquivos anexados antes de enviar a solicitação
        if (formData.has('xmlFilesInput[]')) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../app/api/endpoints/Negocio/POST_processAurora.php', true);
            xhr.upload.onprogress = function (e) {
                if (e.lengthComputable) {
                    const percent = (e.loaded / e.total) * 100;
                    progressBar.value = percent;
                }
            };
            xhr.onloadstart = function () {
                loadingDiv.classList.remove('hide');
                progressBar.classList.remove('hide');
                progressBar.value = 0;
            };
            xhr.onload = function () {
                if (xhr.status === 200) {
                    loadingDiv.classList.add('hide');
                    progressBar.classList.add('hide');
                    progressBar.value = 100;
                    outputDiv.innerHTML = xhr.responseText;
                }
            };
            xhr.send(formData);
        } else {
            alert('Nenhum arquivo selecionado para envio.');
        }
    });

    document.getElementById('enviarAurora').addEventListener('click', function (e) {
        e.preventDefault();
        const input = document.getElementById('fileInput');
        const file = input.files[0];
        if (file) {
            if (file.name.endsWith('.xlsx')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const data = new Uint8Array(e.target.result);
                    const workbook = XLSX.read(data, { type: 'array' });
                    const worksheet = workbook.Sheets[workbook.SheetNames[0]];
    
                    // Converte a planilha para JSON
                    let jsonData = XLSX.utils.sheet_to_json(worksheet, { raw: true });
    
                    // Itera sobre os dados
                    jsonData = jsonData.map(row => {
                        // Converter a coluna "Data produção" para uma data JS
                        if (row['Data produção']) {
                            row['Data produção'] = formatDateForDatabase(excelDateToJSDate(row['Data produção']));
                        }
    
                        // Converter a coluna "Data vencimento" para uma data JS
                        if (row['Data vencimento']) {
                            row['Data vencimento'] = formatDateForDatabase(excelDateToJSDate(row['Data vencimento']));
                        }
    
                        // Iterar sobre outras colunas e substituir células vazias por null
                        for (const key in row) {
                            if (row[key] === '') {
                                row[key] = null;
                            }
                        }
                        return row;
                    });
    
                    // Agora você tem os dados do Excel com as colunas "Data produção" e "Data vencimento" em formato de data de banco de dados
                    // console.log(jsonData);
    
                    // Envie 'jsonData' para o servidor via AJAX
                    if (jsonData.length > 0) {
                        fetch('../app/api/endpoints/Negocio/POST_uploadAurora.php', {
                            method: 'POST',
                            body: JSON.stringify(jsonData),
                            headers: {
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => response.text())
                        .then(data => {
                            document.getElementById('outputAuroraExcel').innerHTML = data;
                        })    
                        .catch(error => {
                            console.error(error);
                        });
                    } else {
                        alert('Nenhum dado do Excel encontrado para enviar.');
                    }
                };
                reader.readAsArrayBuffer(file);
            } else {
                alert('O arquivo deve ser um arquivo Excel válido no formato .xlsx.');
            }
        }
    });

    document.getElementById('scanButtonCruzeiro').addEventListener('click', function () {
        // console.log('Botão foi clicado cruzeiro.');
    
        const xmlForm = document.getElementById('xmlFormCruzeiro');
        const outputDiv = document.getElementById('outputCruzeiro');
        const loadingDiv = document.getElementById('loadingCruzeiro');
        const progressBar = document.getElementById('progressBarCruzeiro');
    
        // Obtenha os valores dos campos dataCruzeiro e cargaCruzeiro
        const dataCruzeiro = document.getElementById('dataCruzeiro').value;
        const cargaCruzeiro = document.getElementById('cargaCruzeiro').value;
    
        const formData = new FormData(xmlForm);
    
        // Adicione os valores dos campos ao objeto FormData
        formData.append('dataCruzeiro', dataCruzeiro);
        formData.append('cargaCruzeiro', cargaCruzeiro);
    
        // Verifique se existem arquivos anexados antes de enviar a solicitação
        if (formData.has('xmlCruzeiroFilesInput[]')) {
            // console.log("existe arquivo");
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../app/api/endpoints/Negocio/POST_processCruzeiro.php', true);
            xhr.upload.onprogress = function (e) {
                if (e.lengthComputable) {
                    const percent = (e.loaded / e.total) * 100;
                    progressBar.value = percent;
                }
            };
            xhr.onloadstart = function () {
                progressBar.classList.remove('hide');
                loadingDiv.classList.remove('hide');
                progressBar.value = 0;
            };
            xhr.onload = function () {
                if (xhr.status === 200) {
                    progressBar.classList.add('hide');
                    loadingDiv.classList.add('hide');
                    progressBar.value = 100;
                    outputDiv.innerHTML = xhr.responseText;
                }
            };
            xhr.send(formData);
            // console.log(formData);
        } else {
            alert('Nenhum arquivo selecionado para envio.');
        }
    });
        
    document.getElementById('scanButtonSuinco').addEventListener('click', function () {
        // console.log('Botão foi clicado Suinco.');
    
        const xmlForm = document.getElementById('xmlFormSuinco');
        const outputDiv = document.getElementById('outputSuinco');
        const loadingDiv = document.getElementById('loadingSuinco');
        const progressBar = document.getElementById('progressBarSuinco');
    
        const formData = new FormData(xmlForm);
    
        // Obter os valores dos campos de data e número
        const dataSuinco = document.getElementById('dataSuinco').value;
        const cargaSuinco = document.getElementById('cargaSuinco').value;
    
        // Adicionar os valores aos dados do formulário
        formData.append('dataSuinco', dataSuinco);
        formData.append('cargaSuinco', cargaSuinco);
    
        // Verifique se existem arquivos anexados antes de enviar a solicitação
        if (formData.has('xmlSuincoFilesInput[]')) {
            // console.log("existe arquivo");
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../app/api/endpoints/Negocio/POST_processSuinco.php', true);
            xhr.upload.onprogress = function (e) {
                if (e.lengthComputable) {
                    const percent = (e.loaded / e.total) * 100;
                    progressBar.value = percent;
                }
            };
            xhr.onloadstart = function () {
                progressBar.classList.remove('hide');
                loadingDiv.classList.remove('hide');
                progressBar.value = 0;
            };
            xhr.onload = function () {
                if (xhr.status === 200) {
                    loadingDiv.classList.add('hide');
                    progressBar.classList.add('hide');
                    progressBar.value = 100;
                    outputDiv.innerHTML = xhr.responseText;
                }
            };
            xhr.send(formData);
            // console.log(formData);
        } else {
            alert('Nenhum arquivo selecionado para envio.');
        }
    });
        
    function excelDateToJSDate(excelDate) {
        if (excelDate && typeof excelDate === 'number') {
            // A data base do Excel é 1 de janeiro de 1900
            const baseDate = new Date(1899, 11, 30); // Subtrai 1 dia para compensar a data base do Excel
            const jsDate = new Date(baseDate.getTime() + excelDate * 24 * 60 * 60 * 1000);
            return jsDate;
        } else {
            return null;
        }
    }

    function formatDateForDatabase(jsDate) {
        if (jsDate instanceof Date) {
            const year = jsDate.getFullYear();
            const month = String(jsDate.getMonth() + 1).padStart(2, '0');
            const day = String(jsDate.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        } else {
            return null;
        }
    }

    document.getElementById('plenaForm').addEventListener('submit', function (e) {
        e.preventDefault();
    
        // Obtenha o valor do input do tipo number com id cargaPlena
        const cargaPlena = document.getElementById('cargaPlena').value;
        const input = document.getElementById('inputPlena');
        const file = input.files[0];
    
        // Obtenha o valor da data selecionada
        const dataSelecionada = document.getElementById('dataPlena').value;
    
        // Array com os nomes das colunas desejadas
        const colunasDesejadas = ['N° NF', 'Razão Social', 'Endereço', 'Bairro', 'Cidade', 'Peso Bruto', '$ Faturado', 'Ent.', 'Qtd. Caixas'];
    
        if (file) {
            if (file.name.endsWith('.xlsx')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const data = new Uint8Array(e.target.result);
                    const workbook = XLSX.read(data, { type: 'array' });
                    const worksheet = workbook.Sheets[workbook.SheetNames[0]];
    
                    // Converte a planilha para JSON e filtra colunas desejadas
                    const jsonData = XLSX.utils.sheet_to_json(worksheet, { raw: true }).map(row => {
                        const newRow = {};
                        colunasDesejadas.forEach(coluna => {
                            newRow[coluna] = row[coluna] || null;
                        });
                        return newRow;
                    });
    
                    // Adicione a data selecionada e o valor do input cargaPlena aos dados do Excel
                    jsonData.forEach(row => {
                        row.data_selecionada = dataSelecionada;
                        row.carga_plena = cargaPlena;
                    });
    
                    // Envie 'jsonData' para o servidor via AJAX
                    if (jsonData.length > 0) {
                        const formData = new FormData();
                        formData.append('dataSelecionada', dataSelecionada);
                        formData.append('jsonData', JSON.stringify(jsonData)); // Adiciona os dados como JSON
                        formData.append('cargaPlena', cargaPlena); // Adiciona o valor de cargaPlena
    
                        fetch('../app/api/endpoints/Negocio/POST_processPlena.php', {
                            method: 'POST',
                            body: formData,
                        })
                            .then(response => response.text())
                            .then(data => {
                                // console.log(data); // Mensagem de confirmação ou erro do servidor
                                document.getElementById('outputPlena').innerHTML = data;
                            })
                            .catch(error => {
                                console.error(error);
                            });
                    } else {
                        alert('Nenhum dado do Excel encontrado para enviar.');
                    }
                };
                reader.readAsArrayBuffer(file);
            } else {
                alert('O arquivo deve ser um arquivo Excel válido no formato .xlsx.');
            }
        }
    });
});
