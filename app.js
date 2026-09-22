document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('[data-confirm]').forEach((el) => {
    el.addEventListener('click', (event) => {
      const mensaje = el.getAttribute('data-confirm');
      if (mensaje && !window.confirm(mensaje)) event.preventDefault();
    });
  });
});
