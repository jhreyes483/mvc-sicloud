<?php

class reports_admin_xls
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $nm_data;
   var $Xls_dados;
   var $Xls_workbook;
   var $Xls_col;
   var $Xls_row;
   var $sc_proc_grid; 
   var $NM_cmp_hidden = array();
   var $Arquivo;
   var $Tit_doc;
   //---- 
   function reports_admin_xls()
   {
   }

   //---- 
   function monta_xls()
   {
      $this->inicializa_vars();
      $this->grava_arquivo();
      $this->monta_html();
   }

   //----- 
   function inicializa_vars()
   {
      global $nm_lang;
      $this->Xls_row = 1;
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      set_include_path(get_include_path() . PATH_SEPARATOR . $this->Ini->path_third . '/phpexcel/');
      require_once $this->Ini->path_third . '/phpexcel/PHPExcel.php';
      require_once $this->Ini->path_third . '/phpexcel/PHPExcel/IOFactory.php';
      require_once $this->Ini->path_third . '/phpexcel/PHPExcel/Cell/AdvancedValueBinder.php';
      $orig_form_dt = strtoupper($_SESSION['scriptcase']['reg_conf']['date_format']);
      $this->SC_date_conf_region = "";
      for ($i = 0; $i < 8; $i++)
      {
          if ($i > 0 && substr($orig_form_dt, $i, 1) != substr($this->SC_date_conf_region, -1, 1)) {
              $this->SC_date_conf_region .= $_SESSION['scriptcase']['reg_conf']['date_sep'];
          }
          $this->SC_date_conf_region .= substr($orig_form_dt, $i, 1);
      }
      $this->Xls_col    = 0;
      $this->nm_data    = new nm_data("es");
      $this->Arquivo    = "sc_xls";
      $this->Arquivo   .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arquivo   .= "_reports_admin";
      $this->Arquivo   .= ".xls";
      $this->Tit_doc    = "reports_admin.xls";
      $this->Xls_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      PHPExcel_Cell::setValueBinder( new PHPExcel_Cell_AdvancedValueBinder() );;
      $this->Xls_dados = new PHPExcel();
      $this->Xls_dados->setActiveSheetIndex(0);
      $this->Nm_ActiveSheet = $this->Xls_dados->getActiveSheet();
      if ($_SESSION['scriptcase']['reg_conf']['css_dir'] == "RTL")
      {
          $this->Nm_ActiveSheet->setRightToLeft(true);
      }
   }

   //----- 
   function grava_arquivo()
   {
      global $nm_lang;
      global
             $nm_nada, $nm_lang;

      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->sc_proc_grid = false; 
      $nm_raiz_img  = ""; 
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['reports_admin']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['reports_admin']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['reports_admin']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['reports_admin']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['reports_admin']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['reports_admin']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['reports_admin']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['reports_admin']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['reports_admin']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
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
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['reports_admin']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['reports_admin']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['reports_admin']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['reports_admin']['xls_name']))
      {
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['reports_admin']['xls_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['reports_admin']['xls_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['reports_admin']['xls_name']);
          $this->Xls_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nmgp_select = "SELECT dc.nombre_clie as dc_nombre_clie, dc.num_documento as dc_num_documento, dc.email_clie as dc_email_clie, ds.suscripcion as ds_suscripcion, str_replace (convert(char(10),ds.fecha_venta,102), '.', '-') + ' ' + convert(char(8),ds.fecha_venta,20) as ds_fecha_venta, drs.direccion as drs_direccion, u.names as u_names, u.surnames as u_surnames, u.canal as u_canal, str_replace (convert(char(10),ds.fecha_autoriza,102), '.', '-') + ' ' + convert(char(8),ds.fecha_autoriza,20) as ds_fecha_autoriza, str_replace (convert(char(10),dc.fecha_registro,102), '.', '-') + ' ' + convert(char(8),dc.fecha_registro,20) as dc_fecha_registro, dc.tipo_cliente as dc_tipo_cliente, dc.medio_contact as dc_medio_contact, dc.tel_casa as dc_tel_casa, dc.celular_clie as dc_celular_clie from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT dc.nombre_clie as dc_nombre_clie, dc.num_documento as dc_num_documento, dc.email_clie as dc_email_clie, ds.suscripcion as ds_suscripcion, ds.fecha_venta as ds_fecha_venta, drs.direccion as drs_direccion, u.names as u_names, u.surnames as u_surnames, u.canal as u_canal, ds.fecha_autoriza as ds_fecha_autoriza, dc.fecha_registro as dc_fecha_registro, dc.tipo_cliente as dc_tipo_cliente, dc.medio_contact as dc_medio_contact, dc.tel_casa as dc_tel_casa, dc.celular_clie as dc_celular_clie from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT dc.nombre_clie as dc_nombre_clie, dc.num_documento as dc_num_documento, dc.email_clie as dc_email_clie, ds.suscripcion as ds_suscripcion, convert(char(23),ds.fecha_venta,121) as ds_fecha_venta, drs.direccion as drs_direccion, u.names as u_names, u.surnames as u_surnames, u.canal as u_canal, convert(char(23),ds.fecha_autoriza,121) as ds_fecha_autoriza, convert(char(23),dc.fecha_registro,121) as dc_fecha_registro, dc.tipo_cliente as dc_tipo_cliente, dc.medio_contact as dc_medio_contact, dc.tel_casa as dc_tel_casa, dc.celular_clie as dc_celular_clie from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT dc.nombre_clie as dc_nombre_clie, dc.num_documento as dc_num_documento, dc.email_clie as dc_email_clie, ds.suscripcion as ds_suscripcion, ds.fecha_venta as ds_fecha_venta, drs.direccion as drs_direccion, u.names as u_names, u.surnames as u_surnames, u.canal as u_canal, ds.fecha_autoriza as ds_fecha_autoriza, dc.fecha_registro as dc_fecha_registro, dc.tipo_cliente as dc_tipo_cliente, dc.medio_contact as dc_medio_contact, dc.tel_casa as dc_tel_casa, dc.celular_clie as dc_celular_clie from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT dc.nombre_clie as dc_nombre_clie, dc.num_documento as dc_num_documento, dc.email_clie as dc_email_clie, ds.suscripcion as ds_suscripcion, EXTEND(ds.fecha_venta, YEAR TO DAY) as ds_fecha_venta, drs.direccion as drs_direccion, u.names as u_names, u.surnames as u_surnames, u.canal as u_canal, EXTEND(ds.fecha_autoriza, YEAR TO DAY) as ds_fecha_autoriza, EXTEND(dc.fecha_registro, YEAR TO FRACTION) as dc_fecha_registro, dc.tipo_cliente as dc_tipo_cliente, dc.medio_contact as dc_medio_contact, dc.tel_casa as dc_tel_casa, dc.celular_clie as dc_celular_clie from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT dc.nombre_clie as dc_nombre_clie, dc.num_documento as dc_num_documento, dc.email_clie as dc_email_clie, ds.suscripcion as ds_suscripcion, ds.fecha_venta as ds_fecha_venta, drs.direccion as drs_direccion, u.names as u_names, u.surnames as u_surnames, u.canal as u_canal, ds.fecha_autoriza as ds_fecha_autoriza, dc.fecha_registro as dc_fecha_registro, dc.tipo_cliente as dc_tipo_cliente, dc.medio_contact as dc_medio_contact, dc.tel_casa as dc_tel_casa, dc.celular_clie as dc_celular_clie from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['reports_admin']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['reports_admin']['order_grid'];
      $nmgp_select .= $nmgp_order_by; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select;
      $rs = $this->Db->Execute($nmgp_select);
      if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1)
      {
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
         exit;
      }

      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['reports_admin']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['dc_nombre_clie'])) ? $this->New_label['dc_nombre_clie'] : "Nombre del cliente"; 
          if ($Cada_col == "dc_nombre_clie" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['dc_num_documento'])) ? $this->New_label['dc_num_documento'] : "Documento del cliente"; 
          if ($Cada_col == "dc_num_documento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['dc_email_clie'])) ? $this->New_label['dc_email_clie'] : "Correo del cliente"; 
          if ($Cada_col == "dc_email_clie" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['ds_suscripcion'])) ? $this->New_label['ds_suscripcion'] : "Suscripcion"; 
          if ($Cada_col == "ds_suscripcion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['ds_fecha_venta'])) ? $this->New_label['ds_fecha_venta'] : "Fecha de Venta"; 
          if ($Cada_col == "ds_fecha_venta" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['drs_direccion'])) ? $this->New_label['drs_direccion'] : "Direccion"; 
          if ($Cada_col == "drs_direccion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['u_names'])) ? $this->New_label['u_names'] : "Nombre del asesor"; 
          if ($Cada_col == "u_names" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['u_surnames'])) ? $this->New_label['u_surnames'] : "Apellido del asesor"; 
          if ($Cada_col == "u_surnames" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['u_canal'])) ? $this->New_label['u_canal'] : "Canal"; 
          if ($Cada_col == "u_canal" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['ds_fecha_autoriza'])) ? $this->New_label['ds_fecha_autoriza'] : "Fecha Autoriza"; 
          if ($Cada_col == "ds_fecha_autoriza" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['dc_fecha_registro'])) ? $this->New_label['dc_fecha_registro'] : "Fecha Registro"; 
          if ($Cada_col == "dc_fecha_registro" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['dc_tipo_cliente'])) ? $this->New_label['dc_tipo_cliente'] : "Tipo Cliente"; 
          if ($Cada_col == "dc_tipo_cliente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['dc_medio_contact'])) ? $this->New_label['dc_medio_contact'] : "Medio Contact"; 
          if ($Cada_col == "dc_medio_contact" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['dc_tel_casa'])) ? $this->New_label['dc_tel_casa'] : "Tel Casa"; 
          if ($Cada_col == "dc_tel_casa" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['dc_celular_clie'])) ? $this->New_label['dc_celular_clie'] : "Celular Clie"; 
          if ($Cada_col == "dc_celular_clie" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
      } 
      while (!$rs->EOF)
      {
         $this->Xls_col = 0;
         $this->Xls_row++;
         $this->dc_nombre_clie = $rs->fields[0] ;  
         $this->dc_num_documento = $rs->fields[1] ;  
         $this->dc_email_clie = $rs->fields[2] ;  
         $this->ds_suscripcion = $rs->fields[3] ;  
         $this->ds_fecha_venta = $rs->fields[4] ;  
         $this->drs_direccion = $rs->fields[5] ;  
         $this->u_names = $rs->fields[6] ;  
         $this->u_surnames = $rs->fields[7] ;  
         $this->u_canal = $rs->fields[8] ;  
         $this->ds_fecha_autoriza = $rs->fields[9] ;  
         $this->dc_fecha_registro = $rs->fields[10] ;  
         $this->dc_tipo_cliente = $rs->fields[11] ;  
         $this->dc_medio_contact = $rs->fields[12] ;  
         $this->dc_tel_casa = $rs->fields[13] ;  
         $this->dc_celular_clie = $rs->fields[14] ;  
         $this->dc_celular_clie = (string)$this->dc_celular_clie;
         $this->sc_proc_grid = true; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['reports_admin']['field_order'] as $Cada_col)
         { 
            if (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off")
            { 
                $NM_func_exp = "NM_export_" . $Cada_col;
                $this->$NM_func_exp();
            } 
         } 
         if (isset($this->NM_Row_din[$this->Xls_row]))
         { 
             $this->Nm_ActiveSheet->getRowDimension($this->Xls_row)->setRowHeight($this->NM_Row_din[$this->Xls_row]);
         } 
         $rs->MoveNext();
      }
      if (isset($this->NM_Col_din))
      { 
          foreach ($this->NM_Col_din as $col => $width)
          { 
              $this->Nm_ActiveSheet->getColumnDimension($col)->setWidth($width / 5);
          } 
      } 
      $rs->Close();
      $objWriter = new PHPExcel_Writer_Excel5($this->Xls_dados);
      $objWriter->save($this->Xls_f);
   }
   //----- dc_nombre_clie
   function NM_export_dc_nombre_clie()
   {
         $this->dc_nombre_clie = html_entity_decode($this->dc_nombre_clie, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->dc_nombre_clie = strip_tags($this->dc_nombre_clie);
         if (!NM_is_utf8($this->dc_nombre_clie))
         {
             $this->dc_nombre_clie = sc_convert_encoding($this->dc_nombre_clie, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->dc_nombre_clie, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- dc_num_documento
   function NM_export_dc_num_documento()
   {
         $this->dc_num_documento = html_entity_decode($this->dc_num_documento, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->dc_num_documento = strip_tags($this->dc_num_documento);
         if (!NM_is_utf8($this->dc_num_documento))
         {
             $this->dc_num_documento = sc_convert_encoding($this->dc_num_documento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->dc_num_documento, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- dc_email_clie
   function NM_export_dc_email_clie()
   {
         $this->dc_email_clie = html_entity_decode($this->dc_email_clie, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->dc_email_clie = strip_tags($this->dc_email_clie);
         if (!NM_is_utf8($this->dc_email_clie))
         {
             $this->dc_email_clie = sc_convert_encoding($this->dc_email_clie, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->dc_email_clie, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- ds_suscripcion
   function NM_export_ds_suscripcion()
   {
         $this->ds_suscripcion = html_entity_decode($this->ds_suscripcion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->ds_suscripcion = strip_tags($this->ds_suscripcion);
         if (!NM_is_utf8($this->ds_suscripcion))
         {
             $this->ds_suscripcion = sc_convert_encoding($this->ds_suscripcion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->ds_suscripcion, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- ds_fecha_venta
   function NM_export_ds_fecha_venta()
   {
         $this->ds_fecha_venta = substr($this->ds_fecha_venta, 0, 10);
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         if (empty($this->ds_fecha_venta) || $this->ds_fecha_venta == "0000-00-00")
         {
             $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->ds_fecha_venta, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         else
         {
             $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->ds_fecha_venta);
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode($this->SC_date_conf_region);
         }
         $this->Xls_col++;
   }
   //----- drs_direccion
   function NM_export_drs_direccion()
   {
         $this->drs_direccion = html_entity_decode($this->drs_direccion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->drs_direccion = strip_tags($this->drs_direccion);
         if (!NM_is_utf8($this->drs_direccion))
         {
             $this->drs_direccion = sc_convert_encoding($this->drs_direccion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->drs_direccion, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- u_names
   function NM_export_u_names()
   {
         $this->u_names = html_entity_decode($this->u_names, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->u_names = strip_tags($this->u_names);
         if (!NM_is_utf8($this->u_names))
         {
             $this->u_names = sc_convert_encoding($this->u_names, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->u_names, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- u_surnames
   function NM_export_u_surnames()
   {
         $this->u_surnames = html_entity_decode($this->u_surnames, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->u_surnames = strip_tags($this->u_surnames);
         if (!NM_is_utf8($this->u_surnames))
         {
             $this->u_surnames = sc_convert_encoding($this->u_surnames, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->u_surnames, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- u_canal
   function NM_export_u_canal()
   {
         $this->u_canal = html_entity_decode($this->u_canal, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->u_canal = strip_tags($this->u_canal);
         if (!NM_is_utf8($this->u_canal))
         {
             $this->u_canal = sc_convert_encoding($this->u_canal, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->u_canal, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- ds_fecha_autoriza
   function NM_export_ds_fecha_autoriza()
   {
         $this->ds_fecha_autoriza = substr($this->ds_fecha_autoriza, 0, 10);
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         if (empty($this->ds_fecha_autoriza) || $this->ds_fecha_autoriza == "0000-00-00")
         {
             $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->ds_fecha_autoriza, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         else
         {
             $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->ds_fecha_autoriza);
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode($this->SC_date_conf_region);
         }
         $this->Xls_col++;
   }
   //----- dc_fecha_registro
   function NM_export_dc_fecha_registro()
   {
      if (!empty($this->dc_fecha_registro))
      {
         if (substr($this->dc_fecha_registro, 10, 1) == "-") 
         { 
             $this->dc_fecha_registro = substr($this->dc_fecha_registro, 0, 10) . " " . substr($this->dc_fecha_registro, 11);
         } 
         if (substr($this->dc_fecha_registro, 13, 1) == ".") 
         { 
            $this->dc_fecha_registro = substr($this->dc_fecha_registro, 0, 13) . ":" . substr($this->dc_fecha_registro, 14, 2) . ":" . substr($this->dc_fecha_registro, 17);
         } 
         $conteudo_x = $this->dc_fecha_registro;
         nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD HH:II:SS");
         if (is_numeric($conteudo_x) && $conteudo_x > 0) 
         { 
             $this->nm_data->SetaData($this->dc_fecha_registro, "YYYY-MM-DD HH:II:SS");
             $this->dc_fecha_registro = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "ddmmaaaa;hhiiss"));
         } 
      }
         if (!NM_is_utf8($this->dc_fecha_registro))
         {
             $this->dc_fecha_registro = sc_convert_encoding($this->dc_fecha_registro, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->dc_fecha_registro, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- dc_tipo_cliente
   function NM_export_dc_tipo_cliente()
   {
         $this->dc_tipo_cliente = html_entity_decode($this->dc_tipo_cliente, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->dc_tipo_cliente = strip_tags($this->dc_tipo_cliente);
         if (!NM_is_utf8($this->dc_tipo_cliente))
         {
             $this->dc_tipo_cliente = sc_convert_encoding($this->dc_tipo_cliente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->dc_tipo_cliente, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- dc_medio_contact
   function NM_export_dc_medio_contact()
   {
         $this->dc_medio_contact = html_entity_decode($this->dc_medio_contact, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->dc_medio_contact = strip_tags($this->dc_medio_contact);
         if (!NM_is_utf8($this->dc_medio_contact))
         {
             $this->dc_medio_contact = sc_convert_encoding($this->dc_medio_contact, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->dc_medio_contact, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- dc_tel_casa
   function NM_export_dc_tel_casa()
   {
         $this->dc_tel_casa = html_entity_decode($this->dc_tel_casa, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->dc_tel_casa = strip_tags($this->dc_tel_casa);
         if (!NM_is_utf8($this->dc_tel_casa))
         {
             $this->dc_tel_casa = sc_convert_encoding($this->dc_tel_casa, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->dc_tel_casa, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- dc_celular_clie
   function NM_export_dc_celular_clie()
   {
         if (!NM_is_utf8($this->dc_celular_clie))
         {
             $this->dc_celular_clie = sc_convert_encoding($this->dc_celular_clie, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->dc_celular_clie))
         {
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->dc_celular_clie);
         $this->Xls_col++;
   }

   function calc_cell($col)
   {
       $arr_alfa = array("","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
       $val_ret = "";
       $result = $col + 1;
       while ($result > 26)
       {
           $cel      = $result % 26;
           $result   = $result / 26;
           if ($cel == 0)
           {
               $cel    = 26;
               $result--;
           }
           $val_ret = $arr_alfa[$cel] . $val_ret;
       }
       $val_ret = $arr_alfa[$result] . $val_ret;
       return $val_ret;
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
   //---- 
   function monta_html()
   {
      global $nm_url_saida, $nm_lang;
      include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['reports_admin']['xls_file']);
      if (is_file($this->Xls_f))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['reports_admin']['xls_file'] = $this->Xls_f;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['reports_admin'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['reports_admin'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_grid_titl'] ?> -  :: Excel</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
{
?>
  <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<?php
}
?>
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
 <META http-equiv="Pragma" content="no-cache"/>
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export.css" /> 
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
  <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $this->Ini->Str_btn_css ?>" /> 
</HEAD>
<BODY class="scExportPage">
<?php echo $this->Ini->Ajax_result_set ?>
<table style="border-collapse: collapse; border-width: 0; height: 100%; width: 100%"><tr><td style="padding: 0; text-align: center; vertical-align: middle">
 <table class="scExportTable" align="center">
  <tr>
   <td class="scExportTitle" style="height: 25px">XLS</td>
  </tr>
  <tr>
   <td class="scExportLine" style="width: 100%">
    <table style="border-collapse: collapse; border-width: 0; width: 100%"><tr><td class="scExportLineFont" style="padding: 3px 0 0 0" id="idMessage">
    <?php echo $this->Ini->Nm_lang['lang_othr_file_msge'] ?>
    </td><td class="scExportLineFont" style="text-align:right; padding: 3px 0 0 0">
     <?php echo nmButtonOutput($this->arr_buttons, "bexportview", "document.Fview.submit()", "document.Fview.submit()", "idBtnView", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
 ?>
     <?php echo nmButtonOutput($this->arr_buttons, "bdownload", "document.Fdown.submit()", "document.Fdown.submit()", "idBtnDown", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
 ?>
     <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F0.submit()", "document.F0.submit()", "idBtnBack", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
 ?>
    </td></tr></table>
   </td>
  </tr>
 </table>
</td></tr></table>
<form name="Fview" method="get" action="<?php echo $this->Ini->path_imag_temp . "/" . $this->Arquivo ?>" target="_blank" style="display: none"> 
</form>
<form name="Fdown" method="get" action="reports_admin_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="reports_admin"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="script_case_session" value="<?php echo NM_encode_input(session_id()); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="volta_grid"> 
</FORM> 
</BODY>
</HTML>
<?php
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
}

?>
