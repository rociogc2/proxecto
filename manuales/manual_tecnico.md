# Manual Técnico do Proxecto **Viajamos!**

Este manual describe todos os pasos necesarios para que calquera persoa poida descargar o código do proxecto **Viajamos!**, poñelo en marcha nun entorno local e continuar o seu desenvolvemento.

---

## 1. Introdución

Viajamos! é unha aplicación web deseñada para planificar viaxes de forma sinxela. O proxecto inclúe:

* **Frontend**: HTML, CSS, JavaScript.
* **Backend**: PHP
* **Arquitectura modular**: como por exemplo, menús e pés reutilizables cargados dinamicamente.

Este manual está pensado para novos colaboradores.

---

## 2. Requisitos Previos

### 2.1 Software necesario

* **Git** (control de versións)
* **Navegador web** actual (Chrome, Firefox…)
* **Editor de código**: VS Code recomendado
* **Servidor local**:

  * Se usas PHP: **XAMPP**, **WAMP** ou **Laragon**

### 2.2 Coñecementos recomendados

* HTML, CSS, JavaScript, PHP
* Uso básico de Git e GitHub

---

## 3. Descarga do Proxecto

### 3.1 Clonar o repositorio desde GitHub

1. Abrir terminal
2. Executar:

```bash
git clone https://github.com/rociogc2/proxecto.git
```

3. Entrar no proxecto:

```bash
cd proxecto
```

---

## 4. Estrutura do Proxecto

A estrutura do proxecto é a seguinte, xunto coa descrición da función de cada unha:

```
proxecto/
│
├── css/
│   └── (todos os estilos da aplicación: deseño, cores, maquetación...)
│
├── html/
│   └── (todas as vistas da aplicación)
│
├── imagenes/
│   └── (todas as imaxes usadas na aplicación: logos, iconas, fondos...)
│
├── js/
│   └── loadHTML.js   (arquivo que carga menús e footers en todas as páxinas)
│
└── php/
    └── lóxica necesaria para o funcionamento da aplicación
```

---

## 5. Configuración e Execución do Proxecto

### 5.1 Executar o proxecto con un servidor local

#### **Opción A: Usando XAMPP / WAMP**

1. Copiar o proxecto na carpeta:

   * XAMPP → `htdocs`
   * WAMP → `www`
2. Arrancar Apache
3. Abrir no navegador:

   ```
   http://localhost/proxecto
   ```

#### **Opción B: Con Live Server (solo para a parte de fronted)**

1. Abrir o proxecto en VS Code
2. Instalar extensión **Live Server**
3. Clic dereito → *Open with Live Server*
4. A web abrirase en: `http://localhost:5500`


---

## 6. Configuración de Componentes Reutilizables

O proxecto utiliza un script chamado **loadHTML()** para cargar o menú e o footer.

### Exemplo:

```javascript
function loadHTML(id, url) {
  fetch(url)
    .then(response => {
      if (!response.ok) {
        throw new Error("Error al cargar " + url);
      }
      return response.text();
    })
    .then(data => {
      document.getElementById(id).innerHTML = data.trim();
    })
    .catch(error => console.error(error));
}
```

### Para incluír o menú nunha páxina:

```html
<div id="menu"></div>
<script>
  loadHTML("menu", "menu_privado.html");
</script>
```

---

## 7. Continuación do Desenvolvemento

### 7.1 Crear novas páxinas

1. Copiar unha páxina existente.
2. Modificar o contido.
3. Manter a carga do menú e footer.

### 7.2 Estilo

* Engadir estilos en `css/nome_ficheiro.css`. Se os estilos son xerais metelos en `css/estilos_generales.css`
* Respectar a paleta e estratexia de deseño existente

### 7.3 Funcionalidades futuras previstas

* Melloras do plan básico:
  - Poder meter os gastos que se van xerando na viaxe para ter un control
  - Un usuario de empresa
  - Integrarse con APIs oara meter directamente os enlaces dos aloxamentos ou calquera outro datos mediante buscadores
* Implementar unha versión Premium que incluiría:
  - Compartir con outros usuarios as viaxes
  - Vincular a galería de fotos á nube
  - Sacar estadísticas dos gastos
  - Exportar as viaxes nun PDF

---

## 8. Traballo con Git

### 8.1 Crear un commit

```bash
git add .
git commit -m "Descrición clara do cambio"
```

### 8.2 Subir cambios a GitHub

```bash
git push origin main
```

### 8.3 Crear unha rama nova

```bash
git checkout -b nova-funcionalidade
```
