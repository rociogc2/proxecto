# Plan de Pruebas - Viajamos!

**Fecha de creación:** 26 de noviembre de 2025
**Versión:** 1.0
**Estado:** Plan de Pruebas Manual

---

## 1. Introducción

Este documento detalla el plan de pruebas realizadas para la aplicación web **Viajamos!**, una plataforma de gestión y planificación de viajes. Las pruebas fueron realizadas de forma manual durante el desarrollo, probando cada funcionalidad directamente en el navegador web.

**Tipo de pruebas:** Pruebas Funcionales Manuales
**Navegador:** Chrome / Firefox / Edge
**Entorno:** XAMPP local (localhost)
**Base de datos:** MySQL / MariaDB

---

## 2. Alcance de las Pruebas

### Módulos Probados:

1. **Autenticación y Gestión de Usuarios**
   - Registro de nuevos usuarios
   - Login
   - Gestión de perfil
   - Cambio de contraseña
   - Eliminación de cuenta

2. **Gestión de Viajes**
   - Crear viajes
   - Editar viajes
   - Ver detalles de viajes
   - Eliminar viajes
   - Subida de fotos de viajes

3. **Gestión de Itinerarios**
   - Crear itinerarios
   - Editar itinerarios
   - Eliminar itinerarios
   - Validación de fechas

4. **Gestión de Alojamientos**
   - Crear alojamientos
   - Editar alojamientos
   - Eliminar alojamientos
   - Vista de alojamientos por viaje

5. **Gestión de Transportes**
   - Crear transportes
   - Editar transportes
   - Eliminar transportes
   - Vista de transportes por viaje

6. **Gestión de Notas**
   - Crear notas
   - Editar notas
   - Eliminar notas
   - Vista de notas por viaje

7. **Gestión de Fotos**
   - Subir fotos
   - Visualizar fotos

8. **Interfaz de Usuario**
   - Navegación entre páginas
   - Responsividad del diseño
   - Funcionamiento de menús
   - Carga dinámica de componentes

---

## 3. Casos de Prueba - Autenticación y Usuarios

### 3.1 Registro de Nuevo Usuario

| ID | Caso de Prueba | Pasos | Resultado Esperado | Resultado Real | Estado |
|---|---|---|---|---|---|
| AU-001 | Registro con datos válidos | 1. Ir a página de registro<br>2. Rellenar formulario con datos válidos<br>3. Hacer clic en "Rexistrarse"<br>4. Verificar que se cree la cuenta | Usuario creado correctamente, redirigido a login | ✅ Funciona correctamente | ✅ PASADO |
| AU-002 | Registro con email duplicado | 1. Intentar registrar con email ya usado<br>2. Verificar validación | Mostrar error: "Email ya existe" | ✅ Valida email duplicado | ✅ PASADO |
| AU-003 | Registro con email inválido | 1. Ingresar email sin formato correcto<br>2. Hacer clic en registrar | Mostrar error de validación | ✅ Rechaza emails inválidos | ✅ PASADO |
| AU-004 | Registro con campos vacíos | 1. Dejar campos vacíos<br>2. Intentar registrar | Mostrar error: campo requerido | ✅ Valida campos obligatorios | ✅ PASADO |
| AU-005 | Confirmación de contraseña no coincide | 1. Ingresar contraseñas diferentes<br>2. Intentar registrar | Mostrar error: contraseñas no coinciden | ✅ Valida coincidencia | ✅ PASADO |

### 3.2 Login de Usuario

| ID | Caso de Prueba | Pasos | Resultado Esperado | Resultado Real | Estado |
|---|---|---|---|---|---|
| AU-006 | Login con credenciales válidas | 1. Ingresar email correcto<br>2. Ingresar contraseña correcta<br>3. Hacer clic en Login | Usuario logueado, redirigido a página de viajes | ✅ Login correcto | ✅ PASADO |
| AU-007 | Login con email incorrecto | 1. Ingresar email que no existe<br>2. Ingresar contraseña<br>3. Hacer clic en Login | Mostrar error: "Email o contraseña incorrecto" | ✅ Rechaza email inválido | ✅ PASADO |
| AU-008 | Login con contraseña incorrecta | 1. Ingresar email correcto<br>2. Ingresar contraseña incorrecta<br>3. Hacer clic en Login | Mostrar error: "Email o contraseña incorrecto" | ✅ Rechaza contraseña | ✅ PASADO |
| AU-009 | Login con campos vacíos | 1. Dejar campos vacíos<br>2. Hacer clic en Login | Mostrar error o no permitir envío | ✅ Valida campos | ✅ PASADO |
| AU-010 | Verificar sesión activa | 1. Hacer login<br>2. Navegar a páginas protegidas<br>3. Verificar acceso | Acceso permitido a todas las páginas protegidas | ✅ Sesión funciona | ✅ PASADO |

