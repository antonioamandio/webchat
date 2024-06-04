const htmlForm = document.querySelector('form'); // Pegando o formulário do HTML

async function userLogin(event) {
    event.preventDefault(); // Evitando o evento padrão do formulário

    // Pegando os campos do formulário HTML
    const inputFirstName = document.getElementById('firstName').value;
    const inputLastName = document.getElementById('lastName').value;
    const inputEmail = document.getElementById('email').value;
    const inputPassword = document.getElementById('password').value;
    
    const formData = new FormData(); // Criando um formulário virtual

    // Adicionando os campos no formulário virtual
    formData.append('firstName', inputFirstName);
    formData.append('lastName', inputLastName);
    formData.append('email', inputEmail);
    formData.append('password', inputPassword);

    const url = 'php/userRegister.php'; // Caminho para o arquivo de registro

    // Cabeçalho de envio para a função fetch
    const headerSend = {
        method: 'POST',
        body: formData
    }

    // Tratando a requisição feita
    try {

        const response = await fetch(url, headerSend);

        if (!response.ok) {
            throw new Error('Erro ao processar a requisição');
        }
        
        else {

            const responseData = await response.json();

            if (responseData.status === 'success') {
                location.href = 'index.php';
            } else {
                const errorText = document.getElementById('errorText');
                errorText.innerHTML = responseData.message;
                errorText.style.display = "block";
            }

        }

    } catch (error) {
        console.error(error);
    }
    
}

htmlForm.addEventListener('submit', userLogin);

// Escondendo o alerta quando um input for digitado
document.querySelectorAll('input').forEach((input) => {
    input.addEventListener('input', () => {
        const errorText = document.getElementById('errorText');
        errorText.style.display = "none";
    });
});