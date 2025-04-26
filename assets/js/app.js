const API_KEY = 'AIzaSyCwm8EoDYcT3ch4S57DiaBr_SSMHZ5QIRU';

const submitButton = document.querySelector('#submit');
const outPutElement = document.querySelector('#result');
const inputElement = document.querySelector('input');
const historyElement = document.querySelector('.chat-history');
const buttonElement = document.querySelector('button');

const context = "Smart MOBY est une solution innovante visant à transformer la mobilité classique en une expérience intelligente et optimisée. Développé en Java et Symfony avec une base de données MySQL, ce projet propose une interface moderne et intuitive pour une meilleure accessibilité. Fonctionnalités principales : - Gestion des transports : Accédez à des services de transport détaillés et disponibles à tout moment. - Événements : Découvrez et participez à divers événements liés à la mobilité. - Offres et services : Profitez d’offres exclusives intégrant divers services et produits. - Blog : Restez informé grâce à un espace dédié aux actualités et conseils sur la mobilité. - Gestion des utilisateurs : Inscrivez-vous et créez un compte pour accéder à toutes les fonctionnalités. Smart MOBY redéfinit l’expérience de déplacement en alliant innovation et praticité.";

function changeInput(value) {
    inputElement.value = value;
}

async function getMessage() {
    const message = inputElement.value.trim();
    if (message === '') return;
    
    const options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'x-goog-api-key': API_KEY
        },
        body: JSON.stringify({
            contents: [{ parts: [{ text: "Question : " + message + "\nContexte : " + context }] }]
        })
    }

    try {
        const response = await fetch('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent', options);
        const data = await response.json();
        const reply = data.candidates?.[0]?.content?.parts?.[0]?.text || "Je ne peux discuter que sur le projet Smart MOBY !";
        outPutElement.textContent = reply;
        const pElement = document.createElement('p');
        pElement.textContent = message;
        pElement.addEventListener('click', () => changeInput(pElement.textContent));
        historyElement.appendChild(pElement);
        inputElement.value = '';
    } catch (error) {
        console.error(error);
        outPutElement.textContent = "Je ne peux discuter que sur le projet Smart MOBY !";
    }
}

submitButton.addEventListener('click', getMessage);

function clearInput() {
    inputElement.value = '';
}

buttonElement.addEventListener('click', clearInput);
