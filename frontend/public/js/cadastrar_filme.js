async function carregarGeneros() {
    try {
        const resposta = await fetch('http://localhost/CineTech2.0/backend/api/generos.php');
        const dados = await resposta.json();

        if (dados.success && Array.isArray(dados.data)) {
            const select = document.getElementById('genero-select');
            select.innerHTML = '<option value="">Selecione um gênero</option>';

            dados.data.forEach((genero) => {
                const option = document.createElement('option');
                option.value = genero.id;
                option.textContent = genero.nome;
                select.appendChild(option);
            });
        } else {
            alert('Erro ao carregar os gêneros.');
        }
    } catch (error) {
        console.error('Erro ao buscar os gêneros:', error);
    }
}

carregarGeneros();

document.getElementById('cadastrar-filme-form').addEventListener('submit', async function (e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    try {
        const response = await fetch('http://localhost/CineTech2.0/backend/api/filmes.php', {
            method: 'POST',
            body: formData,
        });

        const resultado = await response.json();

        if (resultado.success) {
            alert('Filme cadastrado com sucesso!');
            form.reset();
            window.location.href = 'https://localhost/CineTech2.0/frontend/admin/dashboard.html';
        } else {
            alert('Erro ao cadastrar filme: ' + (resultado.message || 'Verifique os dados.'));
        }
    } catch (error) {
        console.error('Erro na requisição:', error);
        alert('Erro ao se comunicar com o servidor.');
    }
});
