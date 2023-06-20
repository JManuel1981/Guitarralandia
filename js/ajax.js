
function addFavorite(id_instrumento) {
    const icon = document.getElementById("heart_" + id_instrumento);
    const isFavorite = icon.classList.contains("fas");

    if (isFavorite) {
        icon.classList.remove("fas", "text-danger");
        icon.classList.add("far");
    } else {
        icon.classList.remove("far");
        icon.classList.add("fas", "text-danger");
    }

    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
        }
    };
    xhttp.open("POST", "index.php?controlador=producto&action=add_favorito", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id_instrumento=" + id_instrumento);
}