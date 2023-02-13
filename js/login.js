const loguear = document.getElementById("login");
const email = document.getElementById("email")
const password = document.getElementById("password")

const formRegistro = document.getElementById("formReg")

const we2 = document.querySelectorAll("#formLogin input")


loguear.addEventListener("click", (e) => {
    e.preventDefault();
    const mybody = []
    let nMybody = ''
    we2.forEach(e => {
        const clave = e.id
        const valor = e.value
        mybody.push(`${encodeURIComponent(clave)}=${encodeURIComponent(valor)}`)

    })
    console.log(mybody);
    //mybody = mybody.substring(0, mybody.length - 2)
    nMybody = mybody.join("&")
    console.log("nMybody", nMybody);


    fetch("/php/login.php", {
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
            if (datos.login) {
                console.log(window.location.href);
                console.log(window.location.origin);
                window.location.href = window.location.origin + "/home.php";

            }
        }
    )
})