<div class="container py-5">
    <!-- Header estilo oscuro similar a navbar -->
    <div class="row mb-5 justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body" style="background: linear-gradient(45deg, #212529, #495057);">
                    <div class="mb-4 text-center">
                        <h5 class="fw-bold text-warning mb-2">¡Bienvenido a la Aplicación para el registro, modificación y eliminación de usuario!</h5>
                        <h3 class="fw-bold text-white mb-0">MANIPULACIÓN DE USUARIOS</h3>
                    </div>
                    <form id="FormUsuarios" class="p-4 bg-dark bg-opacity-75 rounded-3 shadow-sm border border-secondary">
                        <input type="hidden" id="usuario_id" name="usuario_id">
                        <div class="row g-4 mb-3">
                            <div class="col-md-6">
                                <label for="usuario_nombres" class="form-label text-white">Nombres</label>
                                <input type="text" class="form-control form-control-lg bg-dark bg-opacity-50 text-white border-secondary" id="usuario_nombres" name="usuario_nombres" placeholder="Ingrese sus nombres" required>
                            </div>
                            <div class="col-md-6">
                                <label for="usuario_apellidos" class="form-label text-white">Apellidos</label>
                                <input type="text" class="form-control form-control-lg bg-dark bg-opacity-50 text-white border-secondary" id="usuario_apellidos" name="usuario_apellidos" placeholder="Ingrese sus apellidos" required>
                            </div>
                        </div>
                        <div class="row g-4 mb-3">
                            <div class="col-md-6">
                                <label for="usuario_nit" class="form-label text-white">NIT</label>
                                <input type="number" class="form-control form-control-lg bg-dark bg-opacity-50 text-white border-secondary" id="usuario_nit" name="usuario_nit" placeholder="Ingrese su NIT" required>
                            </div>
                            <div class="col-md-6">
                                <label for="usuario_telefono" class="form-label text-white">Teléfono</label>
                                <input type="number" class="form-control form-control-lg bg-dark bg-opacity-50 text-white border-secondary" id="usuario_telefono" name="usuario_telefono" placeholder="Ingrese su número de teléfono" required>
                            </div>
                        </div>
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label for="usuario_correo" class="form-label text-white">Correo electrónico</label>
                                <input type="email" class="form-control form-control-lg bg-dark bg-opacity-50 text-white border-secondary" id="usuario_correo" name="usuario_correo" placeholder="ejemplo@ejemplo.com" required>
                            </div>
                            <div class="col-md-6">
                                <label for="usuario_estado" class="form-label text-white">Estado del usuario</label>
                                <select name="usuario_estado" class="form-select form-select-lg bg-dark bg-opacity-50 text-white border-secondary" id="usuario_estado" required>
                                    <option value="">-- Seleccione el estado --</option>
                                    <option value="P">Presente</option>
                                    <option value="F">Faltando</option>
                                    <option value="C">Comisión</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center gap-3">
                            <button class="btn btn-success btn-lg px-4 shadow" type="submit" id="BtnGuardar">
                                <i class="bi bi-save me-2"></i>Guardar
                            </button>
                            <button class="btn btn-warning btn-lg px-4 shadow d-none" type="button" id="BtnModificar">
                                <i class="bi bi-pencil-square me-2"></i>Modificar
                            </button>
                            <button class="btn btn-secondary btn-lg px-4 shadow" type="reset" id="BtnLimpiar">
                                <i class="bi bi-eraser me-2"></i>Limpiar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Tabla de usuarios con estilo oscuro -->
    <div class="row justify-content-center mt-5">
        <div class="col-lg-11">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body" style="background: linear-gradient(45deg, #212529, #495057);">
                    <h3 class="text-center text-white mb-4">USUARIOS REGISTRADOS EN LA BASE DE DATOS</h3>
                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-hover table-bordered align-middle rounded-3 overflow-hidden" id="TableUsuarios">
                            <!-- Aquí se cargan los usuarios -->
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap Icons CDN (opcional, para los íconos de los botones) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script src="<?= asset('build/js/usuarios/index.js') ?>"></script>

<!-- Estilo para los placeholders blancos -->
<style>
    .form-control::placeholder,
    .form-select::placeholder {
        color: white !important;
        opacity: 0.7 !important;
    }
    
    /* Estilo para las opciones del select */
    .bg-dark option {
        background-color: #343a40;
        color: white;
    }
</style>