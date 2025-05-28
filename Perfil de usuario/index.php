<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>PIXELA</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style_I.css">
</head>
<body>

  <?php 
    session_start();
    include('Backend/conexion.php');
    $query = "SELECT * FROM imagen ORDER BY idImagen DESC";
    $resultado = mysqli_query($conn, $query);
  ?>

  <!-- Encabezado -->
  <header>
    <div class="logo">PIXELA</div>
    <div class="menu-container">
      <div class="user-menu">
        <img src="https://cdn-icons-png.flaticon.com/512/456/456212.png" alt="Usuarioblanco" width="50" class="user-icon">
        <div class="user-dropdown">
          <a href="#">Perfil</a>
          <a href="#">Configuración</a>
          <a href="#">Cerrar sesión</a>
        </div>
      </div>
      <button class="menu-toggle">☰</button>
    </div>
  </header>

  <!-- Barra de búsqueda -->
  <div class="search-bar">
    <input type="text" placeholder="Buscar imágenes..."/>
  </div>

  <!-- Menú lateral -->
  <div class="menu-panel">
    <a href="#">Inicio</a>
    <a href="#">Galería</a>
    <a href="#">Favoritos</a>
    <a href="#">Contacto</a>
  </div>

  <!-- Perfil de usuario -->
  <div class="perfil">
    <div class="encabezado-perfil">
      <img src="Foto_perfil.png" alt="Foto de perfil" class="foto-perfil">
      <div class="info-perfil">
        <h2>Mariana Rivera</h2>
        <p>¡Me gusta compartir mi vida a través de fotos!</p>
      </div>
    </div>

    <!-- Botones -->
    <div class="botones_perfil">
      <button class="editar-perfil" onclick="location.href='editar_perfil.php'">Editar perfil</button>
      <button class="subir-foto" id="abrirModalDesdePerfil">Subir foto</button>
      <button class="mi-album" onclick="location.href='mi_album.php'">Mi álbum</button>
    </div>
  </div>

  <!-- Galería con imágenes reales -->
  <div class="photo-grid">
    <?php foreach ($resultado as $row) { ?>
      <div class="photo">
        <img src="imagenes/<?php echo $row['URLImagen']; ?>" alt="Imagen subida">
        <p>ID Imagen: <?php echo $row['idImagen']; ?></p>
      </div>
    <?php } ?>
  </div>

  <!-- Footer -->
  <footer>
    © 2025 Pixela. Todos los derechos reservados. Queda prohibida la reproducción total o parcial de este sitio sin autorización.
  </footer>

  <!-- Modal flotante para subir publicación -->
  <div id="uploadModal" class="modal">
    <div class="modal-content">
      <span class="close-btn" id="closeModalBtn">&times;</span>
      <h3>Subir publicación</h3>
      <form id="uploadPostForm" action="Backend/subir.php" method="post" enctype="multipart/form-data">
        <input type="file" name="imagen" accept="image/*" required><br><br>
        <button type="submit" name="Guardar">Subir imagen</button>
      </form>
    </div>
  </div>

  <?php if (isset($_SESSION['mensaje'])): ?>
    <div class="alert alert-<?php echo $_SESSION['tipo']; ?>">
      <?php echo $_SESSION['mensaje']; unset($_SESSION['mensaje'], $_SESSION['tipo']); ?>
    </div>
  <?php endif; ?>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/axios@1.6.7/dist/axios.min.js"></script>
  <script src="perfil.js"></script>
</body>
</html>
