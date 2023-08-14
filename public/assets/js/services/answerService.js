import Api from "../utils/api.js";
import Toast from "../utils/toast.js";

const api = new Api('form-answers');

const answerData = {}

const emailInput = document.getElementById('email')

const emailButton = document.getElementById('confirm-button')
if (emailButton) registerEmailEventListener()

function registerEmailEventListener() {
    emailButton.addEventListener('click', () => {
        answerData.email = emailInput.value
        document.getElementById('filler-email').hidden = true
        document.getElementById('fields-to-answer').hidden = false
    })
}

