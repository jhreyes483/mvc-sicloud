<?php

class grid_sicloud_rtf
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $nm_data;
   var $Texto_tag;
   var $Arquivo;
   var $Tit_doc;
   var $sc_proc_grid; 
   var $NM_cmp_hidden = array();

   //---- 
   function grid_sicloud_rtf()
   {
      $this->nm_data   = new nm_data("es");
      $this->Texto_tag = "";
   }

   //---- 
   function monta_rtf()
   {
      $this->inicializa_vars();
      $this->gera_texto_tag();
      $this->grava_arquivo_rtf();
      $this->monta_html();
   }

   //----- 
   function inicializa_vars()
   {
      global $nm_lang;
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $this->Arquivo    = "sc_rtf";
      $this->Arquivo   .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arquivo   .= "_grid_sicloud";
      $this->Arquivo   .= ".rtf";
      $this->Tit_doc    = "grid_sicloud.rtf";
   }

   //----- 
   function gera_texto_tag()
   {
     global $nm_lang;
      global
             $nm_nada, $nm_lang;

      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->sc_proc_grid = false; 
      $nm_raiz_img  = ""; 
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_sicloud']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_sicloud']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_sicloud']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_sicloud']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_sicloud']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_sicloud']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_sicloud']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_sicloud']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_sicloud']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_sicloud']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_sicloud']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_sicloud']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->p_nom_prod = $Busca_temp['p_nom_prod']; 
          $tmp_pos = strpos($this->p_nom_prod, "##@@");
          if ($tmp_pos !== false)
          {
              $this->p_nom_prod = substr($this->p_nom_prod, 0, $tmp_pos);
          }
          $this->u_id_us = $Busca_temp['u_id_us']; 
          $tmp_pos = strpos($this->u_id_us, "##@@");
          if ($tmp_pos !== false)
          {
              $this->u_id_us = substr($this->u_id_us, 0, $tmp_pos);
          }
          $this->u_nom1 = $Busca_temp['u_nom1']; 
          $tmp_pos = strpos($this->u_nom1, "##@@");
          if ($tmp_pos !== false)
          {
              $this->u_nom1 = substr($this->u_nom1, 0, $tmp_pos);
          }
          $this->u_ape1 = $Busca_temp['u_ape1']; 
          $tmp_pos = strpos($this->u_ape1, "##@@");
          if ($tmp_pos !== false)
          {
              $this->u_ape1 = substr($this->u_ape1, 0, $tmp_pos);
          }
      } 
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_sicloud']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_sicloud']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_sicloud']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_sicloud']['rtf_name']))
      {
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_sicloud']['rtf_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_sicloud']['rtf_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_sicloud']['rtf_name']);
      }
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nmgp_select = "SELECT u.ID_us as u_id_us, u.nom1 as u_nom1, u.ape1 as u_ape1, p.nom_prod as p_nom_prod, str_replace (convert(char(10),f.fecha,102), '.', '-') + ' ' + convert(char(8),f.fecha,20) as f_fecha, tp.nom_tipo_pago as tp_nom_tipo_pago, f.total as f_total from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT u.ID_us as u_id_us, u.nom1 as u_nom1, u.ape1 as u_ape1, p.nom_prod as p_nom_prod, f.fecha as f_fecha, tp.nom_tipo_pago as tp_nom_tipo_pago, f.total as f_total from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT u.ID_us as u_id_us, u.nom1 as u_nom1, u.ape1 as u_ape1, p.nom_prod as p_nom_prod, convert(char(23),f.fecha,121) as f_fecha, tp.nom_tipo_pago as tp_nom_tipo_pago, f.total as f_total from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT u.ID_us as u_id_us, u.nom1 as u_nom1, u.ape1 as u_ape1, p.nom_prod as p_nom_prod, f.fecha as f_fecha, tp.nom_tipo_pago as tp_nom_tipo_pago, f.total as f_total from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT u.ID_us as u_id_us, u.nom1 as u_nom1, u.ape1 as u_ape1, p.nom_prod as p_nom_prod, EXTEND(f.fecha, YEAR TO DAY) as f_fecha, tp.nom_tipo_pago as tp_nom_tipo_pago, f.total as f_total from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT u.ID_us as u_id_us, u.nom1 as u_nom1, u.ape1 as u_ape1, p.nom_prod as p_nom_prod, f.fecha as f_fecha, tp.nom_tipo_pago as tp_nom_tipo_pago, f.total as f_total from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_sicloud']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_sicloud']['order_grid'];
      $nmgp_select .= $nmgp_order_by; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select;
      $rs = $this->Db->Execute($nmgp_select);
      if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1)
      {
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
         exit;
      }

      $this->Texto_tag .= "<table>\r\n";
      $this->Texto_tag .= "<tr>\r\n";
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_sicloud']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['u_id_us'])) ? $this->New_label['u_id_us'] : "ID Us"; 
          if ($Cada_col == "u_id_us" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['u_nom1'])) ? $this->New_label['u_nom1'] : "Nom 1"; 
          if ($Cada_col == "u_nom1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['u_ape1'])) ? $this->New_label['u_ape1'] : "Ape 1"; 
          if ($Cada_col == "u_ape1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['p_nom_prod'])) ? $this->New_label['p_nom_prod'] : "Nom Prod"; 
          if ($Cada_col == "p_nom_prod" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['f_fecha'])) ? $this->New_label['f_fecha'] : "Fecha"; 
          if ($Cada_col == "f_fecha" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['tp_nom_tipo_pago'])) ? $this->New_label['tp_nom_tipo_pago'] : "Nom Tipo Pago"; 
          if ($Cada_col == "tp_nom_tipo_pago" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['f_total'])) ? $this->New_label['f_total'] : "Total"; 
          if ($Cada_col == "f_total" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
      } 
      $this->Texto_tag .= "</tr>\r\n";
      while (!$rs->EOF)
      {
         $this->Texto_tag .= "<tr>\r\n";
         $this->u_id_us = $rs->fields[0] ;  
         $this->u_nom1 = $rs->fields[1] ;  
         $this->u_ape1 = $rs->fields[2] ;  
         $this->p_nom_prod = $rs->fields[3] ;  
         $this->f_fecha = $rs->fields[4] ;  
         $this->tp_nom_tipo_pago = $rs->fields[5] ;  
         $this->f_total = $rs->fields[6] ;  
         $this->f_total = (string)$this->f_total;
         $this->sc_proc_grid = true; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_sicloud']['field_order'] as $Cada_col)
         { 
            if (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off")
            { 
                $NM_func_exp = "NM_export_" . $Cada_col;
                $this->$NM_func_exp();
            } 
         } 
         $this->Texto_tag .= "</tr>\r\n";
         $rs->MoveNext();
      }
      $this->Texto_tag .= "</table>\r\n";

      $rs->Close();
   }
   //----- u_id_us
   function NM_export_u_id_us()
   {
         $this->u_id_us = html_entity_decode($this->u_id_us, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->u_id_us = strip_tags($this->u_id_us);
         if (!NM_is_utf8($this->u_id_us))
         {
             $this->u_id_us = sc_convert_encoding($this->u_id_us, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->u_id_us = str_replace('<', '&lt;', $this->u_id_us);
         $this->u_id_us = str_replace('>', '&gt;', $this->u_id_us);
         $this->Texto_tag .= "<td>" . $this->u_id_us . "</td>\r\n";
   }
   //----- u_nom1
   function NM_export_u_nom1()
   {
         $this->u_nom1 = html_entity_decode($this->u_nom1, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->u_nom1 = strip_tags($this->u_nom1);
         if (!NM_is_utf8($this->u_nom1))
         {
             $this->u_nom1 = sc_convert_encoding($this->u_nom1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->u_nom1 = str_replace('<', '&lt;', $this->u_nom1);
         $this->u_nom1 = str_replace('>', '&gt;', $this->u_nom1);
         $this->Texto_tag .= "<td>" . $this->u_nom1 . "</td>\r\n";
   }
   //----- u_ape1
   function NM_export_u_ape1()
   {
         $this->u_ape1 = html_entity_decode($this->u_ape1, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->u_ape1 = strip_tags($this->u_ape1);
         if (!NM_is_utf8($this->u_ape1))
         {
             $this->u_ape1 = sc_convert_encoding($this->u_ape1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->u_ape1 = str_replace('<', '&lt;', $this->u_ape1);
         $this->u_ape1 = str_replace('>', '&gt;', $this->u_ape1);
         $this->Texto_tag .= "<td>" . $this->u_ape1 . "</td>\r\n";
   }
   //----- p_nom_prod
   function NM_export_p_nom_prod()
   {
         $this->p_nom_prod = html_entity_decode($this->p_nom_prod, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->p_nom_prod = strip_tags($this->p_nom_prod);
         if (!NM_is_utf8($this->p_nom_prod))
         {
             $this->p_nom_prod = sc_convert_encoding($this->p_nom_prod, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->p_nom_prod = str_replace('<', '&lt;', $this->p_nom_prod);
         $this->p_nom_prod = str_replace('>', '&gt;', $this->p_nom_prod);
         $this->Texto_tag .= "<td>" . $this->p_nom_prod . "</td>\r\n";
   }
   //----- f_fecha
   function NM_export_f_fecha()
   {
         $conteudo_x = $this->f_fecha;
         nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
         if (is_numeric($conteudo_x) && $conteudo_x > 0) 
         { 
             $this->nm_data->SetaData($this->f_fecha, "YYYY-MM-DD");
             $this->f_fecha = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
         } 
         if (!NM_is_utf8($this->f_fecha))
         {
             $this->f_fecha = sc_convert_encoding($this->f_fecha, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->f_fecha = str_replace('<', '&lt;', $this->f_fecha);
         $this->f_fecha = str_replace('>', '&gt;', $this->f_fecha);
         $this->Texto_tag .= "<td>" . $this->f_fecha . "</td>\r\n";
   }
   //----- tp_nom_tipo_pago
   function NM_export_tp_nom_tipo_pago()
   {
         $this->tp_nom_tipo_pago = html_entity_decode($this->tp_nom_tipo_pago, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tp_nom_tipo_pago = strip_tags($this->tp_nom_tipo_pago);
         if (!NM_is_utf8($this->tp_nom_tipo_pago))
         {
             $this->tp_nom_tipo_pago = sc_convert_encoding($this->tp_nom_tipo_pago, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->tp_nom_tipo_pago = str_replace('<', '&lt;', $this->tp_nom_tipo_pago);
         $this->tp_nom_tipo_pago = str_replace('>', '&gt;', $this->tp_nom_tipo_pago);
         $this->Texto_tag .= "<td>" . $this->tp_nom_tipo_pago . "</td>\r\n";
   }
   //----- f_total
   function NM_export_f_total()
   {
         nmgp_Form_Num_Val($this->f_total, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if (!NM_is_utf8($this->f_total))
         {
             $this->f_total = sc_convert_encoding($this->f_total, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->f_total = str_replace('<', '&lt;', $this->f_total);
         $this->f_total = str_replace('>', '&gt;', $this->f_total);
         $this->Texto_tag .= "<td>" . $this->f_total . "</td>\r\n";
   }

   //----- 
   function grava_arquivo_rtf()
   {
      global $nm_lang, $doc_wrap;
      $rtf_f = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo, "w");
      require_once($this->Ini->path_third      . "/rtf_new/document_generator/cl_xml2driver.php"); 
      $text_ok  =  "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\r\n"; 
      $text_ok .=  "<DOC config_file=\"" . $this->Ini->path_third . "/rtf_new/doc_config.inc\" >\r\n"; 
      $text_ok .=  $this->Texto_tag; 
      $text_ok .=  "</DOC>\r\n"; 
      $xml = new nDOCGEN($text_ok,"RTF"); 
      fwrite($rtf_f, $xml->get_result_file());
      fclose($rtf_f);
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_sicloud']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_sicloud']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_sicloud'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_sicloud'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_grid_titl'] ?> -  :: RTF</TITLE>
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
   <td class="scExportTitle" style="height: 25px">RTF</td>
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
<form name="Fdown" method="get" action="grid_sicloud_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_sicloud"> 
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
