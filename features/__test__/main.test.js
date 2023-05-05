const {  validateCreateSalonForm, validateLoginForm, validatePostMessageForm, setupCreateSalonModal, setupLoginModal, setupPostMessageModal } = require("../../src/main");

describe('validateCreateSalonForm', () => {
  test('retourne false si le nom du salon est vide', () => {
    // Créez un élément de test simulé
    let salonNameInput = { value: '' };
    
    // Remplacez par la ligne suivante pour récupérer l'élément réel du DOM
    salonNameInput = document.createElement('input');
    salonNameInput.id = 'salon_name';
    document.body.appendChild(salonNameInput);

    // Vérifiez que la fonction renvoie false
    expect(validateCreateSalonForm()).toBe(false);
    
    // Nettoyez les éléments créés pour ce test
    document.body.removeChild(salonNameInput);
  });

  test('retourne true si le nom du salon est valide', () => {
    // Créez un élément de test simulé
    let salonNameInput = { value: 'Salon de discussion' };
    
    // Remplacez par la ligne suivante pour récupérer l'élément réel du DOM
    salonNameInput = document.createElement('input');
    salonNameInput.id = 'salon_name';
    salonNameInput.value = 'Salon de discussion';
    document.body.appendChild(salonNameInput);

    // Vérifiez que la fonction renvoie true
    expect(validateCreateSalonForm()).toBe(true);
    
    // Nettoyez les éléments créés pour ce test
    document.body.removeChild(salonNameInput);
  });
});

describe('validateLoginForm', () => {
  test('retourne false si le nom d\'utilisateur est vide', () => {
    // Créez un élément de test simulé
    let usernameInput = { value: '' };

    usernameInput = document.createElement('input');
    usernameInput.id = 'username';
    document.body.appendChild(usernameInput);

    // Vérifiez que la fonction renvoie false et affiche un message dans la console
    // console.log = jest.fn();
    expect(validateLoginForm()).toBe(false);

    document.body.removeChild(usernameInput);

  });

  test('retourne true si le nom d\'utilisateur est valide', () => {
    // Créez un élément de test simulé
    let usernameInput = { value: 'johnDoe' };

    usernameInput = document.createElement('input');
    usernameInput.id = 'username';
    usernameInput.value = 'johnDoe';
    document.body.appendChild(usernameInput);
    // Vérifiez que la fonction renvoie true
    expect(validateLoginForm()).toBe(true);
    document.body.removeChild(usernameInput);

  });
});


