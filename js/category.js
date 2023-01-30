console.log("loading...");
const actionCategory = document.querySelector(".category-action")
const formCategory = document.querySelectorAll(".form-category input")
if (actionCategory !== null) {
    actionCategory.addEventListener("click", (evento) => {
        evento.preventDefault();
        const mybody = []
        let nMybody = ''
        console.log("dddeee");
        console.log("Formulario de categoria? ", formCategory);
        formCategory.forEach(e => {
            const clave = e.id
            const valor = e.value
            mybody.push(`${encodeURIComponent(clave)}=${encodeURIComponent(valor)}`)
        })
        mybody.push(`action=${encodeURIComponent(actionCategory.id)}`)
        console.log(mybody);
        //mybody = mybody.substring(0, mybody.length - 2)
        nMybody = mybody.join("&")
        console.log("nMybody", nMybody);


        fetch("/php/category.php", {
            method: "POST",
            body: nMybody,
            mode: 'cors',
            credentials: 'include',
            headers: {
                //'Content-Type': 'application/json'
                'Content-Type': 'application/x-www-form-urlencoded',
            }
        }).then(
            e => e.json()
        ).then(
            datos => {
                console.log(datos)
                if (datos.respuesta) {
                    console.log("proceso exitoso!");

                }
            }
        )
    })
}