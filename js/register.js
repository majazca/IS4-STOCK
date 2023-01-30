const registro = document.getElementById("register");
const fullName = document.getElementById("fullname-r")
const email = document.getElementById("email-r")
const password = document.getElementById("password-r")
const rpassword = document.getElementById("rpassword-r")

const formRegistro = document.getElementById("formReg")

const we2 = document.querySelectorAll("#formReg input")


registro.addEventListener("click", (e) => {
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


    fetch("/php/register.php", {
        method: "POST",
        body: nMybody,
        headers: {
            //'Content-Type': 'application/json'
            'Content-Type': 'application/x-www-form-urlencoded',
        }
    }).then(
        e => e.json()
    ).then(
        datos => console.log(datos)
    )
})