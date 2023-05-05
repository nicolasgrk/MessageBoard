document.addEventListener('DOMContentLoaded', function () {
    setupCreateSalonModal();
    setupLoginModal();
    setupPostMessageModal();

});

function validateCreateSalonForm() {
    const salonNameInput = document.getElementById("salon_name");
    const salonName = salonNameInput.value.trim();

    if (salonName.length === 0) {
        console.log("Le nom du salon ne peut pas être vide.");
        salonNameInput.focus();
        return false;
    }

    return true;
}

function validateLoginForm() {
    const usernameInput = document.getElementById("username");
    const username = usernameInput.value.trim();

    if (username.length === 0) {
        console.log("Le nom d'utilisateur ne peut pas être vide.");
        usernameInput.focus();
        return false;
    }

    return true;
}

function validatePostMessageForm() {
    const content = document.getElementById('content');
    const errorMessage = document.getElementById('message-error');
    
    if (content.value.length < 2 || content.value.length > 2048) {
        errorMessage.textContent = 'Le message doit contenir entre 2 et 2048 caractères.';
        errorMessage.style.display = 'block';
        return false;
    } else {
        errorMessage.style.display = 'none';
        return true;
    }
}

function setupCreateSalonModal() {
    const createSalonTrigger = document.getElementById('create-salon-trigger');
    const createSalonModal = document.getElementById('create-salon-modal');
    const createSalonClose = document.getElementById('create-salon-close');
    const createSalonCancel = document.getElementById('create-salon-cancel');
    if (createSalonTrigger && createSalonModal && createSalonClose && createSalonCancel) {
        createSalonTrigger.addEventListener('click', function () {
            createSalonModal.classList.add('is-active');
        });
    
        createSalonClose.addEventListener('click', function () {
            createSalonModal.classList.remove('is-active');
        });
    
        createSalonCancel.addEventListener('click', function () {
            createSalonModal.classList.remove('is-active');
        });
    }
}

function setupLoginModal() {
    const loginTrigger = document.getElementById('login-trigger');
    const loginModal = document.getElementById('login-modal');
    const loginClose = document.getElementById('login-close');
    const loginCancel = document.getElementById('login-cancel');
    if (loginTrigger && loginModal && loginClose && loginCancel) {
        loginTrigger.addEventListener('click', function () {
            loginModal.classList.add('is-active');
        });
    
        loginClose.addEventListener('click', function () {
            loginModal.classList.remove('is-active');
        });
    
        loginCancel.addEventListener('click', function () {
            loginModal.classList.remove('is-active');
        });
    }
}
function setupPostMessageModal() {
    const postMessageTrigger = document.getElementById('post-message-trigger');
    const postMessageModal = document.getElementById('post-message-modal');
    const postMessageClose = document.getElementById('post-message-close');
    const postMessageCancel = document.getElementById('post-message-cancel');
    if (postMessageTrigger && postMessageModal && postMessageClose && postMessageCancel) {
        postMessageTrigger.addEventListener('click', function () {
            postMessageModal.classList.add('is-active');
        });
    
        postMessageClose.addEventListener('click', function () {
            postMessageModal.classList.remove('is-active');
        });
    
        postMessageCancel.addEventListener('click', function () {
            postMessageModal.classList.remove('is-active');
        });
    }

}
module.exports = {
    validateCreateSalonForm: validateCreateSalonForm,
    validateLoginForm: validateLoginForm,
    validatePostMessageForm: validatePostMessageForm,
    setupCreateSalonModal: setupCreateSalonModal,
    setupLoginModal: setupLoginModal,
    setupPostMessageModal: setupPostMessageModal
  }

  