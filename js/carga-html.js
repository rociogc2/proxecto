/**
 * Carga contenido HTML desde una URL y lo inserta en un elemento del DOM
 * @param {string} id - ID del elemento donde insertar el contenido
 * @param {string} url - URL del archivo a cargar (HTML)
 * Ejemplo: loadHTML("menu", "../html/menu_privado.html")
 */
function loadHTML(id, url) {
  fetch(url)
    .then(response => {
      // Validar que la solicitud sea exitosa
      if (!response.ok) {
        throw new Error("Error al cargar " + url);
      }
      // Retornar contenido como texto
      return response.text();
    })
    .then(data => {
      // Limpiar espacios en blanco y insertar HTML en el elemento
      document.getElementById(id).innerHTML = data.trim();
    })
    .catch(error => console.error(error));
}
