document.addEventListener('DOMContentLoaded', function () {
    const filmesTable = document.getElementById('filmes-table').querySelector('tbody');
    const totalFilmesElement = document.getElementById('total-filmes');

    function formatarData(data) {
        if (!data) return '';
        const [ano, mes, dia] = data.split('-');
        return `${dia}/${mes}/${ano}`;
    }

    function loadFilmes() {
        fetch('http://localhost/CineTech2.0/backend/api/filmes.php')
            .then((response) => response.json())
            .then((resposta) => {
                if (resposta.success && Array.isArray(resposta.data)) {
                    filmesTable.innerHTML = '';
                    resposta.data.forEach((filme) => {
                        const linha = document.createElement('tr');
                        linha.innerHTML = `
                            <td>${filme.titulo}</td>
                            <td>${filme.genero}</td>
                            <td>${formatarData(filme.data_lancamento)}</td>
                            <td>
                                <button class="visualizar btn btn-outline-secondary btn-sm" data-id="${filme.id}">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="editar btn btn-secondary btn-sm" data-id="${filme.id}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="excluir btn btn-danger btn-sm" data-id="${filme.id}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        `;
                        filmesTable.appendChild(linha);
                    });
                    totalFilmesElement.textContent = resposta.data.length;
                } else {
                    console.error('Resposta inesperada da API:', resposta);
                }
            })
            .catch((error) => {
                console.error('Erro ao carregar filmes:', error);
            });
    }
    loadFilmes();

    document.addEventListener('click', function (event) {
        const target = event.target.closest('button');
        if (!target) return;
        const idFilme = target.dataset.id;
        if (!idFilme) return;

        if (target.classList.contains('editar')) {
            window.location.href = `http://localhost/CineTech2.0/frontend/admin/editar.html?id=${idFilme}`;
        } else if (target.classList.contains('excluir')) {
            if (confirm('Tem certeza que deseja excluir este filme?')) {
                fetch(`/CineTech2.0/backend/api/filmes.php?_method=DELETE`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id: idFilme }),
                })
                    .then(() => loadFilmes())
                    .catch((error) => console.error('Erro ao excluir filme:', error));
            }
        } else if (target.classList.contains('visualizar')) {
            window.location.href = `http://localhost/CineTech2.0/frontend/public/pages/detalhes.html?id=${idFilme}`;
        }
    });
});
