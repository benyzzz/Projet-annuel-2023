<?php
  session_start()
 ?> 


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="sto.css">
    <meta http-equiv="Cache-control" content="no-cache">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
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
        $.ajax({
            url: "../NewsLetter/news.php",
            type: "POST",
            success: function(response) {
                console.log(response);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }
}



    </script>
</head>
<body>
    <div class="wrapper">
        <div class="title">
            Registration Form
        </div>
        <div class="form">
            <form onsubmit="return validateForm()" method="POST" action="2enter.php">
                <div class="inputfield">
                    <label>First Name</label>
                    <input id="first-name" name="first_name" type="text" class="input">
                </div>  
                <div class="inputfield">
                    <label>Last Name</label>
                    <input id="last-name"  name="last_name" type="text" class="input">
                </div> 

                <div class="inputfield">
                    <div class="custom_select">
                        <label for="date_naissance">Date de naissance:</label>
                        <input type="date" id="date_naissance" name="date_naissance" required><br><br>
                    </div>
                </div> 

                <div class="inputfield">
                    <label><br>Phone Number</label>
                    <input id="phone-number" type="text" class="input" name="Phone">
                </div> 
                <div class="inputfield">
                    <label>Address</label>
                    <textarea id="address" class="textarea" name="Address"></textarea>
                </div> 
                <div class="inputfield">
                    <label>Postal Code</label>
                    <input id="postal-code" type="text" class="input" name="postal">
                </div> 
                
                <div class="inputfield">
                  <label>Newsletter</label>
                  <input id="newsletter" type="checkbox" name="newsletter" onchange="toggleNewsletter()">
                </div>
                

                <div class="inputfield terms">
                    <label class="check">
                        <input id="terms-checkbox" type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                    <p>Agreed to terms and conditions</p>
                </div>

                <div class="inputfield">
                    <button type="submit" name="submit" >Register</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>