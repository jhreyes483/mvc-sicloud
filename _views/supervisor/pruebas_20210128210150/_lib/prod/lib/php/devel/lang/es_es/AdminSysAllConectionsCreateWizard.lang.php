<?php   
 
$nm_lang['create_conn_wizard']['btnavancar'] = 'Siguiente'; 
$nm_lang['create_conn_wizard']['btnconcluir'] = 'Guardar'; 
$nm_lang['create_conn_wizard']['btnhelp'] = 'Ayuda'; 
$nm_lang['create_conn_wizard']['btnsair'] = 'Cancelar'; 
$nm_lang['create_conn_wizard']['btntestar'] = 'Probar conexi&oacute;n'; 
$nm_lang['create_conn_wizard']['btnvoltar'] = 'Volver'; 
$nm_lang['create_conn_wizard']['descricoes']['access'] = 'Camino al archivo de base de datos!'; 
$nm_lang['create_conn_wizard']['descricoes']['base'] = 'El nombre de base de datos donde las tablas se almacenan en el servidor.'; 
$nm_lang['create_conn_wizard']['descricoes']['conn'] = 'Un nombre para identificar la conexi&oacute;n que se crear&aacute;. Cuando usted comienza a crear aplicaciones, ser&aacute; este el nombre mostrado.'; 
$nm_lang['create_conn_wizard']['descricoes']['dbms'] = 'El tipo de base de datos'; 
$nm_lang['create_conn_wizard']['descricoes']['decimal'] = 'Separador decimal del SGDB. Utilizado en las inserciones y actualizaciones de las aplicaciones. <br><br> Ej: ACTUALIZAR TB_EXAMPLE CONJUNTO Salario = 1.500,00 ClientID DONDE = 1 si elige el separador decimal a ser &quot;.&quot; <br><br><br> o UPDATE TB_EXAMPLE CONJUNTO Salario =\'1500, 00 \'WHERE ClientID = 1 si elige el separador decimal a\', \'. <BR ><BR >'; 
$nm_lang['create_conn_wizard']['descricoes']['ibase'] = 'Para conectarse a Interbase, debe informar a la m&aacute;quina (la IP, DNS o el nombre) y la ruta del archivo de la base de datos . <BR ><BR > Por ejemplo: 192.168.254.254: c: ibasedatabase.gdb!'; 
$nm_lang['create_conn_wizard']['descricoes']['odbc'] = 'Nombre de la ODBC que se cre&oacute; para acceder a su base de datos!'; 
$nm_lang['create_conn_wizard']['descricoes']['oracle'] = 'Oracle TSNAME  para acceder a la base de datos!'; 
$nm_lang['create_conn_wizard']['descricoes']['pass'] = 'La contrase&ntilde;a de usuario del DBMS!'; 
$nm_lang['create_conn_wizard']['descricoes']['pass_confirm'] = 'La confirmaci&oacute;n de la contrase&ntilde;a debe ser igual a la contrase&ntilde;a!'; 
$nm_lang['create_conn_wizard']['descricoes']['rep'] = 'DataDictionary - es una herramienta de repositorio para almacenar informaci&oacute;n acerca de su base de datos para mejorar la velocidad de desarrollo.'; 
$nm_lang['create_conn_wizard']['descricoes']['retrieve_schema'] = 'Seleccione si desea utilizar el nombre del esquema antes de que el nombre de la tabla. Ej: public.table_name. <br /><br /> Si usted no sabe lo que significa esta opci&oacute;n, deje el valor predeterminado.'; 
$nm_lang['create_conn_wizard']['descricoes']['schema'] = 'El esquema donde se almacenan su tabla!'; 
$nm_lang['create_conn_wizard']['descricoes']['server'] = 'Direcci&oacute;n del servidor donde se almacena la base de datos. Puede ser un local o una m&aacute;quina remota. Todo lo que tienes que hacer es informar al nombre de la m&aacute;quina, su IP o su DNS.'; 
$nm_lang['create_conn_wizard']['descricoes']['sgdb'] = 'M&eacute;todo de acceso para el DBMS. Puede conectarse a trav&eacute;s de una versi&oacute;n espec&iacute;fica de la base de datos, o bien conectarse por ADO u ODBC!'; 
$nm_lang['create_conn_wizard']['descricoes']['sqlite'] = 'Ruta donde el archivo de base de datos SQLite se encuentra!'; 
$nm_lang['create_conn_wizard']['descricoes']['user'] = 'El nombre de usuario del DBMS!'; 
$nm_lang['create_conn_wizard']['descricoes']['use_persistent'] = 'Connection persistent,mismo despues de cerrar la conexion, se queda en el pool de conexiones. Abriendo una nueva conexion verifica se este pool e obtiene el handle.<br /> <br /> Normalmente es mas rapido por que no se abre una nueva conexion. <br /> <br /> Algunos bancos de datos usan cache y en estes casos es mejor abrir una nueva conexion.'; 
$nm_lang['create_conn_wizard']['erro']['conn'] = 'Informar un nombre v&aacute;lido de conexi&oacute;n!'; 
$nm_lang['create_conn_wizard']['erro']['conn_e'] = 'Este nombre  de conexi&oacute;n ya existe!'; 
$nm_lang['create_conn_wizard']['erro']['pass_confirm'] = 'La confirmaci&oacute;n de la contrase&ntilde;a debe ser igual a la contrase&ntilde;a.'; 
$nm_lang['create_conn_wizard']['erro']['sgdb'] = 'Informar un DBMS v&aacute;lido!'; 
$nm_lang['create_conn_wizard']['erro']['title'] = 'ERROR'; 
$nm_lang['form_db2_warning'] = 'Atenci&oacute;n, la siguiente configuraci&oacute;n son espec&iacute;ficos de nativos ibm_db2  <br /> Solo cambiar si sabes lo que est&aacute;s haciendo. Para m&aacute;s detalles vea: <br /> http://br2.php.net/manual/pt_Br/function.db2-connect.php> swap		 	'; 
$nm_lang['label']['access'] = 'RUTA'; 
$nm_lang['label']['action'] = 'Acciones'; 
$nm_lang['label']['addgroup'] = 'A&ntilde;adir esta conexi&oacute;n a mi proyecto actual'; 
$nm_lang['label']['base'] = 'Base de datos'; 
$nm_lang['label']['conn'] = 'Nombre de la conexi&oacute;n'; 
$nm_lang['label']['dbms'] = 'DBMS'; 
$nm_lang['label']['decimal'] = 'Separador decimal'; 
$nm_lang['label']['ibase'] = 'IP: PATH'; 
$nm_lang['label']['lista'] = 'Lista de conexi&oacute;n'; 
$nm_lang['label']['odbc'] = 'Nombre de ODBC de sistema'; 
$nm_lang['label']['oracle'] = 'TSNAME'; 
$nm_lang['label']['pass'] = 'Contrase&ntilde;a'; 
$nm_lang['label']['pass_confirm'] = 'Confirmar contrase&ntilde;a'; 
$nm_lang['label']['port']  = 'Puerto (por defecto %s)';
$nm_lang['label']['prj_criado'] = 'Proyecto creado con &eacute;xito. Seguir para crear una conexi&oacute;n de base de datos'; 
$nm_lang['label']['rep'] = 'Repositorio'; 
$nm_lang['label']['retrieve_schema'] = 'Uso de esquema antes de el nombre de la tabla'; 
$nm_lang['label']['schema'] = 'Schema'; 
$nm_lang['label']['server'] = 'DBMS host o IP'; 
$nm_lang['label']['sgdb'] = 'Tipo de SGBD'; 
$nm_lang['label']['sqlite'] = 'RUTA'; 
$nm_lang['label']['testar'] = 'Probar la conexi&oacute;n'; 
$nm_lang['label']['user'] = 'Usuario'; 
$nm_lang['label']['use_persistent'] = 'Conexi&oacute;n persistente'; 
$nm_lang['lbl_hide_filter']  = 'Ocultar Filtro'; 
$nm_lang['lic_new_error_pr_'] = 'Su licencia Professional Edition s&oacute;lo permiten crear conexiones 6. <BR> Por favor, p&oacute;ngase en contacto con sales@scriptcase.net a migrar a otro tipo de licencia.'; 
$nm_lang['msg_cancel_create_conn'] = '&iquest;Desea cancelar?'; 
$nm_lang['msg_connect_lang'] = 'Cuando se utiliza caracteres multibyte como: &aacute;rabe, chino, japon&eacute;s o ruso, ScriptCase s&oacute;lo admite la codificaci&oacute;n UTF-8 en las bases de datos'; 
$nm_lang['msg_conn_erro']  = 'Error de conexi&oacute;n'; 
$nm_lang['msg_empty_lst_conn']  = 'Lista relacionados vac&iacute;o.'; 
$nm_lang['msg_err_server_empty']  = 'Server no / Host (nombre o IP) &iexcl;Inf&oacute;rmate!'; 
$nm_lang['msg_err_user_empty']  = 'El usuario no es informado!'; 
$nm_lang['new_denied'] = 'Acceso denegado'; 
$nm_lang['page_title'] = 'Haga clic en el icono para seleccionar el DBMS para conectarse'; 
$nm_lang['page_title_edit']  = 'Haga clic en el icono para seleccionar la conexi&oacute;n para editar'; 
$nm_lang['page_title_sucess'] = 'Conexi&oacute;n ha creado'; 
$nm_lang['values']['nao'] = 'No'; 
$nm_lang['values']['sim'] = 'S&iacute;'; 

