import './bootstrap';
import Alpine from 'alpinejs';
import '@nextapps-be/livewire-sortablejs';
window.Alpine = Alpine;

Alpine.start();

const loaderWrapper = document.getElementById('loaderWrapper');
// Fonction pour masquer le loader
function hideLoader() {
    loaderWrapper.style.opacity = '0'; // Définissez l'opacité à 0 pour l'effet de fondu
    setTimeout(() => {
        loaderWrapper.style.display = 'none';
    }, 500); // Attendre la fin de la transition avant de masquer complètement
}

window.addEventListener('load', function() {
    hideLoader();
})
