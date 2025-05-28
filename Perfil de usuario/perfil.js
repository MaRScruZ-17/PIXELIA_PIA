    //CODIGO PARA ENCABEZADO
    const toggleBtn = document.querySelector('.menu-toggle');
    const menuPanel = document.querySelector('.menu-panel');
    const userIcon = document.querySelector('.user-icon');
    const userDropdown = document.querySelector('.user-dropdown');

    toggleBtn.addEventListener('click', () => {
      menuPanel.style.display = menuPanel.style.display === 'flex' ? 'none' : 'flex';
      userDropdown.classList.remove('show');
    });

    userIcon.addEventListener('click', () => {
      userDropdown.classList.toggle('show');
      menuPanel.style.display = 'none';
    });

    window.addEventListener('click', (e) => {
      if (!e.target.closest('header') && !e.target.closest('.menu-panel')) {
        menuPanel.style.display = 'none';
        userDropdown.classList.remove('show');
      }
    });


document.getElementById('abrirModalDesdePerfil').addEventListener('click', function () {
  document.getElementById('uploadModal').style.display = 'block';
});

document.getElementById('closeModalBtn').addEventListener('click', function () {
  document.getElementById('uploadModal').style.display = 'none';
});

// También puedes cerrar si hacen clic fuera del contenido
window.addEventListener('click', function (event) {
  const modal = document.getElementById('uploadModal');
  if (event.target === modal) {
    modal.style.display = 'none';
  }
});
