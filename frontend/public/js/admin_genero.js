document.addEventListener('DOMContentLoaded', function () {
    const generosTable = document.getElementById('generos-table').querySelector('tbody');
    const totalGenerosElement = document.getElementById('total-generos');

    function loadGeneros() {
        fetch('http://localhost/CineTech2.0/backend/api/generos.php')
            .then((response) => response.json())
            .then((resposta) => {
                console.log(resposta);
                if (!resposta.success || !Array.isArray(resposta.data)) {
                    console.error('Erro ao carregar gêneros:', resposta);
                    return;
                }

                const generos = resposta.data;

                generosTable.innerHTML = '';
                generos.forEach((genero) => {
                    const linha = document.createElement('tr');
                    linha.innerHTML = `
                <td>${genero.nome}</td>
                <td>
                    <button class="excluir btn btn-danger btn-sm" data-id="${genero.id}">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            `;
                    generosTable.appendChild(linha);
                });

                totalGenerosElement.textContent = generos.length;
            })
            .catch((erro) => {
                console.error('Erro na requisição de gêneros:', erro);
            });
    }

    loadGeneros();

    document.addEventListener('click', function (event) {
        const target = event.target;

        if (target.classList.contains('excluir')) {
            const idGenero = target.dataset.id;

            fetch(`http://localhost/CineTech2.0/backend/api/generos.php`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id: idGenero }),
            })
                .then((response) => {
                    if (response.ok) {
                        loadGeneros();
                    } else {
                        console.error('Erro ao excluir gênero.');
                    }
                })
                .catch((error) => {
                    console.error('Erro na solicitação de exclusão:', error);
                });
        }
    });
});