describe('validatePostMessageForm', () => {
  test('retourne false si le contenu du message est vide', () => {
    // Créez un élément de test simulé
    const contentInput = document.createElement('input');
    contentInput.id = 'content';
    contentInput.value = '';

    const errorMessage = document.createElement('div');
    errorMessage.id = 'message-error';

    // Ajoutez les éléments au DOM
    document.body.appendChild(contentInput);
    document.body.appendChild(errorMessage);

    // Vérifiez que la fonction renvoie false et affiche un message d'erreur
    expect(validatePostMessageForm()).toBe(false);
    document.body.removeChild(contentInput);
    document.body.removeChild(errorMessage);

  });

  test('retourne false si le contenu du message est trop court', () => {
    // Créez un élément de test simulé
    const contentInput = document.createElement('input');
    contentInput.id = 'content';
    contentInput.value = 'a';

    const errorMessage = document.createElement('div');
    errorMessage.id = 'message-error';

    // Ajoutez les éléments au DOM
    document.body.appendChild(contentInput);
    document.body.appendChild(errorMessage);

    // Vérifiez que la fonction renvoie false et affiche un message d'erreur
    expect(validatePostMessageForm()).toBe(false);
    document.body.removeChild(contentInput);
    document.body.removeChild(errorMessage);
  });

  test('retourne false si le contenu du message est trop long', () => {
    // Créez un élément de test simulé
    const contentInput = document.createElement('input');
    contentInput.id = 'content';
    contentInput.value = 'a'.repeat(2049);

    const errorMessage = document.createElement('div');
    errorMessage.id = 'message-error';

    // Ajoutez les éléments au DOM
    document.body.appendChild(contentInput);
    document.body.appendChild(errorMessage);

    // Vérifiez que la fonction renvoie false et affiche un message d'erreur
    expect(validatePostMessageForm()).toBe(false);
    document.body.removeChild(contentInput);
    document.body.removeChild(errorMessage);
  });

  test('retourne true si le contenu du message est valide', () => {
    // Créez un élément de test simulé
    const contentInput = document.createElement('input');
    contentInput.id = 'content';
    contentInput.value = 'Lorem ipsum dolor sit amet';

    const errorMessage = document.createElement('div');
    errorMessage.id = 'message-error';

    // Ajoutez les éléments au DOM
    document.body.appendChild(contentInput);
    document.body.appendChild(errorMessage);

    // Vérifiez que la fonction renvoie true et cache le message d'erreur
    expect(validatePostMessageForm()).toBe(true);
    document.body.removeChild(contentInput);
    document.body.removeChild(errorMessage);
  });
});
describe('setupCreateSalonModal', () => {
  beforeEach(() => {
    // Crée des éléments HTML factices pour les tests
    document.body.innerHTML = `
      <button id="create-salon-trigger">Create Salon</button>
      <div id="create-salon-modal">
        <button id="create-salon-close">Close</button>
        <button id="create-salon-cancel">Cancel</button>
      </div>
    `;
  });

  afterEach(() => {
    // Supprime tous les éléments HTML créés pour les tests
    document.body.innerHTML = '';
  });

  test('clicking create salon trigger opens modal', () => {
    // Appelle la fonction pour la configurer
    setupCreateSalonModal();

    // Récupère les éléments HTML créés pour les tests
    const createSalonTrigger = document.getElementById('create-salon-trigger');
    const createSalonModal = document.getElementById('create-salon-modal');

    // Simule un clic sur le bouton de déclenchement
    createSalonTrigger.click();

    // Vérifie que la fenêtre modale est ouverte
    expect(createSalonModal.classList).toContain('is-active');
  });

  test('clicking close or cancel button closes modal', () => {
    // Appelle la fonction pour la configurer
    setupCreateSalonModal();

    // Récupère les éléments HTML créés pour les tests
    const createSalonClose = document.getElementById('create-salon-close');
    const createSalonCancel = document.getElementById('create-salon-cancel');
    const createSalonModal = document.getElementById('create-salon-modal');

    // Simule un clic sur le bouton de fermeture
    createSalonClose.click();

    // Vérifie que la fenêtre modale est fermée
    expect(createSalonModal.classList).not.toContain('is-active');

    // Simule un clic sur le bouton d'annulation
    createSalonCancel.click();

    // Vérifie que la fenêtre modale est toujours fermée
    expect(createSalonModal.classList).not.toContain('is-active');
  });
});
describe('setupLoginModal', () => {
  beforeEach(() => {
    // Crée des éléments HTML factices pour les tests
    document.body.innerHTML = `
      <button id="login-trigger">Login</button>
      <div id="login-modal">
        <button id="login-close">Close</button>
        <button id="login-cancel">Cancel</button>
      </div>
    `;
  });

  afterEach(() => {
    // Supprime tous les éléments HTML créés pour les tests
    document.body.innerHTML = '';
  });

  test('clicking login trigger opens modal', () => {
    // Appelle la fonction pour la configurer
    setupLoginModal();

    // Récupère les éléments HTML créés pour les tests
    const loginTrigger = document.getElementById('login-trigger');
    const loginModal = document.getElementById('login-modal');

    // Simule un clic sur le bouton de déclenchement
    loginTrigger.click();

    // Vérifie que la fenêtre modale est ouverte
    expect(loginModal.classList).toContain('is-active');
  });

  test('clicking close or cancel button closes modal', () => {
    // Appelle la fonction pour la configurer
    setupLoginModal();

    // Récupère les éléments HTML créés pour les tests
    const loginClose = document.getElementById('login-close');
    const loginCancel = document.getElementById('login-cancel');
    const loginModal = document.getElementById('login-modal');

    // Simule un clic sur le bouton de fermeture
    loginClose.click();

    // Vérifie que la fenêtre modale est fermée
    expect(loginModal.classList).not.toContain('is-active');

    // Simule un clic sur le bouton d'annulation
    loginCancel.click();

    // Vérifie que la fenêtre modale est toujours fermée
    expect(loginModal.classList).not.toContain('is-active');
  });
});
describe('setupPostMessageModal', () => {
  beforeEach(() => {
    // Crée des éléments HTML factices pour les tests
    document.body.innerHTML = `
      <button id="post-message-trigger">Post Message</button>
      <div id="post-message-modal">
        <button id="post-message-close">Close</button>
        <button id="post-message-cancel">Cancel</button>
      </div>
    `;
  });

  afterEach(() => {
    // Supprime tous les éléments HTML créés pour les tests
    document.body.innerHTML = '';
  });

  test('clicking post message trigger opens modal', () => {
    // Appelle la fonction pour la configurer
    setupPostMessageModal();

    // Récupère les éléments HTML créés pour les tests
    const postMessageTrigger = document.getElementById('post-message-trigger');
    const postMessageModal = document.getElementById('post-message-modal');

    // Simule un clic sur le bouton de déclenchement
    postMessageTrigger.click();

    // Vérifie que la fenêtre modale est ouverte
    expect(postMessageModal.classList).toContain('is-active');
  });

  test('clicking close or cancel button closes modal', () => {
    // Appelle la fonction pour la configurer
    setupPostMessageModal();

    // Récupère les éléments HTML créés pour les tests
    const postMessageClose = document.getElementById('post-message-close');
    const postMessageCancel = document.getElementById('post-message-cancel');
    const postMessageModal = document.getElementById('post-message-modal');

    // Simule un clic sur le bouton de fermeture
    postMessageClose.click();

    // Vérifie que la fenêtre modale est fermée
    expect(postMessageModal.classList).not.toContain('is-active');

    // Simule un clic sur le bouton d'annulation
    postMessageCancel.click();

    // Vérifie que la fenêtre modale est toujours fermée
    expect(postMessageModal.classList).not.toContain('is-active');
  });
});


