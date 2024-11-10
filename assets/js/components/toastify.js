function getQueryParam(param) {
  const urlParams = new URLSearchParams(window.location.search);
  return urlParams.get(param) || null;
}

function getMessageForKey(key, messageAlerts) {
    const alert = messageAlerts.find(alertObj => alertObj.hasOwnProperty(key));
    if (!alert) return null;
    return alert[key];
  }

function makeToast() {
  const itemPlaceHolder = getQueryParam('item') ? getQueryParam('item') : "";

  const messageSuccessAlerts = [
      { 'pokemon-deleted': `Le pokemon ${itemPlaceHolder ?? ""} a bien été supprimé.`},
      { 'pokemon-created': `Le pokemon ${itemPlaceHolder ?? ""} a bien été créé.`},
      { 'pokemon-updated': `Le pokemon ${itemPlaceHolder ?? ""} a bien été modifié.`}
  ];

  const messageErrorAlerts = [
      { 'name-not-filled': `Un champ ${itemPlaceHolder ?? ""} est resté vide.`},
      { 'pokemon-exist': `Le pokemon ${itemPlaceHolder ?? ""} existe déjà`}
  ];
  
  const successMessageKey = getQueryParam('success');
  const successMessage = getMessageForKey(successMessageKey, messageSuccessAlerts);

  if (successMessage) {
    Toastify({
      text: successMessage,
      duration: 3000,
      gravity: "top",
      position: "right",
      style: {
        background: "linear-gradient(to right, #00b09b, #96c93d)",
      },
    }).showToast();
  }
  
  const errorMessageKey = getQueryParam('error');
  const errorMessage = getMessageForKey(errorMessageKey, messageErrorAlerts);
  if (errorMessage) {
    Toastify({
      text: errorMessage,
      duration: 3000,
      gravity: "top",
      position: "right",
      style: {
        background: "linear-gradient(to right, #ff5f6d, #ffc371)",
      },
    }).showToast();
  }
  
  if (successMessage || errorMessage) {
    const newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
    window.history.replaceState({ path: newUrl }, '', newUrl);
  }
}

window.addEventListener('DOMContentLoaded', (event) => {
  makeToast();
});