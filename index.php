<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/1bf359b2a0.js" crossorigin="anonymous"></script>
    <title>Nomina</title>
</head>

<body>

    <script>
        function eliminar() {
            let res = confirm("Estas seguro que deseas eliminar");
            return res;
        }
    </script>

    <h1 class="text-center p-3">Nomina</h1>

    <div class="container-fluid row">
        <form class="col-3 p-3" method="POST">
            <?php
                include_once "./modelo/conexion.php";
                include_once "./controlador/registrar_empleado.php";
                include_once "./controlador/eliminar_empleado.php";
            ?>
            <h3 class="text-center text-secondary">Registro de Nomina</h3>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Empleado</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+">
            </div>
            <div class="mb-3">
                <label for="centro" class="form-label">Centro de Cargo del Empleado</label>
                <input type="text" class="form-control" id="centro" name="centro_cargo" required pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+">
            </div>
            <div class="mb-3">
                <label for="cargo" class="form-label">Cargo del Empleado</label>
                <input type="text" class="form-control" id="cargo" name="cargo" required pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+">
            </div>
            <div class="mb-3">
                <label for="identificacion" class="form-label">Identificación del Empleado</label>
                <input type="text" class="form-control" id="identificacion" name="identificacion" required>
            </div>
            <div class="mb-3">
                <label for="salario" class="form-label">Salario Base del Empleado</label>
                <input type="text" class="form-control" id="salario" name="salario" required>
            </div>
            <div class="mb-3">
                <label for="dias" class="form-label">Días laborados</label>
                <input type="number" class="form-control" id="dias" name="dias" required>
            </div>
            <div class="mb-3">
                <label for="diasIncapacidad" class="form-label">Días laborados</label>
                <input type="number" class="form-control" id="diasIncapacidad" name="diasIncapacidad" required>
            </div>

            <!--Recargo nocturno, Hora dominical-->
            <button type="submit" class="btn btn-primary" name="btnregistrar" value="ok">Registrar</button>
        </form>
        <div class="col-9 p-4">
            <table class="table table-striped">
                <caption>Lista de empleados</caption>
                <thead class="bg-info">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Cargo</th>
                        <th scope="col">Identificación</th>
                        <th scope="col">Salario Base</th>
                        <th scope="col">Días Laborados</th>
                        <th scope="col">Pago Total</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $sql = $conexion->query("SELECT * FROM nomina_empleado");

                    while ($row = $sql->fetch_object()) {
                    ?>
                        <tr>
                            <td><?= $row->id ?>            </td>
                            <td><?= $row->nombre ?>        </td>
                            <td><?= $row->cargo ?>         </td>
                            <td><?= $row->identificacion ?></td>
                            <td><?= $row->salario ?>       </td>
                            <td><?= $row->dias ?>          </td>
                            <td><?= $row->fecha_registro ?></td>
                            <td>
                                <a href="index.php/pdf.php?id=<?= $row->id ?>" class="btn btn-small btn-warning"><i class="fa-solid fa-print"></i></a>
                                <a onclick="return eliminar()" href="index.php?id=<?= $row->id ?>" class="btn btn-small btn-danger"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>