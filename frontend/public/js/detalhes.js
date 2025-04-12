document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const filmeId = urlParams.get('id');
    const filmeDetalhesContainer = document.getElementById('filmeDetalhes');

    if (filmeId) {
        fetch(`/CineTech2.0/backend/api/detalhesFilmes.php?id=${filmeId}`)
            .then((response) => response.json())
            .then((filme) => {
                if (filme) {
                    const [ano, mes, dia] = filme.data_lancamento.split('-');
                    const dataFormatada = `${dia}/${mes}/${ano}`;
                    const filmeHtml = `
                        <div class="card filme-card">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="/CineTech2.0/frontend/public/${filme.capa}" alt="${
                        filme.titulo
                    }" class="img-fluid rounded-start">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">${filme.titulo}</h5>
                                        <p class="card-text"><strong>Data de lançamento:</strong> ${dataFormatada}</p>
                                        <p class="card-text"><strong>Gênero:</strong> ${filme.genero}</p>
                                        <p class="card-text"><strong>Duração:</strong> ${filme.duracao} minutos</p>
                                        <p class="card-text"><strong>Sinopse:</strong> ${filme.descricao}</p>
                                        <div class="d-flex">
                                            <a href="${
                                                filme.trailer
                                            }" class="btn btn-primary btn-custom">Assistir Trailer</a>
                                            <a href="http://localhost/CineTech2.0/frontend/public/pages/home.html" class="btn btn-secondary btn-custom ms-2"> <i class="bi bi-arrow-left me-1"></i> Voltar para o Catálogo</a>
                                        </div>
                                        <div class="mt-3">
                                            <a href="http://localhost/CineTech2.0/frontend/admin/dashboard.html" class="btn btn-outline-secondary btn-sm"> Ir para a Dashboard</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="mt-4">
                                <h3 class="card-title">Trailer</h3>
                                <div class="embed-responsive embed-responsive-16by9">
                                    ${
                                        filme.trailer_iframe
                                            ? filme.trailer_iframe
                                            : '<p class="card-text">Trailer não disponível.</p>'
                                    }
                                </div>
                            </div>
                        </div>
                    `;

                    filmeDetalhesContainer.innerHTML = filmeHtml;
                } else {
                    filmeDetalhesContainer.innerHTML = '<p>Filme não encontrado.</p>';
                }
            })
            .catch((error) => {
                console.error('Erro ao buscar detalhes do filme:', error);
                filmeDetalhesContainer.innerHTML = '<p>Erro ao buscar detalhes do filme.</p>';
            });
    } else {
        filmeDetalhesContainer.innerHTML = '<p>ID do filme não fornecido.</p>';
    }
});