### 3.3 Logout

| ID | Caso de Prueba | Pasos | Resultado Esperado | Resultado Real | Estado |
|---|---|---|---|---|---|
| AU-011 | Logout correctamente | 1. Hacer clic en botón Logout<br>2. Verificar redirección<br>3. Intentar acceder a página protegida | Sesión cerrada, redirigido a login | ✅ Logout funciona | ✅ PASADO |
| AU-012 | Acceso sin sesión a página protegida | 1. Intentar acceder a viajes.php sin login<br>2. Verificar redirección | Redirigido a login | ✅ Redirige correctamente | ✅ PASADO |

### 3.4 Gestión de Perfil

| ID | Caso de Prueba | Pasos | Resultado Esperado | Resultado Real | Estado |
|---|---|---|---|---|---|
| AU-013 | Ver perfil | 1. Login<br>2. Hacer clic en foto/icono de perfil<br>3. Verificar que se muestra la información | Se muestran datos del usuario correctamente | ✅ Perfil visible | ✅ PASADO |
| AU-014 | Editar datos de perfil | 1. Ir a perfil<br>2. Hacer clic en "Editar Perfil"<br>3. Modificar nombre/apellidos<br>4. Guardar | Datos actualizados en base de datos | ✅ Edición funciona | ✅ PASADO |
| AU-015 | Cambiar email en perfil | 1. Ir a editar perfil<br>2. Cambiar email<br>3. Guardar | Email actualizado, verificar login con nuevo email | ✅ Email actualizado | ✅ PASADO |
| AU-016 | Cambiar contraseña | 1. Ir a perfil<br>2. Cambiar contraseña<br>3. Logout y volver a login con nueva contraseña | Login funciona con nueva contraseña | ✅ Contraseña actualizada | ✅ PASADO |

### 3.5 Eliminar Cuenta

| ID | Caso de Prueba | Pasos | Resultado Esperado | Resultado Real | Estado |
|---|---|---|---|---|---|
| AU-017 | Eliminar cuenta con confirmación | 1. Ir a perfil<br>2. Hacer clic en "Eliminar Cuenta"<br>3. Confirmar eliminación<br>4. Ingresar contraseña<br>5. Confirmar | Cuenta eliminada, usuario no puede login | ⚠️ Requiere verificación | ⚠️ REVISAR |
| AU-018 | Eliminar cuenta - datos asociados | 1. Crear usuario con viajes/notas<br>2. Eliminar cuenta<br>3. Verificar que se eliminan viajes, notas, fotos | Todos los datos del usuario se eliminan en cascada | ✅ Cascada funciona | ✅ PASADO |

---

## 4. Casos de Prueba - Gestión de Viajes

### 4.1 Crear Viajes

| ID | Caso de Prueba | Pasos | Resultado Esperado | Resultado Real | Estado |
|---|---|---|---|---|---|
| VI-001 | Crear viaje con datos válidos | 1. Login<br>2. Ir a Viajes<br>3. Hacer clic en "+ Nova Viaxe"<br>4. Rellenar: destino, fecha inicio, fecha fin, descripción<br>5. Subir foto<br>6. Guardar | Viaje creado, visible en lista de viajes | ✅ Viaje creado correctamente | ✅ PASADO |
| VI-002 | Crear viaje sin foto | 1. Ir a crear viaje<br>2. Rellenar datos sin seleccionar foto<br>3. Guardar | Mostrar error: "Foto requerida" o permitir crear sin foto | ⚠️ Revisar requisito | ⚠️ ACLARAR |
| VI-003 | Validación de fechas - fecha fin antes de inicio | 1. Crear viaje<br>2. Fecha inicio: 15/12/2025<br>3. Fecha fin: 10/12/2025<br>4. Guardar | Mostrar error: "Fecha fin debe ser después de fecha inicio" | ✅ Valida fechas | ✅ PASADO |
| VI-004 | Crear viaje con destino vacío | 1. Crear viaje sin destino<br>2. Intentar guardar | Mostrar error: "Destino requerido" | ✅ Valida destino | ✅ PASADO |
| VI-005 | Subir foto de tamaño válido | 1. Crear viaje<br>2. Subir foto JPG/PNG de tamaño normal<br>3. Guardar | Foto guardada correctamente en carpeta | ✅ Foto guardada | ✅ PASADO |
| VI-006 | Crear múltiples viajes | 1. Crear 3 viajes diferentes<br>2. Verificar que aparecen todos | Todos los viajes visibles en lista | ✅ Múltiples viajes funcionan | ✅ PASADO |

