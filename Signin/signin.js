 // Récupération des éléments HTML
    const form = document.querySelector('form');
    const inputs = form.querySelectorAll('input');
    const submitButton = form.querySelector('button[type="submit"]');

    // Fonction pour vérifier si tous les champs sont remplis et que le mot de passe a au moins 6 caractères
function checkInputs() {
  let allInputsFilled = true;
  let passwordInputValue = '';
  inputs.forEach(input => {
    if (input.value.trim() === '') {
      allInputsFilled = false;
    }
    if (input.name === 'password') {
      passwordInputValue = input.value;
    }
  });
  if (allInputsFilled && passwordInputValue.length >= 8) {
    submitButton.removeAttribute('disabled');
    document.querySelector('input[name="password"]').style.borderColor = '';
  } else {
    submitButton.setAttribute('disabled', 'disabled');
    if (passwordInputValue.length < 8) {
      document.querySelector('input[name="password"]').style.borderColor = 'red';
      document.querySelector('input[name="password"]').style.border = '1px solid red';
    } else {
      document.querySelector('input[name="password"]').style.borderColor = '';
    }
  }
}

    // Écoute des événements "input" sur les champs du formulaire
    inputs.forEach(input => {
      input.addEventListener('input', checkInputs);
    });