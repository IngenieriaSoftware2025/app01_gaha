<?php

namespace Controllers;

use Exception;
use Model\ActiveRecord;
use Model\productos;
use MVC\Router;

class ProductoController extends ActiveRecord
{

    public function renderizarPagina(Router $router)
    {
        $router->render('productos/index', []);
    }

    public static function guardarAPI()
    {

        getHeadersApi();

        //validar nmbre del producto
        $_POST['producto_nombre'] = htmlspecialchars($_POST['producto_nombre']);

        if (empty(trim($_POST['producto_nombre']))) {

            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'El nombre del producto no puede quedar vacio'
            ]);
            return;
        }

        //validar la cantidad
        $_POST['producto_cantidad'] = filter_var($_POST['producto_cantidad'], FILTER_VALIDATE_INT);

        if ($_POST['producto_cantidad'] <= 0) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Las cantidad debe de ser mayor a 0'
            ]);
            return;
        }

        //validar la categoria
        $_POST['producto_categoria'] = htmlspecialchars($_POST['producto_categoria']);
        $categoria = $_POST['producto_categoria'];

        if (!in_array($categoria, ['A', 'H', 'C'])) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Las Categorias solo pueden ser Alimentos, Higene u Hogar'
            ]);
            return;
        }

        //validar prioridad
        $_POST['producto_prioridad'] = htmlspecialchars($_POST['producto_prioridad']);
        $prioridad = $_POST['producto_prioridad'];

        if (!in_array($prioridad, ['A', 'M', 'B'])) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'La prioridad solo puede ser Alta, Mediana o Baja'
            ]);
            return;
        }

        //verificar que no se repita el producto
        $sql = "SELECT * FROM productos WHERE producto_nombre = ? and producto_categoria = ? and producto_situacion = 1";
        $resultado = self::$db->prepare($sql);
        $resultado->is_execute([$_POST['producto_nombre'], $_POST['producto_categoria']]);

        if ($resultado->rowCount() > 0) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'El producto ya existe en la misma categoria'
            ]);
            return;
        }

        try {
            //code...
            $data = new Productos([
                'producto_nombre' => $_POST['producto_nombre'],
                'producto_cantidad' => $_POST['producto_cantidad'],
                'producto_categoria' => $_POST['producto_categoria'],
                'producto_prioridad' => $_POST['producto_prioridad'],
                'producto_situacion' => 1
            ]);

            $crear = $data->crear();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'El producto ha sido registrado correctamente'
            ]);     
        } catch (Exception $e) {
            //throw $th;
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al guardar el producto',
                'detalle' => $e->getMessage(),
            ]);
        }
    }


    public static function buscarAPI(){

        try {

            // $data = productos::all();

            $sql = "SELECT * FROM productos where producto_situacion = 1";
            $data = self::fetchArray($sql);

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'productos obtenidos correctamente',
                'data' => $data
            ]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al obtener los productos',
                'detalle' => $e->getMessage(),
            ]);
        }
    }


    public static function modificarAPI()
    {

        getHeadersApi();

        $id = $_POST['producto_id'];
        $_POST['producto_nombre'] = htmlspecialchars($_POST['producto_nombre']);

        $cantidad_apellidos = strlen($_POST['producto_nombre']);

        if ($cantidad_apellidos < 2) {

            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'La cantidad de digitos que debe de contener el apellido debe de ser mayor a dos'
            ]);
            return;
        }

        $_POST['usuario_nombres'] = htmlspecialchars($_POST['usuario_nombres']);

        $cantidad_nombres = strlen($_POST['usuario_nombres']);


        if ($cantidad_nombres < 2) {

            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mennsaje' => 'La cantidad de digitos que debe de contener el nombre debe de ser mayor a dos'
            ]);
            return;
        }

        $_POST['usuario_telefono'] = filter_var($_POST['usuario_telefono'], FILTER_VALIDATE_INT);

        if (strlen($_POST['usuario_telefono']) != 8) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mennsaje' => 'La cantidad de digitos de telefono debe de ser igual a 8'
            ]);
            return;
        }

        $_POST['usuario_nit'] = filter_var($_POST['usuario_nit'], FILTER_SANITIZE_NUMBER_INT);
        $_POST['usuario_correo'] = filter_var($_POST['usuario_correo'], FILTER_SANITIZE_EMAIL);

        if (!filter_var($_POST['usuario_correo'], FILTER_SANITIZE_EMAIL)) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mennsaje' => 'El correo electronico ingresado es invalido'
            ]);
            return;
        }
        $_POST['usuario_estado'] = htmlspecialchars($_POST['usuario_estado']);

        $estado = $_POST['usuario_estado'];

        if ($estado == "P" || $estado == "F" || $estado == "C") {


            try {


                $data = productos::find($id);
                // $data->sincronizar($_POST);
                $data->sincronizar([
                    'usuario_nombres' => $_POST['usuario_nombres'],
                    'producto_nombre' => $_POST['producto_nombre'],
                    'usuario_nit' => $_POST['usuario_nit'],
                    'usuario_telefono' => $_POST['usuario_telefono'],
                    'usuario_correo' => $_POST['usuario_correo'],
                    'usuario_estado' => $_POST['usuario_estado'],
                    'producto_situacion' => 1
                ]);
                $data->actualizar();

                http_response_code(200);
                echo json_encode([
                    'codigo' => 1,
                    'mensaje' => 'La informacion del usuario ha sido modificada exitosamente'
                ]);
            } catch (Exception $e) {
                http_response_code(400);
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'Error al guardar',
                    'detalle' => $e->getMessage(),
                ]);
            }
        } else {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mennsaje' => 'Los detinos solo puedes ser "P, F, C"'
            ]);
            return;
        }
    }
}