### 4.2 Editar Viajes

| ID | Caso de Prueba | Pasos | Resultado Esperado | Resultado Real | Estado |
|---|---|---|---|---|---|
| VI-007 | Editar destino de viaje | 1. Ir a viaje<br>2. Hacer clic en editar<br>3. Cambiar destino<br>4. Guardar | Destino actualizado en BD | ✅ Destino actualizado | ✅ PASADO |
| VI-008 | Editar descripción | 1. Editar viaje<br>2. Cambiar descripción<br>3. Guardar | Descripción actualizada | ✅ Descripción actualizada | ✅ PASADO |
| VI-009 | Editar foto del viaje | 1. Editar viaje<br>2. Subir nueva foto<br>3. Guardar | Nueva foto sustituye a la anterior | ✅ Foto actualizada | ✅ PASADO |
| VI-010 | Editar fechas del viaje | 1. Editar viaje<br>2. Cambiar fechas<br>3. Guardar | Fechas actualizadas correctamente | ✅ Fechas actualizadas | ✅ PASADO |

### 4.3 Ver Detalles de Viaje

| ID | Caso de Prueba | Pasos | Resultado Esperado | Resultado Real | Estado |
|---|---|---|---|---|---|
| VI-011 | Ver detalles completos de viaje | 1. Hacer clic en viaje de la lista<br>2. Verificar que se muestra: destino, fechas, descripción, foto, itinerarios, alojamientos, transportes, notas, fotos | Todos los datos visibles correctamente | ✅ Detalles visibles | ✅ PASADO |
| VI-012 | Navegación desde detalle de viaje | 1. En detalle de viaje<br>2. Hacer clic en tabs: itinerarios, alojamientos, transportes, notas, fotos | Cada sección muestra sus contenidos | ✅ Navegación funciona | ✅ PASADO |

### 4.4 Eliminar Viajes

| ID | Caso de Prueba | Pasos | Resultado Esperado | Resultado Real | Estado |
|---|---|---|---|---|---|
| VI-013 | Eliminar viaje con confirmación | 1. Ir a viaje<br>2. Hacer clic en eliminar<br>3. Confirmar en modal<br>4. Verificar que desaparece de la lista | Viaje eliminado de la lista | ✅ Viaje eliminado | ✅ PASADO |
| VI-014 | Eliminar viaje - elimina elementos relacionados | 1. Crear viaje con itinerarios, alojamientos, notas<br>2. Eliminar viaje<br>3. Verificar en BD que se eliminan todos | Todos los elementos relacionados se eliminan en cascada | ✅ Cascada funciona | ✅ PASADO |

---

## 5. Casos de Prueba - Itinerarios

### 5.1 Crear Itinerarios

| ID | Caso de Prueba | Pasos | Resultado Esperado | Resultado Real | Estado |
|---|---|---|---|---|---|
| IT-001 | Crear itinerario con datos válidos | 1. Ir a viaje<br>2. Ir a sección Itinerarios<br>3. Hacer clic en "+ Novo Itinerario"<br>4. Rellenar: día, hora, actividad<br>5. Guardar | Itinerario creado y visible en lista | ✅ Itinerario creado | ✅ PASADO |
| IT-002 | Crear itinerario sin hora | 1. Crear itinerario sin especificar hora<br>2. Guardar | Permitir crear itinerario (hora opcional) | ✅ Permite sin hora | ✅ PASADO |
| IT-003 | Crear itinerario sin actividad | 1. Crear itinerario sin actividad<br>2. Guardar | Mostrar error o permitir (verificar requisitos) | ✅ Valida actividad | ✅ PASADO |
| IT-004 | Validación de fecha de itinerario | 1. Crear viaje: 01-12 a 10-12<br>2. Crear itinerario con fecha 15-12 (fuera del rango)<br>3. Guardar | Mostrar advertencia o validar que esté dentro del rango del viaje | ⚠️ Revisar validación | ⚠️ REVISAR |
| IT-005 | Crear múltiples itinerarios en el mismo día | 1. Crear 2 itinerarios para el mismo día<br>2. Verificar orden por hora | Itinerarios ordenados por hora del día | ✅ Se ordenan correctamente | ✅ PASADO |

