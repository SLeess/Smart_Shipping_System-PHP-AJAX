function formatData(dataInput){
    formData.append('inputData', dataInput.value);
}

function removerMascaraCPF(cpf) {
    var novo = cpf.value.replace(/[.-]/g, '');
    cpf.value = novo;
}