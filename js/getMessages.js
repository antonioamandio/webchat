let isUserScrolling = false;
let lastScrollTop = 0;

const messageContainer = document.getElementById('messageContainer');

// Detecta se o usuário está fazendo scroll manualmente
messageContainer.addEventListener('scroll', () => {
    const { scrollTop, scrollHeight, clientHeight } = messageContainer;

    // Verifica se o usuário está perto do final
    if (scrollTop + clientHeight >= scrollHeight - 5) {
        isUserScrolling = false; // O usuário está no final
    } else {
        isUserScrolling = true; // O usuário está rolando manualmente
    }

    lastScrollTop = scrollTop; // Atualiza a última posição do scroll
});

// Adicionando as mensagens na tela do chat
function updateMessageContainer(messages, clientToken) {
    messageContainer.innerHTML = ''; // Limpa o contêiner antes de adicionar novas mensagens

    messages.forEach(message => {
        const messageElement = document.createElement('div');

        if (message.sessionToken == clientToken) {
            messageElement.classList.add('senderMessage');
            messageElement.innerHTML = `<div class="messageContent">${message.content}</div>`;
        } else {
            messageElement.classList.add('messageFromOthers');
            messageElement.innerHTML = `
                <div class="receiverName">${message.firstName} ${message.lastName}</div>
                <div class="messageContent">${message.content}</div>
            `;
        }

        messageContainer.appendChild(messageElement);
    });

    // Rolar automaticamente para o final se o usuário não estiver rolando manualmente
    if (!isUserScrolling) {
        messageContainer.scrollTop = messageContainer.scrollHeight;
    }
}

// Inicializa a busca de mensagens imediatamente
getMessage();

// Busca mensagens a cada 2 segundos
setInterval(async () => {
    await getMessage();
}, 2000);

// Função para obter mensagens
async function getMessage() {
    try {
        const url = 'php/getMessages.php'; // Caminho para o arquivo de enviar mensagens
        const response = await fetch(url);

        if (!response.ok) {
            throw new Error('Erro ao processar a requisição');
        } else {
            const responseData = await response.json();
            updateMessageContainer(responseData.messageDatas, responseData.clientSideSessionToken);
        }
    } catch (error) {
        console.error(error);   
    }
}
