function onloadCallback() {
    grecaptcha.render('recaptcha', {
        'sitekey': '6LeS91wmAAAAAPsSADPuJyTXYXDGPQqJ5_ROOyp_',
        'callback': verifyCallback
    });
};

function verifyCallback(response) {
    return new Promise(function (resolve, reject) {
        if (response != '') {
            document.getElementById('confirm-button').disabled = false;
            resolve();
        } else {
            reject();
        }
    })
};