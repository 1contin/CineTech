document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const searchResults = document.getElementById("searchResults");

    function performSearch(searchTerm) {
        fetch("home.php?search=" + searchTerm)
            .then((response) => response.text())
            .then((data) => {
                searchResults.innerHTML = data;
            });
    }

    searchInput.addEventListener("keydown", function (event) {
        if (event.key === "Enter") {
            event.preventDefault();
            performSearch(searchInput.value); 
        }
    });

    searchInput.addEventListener("input", function () {
        performSearch(this.value); 
    });
});