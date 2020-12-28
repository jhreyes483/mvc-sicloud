<?php


    $aP= [];
    $aMenu['A'][1]         = ['USUARIOS'];
    $aMenu['A'][1][1]      = ['Admin Solisitud', ''.BASE_URL.'admin/ControlUsuarios', 'S1S'];
    $aMenu['A'][1][2]      = ['Acumulación de puntos',''.BASE_URL.'comercial/puntos', 'S1P'];
    $aMenu['A'][1][3]      = ['Facturacion',''.BASE_URL.'comercial/facturacion', 'S1F'];  
    $aMenu['A'][1][4]      = ['Consulta factura', ''.BASE_URL.'supervisor/consFactura', 'S1CF'];
    $aMenu['A'][1][5]      = ['Inf Ventas', ''.BASE_URL.'supervisor/facturas', 'S1FF'];

    $aMenu['A'][2]         = ['PRODUCTOS'];
    $aMenu['A'][2][1]      = ['Catalogo',''.BASE_URL.'cliente/catalogo','S1C'] ;
    $aMenu['A'][2][2]      = ['Crear producto', ''.BASE_URL.'logistica/crearProductos','S1PCL'];
    $aMenu['A'][2][3]      = ['Ingresar producto', ''.BASE_URL.'logistica/ingreso','S1PL'];
    $aMenu['A'][2][4]      = ['Editar producto', ''.BASE_URL.'logistica/productos/?edit=1','S1PLE'];  // logistica/productos/?edit=1
    $aMenu['A'][2][5]      = ['Solicitar producto', ''.BASE_URL.'logistica/solicitud','S1CS'];
    $aMenu['A'][2][6]      = ['Sistema de alertas', 'CU0014-alertas.php','S1A'];
    $aMenu['A'][2][7]      = ['Stock', ''.BASE_URL.'logistica/productos','S1S']; 
    $aMenu['A'][2][8]      = ['Cantidad',''.BASE_URL.'logistica/productos', 'S1CT'];
    $aMenu['A'][2][9]      = ['Categoria',''.BASE_URL.'logistica/categoria','S1CG'];
    $aMenu['A'][2][10]     = ['Inf Bodega', 'CU0012-informebodega.php','S1B'];
    $aMenu['A'][3]         = ['ADMIN SISTEMA'];
    $aMenu['A'][3][1]      = ['log errores',''.BASE_URL.'admin/logError','S1LE'];  // admin/logError
    $aMenu['A'][3][2]      = ['log actividades',''.BASE_URL. 'admin/logActividad', 'S1LA'];
    $aMenu['A'][3][3]      = ['log notificaciones',''.BASE_URL. 'admin/logNotificacion', 'S1LN'];
    $aMenu['A'][4]         = ['EDICION'];
    $aMenu['A'][4][1]      = ['Categorias',''.BASE_URL. 'categoria', 'S1CC'];
    $aMenu['A'][4][2]      = ['Empresas',''.BASE_URL. 'empresa', 'S1CE'];
    $aMenu['A'][4][3]      = ['Unid medida',''.BASE_URL. 'medida', 'S1CM'];
    $aMenu['A'][4][4]      = ['Productos', ''.BASE_URL.'logistica/productos/?edit=1','S1PLE'];  
    $aMenu['A'][4][5]      = ['Telefonos', 'formTelefono.php'];
    $aMenu['A'][4][6]      = ['Cuentas', 'TablaUsuario.php', 'S1CCSM' ];// OJO  NO CAMBIAR EL TOKEN, ES EL DE EDITAR USARIO
    $aMenu['A'][5]         = [ 'INICIO','../controlador/api.php?apicall=inicionRol'];

    $aMenu['B'][1]         = [ 'CONSTITUCION'];
    $aMenu['B'][1][1]      = [ 'QUIENES SOMOS', 'CU000-quienessomos.php'];
    $aMenu['B'][1][2]      = [ 'MISION Y VISION', 'CU000-misionyvision.php'];
    $aMenu['B'][2]         = [ 'PROMOCIONES','Promociones.php'];
    $aMenu['B'][3]         = [ 'PRODUCTOS'];
    $aMenu['B'][3][1]      = [ 'CATALOGO','catalogo.php?ops=1'];
    $aMenu['B'][3][2]      = [ 'INF BODEGA','CU0012-informebodega.php'];
    $aMenu['B'][3][3]      = [ 'CATEGORIAS', 'tablaCategoria.php'];
    $aMenu['B'][3][4]      = [ 'CANTIDAD', 'tablaRegistro.php'];
    $aMenu['B'][3][5]      = [ 'SISTEMA ALERTAS', 'CU0014-alertas.php'];
    $aMenu['B'][3][6]      = [ 'STOCK','edicionProductoTabla.php'];
    $aMenu['B'][4]         = [ 'PROCESOS', 'tablaRegistro.php'];
    $aMenu['B'][4][1]      = [ 'CREAR PRODUCTO', 'CU004-crearProductos.php'];
    $aMenu['B'][4][2]      = [ 'INGRESO PRODUCTO', 'CU003-ingresoProducto.php'];
    $aMenu['B'][4][3]      = [ 'EDITAR PRODUCTOS', 'edicionProductoTabla.php?edit'];
    $aMenu['B'][4][4]      = [ 'SOLICITAR PEDIDO', 'CU0018-registropedido.php'];
    $aMenu['B'][5]         = [ 'INICIO','../controlador/api.php?apicall=inicionRol'];

    $aMenu['S'][1]         = [ 'CONSTITUCION'];
    $aMenu['S'][1][1]      = [ 'QUIENES SOMOS', 'CU000-quienessomos.php'];
    $aMenu['S'][1][2]      = [ 'MISION Y VISION', 'CU000-misionyvision.php'];
    $aMenu['S'][2]         = [ 'PROMOCIONES','Promociones.php'];
    $aMenu['S'][4]         = [ 'INF. VENTAS'];
    $aMenu['S'][4][1]      = [ 'FECHA','verFecha.php'];
    $aMenu['S'][4][2]      = [ 'RANGO','verRango.php'];
    $aMenu['S'][4][3]      = ['CONSULTA FACTURAS', 'CU0012-informeVentas.php'];
    $aMenu['S'][5]         = [ 'PRODUCTOS'];
    $aMenu['S'][5][1]      = [ 'CATALOGO','catalogo.php?ops=1'];
    $aMenu['S'][5][2]      = [ 'ALERTAS','CU0014-alertas.php'];
    $aMenu['S'][5][3]      = [  'STOCK','edicionProductoTabla.php'];
    $aMenu['S'][6]         = [ 'INICIO','../controlador/api.php?apicall=inicionRol'];

    $aMenu['V'][1]         = [ 'CONSTITUCION'];
    $aMenu['V'][1][1]      = [ 'QUIENES SOMOS', 'CU000-quienessomos.php'];
    $aMenu['V'][1][2]      = [ 'MISION Y VISION', 'CU000-misionyvision.php'];
    $aMenu['V'][2]         = [ 'PROMOCIONES','Promociones.php'];
    $aMenu['V'][3]         = [ 'PRODUCTOS'];
    $aMenu['V'][3][1]      = [ 'CATALOGO','catalogo.php?ops=1'];
    $aMenu['V'][3][2]      = [ 'CATEGORIAS', 'tablaCategoria.php'];
    $aMenu['V'][3][3]      = [ 'CANTIDAD', 'tablaRegistro.php'];
    $aMenu['V'][3][5]      = [  'STOCK','edicionProductoTabla.php'];
    $aMenu['V'][4]         = [ 'USUARIOS'];
    $aMenu['V'][4][1]      = [ 'CUENTAS','CU009-controlUsuarios.php'];
    $aMenu['V'][4][2]      = [ 'PUNTOS','CU006-acomulaciondepuntos.php'];
    $aMenu['V'][4][3]      = [ 'FACTURACION','CU005-facturacion.php'];
    $aMenu['V'][4][4]      = ['CONSULTA FACTURA', 'formFactura.php'];
    $aMenu['V'][5]         = [ 'INICIO','../controlador/api.php?apicall=inicionRol'];


    $aMenu['P'][1]         = [ 'CONSTITUCION'];
    $aMenu['P'][1][1]      = [ 'QUIENES SOMOS', 'CU000-quienessomos.php'];
    $aMenu['P'][1][2]      = [ 'MISION Y VISION', 'CU000-misionyvision.php'];
    $aMenu['P'][2]         = [ 'PROMOCIONES','Promociones.php'];
    $aMenu['P'][3]         = [ 'CATALOGO','catalogo.php?ops=1'];
    $aMenu['P'][4]         = [ 'SOLICITUDES','CU0018-registropedido.php'];
    $aMenu['P'][5]         = [ 'INICIO','../controlador/api.php?apicall=inicionRol'];


    $aMenu['C'][1]         = [ 'FERRETERIA'];
    $aMenu['C'][1][1]      = [ 'QUIENES SOMOS', 'CU000-quienessomos.php'];
    $aMenu['C'][1][2]      = [ 'MISION Y VISION', 'CU000-misionyvision.php'];
    $aMenu['C'][2]         = [ 'CATALOGO','catalogo.php?ops=1'];
    $aMenu['C'][3]         = [ 'PROMOCIONES','Promociones.php'];
    $aMenu['C'][4]         = [ 'CONTACTO','CU000-contact.php'];
    $aMenu['C'][5]          =[ 'INICIO','../controlador/api.php?apicall=inicionRol'];







?>
