window.onload = () => {
    const backButton = document.getElementById('back-button')

    if (backButton) registerBackButtonEvent()

    function registerBackButtonEvent() {
        backButton.addEventListener('click', () => {
            window.history.back()
        })
    }
}