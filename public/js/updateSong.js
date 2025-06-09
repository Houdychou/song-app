document.addEventListener("DOMContentLoaded", () => {
    let form = document.querySelector("form");
    let idChanson = form.dataset.id;
    form.addEventListener("submit", (e) => {
        e.preventDefault();
        let formData = new FormData(form)

        fetch(`/api/updateSong/${idChanson}`, {
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

                document.querySelector(".success").textContent = data.message;
            })
            .catch(error => {
                console.log(error)
            })
    })
})