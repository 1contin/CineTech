function ocultarLabel(labelId) {
    document.getElementById(labelId).style.display = 'none';
}

function exibirLabel(inputId, labelId) {
    if (document.getElementById(inputId).value === '') {
        document.getElementById(labelId).style.display = 'block';
    }
}