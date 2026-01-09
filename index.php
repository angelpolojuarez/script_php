<?php
// =====================
// ARRAYS VACÍOS
// =====================
$estudiantes = [];
$libros = [];
$prestamos = [];

// =====================
// AÑADIR ESTUDIANTE
// =====================
if (isset($_POST["add_estudiante"])) {
    $estudiantes[] = $_POST["nombre_estudiante"];
}

// =====================
// AÑADIR LIBRO
// =====================
if (isset($_POST["add_libro"])) {
    $libros[] = [
        "titulo" => $_POST["titulo_libro"],
        "copias" => $_POST["cantidad"]
    ];
}

// =====================
// AÑADIR PRÉSTAMO NORMAL
// =====================
if (isset($_POST["add_prestamo"])) {
    $prestamos[] = [
        "estudiante" => $_POST["estudiante"],
        "libro" => $_POST["libro"],
        "fecha" => date("Y-m-d")
    ];
}

// =====================
// AÑADIR PRÉSTAMO VENCIDO
// =====================
if (isset($_POST["add_vencido"])) {
    $prestamos[] = [
        "estudiante" => $_POST["estudiante_v"],
        "libro" => $_POST["libro_v"],
        "fecha" => $_POST["fecha_v"]
    ];
}

$hoy = date("Y-m-d");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Sistema de Biblioteca</title>
<style>
body {
    font-family: Arial;
    background: #0e4b91;
    color: white;
    padding: 20px;
}
.box {
    background: #143b6b;
    padding: 15px;
    border-radius: 10px;
    width: 90%;
    margin: 15px auto;
}
table {
    width: 100%;
    border-collapse: collapse;
}
th, td {
    border: 1px solid white;
    padding: 8px;
    text-align: center;
}
th {
    background: #1f5aa6;
}
input, select, button {
    padding: 6px;
    margin: 4px;
}
button {
    background: #1f5aa6;
    color: white;
    border: none;
}
h1, h2 {
    text-align: center;
}
</style>
</head>

<body>

<h1>📚 Gestión de Biblioteca</h1>

<!-- AÑADIR ESTUDIANTE -->
<div class="box">
<h2>➕ Añadir Estudiante</h2>
<form method="post">
    <input type="text" name="nombre_estudiante" placeholder="Nombre completo" required>
    <button name="add_estudiante">Añadir</button>
</form>
</div>

<!-- MOSTRAR ESTUDIANTES -->
<div class="box">
<h2>👨‍🎓 Estudiantes</h2>
<table>
<tr><th>#</th><th>Nombre</th></tr>
<?php foreach ($estudiantes as $i => $e): ?>
<tr>
    <td><?= $i + 1 ?></td>
    <td><?= $e ?></td>
</tr>
<?php endforeach; ?>
</table>
</div>

<!-- AÑADIR LIBRO -->
<div class="box">
<h2>➕ Añadir Libro</h2>
<form method="post">
    <input type="text" name="titulo_libro" placeholder="Título" required>
    <input type="number" name="cantidad" min="1" required>
    <button name="add_libro">Añadir</button>
</form>
</div>

<!-- MOSTRAR LIBROS -->
<div class="box">
<h2>📖 Libros</h2>
<table>
<tr><th>#</th><th>Título</th><th>Copias</th></tr>
<?php foreach ($libros as $i => $l): ?>
<tr>
    <td><?= $i + 1 ?></td>
    <td><?= $l["titulo"] ?></td>
    <td><?= $l["copias"] ?></td>
</tr>
<?php endforeach; ?>
</table>
</div>

<!-- REGISTRAR PRÉSTAMO -->
<div class="box">
<h2>📄 Registrar Préstamo</h2>
<form method="post">
<select name="estudiante" required>
    <?php foreach ($estudiantes as $e): ?>
        <option><?= $e ?></option>
    <?php endforeach; ?>
</select>

<select name="libro" required>
    <?php foreach ($libros as $l): ?>
        <option><?= $l["titulo"] ?></option>
    <?php endforeach; ?>
</select>

<button name="add_prestamo">Registrar</button>
</form>
</div>

<!-- AÑADIR PRÉSTAMO VENCIDO -->
<div class="box">
<h2>⚠ Añadir Préstamo Vencido</h2>
<form method="post">
<select name="estudiante_v" required>
    <?php foreach ($estudiantes as $e): ?>
        <option><?= $e ?></option>
    <?php endforeach; ?>
</select>

<select name="libro_v" required>
    <?php foreach ($libros as $l): ?>
        <option><?= $l["titulo"] ?></option>
    <?php endforeach; ?>
</select>

<input type="date" name="fecha_v" required>
<button name="add_vencido">Añadir</button>
</form>
</div>

<!-- LISTA DE PRÉSTAMOS -->
<div class="box">
<h2>📋 Préstamos</h2>
<table>
<tr><th>Estudiante</th><th>Libro</th><th>Fecha</th><th>Estado</th></tr>

<?php foreach ($prestamos as $p): 
$dias = (strtotime($hoy) - strtotime($p["fecha"])) / 86400;
$estado = $dias > 15 ? "⚠ Vencido" : "✔ Vigente";
?>
<tr>
    <td><?= $p["estudiante"] ?></td>
    <td><?= $p["libro"] ?></td>
    <td><?= $p["fecha"] ?></td>
    <td><?= $estado ?></td>
</tr>
<?php endforeach; ?>
</table>
</div>

</body>
</html>




