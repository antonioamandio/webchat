const htmlForm = document.querySelector('form'); // Pegando o formulário do HTML

async function sendMessage(event) {
    event.preventDefault(); // Evitando o evento padrão do formulário

    // Pegando o campo do formulário HTML
    const messageInput = document.getElementById('messageInput').value;

    const formData = new FormData(); // Criando um formulário virtual

    // Adicionando os campos no formulário virtual
    formData.append('message', messageInput);

    const url = 'php/sendMessages.php'; // Caminho para o arquivo de enviar mensagens

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

            if (responseData.status === "success") {
                document.getElementById('messageInput').value = '';
            }
            
        }

    } catch (error) {
        console.error(error);
    }

}

// criando o evento de registrar usuário
htmlForm.addEventListener('submit', sendMessage);
