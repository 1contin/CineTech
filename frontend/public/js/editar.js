document.getElementById('form-editar-filme').addEventListener('submit', async function (e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form); 

    const filmeId = new URLSearchParams(window.location.search).get('id');  
    formData.append('id', filmeId);

    try {
        const response = await fetch('/CineTech2.0/backend/api/filmes.php?_method=PUT', {
            method: 'POST', 
            body: formData, 
        });

        const resultado = await response.json();

        if (resultado.success) {
            alert("Filme atualizado com sucesso!");
            window.location.href = "https://localhost/CineTech2.0/frontend/admin/dashboard.html";  
        } else {
            alert("Erro ao atualizar o filme: " + resultado.message);
        }
    } catch (error) {
        console.error("Erro ao enviar atualização:", error);
        alert("Erro inesperado.");
    }
});