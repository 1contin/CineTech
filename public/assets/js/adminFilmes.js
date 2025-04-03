document.addEventListener("DOMContentLoaded", function () {
    const filmesTable = document
        .getElementById("filmes-table")
        .querySelector("tbody");
    const totalFilmesElement = document.getElementById("total-filmes");

    function loadFilmes() {
        fetch("/cineTech/api/filmes.php")
            .then((response) => response.json())
            .then((filmes) => {
                filmesTable.innerHTML = "";
                filmes.forEach((filme) => {
                    const linha = document.createElement("tr");
                    linha.innerHTML = `
                        <td>${filme.titulo}</td>
                        <td>${filme.genero}</td>
                        <td>${filme.data_lancamento}</td>
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
                totalFilmesElement.textContent = filmes.length;
            })
            .catch((error) => console.error("Erro ao carregar filmes:", error));
    }

    loadFilmes();

    document.addEventListener("click", function (event) {
        const target = event.target.closest("button");
        if (!target) return;
        const idFilme = target.dataset.id;
        if (!idFilme) return;

        if (target.classList.contains("editar")) {
            window.location.href = `/cineTech/app/views/admin/editar_filmes.php?id=${idFilme}`;
        } else if (target.classList.contains("excluir")) {
            if (confirm("Tem certeza que deseja excluir este filme?")) {
                fetch(`/cineTech/api/filmes.php`, {
                    method: "DELETE",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ id: idFilme }),
                })
                    .then(() => loadFilmes())
                    .catch((error) =>
                        console.error("Erro ao excluir filme:", error)
                    );
            }
        } else if (target.classList.contains("visualizar")) {
            window.location.href = `/cineTech/app/views/pages/detalhes.php?id=${idFilme}`;
        }
    });
});
