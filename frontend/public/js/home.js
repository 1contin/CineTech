let todosFilmes = [];
let termoAtual = '';
let generosSelecionados = [];

async function buscarFilmes() {
    try {
        const resposta = await fetch('http://localhost/CineTech2.0/backend/api/filmes.php');
        const json = await resposta.json();
        console.log('Resposta da API de filmes:', json);

        if (json.success && Array.isArray(json.data)) {
            todosFilmes = json.data;
            return json.data; 
        } else {
            console.error('Resposta inesperada da API:', json);
            return [];
        }
    } catch (erro) {
        console.error('Erro ao buscar filmes:', erro);
        return [];
    }
}

async function buscarGeneros() {
    try {
        const resposta = await fetch('http://localhost/CineTech2.0/backend/api/generos.php');
        const generos = await resposta.json();
        console.log('Resposta dos gêneros:', generos);
        return generos;
    } catch (erro) {
        console.error('Erro ao buscar gêneros:', erro);
        return [];
    }
}

async function exibirGeneros() {
    const generoFilters = document.getElementById('generoFilters');
    const resposta = await buscarGeneros();
    const generos = resposta.data || [];
    console.log('Generos disponíveis:', generos);

    generoFilters.innerHTML = `
        <div class="filtro-genero">
            <input type="checkbox" value="Todos" id="generoTodos">
            <label for="generoTodos">Todos</label>
        </div>
    `;

    generos.forEach((genero) => {
        generoFilters.innerHTML += `
            <div class="filtro-genero">
                <input type="checkbox" value="${genero.nome}" id="genero-${genero.id}">
                <label for="genero-${genero.id}">${genero.nome}</label>
            </div>
        `;
    });

    const checkboxes = generoFilters.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener('change', () => {
            generosSelecionados = Array.from(checkboxes)
                .filter((cb) => cb.checked)
                .map((cb) => cb.value);

            aplicarFiltros();
        });
    });
}

function aplicarFiltros() {
    let filmesFiltrados = todosFilmes;

    if (generosSelecionados.length > 0 && !generosSelecionados.includes('Todos')) {
        filmesFiltrados = filmesFiltrados.filter((filme) => generosSelecionados.includes(filme.genero));
    }

    if (termoAtual !== '') {
        filmesFiltrados = filmesFiltrados.filter((filme) =>
            filme.titulo.toLowerCase().includes(termoAtual.toLowerCase())
        );
    }

    exibirFilmes(filmesFiltrados);
}

function exibirFilmes(filmesExibir) {
    const searchResults = document.getElementById('searchResults');
    searchResults.innerHTML = '';

    if (filmesExibir.length === 0) {
        searchResults.innerHTML = '<p>Nenhum filme encontrado.</p>';
        return;
    }

    filmesExibir.forEach((filme) => {
        const [ano, mes, dia] = filme.data_lancamento.split('-');
        const data_lancamento = `${dia}/${mes}/${ano}`;
        const cardHtml = `
            <div class="col-12 col-md-3 mb-4">
                <div class="card">
                    <img src="../${filme.capa}" class="card-img-top-home" alt="${filme.titulo}">
                    <div class="card-body">
                        <h5 class="card-title">${filme.titulo}</h5>
                        <p class="card-text"><strong>Gênero:</strong> ${filme.genero}</p>
                        <p class="card-text"><strong>Data de lançamento:</strong> ${data_lancamento}</p>
                        <a href="detalhes.html?id=${filme.id}" class="btn btn-primary">Ver Detalhes</a>
                    </div>
                </div>
            </div>
        `;
        searchResults.innerHTML += cardHtml;
    });
}

document.addEventListener('DOMContentLoaded', async () => {
    const filmes = await buscarFilmes();
    exibirFilmes(filmes);
    await exibirGeneros();

    document.getElementById('searchInput').addEventListener('input', (event) => {
        termoAtual = event.target.value;
        aplicarFiltros();
    });
});
