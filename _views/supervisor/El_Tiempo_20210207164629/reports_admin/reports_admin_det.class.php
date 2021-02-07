<?php
//--- 
class reports_admin_det
{
   var $Ini;
   var $Erro;
   var $Db;
   var $nm_data;
   var $NM_raiz_img; 
   var $nmgp_botoes; 
   var $nm_location;
   var $dc_nombre_clie;
   var $dc_num_documento;
   var $dc_email_clie;
   var $ds_suscripcion;
   var $ds_fecha_venta;
   var $drs_direccion;
   var $u_names;
   var $u_surnames;
   var $u_canal;
   var $ds_fecha_autoriza;
   var $dc_fecha_registro;
   var $dc_tipo_cliente;
   var $dc_medio_contact;
   var $dc_tel_casa;
   var $dc_celular_clie;
   var $dc_fech_nacimiento;
   var $dc_pagador_mismo;
   var $ds_fecha_ini_suscripcion;
   var $ds_publicacion;
   var $ds_periodo_suscripcion;
   var $ds_frecuencia;
   var $drs_departamento;
   var $drs_ciudad;
   var $drs_barrio;
   var $fp_medio_pago;
   var $fp_num_tc;
   var $fp_tipo_tc;
   var $fp_vencimiento_tc;
   var $fp_banco_tc;
   var $fp_num_cuotastc;
   var $fp_debito_automatico;
   var $fp_ofrece_obsequio;
   var $fp_precio_bruto;
   var $fp_descuento;
   var $fp_valor_neto;
   var $fp_observaciones;
   var $u_correo;
 function monta_det()
 {
    global 
           $nm_saida, $nm_lang, $nmgp_cor_print, $nmgp_tipo_pdf;
    $this->nmgp_botoes['det_pdf'] = "on";
    $this->nmgp_botoes['det_print'] = "on";
    $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
    if (isset($_SESSION['scriptcase']['sc_apl_conf']['reports_admin']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['reports_admin']['btn_display']))
    {
        foreach ($_SESSION['scriptcase']['sc_apl_conf']['reports_admin']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
        {
            $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
        }
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['reports_admin']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['reports_admin']['campos_busca']))
    { 
        $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['reports_admin']['campos_busca'];
        if ($_SESSION['scriptcase']['charset'] != "UTF-8")
        {
            $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
        }
        $this->dc_medio_contact = $Busca_temp['dc_medio_contact']; 
        $tmp_pos = strpos($this->dc_medio_contact, "##@@");
        if ($tmp_pos !== false)
        {
            $this->dc_medio_contact = substr($this->dc_medio_contact, 0, $tmp_pos);
        }
        $this->dc_tipo_cliente = $Busca_temp['dc_tipo_cliente']; 
        $tmp_pos = strpos($this->dc_tipo_cliente, "##@@");
        if ($tmp_pos !== false)
        {
            $this->dc_tipo_cliente = substr($this->dc_tipo_cliente, 0, $tmp_pos);
        }
        $this->dc_nombre_clie = $Busca_temp['dc_nombre_clie']; 
        $tmp_pos = strpos($this->dc_nombre_clie, "##@@");
        if ($tmp_pos !== false)
        {
            $this->dc_nombre_clie = substr($this->dc_nombre_clie, 0, $tmp_pos);
        }
        $this->dc_num_documento = $Busca_temp['dc_num_documento']; 
        $tmp_pos = strpos($this->dc_num_documento, "##@@");
        if ($tmp_pos !== false)
        {
            $this->dc_num_documento = substr($this->dc_num_documento, 0, $tmp_pos);
        }
    } 
    $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['reports_admin']['where_orig'];
    $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['reports_admin']['where_pesq'];
    $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['reports_admin']['where_pesq_filtro'];
    $this->nm_field_dinamico = array();
    $this->nm_order_dinamico = array();
    $this->nm_data = new nm_data("es_es");
    $this->NM_raiz_img  = ""; 
    $this->sc_proc_grid = false; 
    include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
    $_SESSION['sc_session'][$this->Ini->sc_page]['reports_admin']['seq_dir'] = 0; 
    $_SESSION['sc_session'][$this->Ini->sc_page]['reports_admin']['sub_dir'] = array(); 
   $Str_date = strtolower($_SESSION['scriptcase']['reg_conf']['date_format']);
   $Lim   = strlen($Str_date);
   $Ult   = "";
   $Arr_D = array();
   for ($I = 0; $I < $Lim; $I++)
   {
       $Char = substr($Str_date, $I, 1);
       if ($Char != $Ult)
       {
           $Arr_D[] = $Char;
       }
       $Ult = $Char;
   }
   $Prim = true;
   $Str  = "";
   foreach ($Arr_D as $Cada_d)
   {
       $Str .= (!$Prim) ? $_SESSION['scriptcase']['reg_conf']['date_sep'] : "";
       $Str .= $Cada_d;
       $Prim = false;
   }
   $Str = str_replace("a", "Y", $Str);
   $Str = str_replace("y", "Y", $Str);
   $nm_data_fixa = date($Str); 
   $this->nm_data->SetaData(date("Y/m/d H:i:s"), "YYYY/MM/DD HH:II:SS"); 
   $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_edit.php", "F", "nmgp_Form_Num_Val") ; 
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase)) 
   { 
       $nmgp_select = "SELECT dc.tipo_cliente as dc_tipo_cliente, dc.nombre_clie as dc_nombre_clie, dc.num_documento as dc_num_documento, dc.medio_contact as dc_medio_contact, dc.tel_casa as dc_tel_casa, dc.celular_clie as dc_celular_clie, str_replace (convert(char(10),dc.fech_nacimiento,102), '.', '-') + ' ' + convert(char(8),dc.fech_nacimiento,20), dc.email_clie as dc_email_clie, dc.pagador_mismo as dc_pagador_mismo, str_replace (convert(char(10),dc.fecha_registro,102), '.', '-') + ' ' + convert(char(8),dc.fecha_registro,20), ds.suscripcion as ds_suscripcion, str_replace (convert(char(10),ds.fecha_venta,102), '.', '-') + ' ' + convert(char(8),ds.fecha_venta,20), str_replace (convert(char(10),ds.fecha_ini_suscripcion,102), '.', '-') + ' ' + convert(char(8),ds.fecha_ini_suscripcion,20), ds.publicacion as ds_publicacion, ds.periodo_suscripcion as ds_periodo_suscripcion, ds.frecuencia as ds_frecuencia, str_replace (convert(char(10),ds.fecha_autoriza,102), '.', '-') + ' ' + convert(char(8),ds.fecha_autoriza,20), drs.departamento as drs_departamento, drs.ciudad as drs_ciudad, drs.barrio as drs_barrio, drs.direccion as drs_direccion, fp.medio_pago as fp_medio_pago, fp.num_TC as fp_num_tc, fp.tipo_TC as fp_tipo_tc, str_replace (convert(char(10),fp.vencimiento_TC,102), '.', '-') + ' ' + convert(char(8),fp.vencimiento_TC,20), fp.banco_TC as fp_banco_tc, fp.num_cuotasTC as fp_num_cuotastc, fp.debito_automatico as fp_debito_automatico, fp.ofrece_obsequio as fp_ofrece_obsequio, fp.precio_bruto as fp_precio_bruto, fp.descuento as fp_descuento, fp.valor_neto as fp_valor_neto, fp.observaciones as fp_observaciones, u.names as u_names, u.surnames as u_surnames, u.correo as u_correo, u.canal as u_canal from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql)) 
   { 
       $nmgp_select = "SELECT dc.tipo_cliente as dc_tipo_cliente, dc.nombre_clie as dc_nombre_clie, dc.num_documento as dc_num_documento, dc.medio_contact as dc_medio_contact, dc.tel_casa as dc_tel_casa, dc.celular_clie as dc_celular_clie, convert(char(23),dc.fech_nacimiento,121), dc.email_clie as dc_email_clie, dc.pagador_mismo as dc_pagador_mismo, convert(char(23),dc.fecha_registro,121), ds.suscripcion as ds_suscripcion, convert(char(23),ds.fecha_venta,121), convert(char(23),ds.fecha_ini_suscripcion,121), ds.publicacion as ds_publicacion, ds.periodo_suscripcion as ds_periodo_suscripcion, ds.frecuencia as ds_frecuencia, convert(char(23),ds.fecha_autoriza,121), drs.departamento as drs_departamento, drs.ciudad as drs_ciudad, drs.barrio as drs_barrio, drs.direccion as drs_direccion, fp.medio_pago as fp_medio_pago, fp.num_TC as fp_num_tc, fp.tipo_TC as fp_tipo_tc, convert(char(23),fp.vencimiento_TC,121), fp.banco_TC as fp_banco_tc, fp.num_cuotasTC as fp_num_cuotastc, fp.debito_automatico as fp_debito_automatico, fp.ofrece_obsequio as fp_ofrece_obsequio, fp.precio_bruto as fp_precio_bruto, fp.descuento as fp_descuento, fp.valor_neto as fp_valor_neto, fp.observaciones as fp_observaciones, u.names as u_names, u.surnames as u_surnames, u.correo as u_correo, u.canal as u_canal from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle)) 
   { 
       $nmgp_select = "SELECT dc.tipo_cliente as dc_tipo_cliente, dc.nombre_clie as dc_nombre_clie, dc.num_documento as dc_num_documento, dc.medio_contact as dc_medio_contact, dc.tel_casa as dc_tel_casa, dc.celular_clie as dc_celular_clie, dc.fech_nacimiento as dc_fech_nacimiento, dc.email_clie as dc_email_clie, dc.pagador_mismo as dc_pagador_mismo, dc.fecha_registro as dc_fecha_registro, ds.suscripcion as ds_suscripcion, ds.fecha_venta as ds_fecha_venta, ds.fecha_ini_suscripcion as ds_fecha_ini_suscripcion, ds.publicacion as ds_publicacion, ds.periodo_suscripcion as ds_periodo_suscripcion, ds.frecuencia as ds_frecuencia, ds.fecha_autoriza as ds_fecha_autoriza, drs.departamento as drs_departamento, drs.ciudad as drs_ciudad, drs.barrio as drs_barrio, drs.direccion as drs_direccion, fp.medio_pago as fp_medio_pago, fp.num_TC as fp_num_tc, fp.tipo_TC as fp_tipo_tc, fp.vencimiento_TC as fp_vencimiento_tc, fp.banco_TC as fp_banco_tc, fp.num_cuotasTC as fp_num_cuotastc, fp.debito_automatico as fp_debito_automatico, fp.ofrece_obsequio as fp_ofrece_obsequio, fp.precio_bruto as fp_precio_bruto, fp.descuento as fp_descuento, fp.valor_neto as fp_valor_neto, fp.observaciones as fp_observaciones, u.names as u_names, u.surnames as u_surnames, u.correo as u_correo, u.canal as u_canal from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix)) 
   { 
       $nmgp_select = "SELECT dc.tipo_cliente as dc_tipo_cliente, dc.nombre_clie as dc_nombre_clie, dc.num_documento as dc_num_documento, dc.medio_contact as dc_medio_contact, dc.tel_casa as dc_tel_casa, dc.celular_clie as dc_celular_clie, EXTEND(dc.fech_nacimiento, YEAR TO DAY), dc.email_clie as dc_email_clie, dc.pagador_mismo as dc_pagador_mismo, EXTEND(dc.fecha_registro, YEAR TO FRACTION), ds.suscripcion as ds_suscripcion, EXTEND(ds.fecha_venta, YEAR TO DAY), EXTEND(ds.fecha_ini_suscripcion, YEAR TO DAY), ds.publicacion as ds_publicacion, ds.periodo_suscripcion as ds_periodo_suscripcion, ds.frecuencia as ds_frecuencia, EXTEND(ds.fecha_autoriza, YEAR TO DAY), drs.departamento as drs_departamento, drs.ciudad as drs_ciudad, drs.barrio as drs_barrio, drs.direccion as drs_direccion, fp.medio_pago as fp_medio_pago, fp.num_TC as fp_num_tc, fp.tipo_TC as fp_tipo_tc, EXTEND(fp.vencimiento_TC, YEAR TO DAY), fp.banco_TC as fp_banco_tc, fp.num_cuotasTC as fp_num_cuotastc, fp.debito_automatico as fp_debito_automatico, fp.ofrece_obsequio as fp_ofrece_obsequio, fp.precio_bruto as fp_precio_bruto, fp.descuento as fp_descuento, fp.valor_neto as fp_valor_neto, fp.observaciones as fp_observaciones, u.names as u_names, u.surnames as u_surnames, u.correo as u_correo, u.canal as u_canal from " . $this->Ini->nm_tabela; 
   } 
   else 
   { 
       $nmgp_select = "SELECT dc.tipo_cliente as dc_tipo_cliente, dc.nombre_clie as dc_nombre_clie, dc.num_documento as dc_num_documento, dc.medio_contact as dc_medio_contact, dc.tel_casa as dc_tel_casa, dc.celular_clie as dc_celular_clie, dc.fech_nacimiento as dc_fech_nacimiento, dc.email_clie as dc_email_clie, dc.pagador_mismo as dc_pagador_mismo, dc.fecha_registro as dc_fecha_registro, ds.suscripcion as ds_suscripcion, ds.fecha_venta as ds_fecha_venta, ds.fecha_ini_suscripcion as ds_fecha_ini_suscripcion, ds.publicacion as ds_publicacion, ds.periodo_suscripcion as ds_periodo_suscripcion, ds.frecuencia as ds_frecuencia, ds.fecha_autoriza as ds_fecha_autoriza, drs.departamento as drs_departamento, drs.ciudad as drs_ciudad, drs.barrio as drs_barrio, drs.direccion as drs_direccion, fp.medio_pago as fp_medio_pago, fp.num_TC as fp_num_tc, fp.tipo_TC as fp_tipo_tc, fp.vencimiento_TC as fp_vencimiento_tc, fp.banco_TC as fp_banco_tc, fp.num_cuotasTC as fp_num_cuotastc, fp.debito_automatico as fp_debito_automatico, fp.ofrece_obsequio as fp_ofrece_obsequio, fp.precio_bruto as fp_precio_bruto, fp.descuento as fp_descuento, fp.valor_neto as fp_valor_neto, fp.observaciones as fp_observaciones, u.names as u_names, u.surnames as u_surnames, u.correo as u_correo, u.canal as u_canal from " . $this->Ini->nm_tabela; 
   } 
   $parms_det = explode("*PDet*", $_SESSION['sc_session'][$this->Ini->sc_page]['reports_admin']['chave_det']) ; 
   foreach ($parms_det as $key => $cada_par)
   {
       $parms_det[$key] = $this->Db->qstr($parms_det[$key]);
       $parms_det[$key] = substr($parms_det[$key], 1, strlen($parms_det[$key]) - 2);
   } 
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
   {
       $nmgp_select .= " where  dc.nombre_clie = '$parms_det[0]' and dc.num_documento = '$parms_det[1]' and dc.email_clie = '$parms_det[2]' and ds.suscripcion = '$parms_det[3]' and drs.direccion = '$parms_det[4]' and u.names = '$parms_det[5]' and u.surnames = '$parms_det[6]' and u.canal = '$parms_det[7]' and dc.fecha_registro = #$parms_det[8]# and dc.tipo_cliente = '$parms_det[9]' and dc.medio_contact = '$parms_det[10]' and dc.tel_casa = '$parms_det[11]' and dc.celular_clie = $parms_det[12]" ;  
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
   {
       $nmgp_select .= " where  dc.nombre_clie = '$parms_det[0]' and dc.num_documento = '$parms_det[1]' and dc.email_clie = '$parms_det[2]' and ds.suscripcion = '$parms_det[3]' and drs.direccion = '$parms_det[4]' and u.names = '$parms_det[5]' and u.surnames = '$parms_det[6]' and u.canal = '$parms_det[7]' and convert(char(23),dc.fecha_registro,121) = '$parms_det[8]' and dc.tipo_cliente = '$parms_det[9]' and dc.medio_contact = '$parms_det[10]' and dc.tel_casa = '$parms_det[11]' and dc.celular_clie = $parms_det[12]" ;  
   } 
   else 
   { 
       $nmgp_select .= " where  dc.nombre_clie = '$parms_det[0]' and dc.num_documento = '$parms_det[1]' and dc.email_clie = '$parms_det[2]' and ds.suscripcion = '$parms_det[3]' and drs.direccion = '$parms_det[4]' and u.names = '$parms_det[5]' and u.surnames = '$parms_det[6]' and u.canal = '$parms_det[7]' and dc.fecha_registro = " . $this->Ini->date_delim . $parms_det[8] . $this->Ini->date_delim1 . " and dc.tipo_cliente = '$parms_det[9]' and dc.medio_contact = '$parms_det[10]' and dc.tel_casa = '$parms_det[11]' and dc.celular_clie = $parms_det[12]" ;  
   } 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
   $rs = $this->Db->Execute($nmgp_select) ; 
   if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
   { 
       $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit ; 
   }  
   $this->dc_tipo_cliente = $rs->fields[0] ;  
   $this->dc_nombre_clie = $rs->fields[1] ;  
   $this->dc_num_documento = $rs->fields[2] ;  
   $this->dc_medio_contact = $rs->fields[3] ;  
   $this->dc_tel_casa = $rs->fields[4] ;  
   $this->dc_celular_clie = $rs->fields[5] ;  
   $this->dc_celular_clie = (string)$this->dc_celular_clie;
   $this->dc_fech_nacimiento = $rs->fields[6] ;  
   $this->dc_email_clie = $rs->fields[7] ;  
   $this->dc_pagador_mismo = $rs->fields[8] ;  
   $this->dc_fecha_registro = $rs->fields[9] ;  
   $this->ds_suscripcion = $rs->fields[10] ;  
   $this->ds_fecha_venta = $rs->fields[11] ;  
   $this->ds_fecha_ini_suscripcion = $rs->fields[12] ;  
   $this->ds_publicacion = $rs->fields[13] ;  
   $this->ds_periodo_suscripcion = $rs->fields[14] ;  
   $this->ds_frecuencia = $rs->fields[15] ;  
   $this->ds_fecha_autoriza = $rs->fields[16] ;  
   $this->drs_departamento = $rs->fields[17] ;  
   $this->drs_ciudad = $rs->fields[18] ;  
   $this->drs_barrio = $rs->fields[19] ;  
   $this->drs_direccion = $rs->fields[20] ;  
   $this->fp_medio_pago = $rs->fields[21] ;  
   $this->fp_num_tc = $rs->fields[22] ;  
   $this->fp_num_tc = (string)$this->fp_num_tc;
   $this->fp_tipo_tc = $rs->fields[23] ;  
   $this->fp_vencimiento_tc = $rs->fields[24] ;  
   $this->fp_banco_tc = $rs->fields[25] ;  
   $this->fp_num_cuotastc = $rs->fields[26] ;  
   $this->fp_num_cuotastc = (string)$this->fp_num_cuotastc;
   $this->fp_debito_automatico = $rs->fields[27] ;  
   $this->fp_ofrece_obsequio = $rs->fields[28] ;  
   $this->fp_precio_bruto = $rs->fields[29] ;  
   $this->fp_precio_bruto = (string)$this->fp_precio_bruto;
   $this->fp_descuento = $rs->fields[30] ;  
   $this->fp_descuento = (string)$this->fp_descuento;
   $this->fp_valor_neto = $rs->fields[31] ;  
   $this->fp_valor_neto = (string)$this->fp_valor_neto;
   $this->fp_observaciones = $rs->fields[32] ;  
   $this->u_names = $rs->fields[33] ;  
   $this->u_surnames = $rs->fields[34] ;  
   $this->u_correo = $rs->fields[35] ;  
   $this->u_canal = $rs->fields[36] ;  
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['reports_admin']['cmp_acum']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['reports_admin']['cmp_acum']))
   {
       $parms_acum = explode(";", $_SESSION['sc_session'][$this->Ini->sc_page]['reports_admin']['cmp_acum']);
       foreach ($parms_acum as $cada_par)
       {
          $cada_val = explode("=", $cada_par);
          $this->$cada_val[0] = $cada_val[1];
       }
   }
//--- 
   $nm_saida->saida("<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\"\r\n");
   $nm_saida->saida("            \"http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n");
   $nm_saida->saida("<html" . $_SESSION['scriptcase']['reg_conf']['html_dir'] . ">\r\n");
   $nm_saida->saida("<HEAD>\r\n");
   $nm_saida->saida("   <TITLE>" . $this->Ini->Nm_lang['lang_othr_detl_titl'] . " - </TITLE>\r\n");
   $nm_saida->saida(" <META http-equiv=\"Content-Type\" content=\"text/html; charset=" . $_SESSION['scriptcase']['charset_html'] . "\" />\r\n");
   $nm_saida->saida(" <META http-equiv=\"Expires\" content=\"Fri, Jan 01 1900 00:00:00 GMT\"/>\r\n");
   $nm_saida->saida(" <META http-equiv=\"Last-Modified\" content=\"" . gmdate("D, d M Y H:i:s") . " GMT\"/>\r\n");
   $nm_saida->saida(" <META http-equiv=\"Cache-Control\" content=\"no-store, no-cache, must-revalidate\"/>\r\n");
   $nm_saida->saida(" <META http-equiv=\"Cache-Control\" content=\"post-check=0, pre-check=0\"/>\r\n");
   $nm_saida->saida(" <META http-equiv=\"Pragma\" content=\"no-cache\"/>\r\n");
   if ($_SESSION['scriptcase']['proc_mobile'])
   {
       $nm_saida->saida(" <meta name=\"viewport\" content=\"width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;\" />\r\n");
   }

   $nm_saida->saida(" <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery/js/jquery.js\"></script>\r\n");
   $nm_saida->saida(" <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/malsup-blockui/jquery.blockUI.js\"></script>\r\n");
   $nm_saida->saida(" <script type=\"text/javascript\">var sc_pathToTB = '" . $this->Ini->path_prod . "/third/jquery_plugin/thickbox/';</script>\r\n");
   $nm_saida->saida(" <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/thickbox/thickbox-compressed.js\"></script>\r\n");
   $nm_saida->saida(" <script type=\"text/javascript\" src=\"../_lib/lib/js/jquery.scInput.js\"></script>\r\n");
   $nm_saida->saida(" <link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/jquery_plugin/thickbox/thickbox.css\" type=\"text/css\" media=\"screen\" />\r\n");
   if (($_SESSION['sc_session'][$this->Ini->sc_page]['reports_admin']['det_print'] == "print" && strtoupper($nmgp_cor_print) == "PB") || $nmgp_tipo_pdf == "pb")
   {
       $nm_saida->saida(" <link rel=\"stylesheet\" type=\"text/css\" href=\"" . $this->Ini->path_link . "_lib/css/" . $this->Ini->str_schema_all . "_grid_bw.css\" /> \r\n");
       $nm_saida->saida(" <link rel=\"stylesheet\" type=\"text/css\" href=\"" . $this->Ini->path_link . "_lib/css/" . $this->Ini->str_schema_all . "_grid_bw" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" /> \r\n");
   }
   else
   {
       $nm_saida->saida(" <link rel=\"stylesheet\" type=\"text/css\" href=\"" . $this->Ini->path_link . "_lib/css/" . $this->Ini->str_schema_all . "_grid.css\" /> \r\n");
       $nm_saida->saida(" <link rel=\"stylesheet\" type=\"text/css\" href=\"" . $this->Ini->path_link . "_lib/css/" . $this->Ini->str_schema_all . "_grid" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" /> \r\n");
   }
       $nm_saida->saida(" <link rel=\"stylesheet\" type=\"text/css\" href=\"" . $this->Ini->path_link . "reports_admin/reports_admin_det_" . strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css\" />\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['reports_admin']['pdf_det'] && $_SESSION['sc_session'][$this->Ini->sc_page]['reports_admin']['det_print'] != "print")
   {
       $nm_saida->saida(" <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/buttons/" . $this->Ini->Str_btn_css . "\" /> \r\n");
       $nm_saida->saida(" <link rel=\"stylesheet\" href=\"../_lib/css/" . $_SESSION['scriptcase']['erro']['str_schema'] . "\" type=\"text/css\" media=\"screen\" />\r\n");
       $nm_saida->saida(" <link rel=\"stylesheet\" href=\"../_lib/css/" . $_SESSION['scriptcase']['erro']['str_schema_dir'] . "\" type=\"text/css\" media=\"screen\" />\r\n");
   }
   $nm_saida->saida("</HEAD>\r\n");
   $nm_saida->saida("  <body class=\"scGridPage\">\r\n");
   $nm_saida->saida("  " . $this->Ini->Ajax_result_set . "\r\n");
   $nm_saida->saida("<table border=0 align=\"center\" valign=\"top\" ><tr><td style=\"padding: 0px\"><div class=\"scGridBorder\"><table width='100%' cellspacing=0 cellpadding=0><tr><td>\r\n");
   $nm_saida->saida("<tr><td class=\"scGridTabelaTd\">\r\n");
   $nm_saida->saida("<style>\r\n");
   $nm_saida->saida("#lin1_col1 { padding-left:9px; padding-top:7px;  height:27px; overflow:hidden; text-align:left;}			 \r\n");
   $nm_saida->saida("#lin1_col2 { padding-right:9px; padding-top:7px; height:27px; text-align:right; overflow:hidden;   font-size:12px; font-weight:normal;}\r\n");
   $nm_saida->saida("</style>\r\n");
   $nm_saida->saida("<div style=\"width: 100%\">\r\n");
   $nm_saida->saida(" <div class=\"scGridHeader\" style=\"height:11px; display: block; border-width:0px; \"></div>\r\n");
   $nm_saida->saida(" <div style=\"height:37px; border-width:0px 0px 1px 0px;  border-style: dashed; border-color:#ddd; display: block\">\r\n");
   $nm_saida->saida(" 	<table style=\"width:100%; border-collapse:collapse; padding:0;\">\r\n");
   $nm_saida->saida("    	<tr>\r\n");
   $nm_saida->saida("        	<td id=\"lin1_col1\" class=\"scGridHeaderFont\"><span>" . $this->Ini->Nm_lang['lang_othr_detl_titl'] . " - </span></td>\r\n");
   $nm_saida->saida("            <td id=\"lin1_col2\" class=\"scGridHeaderFont\"><span></span></td>\r\n");
   $nm_saida->saida("        </tr>\r\n");
   $nm_saida->saida("    </table>		 \r\n");
   $nm_saida->saida(" </div>\r\n");
   $nm_saida->saida("</div>\r\n");
   $nm_saida->saida("  </TD>\r\n");
   $nm_saida->saida(" </TR>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['reports_admin']['det_print'] != "print" && !$_SESSION['sc_session'][$this->Ini->sc_page]['reports_admin']['pdf_det']) 
   { 
       $nm_saida->saida("   <tr><td class=\"scGridTabelaTd\">\r\n");
       $nm_saida->saida("    <table width=\"100%\"><tr>\r\n");
       $nm_saida->saida("     <td class=\"scGridToolbar\">\r\n");
       $nm_saida->saida("         </td> \r\n");
       $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"center\" width=\"33%\"> \r\n");
       if ($this->nmgp_botoes['det_pdf'] == "on")
       {
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bpdf", "", "", "Dpdf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "reports_admin/reports_admin_config_pdf.php?nm_opc=pdf_det&nm_target=0&nm_cor=cor&papel=1&orientacao=1&largura=1200&conf_larg=S&conf_fonte=10&language=es&conf_socor=S&KeepThis=false&TB_iframe=true&modal=true", "", "only_text", "text_right", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
       }
       if ($this->nmgp_botoes['det_print'] == "on")
       {
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bprint", "", "", "Dprint_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "reports_admin/reports_admin_config_print.php?nm_opc=detalhe&nm_cor=AM&language=es&KeepThis=true&TB_iframe=true&modal=true", "", "only_text", "text_right", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
       }
       $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "document.F3.submit()", "document.F3.submit()", "sc_b_sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
       $nm_saida->saida("           $Cod_Btn \r\n");
       $nm_saida->saida("         </td> \r\n");
       $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"right\" width=\"33%\"> \r\n");
       $nm_saida->saida("     </td>\r\n");
       $nm_saida->saida("    </tr></table>\r\n");
       $nm_saida->saida("   </td></tr>\r\n");
   } 
   $nm_saida->saida("<tr><td class=\"scGridTabelaTd\">\r\n");
   $nm_saida->saida("<TABLE style=\"padding: 0px; spacing: 0px; border-width: 0px;\"  align=\"center\" valign=\"top\" width=\"100%\">\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['dc_tipo_cliente'])) ? $this->New_label['dc_tipo_cliente'] : "Tipo Cliente"; 
          $conteudo = trim(sc_strip_script($this->dc_tipo_cliente)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_dc_tipo_cliente_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldOddVert css_dc_tipo_cliente_det_line\"   ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['dc_nombre_clie'])) ? $this->New_label['dc_nombre_clie'] : "Nombre del cliente"; 
          $conteudo = trim(sc_strip_script($this->dc_nombre_clie)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_dc_nombre_clie_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldEvenVert css_dc_nombre_clie_det_line\"   ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['dc_num_documento'])) ? $this->New_label['dc_num_documento'] : "Documento del cliente"; 
          $conteudo = trim(sc_strip_script($this->dc_num_documento)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_dc_num_documento_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldOddVert css_dc_num_documento_det_line\"   ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['dc_medio_contact'])) ? $this->New_label['dc_medio_contact'] : "Medio Contact"; 
          $conteudo = trim(sc_strip_script($this->dc_medio_contact)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_dc_medio_contact_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldEvenVert css_dc_medio_contact_det_line\"   ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['dc_tel_casa'])) ? $this->New_label['dc_tel_casa'] : "Tel Casa"; 
          $conteudo = trim(sc_strip_script($this->dc_tel_casa)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_dc_tel_casa_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldOddVert css_dc_tel_casa_det_line\"   ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['dc_celular_clie'])) ? $this->New_label['dc_celular_clie'] : "Celular Clie"; 
          $conteudo = trim(NM_encode_input(sc_strip_script($this->dc_celular_clie))); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_dc_celular_clie_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldEvenVert css_dc_celular_clie_det_line\"  NOWRAP ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['dc_fech_nacimiento'])) ? $this->New_label['dc_fech_nacimiento'] : "Fech Nacimiento"; 
          $conteudo = trim(NM_encode_input(sc_strip_script($this->dc_fech_nacimiento))); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
          else    
          { 
               $conteudo_x =  $conteudo;
               nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
               if (is_numeric($conteudo_x) && $conteudo_x > 0) 
               { 
                   $this->nm_data->SetaData($conteudo, "YYYY-MM-DD");
                   $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
               } 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_dc_fech_nacimiento_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldOddVert css_dc_fech_nacimiento_det_line\"  NOWRAP ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['dc_email_clie'])) ? $this->New_label['dc_email_clie'] : "Correo del cliente"; 
          $conteudo = trim(sc_strip_script($this->dc_email_clie)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_dc_email_clie_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldEvenVert css_dc_email_clie_det_line\"   ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['dc_pagador_mismo'])) ? $this->New_label['dc_pagador_mismo'] : "Pagador Mismo"; 
          $conteudo = trim(sc_strip_script($this->dc_pagador_mismo)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_dc_pagador_mismo_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldOddVert css_dc_pagador_mismo_det_line\"   ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['dc_fecha_registro'])) ? $this->New_label['dc_fecha_registro'] : "Fecha Registro"; 
          $conteudo = trim(NM_encode_input(sc_strip_script($this->dc_fecha_registro))); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
          else    
          { 
               if (substr($conteudo, 10, 1) == "-") 
               { 
                  $conteudo = substr($conteudo, 0, 10) . " " . substr($conteudo, 11);
               } 
               if (substr($conteudo, 13, 1) == ".") 
               { 
                  $conteudo = substr($conteudo, 0, 13) . ":" . substr($conteudo, 14, 2) . ":" . substr($conteudo, 17);
               } 
               $conteudo_x =  $conteudo;
               nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD HH:II:SS");
               if (is_numeric($conteudo_x) && $conteudo_x > 0) 
               { 
                   $this->nm_data->SetaData($conteudo, "YYYY-MM-DD HH:II:SS");
                   $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "ddmmaaaa;hhiiss"));
               } 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_dc_fecha_registro_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldEvenVert css_dc_fecha_registro_det_line\"  NOWRAP ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['ds_suscripcion'])) ? $this->New_label['ds_suscripcion'] : "Suscripcion"; 
          $conteudo = trim(sc_strip_script($this->ds_suscripcion)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_ds_suscripcion_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldOddVert css_ds_suscripcion_det_line\"   ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['ds_fecha_venta'])) ? $this->New_label['ds_fecha_venta'] : "Fecha de Venta"; 
          $conteudo = trim(NM_encode_input(sc_strip_script($this->ds_fecha_venta))); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
          else    
          { 
               $conteudo_x =  $conteudo;
               nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
               if (is_numeric($conteudo_x) && $conteudo_x > 0) 
               { 
                   $this->nm_data->SetaData($conteudo, "YYYY-MM-DD");
                   $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
               } 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_ds_fecha_venta_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldEvenVert css_ds_fecha_venta_det_line\"  NOWRAP ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['ds_fecha_ini_suscripcion'])) ? $this->New_label['ds_fecha_ini_suscripcion'] : "Fecha Ini Suscripcion"; 
          $conteudo = trim(NM_encode_input(sc_strip_script($this->ds_fecha_ini_suscripcion))); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
          else    
          { 
               $conteudo_x =  $conteudo;
               nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
               if (is_numeric($conteudo_x) && $conteudo_x > 0) 
               { 
                   $this->nm_data->SetaData($conteudo, "YYYY-MM-DD");
                   $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
               } 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_ds_fecha_ini_suscripcion_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldOddVert css_ds_fecha_ini_suscripcion_det_line\"  NOWRAP ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['ds_publicacion'])) ? $this->New_label['ds_publicacion'] : "Publicacion"; 
          $conteudo = trim(sc_strip_script($this->ds_publicacion)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_ds_publicacion_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldEvenVert css_ds_publicacion_det_line\"   ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['ds_periodo_suscripcion'])) ? $this->New_label['ds_periodo_suscripcion'] : "Periodo Suscripcion"; 
          $conteudo = trim(sc_strip_script($this->ds_periodo_suscripcion)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_ds_periodo_suscripcion_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldOddVert css_ds_periodo_suscripcion_det_line\"   ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['ds_frecuencia'])) ? $this->New_label['ds_frecuencia'] : "Frecuencia"; 
          $conteudo = trim(sc_strip_script($this->ds_frecuencia)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_ds_frecuencia_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldEvenVert css_ds_frecuencia_det_line\"   ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['ds_fecha_autoriza'])) ? $this->New_label['ds_fecha_autoriza'] : "Fecha Autoriza"; 
          $conteudo = trim(NM_encode_input(sc_strip_script($this->ds_fecha_autoriza))); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
          else    
          { 
               $conteudo_x =  $conteudo;
               nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
               if (is_numeric($conteudo_x) && $conteudo_x > 0) 
               { 
                   $this->nm_data->SetaData($conteudo, "YYYY-MM-DD");
                   $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
               } 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_ds_fecha_autoriza_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldOddVert css_ds_fecha_autoriza_det_line\"  NOWRAP ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['drs_departamento'])) ? $this->New_label['drs_departamento'] : "Departamento"; 
          $conteudo = trim(sc_strip_script($this->drs_departamento)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_drs_departamento_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldEvenVert css_drs_departamento_det_line\"   ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['drs_ciudad'])) ? $this->New_label['drs_ciudad'] : "Ciudad"; 
          $conteudo = trim(sc_strip_script($this->drs_ciudad)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_drs_ciudad_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldOddVert css_drs_ciudad_det_line\"   ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['drs_barrio'])) ? $this->New_label['drs_barrio'] : "Barrio"; 
          $conteudo = trim(sc_strip_script($this->drs_barrio)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_drs_barrio_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldEvenVert css_drs_barrio_det_line\"   ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['drs_direccion'])) ? $this->New_label['drs_direccion'] : "Direccion"; 
          $conteudo = trim(sc_strip_script($this->drs_direccion)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_drs_direccion_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldOddVert css_drs_direccion_det_line\"   ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['fp_medio_pago'])) ? $this->New_label['fp_medio_pago'] : "Medio Pago"; 
          $conteudo = trim(sc_strip_script($this->fp_medio_pago)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_fp_medio_pago_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldEvenVert css_fp_medio_pago_det_line\"   ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['fp_num_tc'])) ? $this->New_label['fp_num_tc'] : "Num TC"; 
          $conteudo = trim(NM_encode_input(sc_strip_script($this->fp_num_tc))); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_fp_num_tc_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldOddVert css_fp_num_tc_det_line\"  NOWRAP ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['fp_tipo_tc'])) ? $this->New_label['fp_tipo_tc'] : "Tipo TC"; 
          $conteudo = trim(sc_strip_script($this->fp_tipo_tc)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_fp_tipo_tc_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldEvenVert css_fp_tipo_tc_det_line\"   ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['fp_vencimiento_tc'])) ? $this->New_label['fp_vencimiento_tc'] : "Vencimiento TC"; 
          $conteudo = trim(NM_encode_input(sc_strip_script($this->fp_vencimiento_tc))); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
          else    
          { 
               $conteudo_x =  $conteudo;
               nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
               if (is_numeric($conteudo_x) && $conteudo_x > 0) 
               { 
                   $this->nm_data->SetaData($conteudo, "YYYY-MM-DD");
                   $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
               } 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_fp_vencimiento_tc_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldOddVert css_fp_vencimiento_tc_det_line\"  NOWRAP ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['fp_banco_tc'])) ? $this->New_label['fp_banco_tc'] : "Banco TC"; 
          $conteudo = trim(sc_strip_script($this->fp_banco_tc)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_fp_banco_tc_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldEvenVert css_fp_banco_tc_det_line\"   ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['fp_num_cuotastc'])) ? $this->New_label['fp_num_cuotastc'] : "Num Cuotas TC"; 
          $conteudo = trim(NM_encode_input(sc_strip_script($this->fp_num_cuotastc))); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_fp_num_cuotastc_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldOddVert css_fp_num_cuotastc_det_line\"  NOWRAP ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['fp_debito_automatico'])) ? $this->New_label['fp_debito_automatico'] : "Debito Automatico"; 
          $conteudo = trim(sc_strip_script($this->fp_debito_automatico)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_fp_debito_automatico_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldEvenVert css_fp_debito_automatico_det_line\"   ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['fp_ofrece_obsequio'])) ? $this->New_label['fp_ofrece_obsequio'] : "Ofrece Obsequio"; 
          $conteudo = trim(sc_strip_script($this->fp_ofrece_obsequio)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_fp_ofrece_obsequio_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldOddVert css_fp_ofrece_obsequio_det_line\"   ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['fp_precio_bruto'])) ? $this->New_label['fp_precio_bruto'] : "Precio Bruto"; 
          $conteudo = trim(NM_encode_input(sc_strip_script($this->fp_precio_bruto))); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_fp_precio_bruto_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldEvenVert css_fp_precio_bruto_det_line\"  NOWRAP ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['fp_descuento'])) ? $this->New_label['fp_descuento'] : "Descuento"; 
          $conteudo = trim(NM_encode_input(sc_strip_script($this->fp_descuento))); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_fp_descuento_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldOddVert css_fp_descuento_det_line\"  NOWRAP ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['fp_valor_neto'])) ? $this->New_label['fp_valor_neto'] : "Valor Neto"; 
          $conteudo = trim(NM_encode_input(sc_strip_script($this->fp_valor_neto))); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_fp_valor_neto_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldEvenVert css_fp_valor_neto_det_line\"  NOWRAP ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['fp_observaciones'])) ? $this->New_label['fp_observaciones'] : "Observaciones"; 
          $conteudo = trim(sc_strip_script($this->fp_observaciones)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
          else   
          { 
              $conteudo = nl2br($conteudo) ; 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_fp_observaciones_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldOddVert css_fp_observaciones_det_line\"   ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['u_names'])) ? $this->New_label['u_names'] : "Nombre del asesor"; 
          $conteudo = trim(sc_strip_script($this->u_names)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_u_names_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldEvenVert css_u_names_det_line\"   ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['u_surnames'])) ? $this->New_label['u_surnames'] : "Apellido del asesor"; 
          $conteudo = trim(sc_strip_script($this->u_surnames)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_u_surnames_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldOddVert css_u_surnames_det_line\"   ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['u_correo'])) ? $this->New_label['u_correo'] : "Correo"; 
          $conteudo = trim(sc_strip_script($this->u_correo)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_u_correo_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldEvenVert css_u_correo_det_line\"   ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("  <TR class=\"scGridLabel\">\r\n");
          $SC_Label = (isset($this->New_label['u_canal'])) ? $this->New_label['u_canal'] : "Canal"; 
          $conteudo = trim(sc_strip_script($this->u_canal)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ; 
          } 
   $nm_saida->saida("    <TD class=\"scGridLabelFont css_u_canal_det_label\"  >" . nl2br($SC_Label) . "</TD>\r\n");
   $nm_saida->saida("    <TD class=\"scGridFieldOddVert css_u_canal_det_line\"   ALIGN=\"\" VALIGN=\"\">" . $conteudo . "</TD>\r\n");
   $nm_saida->saida("   \r\n");
   $nm_saida->saida("  </TR>\r\n");
   $nm_saida->saida("</TABLE>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['reports_admin']['det_print'] != "print" && !$_SESSION['sc_session'][$this->Ini->sc_page]['reports_admin']['pdf_det']) 
   { 
       $nm_saida->saida("   <tr><td class=\"scGridTabelaTd\">\r\n");
       $nm_saida->saida("    <table width=\"100%\"><tr>\r\n");
       $nm_saida->saida("     <td class=\"scGridToolbar\">\r\n");
       $nm_saida->saida("         </td> \r\n");
       $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"center\" width=\"33%\"> \r\n");
       $nm_saida->saida("         </td> \r\n");
       $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"right\" width=\"33%\"> \r\n");
       $nm_saida->saida("     </td>\r\n");
       $nm_saida->saida("    </tr></table>\r\n");
       $nm_saida->saida("   </td></tr>\r\n");
   } 
   $rs->Close(); 
   $nm_saida->saida("  </td>\r\n");
   $nm_saida->saida(" </tr>\r\n");
   $nm_saida->saida(" </table>\r\n");
   $nm_saida->saida(" </div>\r\n");
   $nm_saida->saida("  </td>\r\n");
   $nm_saida->saida(" </tr>\r\n");
   $nm_saida->saida(" </table>\r\n");
   $nm_saida->saida("  </td>\r\n");
   $nm_saida->saida(" </tr>\r\n");
   $nm_saida->saida(" </table>\r\n");
   $nm_saida->saida(" </div>\r\n");
   $nm_saida->saida("  </td>\r\n");
   $nm_saida->saida(" </tr>\r\n");
   $nm_saida->saida(" </table>\r\n");
//--- 
//--- 
   $nm_saida->saida("<form name=\"F3\" method=post\r\n");
   $nm_saida->saida("                  target=\"_self\"\r\n");
   $nm_saida->saida("                  action=\"./\">\r\n");
   $nm_saida->saida("<input type=hidden name=\"nmgp_opcao\" value=\"igual\"/>\r\n");
   $nm_saida->saida("<input type=hidden name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/>\r\n");
   $nm_saida->saida("<input type=hidden name=\"script_case_session\" value=\"" . NM_encode_input(session_id()) . "\"/>\r\n");
   $nm_saida->saida("</form>\r\n");
   $nm_saida->saida("<script language=JavaScript>\r\n");
   $nm_saida->saida("   function nm_mostra_doc(campo1, campo2, campo3)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       NovaJanela = window.open (\"reports_admin_doc.php?script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&nm_cod_doc=\" + campo1 + \"&nm_nome_doc=\" + campo2 + \"&nm_cod_apl=\" + campo3, \"ScriptCase\", \"resizable\");\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_move(x, y, z, p, g) \r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("      window.location = \"" . $this->Ini->path_link . "reports_admin/index.php?nmgp_opcao=pdf_det&nmgp_tipo_pdf=\" + z + \"&nmgp_parms_pdf=\" + p +  \"&nmgp_graf_pdf=\" + g + \"&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "\";\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_print_conf(tp, cor)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       window.open('" . $this->Ini->path_link . "reports_admin/reports_admin_iframe_prt.php?path_botoes=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&opcao=det_print&cor_print=' + cor,'','location=no,menubar,resizable,scrollbars,status=no,toolbar');\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("</script>\r\n");
   $nm_saida->saida("</body>\r\n");
   $nm_saida->saida("</html>\r\n");
 }
   function nm_gera_mask(&$nm_campo, $nm_mask)
   { 
      $trab_campo = $nm_campo;
      $trab_mask  = $nm_mask;
      $tam_campo  = strlen($nm_campo);
      $trab_saida = "";
      $mask_num = false;
      for ($x=0; $x < strlen($trab_mask); $x++)
      {
          if (substr($trab_mask, $x, 1) == "#")
          {
              $mask_num = true;
              break;
          }
      }
      if ($mask_num )
      {
          $ver_duas = explode(";", $trab_mask);
          if (isset($ver_duas[1]) && !empty($ver_duas[1]))
          {
              $cont1 = count(explode("#", $ver_duas[0])) - 1;
              $cont2 = count(explode("#", $ver_duas[1])) - 1;
              if ($cont2 >= $tam_campo)
              {
                  $trab_mask = $ver_duas[1];
              }
              else
              {
                  $trab_mask = $ver_duas[0];
              }
          }
          $tam_mask = strlen($trab_mask);
          $xdados = 0;
          for ($x=0; $x < $tam_mask; $x++)
          {
              if (substr($trab_mask, $x, 1) == "#" && $xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_campo, $xdados, 1);
                  $xdados++;
              }
              elseif ($xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_mask, $x, 1);
              }
          }
          if ($xdados < $tam_campo)
          {
              $trab_saida .= substr($trab_campo, $xdados);
          }
          $nm_campo = $trab_saida;
          return;
      }
      for ($ix = strlen($trab_mask); $ix > 0; $ix--)
      {
           $char_mask = substr($trab_mask, $ix - 1, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               $trab_saida = $char_mask . $trab_saida;
           }
           else
           {
               if ($tam_campo != 0)
               {
                   $trab_saida = substr($trab_campo, $tam_campo - 1, 1) . $trab_saida;
                   $tam_campo--;
               }
               else
               {
                   $trab_saida = "0" . $trab_saida;
               }
           }
      }
      if ($tam_campo != 0)
      {
          $trab_saida = substr($trab_campo, 0, $tam_campo) . $trab_saida;
          $trab_mask  = str_repeat("z", $tam_campo) . $trab_mask;
      }
   
      $iz = 0; 
      for ($ix = 0; $ix < strlen($trab_mask); $ix++)
      {
           $char_mask = substr($trab_mask, $ix, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               if ($char_mask == "." || $char_mask == ",")
               {
                   $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
               }
               else
               {
                   $iz++;
               }
           }
           elseif ($char_mask == "x" || substr($trab_saida, $iz, 1) != "0")
           {
               $ix = strlen($trab_mask) + 1;
           }
           else
           {
               $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
           }
      }
      $nm_campo = $trab_saida;
   } 
   function nm_conv_data_db($dt_in, $form_in, $form_out)
   {
       $dt_out = $dt_in;
       if (strtoupper($form_in) == "DB_FORMAT")
       {
           if ($dt_out == "null" || $dt_out == "")
           {
               $dt_out = "";
               return $dt_out;
           }
           $form_in = "AAAA-MM-DD";
       }
       if (strtoupper($form_out) == "DB_FORMAT")
       {
           if (empty($dt_out))
           {
               $dt_out = "null";
               return $dt_out;
           }
           $form_out = "AAAA-MM-DD";
       }
       nm_conv_form_data($dt_out, $form_in, $form_out);
       return $dt_out;
   }
}
