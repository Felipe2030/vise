import axios from 'axios'

const form = document.querySelector("form")
const btnLogin = document.querySelector("#btn-login")
const messages = document.querySelector("#messages")

btnLogin.addEventListener('click', async function(event) {
    event.preventDefault()

    try {
        const formData = new FormData(form)
        const { data } = await axios.post('/login', formData)
        
        messages.innerHTML = `<div class="success">${data.message}</div>`

        setTimeout(() => { 
            messages.innerHTML = '' 
            window.location.href = '/'
        }, 3000)
    } catch (error) {
        const errosValidate = error.response?.data

        if(errosValidate){
            for (const index in errosValidate) {
                if (errosValidate.hasOwnProperty(index)) {
                    messages.innerHTML += `<div class="error">${errosValidate[index]}</div>`
                }
            }

            setTimeout(() => { messages.innerHTML = '' }, 3000)
        }
    }
})