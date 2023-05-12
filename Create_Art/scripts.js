document.getElementById('createArtForm').addEventListener('submit', (e) => {
    e.preventDefault();

    const formData = new FormData(e.target);

    fetch('create_art.php', {
        method: 'POST',
        body: formData
    })
        .then(response => {
            if (response.ok) {
                return response.json();
            }
            throw new Error("Erreur lors de la création de l'offre d'art");
        })
        .then(result => {
            if (result.result === 'success') {
                alert("Offre d'art crée avec succès");
                window.location.href = '/Auction/auction.html';
            } else {
                console.error(result.message);
                alert("Erreur lors de la création de l'offre d'art");
            }
        })
        .catch(error => {
            console.error(error);
            alert("Erreur lors de la création de l'offre d'art");
        });
});
