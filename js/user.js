console.log("loading...");
const actionUser = document.querySelector(".user-action")
const formUser = document.querySelectorAll(".form-user input")
actionUser.addEventListener("click", (evento) => {
    evento.preventDefault();
    const mybody = []
    let nMybody = ''
    console.log("ddd");
    console.log("Formulario de usuario? ", formUser);
    formUser.forEach(e => {
        const clave = e.id
        const valor = e.value
        mybody.push(`${encodeURIComponent(clave)}=${encodeURIComponent(valor)}`)
    })
    mybody.push(`action=${encodeURIComponent(actionUser.id)}`)
    console.log(mybody);
    //mybody = mybody.substring(0, mybody.length - 2)
    nMybody = mybody.join("&")
    console.log("nMybody", nMybody);


    fetch("/php/user.php", {
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