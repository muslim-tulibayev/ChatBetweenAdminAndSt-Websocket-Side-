import './bootstrap';

document.getElementById('loginBtn').addEventListener('click', async () => {
    const res = await fetch('/api/authenticate', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            name: document.getElementById('inputName').value,
            password: document.getElementById('inputPass').value,
        })
    })

    const data = await res.json()

    sessionStorage.setItem('token', data.token)
    location.href = '/'
})