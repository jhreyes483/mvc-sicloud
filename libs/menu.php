<?php


    $aP= [];
    $aMenu['A'][1]         = ['USUARIOS'];
    $aMenu['A'][1][1]      = ['Admin Solisitud', ''.BASE_URL.'admin/ControlUsuarios', 'S1S'];
    $aMenu['A'][1][2]      = ['Acumulación de puntos',''.BASE_URL.'comercial/puntos', 'S1P'];
    $aMenu['A'][1][3]      = ['Facturacion',''.BASE_URL.'factura', 'S1F'];  
    $aMenu['A'][1][4]      = ['Consulta factura', ''.BASE_URL.'supervisor/consFactura', 'S1CF'];
    $aMenu['A'][1][5]      = ['Inf Ventas', ''.BASE_URL.'supervisor/facturas', 'S1FF'];

    $aMenu['A'][2]         = ['PRODUCTOS'];
    $aMenu['A'][2][1]      = ['Catalogo',''.BASE_URL.'cliente/catalogo','S1C'] ;
    $aMenu['A'][2][2]      = ['Crear producto', ''.BASE_URL.'producto/create','S1PCL'];
    $aMenu['A'][2][3]      = ['Ingresar producto', ''.BASE_URL.'producto/ingreso','S1PL'];
    $aMenu['A'][2][4]      = ['Editar producto', ''.BASE_URL.'producto?edit=1','S1PLE'];  // logistica/productos/?edit=1
    $aMenu['A'][2][5]      = ['Solicitar producto', ''.BASE_URL.'logistica/solicitud','S1CS'];
    $aMenu['A'][2][6]      = ['Sistema de alertas', 'CU0014-alertas.php','S1A'];
    $aMenu['A'][2][7]      = ['Stock', ''.BASE_URL.'producto','S1SDF']; 
    $aMenu['A'][2][8]      = ['Cantidad',''.BASE_URL.'logistica/cantidad', 'S1CT'];
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
    $aMenu['A'][4][4]      = ['Productos', ''.BASE_URL.'producto?edit','S1PLE'];  
    $aMenu['A'][4][5]      = ['Telefonos', 'formTelefono.php'];
    $aMenu['A'][4][6]      = ['Cuentas', ''.BASE_URL.'user', 'S1CCSM' ];// OJO  NO CAMBIAR EL TOKEN, ES EL DE EDITAR USARIO
    $aMenu['A'][5]         = [ 'INICIO',''.BASE_URL.'admim', 'S1AAFRT'];

    $aMenu['B'][1]         = [ 'CONSTITUCION'];
    $aMenu['B'][1][1]      = [ 'QUIENES SOMOS',''.BASE_URL.'entidad'];
    $aMenu['B'][1][2]      = [ 'MISION Y VISION', ''.BASE_URL.'mision'];
    $aMenu['B'][2]         = [ 'PROMOCIONES',''.BASE_URL.'promocion'];
    $aMenu['B'][3]         = [ 'PRODUCTOS'];
    $aMenu['B'][3][1]      = [ 'CATALOGO',''.BASE_URL.'cliente/catalogo','S1C'];
    $aMenu['B'][3][2]      = [ 'INF BODEGA','CU0012-informebodega.php'];
    $aMenu['B'][3][3]      = [ 'CATEGORIAS', ''.BASE_URL. 'categoria', 'S1CC'];
    $aMenu['B'][3][4]      = [ 'CANTIDAD',''.BASE_URL.'logistica/categoria','S1CG'];
    $aMenu['B'][3][5]      = [ 'SISTEMA ALERTAS', 'CU0014-alertas.php'];
    $aMenu['B'][3][6]      = [ 'STOCK',''.BASE_URL.'producto','S1SDF'];
    $aMenu['B'][4]         = [ 'PROCESOS', 'tablaRegistro.php'];
    $aMenu['B'][4][1]      = [ 'CREAR PRODUCTO', ''.BASE_URL.'producto/create','S1PCL'];
    $aMenu['B'][4][2]      = [ 'INGRESO PRODUCTO', ''.BASE_URL.'producto/ingreso','S1PL'];
    $aMenu['B'][4][3]      = [ 'EDITAR PRODUCTOS', ''.BASE_URL.'producto?edit=1','S1PLE'];
    $aMenu['B'][4][4]      = [ 'SOLICITAR PEDIDO', 'CU0018-registropedido.php'];
    $aMenu['B'][5]         = [ 'INICIO',''.BASE_URL.'logistica', 'S1AADFR'];

    $aMenu['S'][1]         = [ 'CONSTITUCION'];
    $aMenu['S'][1][1]      = [ 'QUIENES SOMOS',''.BASE_URL.'entidad'];
    $aMenu['S'][1][2]      = [ 'MISION Y VISION', ''.BASE_URL.'mision'];
    $aMenu['S'][2]         = [ 'PROMOCIONES',''.BASE_URL.'promocion'];
    $aMenu['S'][4]         = [ 'INF. VENTAS',''.BASE_URL.'supervisor/facturas', 'S1FF'  ];
    $aMenu['S'][4][1]      = [ 'FECHA','verFecha.php'];
    $aMenu['S'][4][2]      = [ 'RANGO','verRango.php'];
    $aMenu['S'][4][3]      = ['CONSULTA FACTURAS',''.BASE_URL.'supervisor/consFactura', 'S1CF'];
    $aMenu['S'][5]         = [ 'PRODUCTOS'];
    $aMenu['S'][5][1]      = [ 'CATALOGO',''.BASE_URL.'cliente/catalogo','S1C'];
    $aMenu['S'][5][2]      = [ 'ALERTAS','CU0014-alertas.php'];
    $aMenu['S'][5][3]      = [ 'STOCK',''.BASE_URL.'producto','S1SDF'];
    $aMenu['S'][6]         = [ 'INICIO',''.BASE_URL.'supervior', 'S1FAHFK'];

    $aMenu['V'][1]         = [ 'CONSTITUCION'];
    $aMenu['V'][1][1]      = [ 'QUIENES SOMOS',''.BASE_URL.'entidad'];
    $aMenu['V'][1][2]      = [ 'MISION Y VISION', ''.BASE_URL.'mision'];
    $aMenu['V'][2]         = [ 'PROMOCIONES',''.BASE_URL.'promocion'];
    $aMenu['V'][3]         = [ 'PRODUCTOS'];
    $aMenu['V'][3][1]      = [ 'CATALOGO',''.BASE_URL.'cliente/catalogo','S1C'];
    $aMenu['V'][3][2]      = [ 'CATEGORIAS', ''.BASE_URL. 'categoria', 'S1CC'];
    $aMenu['V'][3][3]      = [ 'CANTIDAD',''.BASE_URL.'logistica/categoria','S1CG'];
    $aMenu['V'][3][5]      = [ 'STOCK',''.BASE_URL.'producto','S1SDF'];
    $aMenu['V'][4]         = [ 'USUARIOS'];
    $aMenu['V'][4][1]      = [ 'CUENTAS', ''.BASE_URL.'admin/ControlUsuarios', 'S1SCSD'];
    $aMenu['V'][4][2]      = [ 'PUNTOS',''.BASE_URL.'comercial/puntos', 'S1P'];
    $aMenu['V'][4][3]      = [ 'FACTURACION',''.BASE_URL.'factura', 'S1F'];
    $aMenu['V'][4][4]      = ['CONSULTA FACTURA',''.BASE_URL.'supervisor/consFactura', 'S1CF'];
    $aMenu['V'][5]         = [ 'INICIO',''.BASE_URL.'comercial', 'DFEGAAG'];


    $aMenu['P'][1]         = [ 'CONSTITUCION'];
    $aMenu['P'][1][1]      = [ 'QUIENES SOMOS',''.BASE_URL.'entidad'];
    $aMenu['P'][1][2]      = [ 'MISION Y VISION', ''.BASE_URL.'mision'];
    $aMenu['P'][2]         = [ 'PROMOCIONES',''.BASE_URL.'promocion'];
    $aMenu['P'][3]         = [ 'CATALOGO',''.BASE_URL.'cliente/catalogo','S1C'];
    $aMenu['P'][4]         = [ 'SOLICITUDES','CU0018-registropedido.php'];
    $aMenu['P'][5]         = [ 'INICIO',''.BASE_URL.'proveedor', 'PFPGAAG'];


    $aMenu['C'][1]         = [ 'FERRETERIA'];
    $aMenu['C'][1][1]      = [ 'QUIENES SOMOS',''.BASE_URL.'entidad'];
    $aMenu['C'][1][2]      = [ 'MISION Y VISION', ''.BASE_URL.'mision'];
    $aMenu['C'][2]         = [ 'CATALOGO',''.BASE_URL.'cliente/catalogo','S1C'];
    $aMenu['C'][3]         = [ 'PROMOCIONES',''.BASE_URL.'promocion'];
    $aMenu['C'][4]         = [ 'CONTACTO','CU000-contact.php'];
    $aMenu['C'][5]         = [ 'INICIO',''.BASE_URL.'proveedor', 'PFPGAAG'];







?>
