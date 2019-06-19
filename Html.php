<?php

namespace \20veinte\Html;

class Html{

  //var $html;

  public function __construct($args = []){
    //$this->html = key_val('html', $args);
  }

  //FUNCTION TO GET HTML TABLE
  public function table($table){
  	$html = '';
  	if(is_array($table)){
  		//FIX ADD BLANK SPACE IF NOT EXISTS
  		$max_array = array();
  		foreach($table as $ktype => $arrt){
        if(!empty($arrt) && is_array($arrt)){
      		foreach($arrt as $kt => $vt){
      			$tot = count($vt);
      			if(!is_numeric($kt))$tot = $tot-1;
      			$max_array[$tot] = $tot;
      		}
        }
  		}

  		krsort($max_array); $max = key($max_array);
  		foreach($table as $ktype => $arrt){
        if(!empty($arrt) && is_array($arrt)){
          foreach($arrt as $key => $vt){
  					$t = count($vt);
  					if(!is_numeric($key))$t = $t-1;
  					if($t < $max){
  						$size = $max - $t;
  						for($i = $t; $i < $max; ++$i){
  							$table[$ktype][$key][] = '';
  						}
  					}
          }
  			}
  		}
      //FIX ADD BLANK SPACE IF NOT EXISTS

  		$html_table = $head = '';
  		foreach($table as $type => $arr){
  			if($type == 'th')$head = '<thead role="row" class="even">';
  			if($type == 'td')$head = '<tbody>';
  			if(!is_array($head))$html_table .= $head;
          if(!empty($arr) && is_array($arr)){
            $no_line = 0;
      			foreach($arr as $row => $arr_row){
      				if(!empty($arr_row)){

      					if(is_array($arr_row) && !empty($arr_row)){
                  if($no_line % 2 == 0)$class_row = "role='row' class='even'";
                  else $class_row = "role='row' class='odd'";

      						$html_table .= "<tr $class_row>";
      						foreach($arr_row as $no => $data_row){
                    $d_value = $this->key_val('value', $data_row);
                    $style_td = $this->args($this->key_val('args', $data_row));
                    $html_table .= "<{$type} {$style_td}>$d_value</{$type}>";
      						}
      						$html_table .= '</tr>';
      					}
      				}
              ++$no_line;
      			}
          }
  			if($type = 'th')$head = '</thead>';
  			if($type = 'td')$head = '</tbody>';
  			$html_table .= $head;
  		}
  		$table = $html_table;
  	}
    return "<table>$table</table>";
  }

  //FUNCTION TO GET HTML ALERT
  public function alert($message = '', $type = ''){
    return '';
  }

  //FUNCTION TO GET ROW / GRID BOOSTRAP
  public function grid($array){
    $return = '<div class="row">';
  	if(!empty($array)){
  		foreach($array as $k => $row){
        $style = '';
        $html = $this->key_val('html', $row);
        $col = $this->key_val('col', $row, 12);
        $col_sm = $this->key_val('sm', $row, $col);
        $col_md = $this->key_val('md', $row, $col);
        $col_lg = $this->key_val('lg', $row, $col);
        $col_xl = $this->key_val('xl', $row, $col);
        $html_args = $this->args($this->key_val('args', $row));
        $return .= "<div class='col-sm-{$col_sm} col-md-{$col_md} col-lg-{$col_lg} col-xl-{$col_xl} col-{$col} $class' {$html_args}>{$html}</div>";
  		}
  	}
    $return .= '</div>';
    return $return;
  }

  //FUNCTION REDIRECT HTML
  public function meta($url, $time = 0){
  	return "<script>setTimeout(function(){window.location = '{$url}';}, {$time}*1000);</script>";
  }

  //FUNCTION TO GET ICON
  public function icon($name, $prefix = 'fas fa-'){
    return "<i class='{$prefix}{$name}'></i>";
  }

  //FUNCTION TO GET HTML BUTTON
  public function button($title, $args = []){
    $icon = $this->key_val('icon', $args);
    if($icon != ''){
      $icon = $this->icon($icon);
      unset($args['icon']);
    }
    $html_args = $this->args($args);
    return "<button {$html_args}>{$icon} $title</button>";
  }

  //FUNCTION TO GET INPUT
  public function input($args = []){
    $html_args = $this->args($args);
    return "<input {$html_args} />";
  }

  //FUNCTION TO GET TEXTAREA
  public function textarea($value, $args = []){
    $html_args = $this->args($args);
    return "<textarea {$html_args}>{$value}</textarea>";
  }

  //FUNCTION TO GET FORM
  public function form($html, $args = []){
    $html_args = $this->args($args);
    return "<form {$html_args}>$html</form>";
  }