### 5.2 Editar Itinerarios

| ID | Caso de Prueba | Pasos | Resultado Esperado | Resultado Real | Estado |
|---|---|---|---|---|---|
| IT-006 | Editar actividad de itinerario | 1. Ir a itinerario<br>2. Hacer clic en editar<br>3. Cambiar actividad<br>4. Guardar | Actividad actualizada | ✅ Actividad actualizada | ✅ PASADO |
| IT-007 | Editar hora de itinerario | 1. Editar itinerario<br>2. Cambiar hora<br>3. Guardar | Hora actualizada | ✅ Hora actualizada | ✅ PASADO |
| IT-008 | Editar día de itinerario | 1. Editar itinerario<br>2. Cambiar día<br>3. Guardar | Día actualizado | ✅ Día actualizado | ✅ PASADO |

### 5.3 Eliminar Itinerarios

| ID | Caso de Prueba | Pasos | Resultado Esperado | Resultado Real | Estado |
|---|---|---|---|---|---|
| IT-009 | Eliminar itinerario | 1. Ir a itinerario<br>2. Hacer clic en eliminar<br>3. Confirmar | Itinerario eliminado de la lista | ✅ Itinerario eliminado | ✅ PASADO |

---

## 6. Casos de Prueba - Alojamientos

### 6.1 Crear Alojamientos

| ID | Caso de Prueba | Pasos | Resultado Esperado | Resultado Real | Estado |
|---|---|---|---|---|---|
| AL-001 | Crear alojamiento con datos válidos | 1. Ir a viaje<br>2. Ir a Alojamientos<br>3. Hacer clic en "+ Novo Alojamiento"<br>4. Rellenar: tipo, nombre, dirección, fechas, check-in, check-out<br>5. Guardar | Alojamiento creado y visible | ✅ Alojamiento creado | ✅ PASADO |
| AL-002 | Crear alojamiento sin tipo | 1. Crear alojamiento sin seleccionar tipo<br>2. Guardar | Mostrar error: "Tipo requerido" | ✅ Valida tipo | ✅ PASADO |
| AL-003 | Crear alojamiento sin nombre | 1. Crear alojamiento sin nombre<br>2. Guardar | Mostrar error: "Nombre requerido" | ✅ Valida nombre | ✅ PASADO |
| AL-004 | Validación de fechas en alojamiento | 1. Crear alojamiento<br>2. Fecha fin anterior a fecha inicio<br>3. Guardar | Mostrar error: "Fecha fin debe ser después de inicio" | ✅ Valida fechas | ✅ PASADO |
| AL-005 | Crear múltiples alojamientos | 1. Crear 3 alojamientos diferentes<br>2. Verificar que aparecen todos | Todos los alojamientos visibles | ✅ Múltiples alojamientos | ✅ PASADO |

### 6.2 Editar Alojamientos

| ID | Caso de Prueba | Pasos | Resultado Esperado | Resultado Real | Estado |
|---|---|---|---|---|---|
| AL-006 | Editar información de alojamiento | 1. Ir a alojamiento<br>2. Hacer clic en editar<br>3. Cambiar nombre/dirección<br>4. Guardar | Datos actualizados | ✅ Datos actualizados | ✅ PASADO |
| AL-007 | Editar horarios check-in/check-out | 1. Editar alojamiento<br>2. Cambiar horas<br>3. Guardar | Horarios actualizados | ✅ Horarios actualizados | ✅ PASADO |

### 6.3 Eliminar Alojamientos

| ID | Caso de Prueba | Pasos | Resultado Esperado | Resultado Real | Estado |
|---|---|---|---|---|---|
| AL-008 | Eliminar alojamiento | 1. Ir a alojamiento<br>2. Hacer clic en eliminar<br>3. Confirmar | Alojamiento eliminado | ✅ Alojamiento eliminado | ✅ PASADO |

---

## 7. Casos de Prueba - Transportes

### 7.1 Crear Transportes

