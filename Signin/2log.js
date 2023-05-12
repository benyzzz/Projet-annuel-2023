        function validateForm() {
    // R�cup�rer les valeurs des champs
    var firstName = document.getElementById("first-name").value;
    var lastName = document.getElementById("last-name").value;
    var phoneNumber = document.getElementById("phone-number").value;
    var address = document.getElementById("address").value;
    var postalCode = document.getElementById("postal-code").value;
    var termsChecked = document.getElementById("terms-checkbox").checked;
    var dateNaissance = document.getElementById("date_naissance").value;

    // V�rifier la longueur du pr�nom et du nom
    if (firstName.length > 15 || lastName.length > 20) {
        alert("Le pr�nom/nom doit �tre valide.");
        return false;
    }

    // V�rifier le nombre de voyelles cons�cutives dans le pr�nom
    if (/[aeiou]{4}/i.test(firstName)) {
        alert("Le pr�nom ne peut pas contenir plus de 3 voyelles cons�cutives.");
        return false;
    }

    // V�rifier le nombre de voyelles cons�cutives dans le nom
    if (/[aeiou]{4}/i.test(lastName)) {
        alert("Le nom ne peut pas contenir plus de 3 voyelles cons�cutives.");
        return false;
    }

    // V�rifier le num�ro de t�l�phone
    if (!phoneNumber.match(/^0\d{9}$/)) {
        alert("Veuillez entrer un num�ro de t�l�phone valide commen�ant par 0 et comportant 10 chiffres.");
        return false;
    }

    // V�rifier l'adresse
    if (address.trim() === "" || !/\d/.test(address)) {
        alert("Veuillez entrer une adresse valide et sp�cifier au moins un num�ro de rue.");
        return false;
    }

    // V�rifier le code postal
    var postalCodeValue = parseInt(postalCode, 10);
    if (!postalCode.match(/^\d{5}$/) || postalCodeValue < 1000 || postalCodeValue > 98799) {
        alert("Veuillez entrer un code postal valide.");
        return false;
    }

    // V�rifier que tous les champs sont remplis et les conditions accept�es
    if (firstName.trim() === "" || lastName.trim() === "" || phoneNumber.trim() === "" || address.trim() === "" || postalCode.trim() === "" || !termsChecked) {
        alert("Veuillez remplir tous les champs et accepter les conditions.");
        return false;
    }

    // V�rifier la date de naissance
    var dateNaissanceObj = new Date(dateNaissance);
    var maintenant = new Date();
    var age = maintenant.getFullYear() - dateNaissanceObj.getFullYear();
      
      if (age < 18) {
        alert("D�sol�, vous �tes trop jeune pour utiliser ce service.");
        return false;
      } else if (age > 110) {
        alert("D�sol�, vous �tes trop vieux pour utiliser ce service ( age max : Sanane ans.");
        return false;
      } else if (dateNaissanceObj > maintenant) {
        alert("La date de naissance ne peut pas �tre dans le futur.");
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