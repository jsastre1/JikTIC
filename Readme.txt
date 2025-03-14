# Proyecto de Formulario de Registro

Este proyecto es un formulario de registro con un diseño moderno y responsivo, utilizando HTML, CSS y JavaScript. El formulario valida los datos del usuario.

## Características

- **Formulario de Registro**: Permite a los usuarios registrarse con un correo electrónico y una contraseña.
- **Validación de Datos**: Valida que el correo electrónico sea válido y que la contraseña tenga al menos 6 caracteres.
- **Diseño Responsivo**: Se adapta a diferentes tamaños de pantalla (teléfonos, tabletas y laptops).

## Instalación

1. **Clonar el Repositorio**:

    git clone https://github.com/jsastre1/Jktic.git
    cd  Jktic.git

2. **Abrir el Proyecto en Visual Studio Code y Xampp**:

    File > Open folder y seleccionar la carpeta donde se tenga guardado

3. **Configurar el Servidor Local**:
    - Si estás utilizando XAMPP, asegúrate de que el servidor Apache esté corriendo.
    - Coloca el proyecto en la carpeta `htdocs` de XAMPP.
  
## Uso

1. **Abrir el Navegador**:
    - Navega a "http://localhost/JkTIC - avanzado/Html/index.html".

2. **Registrar un Usuario**:
    - Da clic en el enlace Registrate aqui luego Completa el formulario con un correo electrónico válido y una contraseña de al menos 6 caracteres.
    - Haz clic en "Registrar".

3. **Cerrar Sesión**:
    - Haz clic en el botón "Cerrar Sesión" para eliminar los datos del usuario de "localStorage".

## Archivos Principales

### Carpeta HTML 
bienvenido.html -> Mensaje que muetra que el usuario esta logueado o inicio sesion de menra valida
index.html -> Pagina de inicio con login sgun usuarios registrados
register.html -> registro de usuarios que se almacenan en Mysql

### Carpeta Css
styles.css -> estilos para todas las paginas y Media querys para el diseño responsivo

### Carpeta JavaScript
scripts.js -> Validacion de login, envio de informacion.

### Carpeta Php
auth.php -> Conexion con Base de datos y insercion de datos nuevos 
check_session.php - > sesion actia o inactiva
logout.php -> Verificacion que la session se inicio y cerro correctamente

Mejoras:
- Un botón de Cerrar Sesión que borre el usuario de localStorage.
- Un efecto de loading en el botón mientras se procesa el login.
- Uso de fetch() para autenticar con una API (simulada con setTimeout).