$nm_lang['lbl_excl'] = '&iquest;Realmente desea eliminar esta conexi&oacute;n?'; 
$nm_lang['mainmenu_new_conn']  = 'Nueva conexi&oacute;n';
$nm_lang['btn_conc'] = 'Guardar'; 
$nm_lang['btn_db2'] = 'DB2'; 
$nm_lang['btn_edit'] = 'Editar'; 
$nm_lang['btn_excl'] = 'Borrar'; 
$nm_lang['btn_filt'] = 'Filtro'; 
$nm_lang['btn_pass'] = 'Cambiar Contrase&ntilde;a'; 
$nm_lang['btn_stat'] = 'Conexi&oacute;n'; 
$nm_lang['btn_test'] = 'Prueba'; 
$nm_lang['lbl_apli'] = 'Aplicar'; 
$nm_lang['lbl_atr'] = 'Atributo'; 
$nm_lang['lbl_base'] = 'Base'; 
$nm_lang['lbl_dbms'] = 'Tipo de base de datos'; 
$nm_lang['lbl_deci'] = 'Separador decimal'; 
$nm_lang['lbl_excl'] = '&iquest;Realmente desea eliminar esta conexi&oacute;n?'; 
$nm_lang['lbl_exi'] = 'Mostrar'; 
$nm_lang['lbl_filt'] = 'Filtros'; 
$nm_lang['lbl_filt_exib'] = 'Mostrar'; 
$nm_lang['lbl_filt_n_exib'] = 'No mostrar'; 
$nm_lang['lbl_filt_owner'] = 'Propietario'; 
$nm_lang['lbl_filt_tab'] = 'Tablas'; 
$nm_lang['lbl_nao'] = 'No'; 
$nm_lang['lbl_pass'] = 'Contrase&ntilde;a'; 
$nm_lang['lbl_pass_blank'] = 'Establecer contrase&ntilde;a en blanco'; 
$nm_lang['lbl_pass_confirm'] = 'Confirmar contrase&ntilde;a'; 
$nm_lang['lbl_retrieve_schema'] = 'Uso de esquema antes de el nombre de la tabla'; 
$nm_lang['lbl_schema'] = 'Esquema'; 
$nm_lang['lbl_serv'] = 'Host'; 
$nm_lang['lbl_show_proc'] = 'Procedures'; 
$nm_lang['lbl_show_system'] = 'Tablas del sistema'; 
$nm_lang['lbl_show_table'] = 'Tablas'; 
$nm_lang['lbl_show_view'] = 'Views'; 
$nm_lang['lbl_sim'] = 'S&iacute;'; 
$nm_lang['lbl_trans'] = 'Ha transacci&oacute;n?'; 
$nm_lang['lbl_use_persistent'] = 'Conexi&oacute;n persistente'; 
$nm_lang['lbl_usua'] = 'Usuario'; 
$nm_lang['lbl_val'] = 'Valor'; 
$nm_lang['msg_connect_lang'] = 'Cuando se utiliza caracteres multibyte como: &aacute;rabe, chino, japon&eacute;s o ruso, ScriptCase s&oacute;lo admite la codificaci&oacute;n UTF-8 bases de datos, leer y escribir todos los datos est&aacute;n almacenados y se muestra como la codificaci&oacute;n UTF-8 en su base de datos'; 
$nm_lang['msg_save_text'] = 'Sus cambios se han guardado.'; 
$nm_lang['msg_save_title'] = 'Advertencia'; 
$nm_lang['button_cancel'] = 'Cancelar'; 
$nm_lang['button_close'] = 'Cerrar'; 
$nm_lang['button_confirm'] = 'Confirmar';
$nm_lang['lbl_bt_edit_conn']  = 'Editar conexi&oacute;n'; 
$nm_lang['lbl_connection_edit']  = 'Editar conexi&oacute;n'; 

$nm_lang['lbl_loading']  = 'Cargando';

$nm_lang['page_apl_cache'] = 'Las aplicaciones publicadas hacen caché de conexión. Al cambiar alguna conexión, recuerde que debe cerrar el navegador y abra la aplicación generada de nuevo!';

$nm_lang['create_conn_wizard']['descricoes']['date_separator'] = 'Carácter que se utiliza como delimitador en los campos de fecha dentro de las bases de datos. Ejemplo: &#39;2016-01-01&#39; <br /><br /> Si usted no sabe lo que significa esta opción, por favor, sólo dejarla en blanco.';
$nm_lang['label']['date_separator'] = 'Carácter delimitador para campo fecha en la base de datos.';
$nm_lang['lbl_date_separator'] = 'Carácter delimitador para data no banco de dados';
?>