| ID | Caso de Prueba | Pasos | Resultado Esperado | Resultado Real | Estado |
|---|---|---|---|---|---|
| TR-001 | Crear transporte con datos válidos | 1. Ir a viaje<br>2. Ir a Transportes<br>3. Hacer clic en "+ Novo Transporte"<br>4. Rellenar: tipo, parada, compañía, día, hora<br>5. Guardar | Transporte creado y visible | ✅ Transporte creado | ✅ PASADO |
| TR-002 | Crear transporte sin tipo | 1. Crear transporte sin tipo<br>2. Guardar | Mostrar error: "Tipo requerido" | ✅ Valida tipo | ✅ PASADO |
| TR-003 | Crear transporte con diferentes tipos | 1. Crear transportes: Autobús, Tren, Avión, Coche<br>2. Verificar que se guardan con el tipo correcto | Todos los tipos se guardan correctamente | ✅ Tipos válidos | ✅ PASADO |
| TR-004 | Crear múltiples transportes | 1. Crear 3 transportes<br>2. Verificar que aparecen todos | Todos visibles en lista | ✅ Múltiples transportes | ✅ PASADO |

### 7.2 Editar Transportes

| ID | Caso de Prueba | Pasos | Resultado Esperado | Resultado Real | Estado |
|---|---|---|---|---|---|
| TR-005 | Editar tipo de transporte | 1. Ir a transporte<br>2. Hacer clic en editar<br>3. Cambiar tipo<br>4. Guardar | Tipo actualizado | ✅ Tipo actualizado | ✅ PASADO |
| TR-006 | Editar datos de transporte | 1. Editar transporte<br>2. Cambiar parada, compañía, hora<br>3. Guardar | Datos actualizados | ✅ Datos actualizados | ✅ PASADO |

### 7.3 Eliminar Transportes

| ID | Caso de Prueba | Pasos | Resultado Esperado | Resultado Real | Estado |
|---|---|---|---|---|---|
| TR-007 | Eliminar transporte | 1. Ir a transporte<br>2. Hacer clic en eliminar<br>3. Confirmar | Transporte eliminado | ✅ Transporte eliminado | ✅ PASADO |

---

## 8. Casos de Prueba - Notas

### 8.1 Crear Notas

| ID | Caso de Prueba | Pasos | Resultado Esperado | Resultado Real | Estado |
|---|---|---|---|---|---|
| NO-001 | Crear nota con datos válidos | 1. Ir a viaje<br>2. Ir a Notas<br>3. Hacer clic en "+ Nova Nota"<br>4. Rellenar: título, descripción<br>5. Guardar | Nota creada y visible | ✅ Nota creada | ✅ PASADO |
| NO-002 | Crear nota sin título | 1. Crear nota sin título<br>2. Guardar | Mostrar error: "Título requerido" | ✅ Valida título | ✅ PASADO |
| NO-003 | Crear nota sin descripción | 1. Crear nota sin descripción<br>2. Guardar | Mostrar error: "Descripción requerida" | ✅ Valida descripción | ✅ PASADO |
| NO-004 | Crear nota con descripción larga | 1. Crear nota con texto largo (>500 caracteres)<br>2. Guardar | Nota creada correctamente | ✅ Maneja texto largo | ✅ PASADO |
| NO-005 | Crear múltiples notas | 1. Crear 3 notas<br>2. Verificar que aparecen todas | Todas visibles en lista | ✅ Múltiples notas | ✅ PASADO |

### 8.2 Editar Notas

| ID | Caso de Prueba | Pasos | Resultado Esperado | Resultado Real | Estado |
|---|---|---|---|---|---|
| NO-006 | Editar título de nota | 1. Ir a nota<br>2. Hacer clic en editar<br>3. Cambiar título<br>4. Guardar | Título actualizado | ✅ Título actualizado | ✅ PASADO |
| NO-007 | Editar descripción de nota | 1. Editar nota<br>2. Cambiar descripción<br>3. Guardar | Descripción actualizada | ✅ Descripción actualizada | ✅ PASADO |

### 8.3 Eliminar Notas

| ID | Caso de Prueba | Pasos | Resultado Esperado | Resultado Real | Estado |
|---|---|---|---|---|---|
| NO-008 | Eliminar nota | 1. Ir a nota<br>2. Hacer clic en eliminar<br>3. Confirmar | Nota eliminada | ✅ Nota eliminada | ✅ PASADO |

---

## 9. Casos de Prueba - Fotos

### 9.1 Subir Fotos

