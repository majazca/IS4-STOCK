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
        formProduct.forEach(e => {
            const clave = e.id
            const valor = e.value
            mybody.push(`${encodeURIComponent(clave)}=${encodeURIComponent(valor)}`)
        })
        mybody.push(`action=${encodeURIComponent(actionProduct.id)}`)
        console.log(mybody);
        //mybody = mybody.substring(0, mybody.length - 2)
        nMybody = mybody.join("&")
        console.log("nMybody", nMybody);


        fetch("/php/products.php", {
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


const cambiarCateg = document.querySelector("#productCategory")
if (cambiarCateg !== null) {
    cambiarCateg.addEventListener("change", (e) => {
        document.querySelector("#productCategoryOk").value = e.target.value
        console.log(document.querySelector("#productCategoryOk").value);
    })
}

//  >
const btnBorrarProducto = document.querySelector(".listado-productos")
if (btnBorrarProducto !== null) {
    btnBorrarProducto.addEventListener("click", (e) => {
        //e.preventDefault();
        if (e.target.classList.contains("deleteProduct")) {
            console.log("que iba a borrar?", e.target.dataset.id);
            const productoIdDelete = e.target.dataset.id;
            const mybody = []
            let nMybody = ''
            mybody.push(`${encodeURIComponent('productIdDelete')}=${encodeURIComponent(productoIdDelete)}`)
            mybody.push(`action=${encodeURIComponent('deleteProduct')}`)
            console.log(mybody);
            //mybody = mybody.substring(0, mybody.length - 2)
            nMybody = mybody.join("&")
            console.log("nMybody", nMybody);
            fetch("/php/products.php", {
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
                        alert("Producto con id :" + productoIdDelete + " ha sido eliminado!")
                    }
                }
            )
        }
    })
}