  //FUNCTION TO GET BR
  public function br($no = ''){
    $html = '';
    if(is_numeric($no) && $no > 0)for($i = 0; $i <= $no; ++$i)$html .= '<br>';
    else $html .= '<br>';
    return $html;
  }

  //FUNCTION TO GET HR
  public function hr($no = ''){
    $html = '';
    if(is_numeric($no) && $no > 0)for($i = 0; $i <= $no; ++$i)$html .= '<hr>';
    else $html .= '<hr>';
    return $html;
  }

  //FUNCTION TO GET HEADINGS
  public function heading($number, $text, $args = []){
    $html_args = $this->args($args);
    return "<h{$number} {$html_args}>{$text}</h{$number}>";
  }

  //FUNCTION TO GET BOLD
  public function bold($string, $align = ''){
    if(!is_array($string)){
      return "<b>{$string}</b>";
    }
  }

  //FUNCTION TO GET SELECTL
  public function select($options, $args = []){
    $html_args = $this->args($args);
    $html = "<select {$html_args}>";
    $html .= "<option value='' selected></option>";
    if(!empty($options) && is_array($options)){
      foreach($options as $k => $v){
        if(is_array($v)){
           $html .= "<optgroup label='{$k}'>";
           foreach($v as $kk => $vv){
              if($value != '' && $kk == $value)$selk = 'selected'; else $selk = '';
              $val = trim($vv);
              if(!is_array($val) && $val != ''){
                if($number)$html .= "<option value='$kk' $selk>$kk - $val</option>";
                else $html .= "<option value='$kk' $selk>$val</option>";
              }
           }
        }else{
          if($v != ''){
            if($value != '' && $k == $value)$sel = 'selected'; else $sel = '';
            if($decode)$val = utf8_decode($v);
            else $val = utf8_encode($v);
            $val = trim($v);

             if($number)$html .= "<option value='$k' $sel>$k - $val</option>";
             else $html .= "<option value='$k' $sel>$val</option>";
          }
        }
      }
    }
    $html .= '</select>';
    return $html;
  }

  //FUNCTION TO GET HTML AS CURRENCY
  public function currency($number, $decimal = 2){
  	if(!is_numeric($number))$number = 0;
    if(!is_numeric($decimal))$decimal = 2;
  	return '$'.number_format($number, $decimal);
  }

  //FUNCTION TO PRINT OR SHOW ARRAY AS CLEANEST POSSIBLE
  public function ia($array){
    if(is_array($array))return '<pre>'.print_r($array).'</pre>';
    else return $array;
  }
  
  //FUNCTION TO COMPRESS HTML
  public function html($html, $echo = TRUE){
  	$html = str_replace('> <','><',preg_replace('/\s+/', ' ', $html));
  	$html = str_replace(' >', '>', $html);
  	$html = str_replace(' />', '/>', $html);
  	if($echo)echo $html;
    else return $html;
  }

  FUNCTION TO GET ARRAY ARGS TO HTML TAG
  private function args($args){
    $html = '';
    if(is_array($args) && !empty($args)){
      foreach($args as $k => $v){
        if($k != '')$html .= " {$k}='{$v}'";
      }
    }
    return $html;
  }

  FUNCTION TO CHECK IS ELEMENT IS IN ARRAY
  public function key_val($key, $array, $default = ''){
    return array_key_exists($key, $array) ? $array[$key] : $default;
  }

  FUNCTION TO SEND CURL
  public function send($args = []){
    $response = '';
    $url = $this->key_val('url', $args);
    $data = $this->key_val('data', $args);
    $credentials = $this->key_val('credentials', $args);
    $timeout = $this->key_val('timeout', $args, 60);
  	if($url != ''){
  		$ch = curl_init($url);
  		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  		curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
  		curl_setopt($ch, CURLOPT_POST, TRUE);
  		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

      //DATA
  		if(!empty($data)){
  			curl_setopt($ch,CURLOPT_FOLLOWLOCATION, TRUE);
  			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
  			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data, '', '&'));
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
      }

      //TIMEOUT
  		if($timeout != ''){
  			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
  		}

      //BASIC AUTH
  		if(isset($credentials['user']) && isset($credentials['pass'])){
  			curl_setopt($ch, CURLOPT_USERPWD, "{$credentials['user']}:{$credentials['pass']}");
  		}

      //RESPONSE
      $response = curl_exec($ch);
  	  if(curl_errno($ch)){
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $response = "CURL ({$code}):".curl_error($ch);
      }
  	  curl_close($ch);
  	}
  	return $response;
  }
}
