document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('cadastrar-genero-form');

    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const nome = document.getElementById('nome').value;

        const dados = { nome };

        try {
            const response = await fetch('http://localhost/CineTech2.0/backend/api/generos.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(dados),
            });

            const result = await response.json();

            if (result.success) {
                alert('Gênero cadastrado com sucesso!');
                form.reset();
            } else {
                alert('Erro ao cadastrar gênero: ' + result.message);
            }
        } catch (error) {
            console.error('Erro na requisição:', error);
            alert('Ocorreu um erro na requisição. Tente novamente.');
        }
    });
});