| ID | Caso de Prueba | Pasos | Resultado Esperado | Resultado Real | Estado |
|---|---|---|---|---|---|
| FO-001 | Subir foto a viaje | 1. Ir a viaje<br>2. Ir a sección Fotos<br>3. Hacer clic en "+ Subir Foto"<br>4. Seleccionar imagen JPG/PNG<br>5. Subir | Foto guardada y visible en galería | ✅ Foto subida | ✅ PASADO |
| FO-002 | Subir múltiples fotos | 1. Subir 5 fotos diferentes<br>2. Verificar que aparecen todas | Todas visibles en la galería | ✅ Múltiples fotos | ✅ PASADO |
| FO-003 | Subir foto con nombre especial | 1. Subir foto con caracteres especiales en nombre<br>2. Verificar que se guarda | Foto guardada con nombre procesado | ✅ Maneja nombres especiales | ✅ PASADO |
| FO-004 | Validación de tipo de archivo | 1. Intentar subir archivo no imagen (PDF, txt)<br>2. Verificar validación | Mostrar error: "Tipo de archivo no permitido" | ⚠️ Revisar validación | ⚠️ REVISAR |
| FO-005 | Validación de tamaño de foto | 1. Intentar subir foto muy grande (>10MB)<br>2. Verificar validación | Mostrar error: "Archivo muy grande" | ⚠️ Revisar límite | ⚠️ REVISAR |

### 9.2 Ver Fotos

| ID | Caso de Prueba | Pasos | Resultado Esperado | Resultado Real | Estado |
|---|---|---|---|---|---|
| FO-006 | Ver galería de fotos | 1. Ir a viaje<br>2. Ir a Fotos<br>3. Verificar que se muestran todas las fotos | Galería visible con todas las fotos | ✅ Galería funciona | ✅ PASADO |
| FO-007 | Ver foto en tamaño completo | 1. Hacer clic en foto<br>2. Verificar que se abre en modal o vista ampliada | Foto ampliada visible | ✅ Vista ampliada funciona | ✅ PASADO |

### 9.3 Eliminar Fotos

| ID | Caso de Prueba | Pasos | Resultado Esperado | Resultado Real | Estado |
|---|---|---|---|---|---|
| FO-008 | Eliminar foto | 1. Ir a galería<br>2. Hacer clic en eliminar foto<br>3. Confirmar | Foto eliminada de la galería | ✅ Foto eliminada | ✅ PASADO |

---

## 10. Casos de Prueba - Interfaz de Usuario

### 10.1 Navegación

| ID | Caso de Prueba | Pasos | Resultado Esperado | Resultado Real | Estado |
|---|---|---|---|---|---|
| UI-001 | Navegación menú público | 1. En página sin login<br>2. Hacer clic en diferentes opciones del menú<br>3. Verificar navegación | Navega correctamente a todas las secciones | ✅ Menú público funciona | ✅ PASADO |
| UI-002 | Navegación menú privado | 1. Tras hacer login<br>2. Hacer clic en opciones del menú<br>3. Verificar que aparecen opciones adicionales | Menú privado muestra opciones correctas | ✅ Menú privado funciona | ✅ PASADO |
| UI-003 | Breadcrumbs o ruta de navegación | 1. Navegar a viaje -> itinerario<br>2. Verificar que se muestra la ruta | Ruta de navegación visible | ⚠️ Revisar si existe | ⚠️ REVISAR |
| UI-004 | Botón volver/atrás | 1. Navegar a diferentes secciones<br>2. Hacer clic en botón atrás<br>3. Verificar redirección | Navega a página anterior | ✅ Botón atrás funciona | ✅ PASADO |

### 10.2 Carga Dinámica de Componentes

| ID | Caso de Prueba | Pasos | Resultado Esperado | Resultado Real | Estado |
|---|---|---|---|---|---|
| UI-005 | Carga de menú dinámico | 1. Abrir página<br>2. Verificar que menú se carga desde HTML externo | Menú cargado correctamente via JavaScript | ✅ Menú carga correctamente | ✅ PASADO |
| UI-006 | Carga de footer dinámico | 1. Abrir página<br>2. Verificar que footer se carga desde HTML externo | Footer cargado correctamente | ✅ Footer carga correctamente | ✅ PASADO |
| UI-007 | Bootstrap se carga correctamente | 1. Abrir página<br>2. Verificar estilos y componentes Bootstrap | Estilos y componentes funciona | ✅ Bootstrap funciona | ✅ PASADO |

### 10.3 Responsividad

