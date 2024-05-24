<div class="container">
    <div class="row g-4">
        <!-- Formulario de Estudiante -->
        <div class="col-md-6">
            <form class="bg-light p-4 rounded-lg m-3 bg-primary" style="
                background: linear-gradient(
                    to right,
                    #4c24ee,
                    #4624ee,
                    #245aee,
                    #24a7ee
                );
            " method="POST" action="/crear-estudiante">
                <h2 class="text-lg font-semibold mb-4">Estudiante Form</h2>
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" id="name" name="name" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Birth Date:</label>
                    <input type="date" id="date" name="date" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="sex" class="form-label">Sex:</label>
                    <input type="text" id="sex" name="sex" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-control">
                </div>
                <div class="d-grid mb-2">
                    <input type="submit" value="Crear Estudiante" class="btn btn-success">
                </div>
                <div class="d-grid">
                    <button id="actualizarEstudiante" class="btn btn-info">Actualizar Estudiante</button>
                </div>
            </form>
        </div>

        <!-- Formulario de Materia -->
        <div class="col-md-6">
            <form class="bg-light p-4 rounded-lg m-3 bg-primary" style="
                background: linear-gradient(
                    to right,
                    #4c24ee,
                    #4624ee,
                    #245aee,
                    #24a7ee
                );
            " method="POST" action="/crear-materia">
                <h2 class="text-lg font-semibold mb-4">Materia Form</h2>
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" id="name" name="name" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="credits" class="form-label">Credits:</label>
                    <input type="number" id="credits" name="credits" class="form-control">
                </div>
                <div class="d-grid mb-2">
                    <input type="submit" value="Crear Materia" class="btn btn-success">
                </div>
                <div class="d-grid">
                    <button id="actualizarMateria" class="btn btn-info">Actualizar Materia</button>
                </div>
            </form>
        </div>

        <!-- Formulario de Matricula -->
        <div class="col-md-6">
            <form class="bg-light p-4 rounded-lg m-3 bg-primary" style="
                background: linear-gradient(
                    to right,
                    #4c24ee,
                    #4624ee,
                    #245aee,
                    #24a7ee
                );
            " method="POST" action="/crear-matricula">
                <h2 class="text-lg font-semibold mb-4">Matricula Form</h2>
                <div class="mb-3">
                    <label for="cedula" class="form-label">Cedula:</label>
                    <input type="text" id="cedula" name="cedula" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="id_materia" class="form-label">ID Materia:</label>
                    <input type="number" id="id_materia" name="id_materia" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="periodo_academico" class="form-label">Periodo Academico:</label>
                    <input type="number" id="periodo_academico" name="periodo_academico" class="form-control">
                </div>
                <div class="d-grid mb-2">
                    <input type="submit" value="Crear Matricula" class="btn btn-success">
                </div>
                <div class="d-grid">
                    <button id="actualizarMatricula" class="btn btn-info">Actualizar Matricula</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    function showToast(message, icon) {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: icon,
            title: message
        });
    }

    document.getElementById('actualizarEstudiante').addEventListener('click', async function(event) {
        event.preventDefault();

        const {
            value: searchQuery
        } = await Swal.fire({
            title: 'Buscar Estudiante',
            input: 'text',
            inputPlaceholder: 'Ingrese la ID del estudiante...',
            showCancelButton: true,
            inputValidator: (value) => {
                if (!value) {
                    return 'Por favor ingrese una ID';
                }
            }
        });

        if (searchQuery) {
            try {
                const response = await fetch('/obtenerestudiantes', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                });

                const estudiantes = await response.json();
                const estudiante = estudiantes.find(est => est.id.toString() === searchQuery);

                if (estudiante) {
                    const tableContent = `
                <div class="max-w-md mx-auto bg-white shadow-md rounded my-6 dark:bg-gray-800 d-flex justify-content-center">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-blue-100 dark:bg-blue-900 border border-blue-500 dark:border-blue-700">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b-2 border-blue-500 dark:border-blue-700 text-left text-sm leading-4 font-medium text-blue-600 dark:text-blue-300 uppercase">ID</th>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-blue-500 dark:border-blue-700 text-blue-800 dark:text-blue-200">${estudiante.id}</td>
                                </tr>
                                <tr>
                                    <th class="px-6 py-3 border-b-2 border-blue-500 dark:border-blue-700 text-left text-sm leading-4 font-medium text-blue-600 dark:text-blue-300 uppercase">Name</th>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-blue-500 dark:border-blue-700 text-blue-800 dark:text-blue-200">${estudiante.name}</td>
                                </tr>
                                <tr>
                                    <th class="px-6 py-3 border-b-2 border-blue-500 dark:border-blue-700 text-left text-sm leading-4 font-medium text-blue-600 dark:text-blue-300 uppercase">Date</th>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-blue-500 dark:border-blue-700 text-blue-800 dark:text-blue-200">${estudiante.date}</td>
                                </tr>
                                <tr>
                                    <th class="px-6 py-3 border-b-2 border-blue-500 dark:border-blue-700 text-left text-sm leading-4 font-medium text-blue-600 dark:text-blue-300 uppercase">Sex</th>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-blue-500 dark:border-blue-700 text-blue-800 dark:text-blue-200">${estudiante.sex}</td>
                                </tr>
                                <tr>
                                    <th class="px-6 py-3 border-b-2 border-blue-500 dark:border-blue-700 text-left text-sm leading-4 font-medium text-blue-600 dark:text-blue-300 uppercase">Email</th>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-blue-500 dark:border-blue-700 text-blue-800 dark:text-blue-200">${estudiante.email}</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                `;

                    Swal.fire({
                        title: 'Coincidencia Encontrada',
                        html: tableContent,
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Sí, deseo modificar!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'Modificar Estudiante',
                                html: `
                            <input id="swal-id" class="swal2-input" placeholder="ID" value="${estudiante.id}" readonly>
                            <input id="swal-name" class="swal2-input" placeholder="Nombre" value="${estudiante.name}">
                            <input type="date" id="swal-date" class="swal2-input" value="${estudiante.date}">
                            <input id="swal-sex" class="swal2-input" placeholder="Sexo" value="${estudiante.sex}">
                            <input id="swal-email" class="swal2-input" placeholder="Email" value="${estudiante.email}">`,
                                focusConfirm: false,
                                preConfirm: () => {
                                    return {
                                        id: document.getElementById('swal-id').value,
                                        name: document.getElementById('swal-name').value,
                                        date: document.getElementById('swal-date').value,
                                        sex: document.getElementById('swal-sex').value,
                                        email: document.getElementById('swal-email').value
                                    };
                                },
                                showCancelButton: true,
                                confirmButtonText: 'Guardar Cambios',
                                cancelButtonText: 'Cancelar',
                                showLoaderOnConfirm: true,
                                allowOutsideClick: () => !Swal.isLoading(),
                            }).then(async (result) => {
                                if (result.isConfirmed) {
                                    const updatedEstudiante = result.value;
                                    try {
                                        const response = await fetch('/actualizarestudiante', {
                                            method: 'PUT',
                                            headers: {
                                                'Content-Type': 'application/json'
                                            },
                                            body: JSON.stringify(updatedEstudiante)
                                        });

                                        const data = await response.json();

                                        if (data.success) {
                                            showToast(data.success, 'success');
                                        } else if (data.error) {
                                            showToast(data.error, 'error');
                                        }
                                    } catch (error) {
                                        showToast('Error al actualizar el estudiante', 'error');
                                    }
                                }
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'No se encontró coincidencia',
                        text: 'Intente con otra ID',
                        icon: 'error'
                    });
                }
            } catch (error) {
                Swal.fire({
                    title: "Error!",
                    text: "Hubo un problema al buscar el estudiante.",
                    icon: "error"
                });
            }
        }
    });

    document.getElementById('actualizarMateria').addEventListener('click', async function(event) {
        event.preventDefault();

        const {
            value: searchQuery
        } = await Swal.fire({
            title: 'Buscar Materia',
            input: 'text',
            inputPlaceholder: 'Ingrese la ID de la materia...',
            showCancelButton: true,
            inputValidator: (value) => {
                if (!value) {
                    return 'Por favor ingrese una ID';
                }
            }
        });

        if (searchQuery) {
            try {
                const response = await fetch('/obtenermaterias', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                });

                const materias = await response.json();
                const materia = materias.find(mat => mat.id.toString() === searchQuery);

                if (materia) {
                    const tableContent = `
                <div class="max-w-md mx-auto bg-white shadow-md rounded my-6 dark:bg-gray-800 d-flex justify-content-center">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-blue-100 dark:bg-blue-900 border border-blue-500 dark:border-blue-700">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b-2 border-blue-500 dark:border-blue-700 text-left text-sm leading-4 font-medium text-blue-600 dark:text-blue-300 uppercase">ID</th>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-blue-500 dark:border-blue-700 text-blue-800 dark:text-blue-200">${materia.id}</td>
                                </tr>
                                <tr>
                                    <th class="px-6 py-3 border-b-2 border-blue-500 dark:border-blue-700 text-left text-sm leading-4 font-medium text-blue-600 dark:text-blue-300 uppercase">Name</th>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-blue-500 dark:border-blue-700 text-blue-800 dark:text-blue-200">${materia.name}</td>
                                </tr>
                                <tr>
                                    <th class="px-6 py-3 border-b-2 border-blue-500 dark:border-blue-700 text-left text-sm leading-4 font-medium text-blue-600 dark:text-blue-300 uppercase">Credits</th>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-blue-500 dark:border-blue-700 text-blue-800 dark:text-blue-200">${materia.credits}</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                `;

                    Swal.fire({
                        title: 'Coincidencia Encontrada',
                        html: tableContent,
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Sí, deseo modificar!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'Modificar Materia',
                                html: `
                            <input id="swal-id" class="swal2-input" placeholder="ID" value="${materia.id}" readonly>
                            <input id="swal-name" class="swal2-input" placeholder="Nombre" value="${materia.name}">
                            <input type="number" id="swal-credits" class="swal2-input" value="${materia.credits}">`,
                                focusConfirm: false,
                                preConfirm: () => {
                                    return {
                                        id: document.getElementById('swal-id').value,
                                        name: document.getElementById('swal-name').value,
                                        credits: document.getElementById('swal-credits').value
                                    };
                                },
                                showCancelButton: true,
                                confirmButtonText: 'Guardar Cambios',
                                cancelButtonText: 'Cancelar',
                                showLoaderOnConfirm: true,
                                allowOutsideClick: () => !Swal.isLoading(),
                            }).then(async (result) => {
                                if (result.isConfirmed) {
                                    const updatedMateria = result.value;
                                    try {
                                        const response = await fetch('/actualizarmateria', {
                                            method: 'PUT',
                                            headers: {
                                                'Content-Type': 'application/json'
                                            },
                                            body: JSON.stringify(updatedMateria)
                                        });

                                        const data = await response.json();

                                        if (data.success) {
                                            showToast(data.success, 'success');
                                        } else if (data.error) {
                                            showToast(data.error, 'error');
                                        }
                                    } catch (error) {
                                        showToast('Error al actualizar la materia', 'error');
                                    }
                                }
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'No se encontró coincidencia',
                        text: 'Intente con otra ID',
                        icon: 'error'
                    });
                }
            } catch (error) {
                Swal.fire({
                    title: "Error!",
                    text: "Hubo un problema al buscar la materia.",
                    icon: "error"
                });
            }
        }
    });

    document.getElementById('actualizarMatricula').addEventListener('click', async function(event) {
        event.preventDefault();

        const {
            value: searchQuery
        } = await Swal.fire({
            title: 'Buscar Matricula',
            input: 'text',
            inputPlaceholder: 'Ingrese la ID de la matricula...',
            showCancelButton: true,
            inputValidator: (value) => {
                if (!value) {
                    return 'Por favor ingrese una ID';
                }
            }
        });

        if (searchQuery) {
            try {
                const response = await fetch('/obtenermatriculas', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                });

                const matriculas = await response.json();
                const matricula = matriculas.find(mat => mat.id.toString() === searchQuery);

                if (matricula) {
                    const tableContent = `
                <div class="max-w-md mx-auto bg-white shadow-md rounded my-6 dark:bg-gray-800 d-flex justify-content-center">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-blue-100 dark:bg-blue-900 border border-blue-500 dark:border-blue-700">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b-2 border-blue-500 dark:border-blue-700 text-left text-sm leading-4 font-medium text-blue-600 dark:text-blue-300 uppercase">ID</th>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-blue-500 dark:border-blue-700 text-blue-800 dark:text-blue-200">${matricula.id}</td>
                                </tr>
                                <tr>
                                    <th class="px-6 py-3 border-b-2 border-blue-500 dark:border-blue-700 text-left text-sm leading-4 font-medium text-blue-600 dark:text-blue-300 uppercase">Cedula</th>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-blue-500 dark:border-blue-700 text-blue-800 dark:text-blue-200">${matricula.cedula}</td>
                                </tr>
                                <tr>
                                    <th class="px-6 py-3 border-b-2 border-blue-500 dark:border-blue-700 text-left text-sm leading-4 font-medium text-blue-600 dark:text-blue-300 uppercase">ID_Matricula: </th>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-blue-500 dark:border-blue-700 text-blue-800 dark:text-blue-200">${matricula.id_materia}</td>
                                </tr>

                                <tr>
                                    <th class="px-6 py-3 border-b-2 border-blue-500 dark:border-blue-700 text-left text-sm leading-4 font-medium text-blue-600 dark:text-blue-300 uppercase">Periodo</th>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-blue-500 dark:border-blue-700 text-blue-800 dark:text-blue-200">${matricula.periodo_academico}</td>
                                </tr>

                            </thead>
                        </table>
                    </div>
                </div>
                `;

                    Swal.fire({
                        title: 'Coincidencia Encontrada',
                        html: tableContent,
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Sí, deseo modificar!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'Modificar Matricula',
                                html: `
                            <input id="swal-id" class="swal2-input" placeholder="ID" value="${matricula.id}" readonly>
                            <input id="swal-cedula" class="swal2-input" placeholder="Cedula" value="${matricula.cedula}">
                            <input type="number" id="swal-id_materia" class="swal2-input" placeholder="id materia" value="${matricula.id_materia}">
                            <input type="number" id="swal-periodo_academico" class="swal2-input" value="${matricula.periodo_academico}">`,
                                focusConfirm: false,
                                preConfirm: () => {
                                    return {
                                        id: document.getElementById('swal-id').value,
                                        cedula: document.getElementById('swal-cedula').value,
                                        id_materia: document.getElementById('swal-id_materia').value,
                                        periodo_academico: document.getElementById('swal-periodo_academico').value
                                    };
                                },
                                showCancelButton: true,
                                confirmButtonText: 'Guardar Cambios',
                                cancelButtonText: 'Cancelar',
                                showLoaderOnConfirm: true,
                                allowOutsideClick: () => !Swal.isLoading(),
                            }).then(async (result) => {
                                if (result.isConfirmed) {
                                    const updatedMatricula = result.value;
                                    try {
                                        const response = await fetch('/actualizarmatricula', {
                                            method: 'PUT',
                                            headers: {
                                                'Content-Type': 'application/json'
                                            },
                                            body: JSON.stringify(updatedMatricula)
                                        });

                                        const data = await response.json();

                                        if (data.success) {
                                            showToast(data.success, 'success');
                                        } else if (data.error) {
                                            showToast(data.error, 'error');
                                        }
                                    } catch (error) {
                                        showToast('Error al actualizar la matricula', 'error');
                                    }
                                }
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'No se encontró coincidencia',
                        text: 'Intente con otra ID',
                        icon: 'error'
                    });
                }
            } catch (error) {
                Swal.fire({
                    title: "Error!",
                    text: "Hubo un problema al buscar la matricula.",
                    icon: "error"
                });
            }
        }
    });



    <?php if (!empty($message)) : ?>
        showToast("<?php echo $message; ?>", "<?php echo (empty($alertas['error'])) ? 'success' : 'error'; ?>");
    <?php endif; ?>

    <?php if (!empty($alertas['error'])) : ?>
        <?php foreach ($alertas['error'] as $error) : ?>
            showToast("<?php echo $error; ?>", "error");
        <?php endforeach; ?>
    <?php endif; ?>
</script>