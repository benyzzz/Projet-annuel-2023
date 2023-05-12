        function validateForm() {
    // Récupérer les valeurs des champs
    var firstName = document.getElementById("first-name").value;
    var lastName = document.getElementById("last-name").value;
    var phoneNumber = document.getElementById("phone-number").value;
    var address = document.getElementById("address").value;
    var postalCode = document.getElementById("postal-code").value;
    var termsChecked = document.getElementById("terms-checkbox").checked;
    var dateNaissance = document.getElementById("date_naissance").value;

    // Vérifier la longueur du prénom et du nom
    if (firstName.length > 15 || lastName.length > 20) {
        alert("Le prénom/nom doit être valide.");
        return false;
    }

    // Vérifier le nombre de voyelles consécutives dans le prénom
    if (/[aeiou]{4}/i.test(firstName)) {
        alert("Le prénom ne peut pas contenir plus de 3 voyelles consécutives.");
        return false;
    }

    // Vérifier le nombre de voyelles consécutives dans le nom
    if (/[aeiou]{4}/i.test(lastName)) {
        alert("Le nom ne peut pas contenir plus de 3 voyelles consécutives.");
        return false;
    }

    // Vérifier le numéro de téléphone
    if (!phoneNumber.match(/^0\d{9}$/)) {
        alert("Veuillez entrer un numéro de téléphone valide commençant par 0 et comportant 10 chiffres.");
        return false;
    }

    // Vérifier l'adresse
    if (address.trim() === "" || !/\d/.test(address)) {
        alert("Veuillez entrer une adresse valide et spécifier au moins un numéro de rue.");
        return false;
    }

    // Vérifier le code postal
    var postalCodeValue = parseInt(postalCode, 10);
    if (!postalCode.match(/^\d{5}$/) || postalCodeValue < 1000 || postalCodeValue > 98799) {
        alert("Veuillez entrer un code postal valide.");
        return false;
    }

    // Vérifier que tous les champs sont remplis et les conditions acceptées
    if (firstName.trim() === "" || lastName.trim() === "" || phoneNumber.trim() === "" || address.trim() === "" || postalCode.trim() === "" || !termsChecked) {
        alert("Veuillez remplir tous les champs et accepter les conditions.");
        return false;
    }

    // Vérifier la date de naissance
    var dateNaissanceObj = new Date(dateNaissance);
    var maintenant = new Date();
    var age = maintenant.getFullYear() - dateNaissanceObj.getFullYear();
      
      if (age < 18) {
        alert("Désolé, vous êtes trop jeune pour utiliser ce service.");
        return false;
      } else if (age > 110) {
        alert("Désolé, vous êtes trop vieux pour utiliser ce service ( age max : Sanane ans.");
        return false;
      } else if (dateNaissanceObj > maintenant) {
        alert("La date de naissance ne peut pas être dans le futur.");
        return false;
      } else {
        return true;
      }


    return true;
}

  
  
    function toggleNewsletter() {
    var newsletterCheckbox = document.getElementById("newsletter");
    if (newsletterCheckbox.checked) {
        // Appeler le script PHP pour envoyer la newsletter
        window.location.href = "../NewsLetter/news.php";
    }
}