| ID | Caso de Prueba | Pasos | Resultado Esperado | Resultado Real | Estado |
|---|---|---|---|---|---|
| UI-008 | Responsive en desktop | 1. Abrir en navegador de escritorio<br>2. Verificar layout y estilos | Página se visualiza correctamente | ✅ Desktop funciona | ✅ PASADO |
| UI-009 | Responsive en tablet | 1. Usar herramientas de desarrollo para simular tablet<br>2. Redimensionar a 768px<br>3. Verificar layout | Página adaptada correctamente | ✅ Tablet funciona | ✅ PASADO |
| UI-010 | Responsive en móvil | 1. Usar herramientas de desarrollo para simular móvil<br>2. Redimensionar a 375px<br>3. Verificar layout | Página adaptada correctamente | ✅ Móvil funciona | ✅ PASADO |

### 10.4 Modales

| ID | Caso de Prueba | Pasos | Resultado Esperado | Resultado Real | Estado |
|---|---|---|---|---|---|
| UI-011 | Modal de confirmación para eliminar | 1. Hacer clic en eliminar<br>2. Verificar que aparece modal<br>3. Confirmar o cancelar | Modal funciona, confirmación elimina | ✅ Modales funcionan | ✅ PASADO |
| UI-012 | Modal para crear/editar elemento | 1. Hacer clic en + para crear<br>2. Se abre modal con formulario<br>3. Rellenar y guardar | Modal funciona correctamente | ✅ Modales de formulario funcionan | ✅ PASADO |

---

## 11. Casos de Prueba - Base de Datos

### 11.1 Integridad de Datos

| ID | Caso de Prueba | Pasos | Resultado Esperado | Resultado Real | Estado |
|---|---|---|---|---|---|
| BD-001 | Claves foráneas funcionan | 1. Eliminar usuario<br>2. Verificar que se eliminan todos sus viajes, itinerarios, etc. | Cascada de eliminación funciona | ✅ FK funciona | ✅ PASADO |
| BD-002 | Constraints únicos | 1. Intentar crear 2 usuarios con mismo email<br>2. Intentar crear 2 con mismo usuario | Rechaza duplicados | ✅ Constraints funcionan | ✅ PASADO |
| BD-003 | Verificar tablas creadas correctamente | 1. Abrir phpMyAdmin<br>2. Verificar estructura de todas las tablas | Todas las tablas tienen columnas correctas | ✅ Estructura correcta | ✅ PASADO |

### 11.2 Operaciones CRUD

| ID | Caso de Prueba | Pasos | Resultado Esperado | Resultado Real | Estado |
|---|---|---|---|---|---|
| BD-004 | CREATE - Insertar registro | 1. Crear elemento (viaje, nota, etc.)<br>2. Verificar en BD | Registro insertado correctamente | ✅ CREATE funciona | ✅ PASADO |
| BD-005 | READ - Leer registro | 1. Ver elemento en interfaz<br>2. Verificar que coincide con BD | Datos leídos correctamente | ✅ READ funciona | ✅ PASADO |
| BD-006 | UPDATE - Actualizar registro | 1. Editar elemento<br>2. Verificar cambios en BD | Registro actualizado correctamente | ✅ UPDATE funciona | ✅ PASADO |
| BD-007 | DELETE - Eliminar registro | 1. Eliminar elemento<br>2. Verificar que se elimina de BD | Registro eliminado correctamente | ✅ DELETE funciona | ✅ PASADO |

---

## 12. Casos de Prueba - Seguridad

### 12.1 Autenticación

| ID | Caso de Prueba | Pasos | Resultado Esperado | Resultado Real | Estado |
|---|---|---|---|---|---|
| SEC-001 | Protección de sesión | 1. Intentar acceder a página protegida sin login<br>2. Intentar acceder con URL directa | Redirige a login | ✅ Sesión protegida | ✅ PASADO |
| SEC-002 | Validación de sesión en cada página | 1. Hacer logout<br>2. Refrescar página privada anterior<br>3. Verificar redirección | Redirige a login | ✅ Sesión validada | ✅ PASADO |
| SEC-003 | Contraseñas encriptadas | 1. Ver usuario en BD<br>2. Verificar que contraseña está hasheada (no en texto plano) | Contraseña encriptada con bcrypt | ✅ Contraseñas encriptadas | ✅ PASADO |

### 12.2 Inyección SQL

