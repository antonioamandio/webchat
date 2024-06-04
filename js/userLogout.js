const logoutButton = document.getElementById('logoutButton');

function userLogout() {
    
    const url = 'php/userLogout.php'; // Caminho para o arquivo de registro

    // Tratando a requisição feita

        fetch(url).then((response) => {

            if (response.ok) {
                return response.json();
            } else {
                throw new Error('Erro ao processar a requisição');
            }

        }).then((responseData) => {

            if (responseData.status === 'success') {
                location.href = 'login.php';
            }

        }).catch((error) => {

            console.error(error);
            
        });
    
}

logoutButton.addEventListener('click', userLogout);