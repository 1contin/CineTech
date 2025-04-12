document.addEventListener('DOMContentLoaded', async () => {
    const urlParams = new URLSearchParams(window.location.search);
    const filmeId = urlParams.get('id'); 

    if (!filmeId) {
        alert('ID do filme não fornecido.');
        return;
    }

    try {
        const response = await fetch(`/CineTech2.0/backend/api/filmes.php?id=${filmeId}`);
        const resultado = await response.json();
        const filme = resultado.data[0];

        document.getElementById('titulo').value = filme.titulo;
        document.getElementById('descricao').value = filme.descricao;
        document.getElementById('trailer').value = filme.trailer;
        document.getElementById('trailer_iframe').value = filme.trailer_iframe;
        document.getElementById('data_lancamento').value = filme.data_lancamento;
        document.getElementById('duracao').value = filme.duracao;

        const generoSelect = document.getElementById('genero-select');
        const generoResponse = await fetch('/CineTech2.0/backend/api/generos.php');
        const generos = await generoResponse.json();

        generos.data.forEach((genero) => {
            const option = document.createElement('option');
            option.value = genero.id;
            option.textContent = genero.nome;
            if (genero.id == filme.genero_id) {
                option.selected = true;
            }
            generoSelect.appendChild(option);
        });

    } catch (erro) {
        console.error('Erro ao carregar dados do filme:', erro);
        alert('Erro ao carregar os dados do filme.');
    }
});