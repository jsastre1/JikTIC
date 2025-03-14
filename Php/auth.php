<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jktic";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Conexión fallida: " . $conn->connect_error]));
}

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $user_email = $_POST['username'];
    $user_password = $_POST['password'];

    // Validar que el usuario sea un correo electrónico válido
    if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => "error", "message" => "Por favor, ingrese un correo electrónico válido."]);
        exit;
    }

    // Validar que la contraseña tenga al menos 6 caracteres
    if (strlen($user_password) < 6) {
        echo json_encode(["status" => "error", "message" => "La contraseña debe tener al menos 6 caracteres."]);
        exit;
    }

    if ($action === 'register') {
        // Encriptar la contraseña
        $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

        // Insertar el nuevo usuario en la base de datos
        $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $user_email, $hashed_password);
        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Registro exitoso."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error al registrar el usuario."]);
        }
        $stmt->close();
    } elseif ($action === 'login') {
        // Consultar la base de datos para verificar las credenciales
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $user_email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Verificar la contraseña ingresada con la contraseña almacenada
            if (password_verify($user_password, $row['password'])) {
                // Almacenar la información del usuario en la sesión
                $_SESSION['user'] = $user_email;
                echo json_encode(["status" => "success", "message" => "Inicio de sesión exitoso. Bienvenido, " . htmlspecialchars($user_email, ENT_QUOTES, 'UTF-8') . "!", "user" => $user_email]);
            } else {
                echo json_encode(["status" => "error", "message" => "Nombre de usuario o contraseña incorrectos."]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Nombre de usuario o contraseña incorrectos."]);
        }
        $stmt->close();
    }
}

$conn->close();
?>