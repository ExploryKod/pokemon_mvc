import '../scss/style.scss';
import './script.js';
// Prevent l'auto-reload on watch
if(import.meta.hot) {
    import.meta.hot.on('vite:beforeFullReload', (e) => {
        if(e.type === 'full-reload'){
            throw '(skipping full reload for js change)';
        }
    })
}
