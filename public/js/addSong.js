document.addEventListener("DOMContentLoaded", () => {
    let deleteLink = document.querySelectorAll(".delete-song");
    deleteLink.forEach(link => {
        link.addEventListener("click", (e) => {
            const confirmDelete = confirm("Voulez-vous supprimer cette chanson ?");
            if (!confirmDelete) {
                e.preventDefault();
            }
        })
    })
    let form = document.querySelector("#addForm");
    form.addEventListener("submit", (e) => {
        e.preventDefault();
        let formData = new FormData(form)

        fetch("/api/addSong", {
            method: "POST",
            body: formData
        }).then(res => res.json())
            .then(data => {
                document.querySelector(".success").textContent = "";
                document.querySelector(".error-titre").textContent = "";
                document.querySelector(".error-annee").textContent = "";

                if (!data.success) {
                    if (data.errors) {
                        document.querySelector(".error-titre").textContent = data.errors["titre_chanson"];
                        document.querySelector(".error-annee").textContent = data.errors["annee"];
                        return;
                    }
                }

                const selectedChanteur = document.querySelector("#chanteur option:checked");
                const selectedCategorie = document.querySelector("#categorie option:checked");
                const nomChanteur = selectedChanteur.dataset.chanteur;
                const libelleCategorie = selectedCategorie.dataset.categorie;

                document.querySelector(".cards").innerHTML += `
                <div class="card">
                    <h2>${formData.get("titre")}</h2>
                    <p><strong>Année :</strong> ${formData.get("annee")}</p>
                    <p><strong>Chanteur :</strong> ${nomChanteur}</p>
                    <p><strong>Catégorie :</strong> ${libelleCategorie}</p>
                    <a href="/deleteSong/${document.querySelector(".card").dataset.chanson}" class="delete-song">Supprimer</a>
                </div>`;

                document.querySelector(".success").textContent = data.message;

                form.reset();
            })
            .catch(error => {
                console.log(error)
            })
    })
})