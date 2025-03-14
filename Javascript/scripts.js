function validateForm(action) {
    let username, password;
    if (action === 'login') {
        username = document.getElementById('username').value;
        password = document.getElementById('password').value;
    } else if (action === 'register') {
        username = document.getElementById('reg_username').value;
        password = document.getElementById('reg_password').value;
    }

    // Validar que el usuario sea un correo electrónico válido
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(username)) {
        alert('Por favor, ingrese un correo electrónico válido.');
        return false;
    }

    // Validar que la contraseña tenga al menos 6 caracteres
    if (password.length < 6) {
        alert('La contraseña debe tener al menos 6 caracteres.');
        return false;
    }

    // Enviar los datos del formulario mediante AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../Php/auth.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.status === "success") {
                if (action === 'login') {
                    localStorage.setItem("user", response.user);
                    alert(response.message);
                    // Redirigir a la página de bienvenida o dashboard
                    window.location.href = "bienvenido.html";
                } else {
                    alert(response.message);
                    // Redirigir a la página de inicio de sesión
                    window.location.href = "index.html";
                }
            } else {
                alert(response.message);
            }
        }
    };
    xhr.send("action=" + encodeURIComponent(action) + "&username=" + encodeURIComponent(username) + "&password=" + encodeURIComponent(password));

    return false; // Evitar el envío del formulario
}