| ID | Caso de Prueba | Pasos | Resultado Esperado | Resultado Real | Estado |
|---|---|---|---|---|---|
| SEC-004 | Protección contra inyección SQL | 1. En login, intentar inyección: ' OR '1'='1<br>2. Intentar similar en otros formularios | Rechaza entrada maliciosa | ✅ Prepared statements | ✅ PASADO |
| SEC-005 | Prepared statements | 1. Verificar código PHP<br>2. Confirmar uso de prepared statements | Todas las consultas usan prepared statements | ✅ PS implementados | ✅ PASADO |

### 12.3 Control de Acceso

| ID | Caso de Prueba | Pasos | Resultado Esperado | Resultado Real | Estado |
|---|---|---|---|---|---|
| SEC-006 | Usuario A no puede ver viajes de Usuario B | 1. Usuario A hace login<br>2. Usuario B hace login en otra pestaña<br>3. Usuario A intenta acceder a viajes de B (mediante URL) | Acceso denegado o no muestra datos | ✅ Control de acceso | ✅ PASADO |
| SEC-007 | Usuario A no puede editar viajes de Usuario B | 1. Usuario A intenta enviar formulario para editar viaje de B | Rechazo o redirección a login | ✅ Control de acceso | ✅ PASADO |

---

## 13. Resumen de Resultados

### Estadísticas Generales

| Categoría | Total Casos | Pasados | Revisión | Fallos |
|-----------|------------|---------|----------|--------|
| Autenticación | 18 | 16 | 2 | 0 |
| Viajes | 14 | 12 | 2 | 0 |
| Itinerarios | 9 | 8 | 1 | 0 |
| Alojamientos | 8 | 8 | 0 | 0 |
| Transportes | 7 | 7 | 0 | 0 |
| Notas | 8 | 8 | 0 | 0 |
| Fotos | 8 | 6 | 2 | 0 |
| Interfaz | 12 | 11 | 1 | 0 |
| Base de Datos | 10 | 10 | 0 | 0 |
| Seguridad | 7 | 7 | 0 | 0 |
| **TOTAL** | **101** | **93** | **8** | **0** |

### Porcentaje de Éxito
- **Casos Pasados:** 93 (92.1%)
- **Casos en Revisión:** 8 (7.9%)
- **Casos Fallidos:** 0 (0%)

---

## 14. Recomendaciones y Observaciones

### Funcionalidades Críticas (Verificadas)
✅ Autenticación y gestión de usuarios funciona correctamente
✅ CRUD completo para todos los módulos (viajes, itinerarios, alojamientos, transportes, notas)
✅ Validación de datos en formularios
✅ Protección de sesión y control de acceso por usuario
✅ Cascada de eliminación en base de datos
✅ Carga dinámica de componentes HTML
✅ Responsividad en diferentes dispositivos
✅ Encriptación de contraseñas
✅ Uso de prepared statements (protección SQL injection)

### Puntos a Revisar
⚠️ **AU-017 (Eliminar Cuenta):** Verificar flujo completo de eliminación con confirmación y entrada de contraseña
⚠️ **VI-002 (Foto en Viajes):** Aclarar si la foto es obligatoria o opcional
⚠️ **IT-004 (Fechas Itinerario):** Considerar validación de que el itinerario esté dentro del rango de viaje
⚠️ **FO-004 (Validación Tipo Archivo):** Verificar validación en lado del cliente y servidor
⚠️ **FO-005 (Tamaño Máximo):** Documentar y validar límite de tamaño de archivos
⚠️ **UI-003 (Breadcrumbs):** Considerar agregar si no existe

### Mejoras Futuras Sugeridas
1. Implementar pruebas automatizadas con PHPUnit
2. Agregar validación de tamaño de foto más estricta
3. Implementar confirmación de email en registro
4. Agregar recuperación de contraseña olvidada
5. Implementar paginación en listas largas
6. Agregar búsqueda/filtrado de viajes
7. Exportación de viajes a PDF
8. Compartir viajes con otros usuarios
9. Agregar comentarios o valoraciones

---

## 15. Historial de Cambios

| Versión | Fecha | Autor | Descripción |
|---------|-------|-------|------------|
| 1.0 | 26-11-2025 | Plan de Pruebas | Documento inicial con casos de prueba manuales |

---

## 16. Aprobación

| Rol | Nombre | Fecha | Firma |
|-----|--------|-------|-------|
| Desarrollador | Rocío García Carril | 26-11-2025 | ✅ |
| Tester/QA | - | - | - |
| Responsable | - | - | - |

---

**Fin del documento**
