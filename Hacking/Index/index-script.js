// Funzione per aggiungere l'effetto di scrittura del testo
document.addEventListener('DOMContentLoaded', function() {
  let typewriterText = document.querySelector('.typewriter');
  let text = typewriterText.textContent;
  typewriterText.textContent = ''; // Pulisce il testo
  let i = 0;

  function type() {
    if (i < text.length) {
      typewriterText.textContent += text.charAt(i);
      i++;
      setTimeout(type, 100);
    }
  }

  type();
});
