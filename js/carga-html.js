function loadHTML(id, url) {
  fetch(url)
    .then(response => {
      if (!response.ok) {
        throw new Error("Error al cargar " + url);
      }
      return response.text();
    })
    .then(data => {
      // Elimina saltos de línea y espacios extra
      document.getElementById(id).innerHTML = data.trim();
    })
    .catch(error => console.error(error));
}
