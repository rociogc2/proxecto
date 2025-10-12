
  // Obtener elementos
  const modal = document.getElementById("formularioModal");
  const btn = document.getElementById("crear");
  const span = document.querySelector(".btn-close");


  btn.onclick = function () {
    modal.style.display = "block";
  }

  // Cerrar al hacer clic en la X
  span.onclick = function () {
    modal.style.display = "none";
  }

  // Cerrar al hacer clic fuera del contenido
  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
