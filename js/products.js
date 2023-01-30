console.log("loading...");
const actionProduct = document.querySelector(".product-action")
const formProduct = document.querySelectorAll(".form-product input")
if (actionProduct !== null) {
    actionProduct.addEventListener("click", (evento) => {
        evento.preventDefault();
        const mybody = []
        let nMybody = ''
        console.log("dddeee");
        console.log("Formulario de categoria? ", formProduct);
        formCategory.forEach(e => {
            const clave = e.id
            const valor = e.value
            mybody.push(`${encodeURIComponent(clave)}=${encodeURIComponent(valor)}`)
        })
        mybody.push(`action=${encodeURIComponent(actionProduct.id)}`)
        console.log(mybody);
        //mybody = mybody.substring(0, mybody.length - 2)
        nMybody = mybody.join("&")
        console.log("nMybody", nMybody);


        fetch("/php/product.php", {
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