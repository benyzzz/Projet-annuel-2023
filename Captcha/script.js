document.addEventListener('DOMContentLoaded', () => {
    const puzzleContainer = document.getElementById('puzzle-container');
    const submitBtn = document.getElementById('submit-btn');
  
    // Générer les pièces du puzzle
    function createPuzzlePieces() {
      // Ici, vous pouvez ajouter un code pour récupérer l'image personnalisée depuis le backoffice
      // (par exemple, en utilisant AJAX et PHP)
  
      // Pour l'instant, nous utilisons une image statique
      const imageUrl = 'puzzle/puzzle.jpg';
      const img = new Image();
      img.onload = function() {
        const imgWidth = this.width;
        const imgHeight = this.height;
        // Utilisez imgWidth et imgHeight pour limiter le mouvement des pièces
      };
      img.src = imageUrl;
  
      for (let i = 0; i < 9; i++) {
        const piece = document.createElement('div');
        piece.classList.add('puzzle-piece');
        piece.style.backgroundImage = `url(${imageUrl})`;
        piece.style.backgroundPosition = `-${(i % 3) * 100}px -${Math.floor(i / 3) * 100}px`;
        piece.dataset.index = i;
        puzzleContainer.appendChild(piece);
      }
    }
  
    // Fonction pour mélanger les pièces du puzzle
    function shufflePuzzlePieces() {
      const pieces = Array.from(puzzleContainer.children);
      pieces.sort(() => Math.random() - 0.5);
      pieces.forEach(piece => {
        piece.style.left = `${Math.floor(Math.random() * 3) * 100}px`;
        piece.style.top = `${Math.floor(Math.random() * 3) * 100}px`;
      });
    }
  
    // Fonction pour déplacer les pièces avec la souris
    function initDragAndDrop() {
      let selectedPiece = null;
      let offsetX = 0;
      let offsetY = 0;
      const imgRect = puzzleContainer.getBoundingClientRect(); // Récupérez les limites de l'image
      const imgWidth = imgRect.width;
      const imgHeight = imgRect.height;
      const puzzlePieceSize = 100;

  puzzleContainer.addEventListener('mousedown', event => {
    if (event.target.classList.contains('puzzle-piece')) {
      selectedPiece = event.target;
      offsetX = event.clientX - selectedPiece.offsetLeft;
      offsetY = event.clientY - selectedPiece.offsetTop;
      selectedPiece.style.zIndex = '1000';
    }
  });

  puzzleContainer.addEventListener('mousemove', event => {
    if (selectedPiece) {
      let x = event.clientX - offsetX;
      let y = event.clientY - offsetY;
      // Limitez la position de chaque pièce à l'intérieur de l'image
      x = Math.max(Math.min(x, imgWidth - puzzlePieceSize), 0);
      y = Math.max(Math.min(y, imgHeight - puzzlePieceSize), 0);
      selectedPiece.style.left = `${x}px`;
      selectedPiece.style.top = `${y}px`;
    }
  });

  puzzleContainer.addEventListener('mouseup', event => {
    if (selectedPiece) {
      selectedPiece.style.zIndex = '1';
      const x = Math.round((event.clientX - offsetX) / puzzlePieceSize) * puzzlePieceSize;
      const y = Math.round((event.clientY - offsetY) / puzzlePieceSize) * puzzlePieceSize;
      selectedPiece.style.left = `${x}px`;
      selectedPiece.style.top = `${y}px`;
      selectedPiece = null;
    }
  });
}
  
    // Fonction pour vérifier si le puzzle est résolu
    function isPuzzleSolved() {
      const pieces = Array.from(puzzleContainer.children);
      return pieces.every(piece => {
        const index = parseInt(piece.dataset.index, 10);
        const xPos = parseInt(piece.style.left, 10) / 100;
        const yPos = parseInt(piece.style.top, 10) / 100;
        return index === xPos + yPos * 3;
      });
    }
  
    // Fonction pour gérer la validation du captcha
    submitBtn.addEventListener('click', () => {
      if (isPuzzleSolved()) {
        // Le captcha est résolu, vous pouvez envoyer les données du formulaire
        alert('Captcha résolu !');
        window.location.href = '../Auction/auction.html';
      } else {
        // Le captcha n'est pas résolu, affichez un message d'erreur et mélangez les pièces à nouveau
        alert('Captcha non résolu. Veuillez réessayer.');
        shufflePuzzlePieces();
      }
    });
  
    // Initialisation du captcha puzzle
    createPuzzlePieces();
    shufflePuzzlePieces();
    initDragAndDrop();
  });
  
