console.log("loading... salidas");

fetch("/php/products.php?obtener=listado").then(r => r.json()).then(data => {
    console.log("veamos el data", data);
    const listadoProductos = []
    data.forEach(element => {
        listadoProductos.push(element.codigo)
    });
    document.querySelector("datalist#productos").innerHTML = listadoProductos.map(e => `<option value="${e}">`).join(" ")
})

fetch("/php/providers.php?obtener=listado").then(r => r.json()).then(data => {
    console.log("veamos el data", data);
    const listadoProveedores = []
    data.forEach(element => {
        listadoProveedores.push(`<option value="${element.id}">${element.nombre}</option>`)
    });
    console.log(listadoProveedores);
    // <option value="1">On Hold</option>
    document.querySelector("select#supplierId").innerHTML += listadoProveedores.join(" ")
})

document.querySelector(".entrada-detalle").addEventListener("change", (e) => {
    console.log("veamos la e", e)
    if (e.target.className == 'product-qty' || e.target.className == 'product-punit') {
        const q = e.target.closest("tr")
        q.querySelector(".product-ptotal").value = parseInt(q.querySelector(".product-qty").value) * parseInt(q.querySelector(".product-punit").value)
        sumarTodo()
    }
})


const actionProduct = document.querySelector(".product-action")
const formProduct = document.querySelectorAll(".form-product .form-group input")
const formProductSelect = document.querySelectorAll(".form-product .form-group select")

if (actionProduct !== null) {

    actionProduct.addEventListener("click", (evento) => {
        evento.preventDefault();


        // Comenzamos

        const tableFP = document.querySelectorAll(".form-product .entrada-detalle tr")
            /* console.log("Only Inputs!", formProduct);
            console.log("Only selectS!", formProductSelect);
            console.log("Mi table!!", tableFP); */
        lista = []
        tableFP.forEach((el) => {
            //console.log("que es?", el.querySelectorAll("td"))
            lista.push(el.querySelectorAll("td"))
        })
        console.log("lista", lista);

        const listadoDetalle = {
            "product-id": [],
            "product-qty": [],
            "product-lote": [],
            "product-vence": [],
            "product-punit": [],
            "product-ptotal": []
        }

        lista.forEach((ew) => {
            ew.forEach((elem) => {
                const producto = elem.querySelector("input")
                console.log("el elemento?", producto);
                console.log("ok ok, espera un momento", producto.className);
                if (producto.className == "product-id") {
                    listadoDetalle["product-id"].push(producto.value)
                } else if (producto.className == "product-qty") {
                    listadoDetalle["product-qty"].push(producto.value)
                } else if (producto.className == "product-lote") {
                    listadoDetalle["product-lote"].push(producto.value)
                } else if (producto.className == "product-vence") {
                    listadoDetalle["product-vence"].push(producto.value)
                } else if (producto.className == "product-punit") {
                    listadoDetalle["product-punit"].push(producto.value)
                } else if (producto.className == "product-ptotal") {
                    listadoDetalle["product-ptotal"].push(producto.value)
                }
            })
        })
        console.log("el listado detalle", listadoDetalle);
        // Test!

        const mybody = []
        let nMybody = ''
        console.log("dddeee");
        console.log("Formulario de categoria? ", formProduct);
        formProduct.forEach(e => {
            const clave = e.id
            const valor = e.value
            mybody.push(`${encodeURIComponent(clave)}=${encodeURIComponent(valor)}`)
        })
        formProductSelect.forEach(e => {
            const clave = e.id
            const valor = e.value
            mybody.push(`${encodeURIComponent(clave)}=${encodeURIComponent(valor)}`)
        })
        for (e in listadoDetalle) {
            mybody.push(`${encodeURIComponent(e)}=${encodeURIComponent(listadoDetalle[e].join(","))}`)
        }
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

function sumarTodo() {
    valores = document.querySelectorAll(".form-product .entrada-detalle tr .product-ptotal")
    suma = 0
    valores.forEach(el => {
        suma = suma + parseInt(el.value)
        console.log("suma", suma, "value?", el.value, "el_value_int", parseInt(el.value));
    })
    document.getElementById("amountTotal").value = 0
    document.getElementById("amountTotal").value = suma
}