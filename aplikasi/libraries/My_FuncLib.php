<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class My_FuncLib {
var $ci;
	
	public function __construct() {
	//utk constructor ci library
		$this->ci = &get_instance();
	}
	
	public function autonum($prfx=false,$counter=0,$zeroled=0){
		$prefix = date($prfx);
		$runnum = str_pad($counter, $zeroled, '0', STR_PAD_LEFT);

		return $prefix.$runnum;
	}
	public function genTimestamp(){
		$date = new DateTime();
		return $date->getTimestamp();
	}

	public function microId(){
		$micro = explode(" ",microtime());
		return $micro[1].str_replace('0.','',substr($micro[0], 0, -2));
		//return $micro[1].str_replace('0.','',$micro[0]);
	}
	
	public function PassCrypt($var = false){	
		$result = hash('sha1',"W3rPi3".$var."4dm1N");
		return $result;
	}
	
	public function CleanLogin($var=FALSE){
		$Ilegal=array("'",'/',';','*','%','#','(',')','+','=');
		
		return stripslashes(strip_tags(str_replace($Ilegal,"",$var)));
	}
	
	public function CleanIns($var=FALSE){
		$Ilegal=array("'",'/');
		$correct = array("`",'');
		return stripslashes(strip_tags(str_replace($Ilegal,$correct,$var)));
	}
	public function HtmlIns($var=FALSE){
		$Ilegal=array("'");
		$correct = array("`",'');
		return stripslashes(str_replace($Ilegal,$correct,$var));
	}

	public function alldate($date=FALSE)
    {
        $bln = array ("13"=>'',"01"=>'January',"02"=>'February',"03"=>'March',"04"=>'April',"05"=>'May',"06"=>'June',"07"=>'July',"08"=>'August',"09"=>'September',"10"=>'October',"11"=>'November',"12"=>'December');
        //print_r($bln);
		$tempfirst = explode(' ', $date);
		
        $getdate = explode('-', $tempfirst[0]);
		$gettime= explode(':', $tempfirst[1]);
		
	        $bulan = date("m",strtotime($date));         
            $tgl = date("d",strtotime($date));
            $yr = date("Y",strtotime($date));
		$hour=$gettime[0]; $minute=$gettime[1];
           return $tgl." ".$bln[$bulan]." ".$yr.", ".$hour.":".$minute;
        
    }
	
	public function splitdate($date=FALSE)
    {
        $bln = array ("13"=>'',"01"=>'Jan',"02"=>'Feb',"03"=>'Mar',"04"=>'Apr',"05"=>'May',"06"=>'Jun',"07"=>'Jul',"08"=>'Aug',"09"=>'Sep',"10"=>'Oct',"11"=>'Nov',"12"=>'Dec');
        //print_r($bln);
		$tempfirst = explode(' ', $date);
		
        $getdate = explode('-', $tempfirst[0]);
		$gettime= explode(':', $tempfirst[1]);
		
	        $bulan = date("m",strtotime($date));         
            $tgl = date("d",strtotime($date));
            $yr = date("Y",strtotime($date));
		$hour=$gettime[0]; $minute=$gettime[1];
         return array("tgl"=>$tgl,"bln"=>$bln[$bulan],"m"=>$bulan,"thn"=>$yr,"jam"=>$hour,"menit"=>$minute);
        
    }
	    public function stringToUnixTime($var=FALSE)
    {
        $date = strtok($var, " ");
        $time = strtok(" ");
     
        // These are the actual codes for the PHP date format
        $d /* day     */ = strtok($date, "/");
        $m /* month   */ = strtok("/");
        $Y /* year    */ = strtok("/");
     
        $s /* seconds */ = strtok($time, "-");
        $i /* minutes */ = strtok("-");
        $h /* hours   */ = strtok("-");
       
        return mktime($h, $i, $s, $m, $d, $Y);
    } 
	
	public function strTags($var=FALSE) {
			$var=preg_replace ('/<[^>]*>/', '', $var);		
			//$count=strlen($var);
			//$strx=decodeAndStripHTML($var);
			$string=explode(" ", trim($var));
			$strx="";
			while (list(,$v) = each($string)):
				$strx .= preg_replace('/\s*/m', '',$v)." ";
			endwhile;
			
			return $strx;
	}
	
    public function conv($var=FALSE) {
		
		return isset($var) ? htmlspecialchars(stripslashes(trim($this->strURLrep($this->strCODErep($var))))) : "";
	}
	
	public function deconv($var){
		$result=str_replace(Chr(13), "",html_entity_decode($var));
		return $result;
	}
		
	public function str_fullname($var=FALSE) {
		$countvar=substr_count($var, " "); 
		$string=explode(" ", trim($var));
		$str="";
		for($i=0; $i<=$countvar; $i++):
				if($i == $countvar):
				$str .= ucfirst(strtolower($string[$i]));//end of $var
			else:
				$str .= ucfirst(strtolower($string[$i]))." ";
			endif;
				 //end of $var
		endfor;
		return $str; //$leng ." ..."
	}
	public function front_name($var=FALSE) {
		$string = explode(" ", trim($var));
		
		$str .= ucfirst(strtolower($string[0]));//end of $var
		return $str; //$leng ." ..."
	}
	public function str_upper($var=FALSE) {
		$countvar=substr_count($var, " "); 
		$string=explode(" ", trim($var));
		$str="";
		for($i=0; $i<=$countvar; $i++):
				if($i == $countvar):
				$str .= strtoupper($string[$i]);//end of $var
			else:
				$str .= strtoupper($string[$i])." ";
			endif;
				 //end of $var
		endfor;
		return $str; //$leng ." ..."
	}
	public function str_lower($var=FALSE) {
		$countvar=substr_count($var, " "); 
		$string=explode(" ", trim($var));
		$str="";
		for($i=0; $i<=$countvar; $i++):
				if($i == $countvar):
				$str .= strtolower($string[$i]);//end of $var
			else:
				$str .= strtolower($string[$i])." ";
			endif;
				 //end of $var
		endfor;
		return $str; //$leng ." ..."
	}
	
	public function strcut($var=FALSE, $len=FALSE) {
		$countvar=substr_count($this->decodeAndStripHTML($var), " "); 
		$leng=($countvar<$len)?$countvar:$len;
		$strx=$this->decodeAndStripHTML($var);
		$string=explode(" ", $strx);
		$str="";
		for($i=0; $i<=$leng; $i++):
			if($i == $leng):
				$str .= $string[$i]; //end of $var
			else:
				$str .= $string[$i]." ";
			endif;
		endfor;
		return ucwords($str); //$leng ." ..."
	}
	public function decodeAndStripHTML($string=FALSE){ 
   	 return strip_tags(htmlspecialchars_decode($string)); 
	}
	
	
    /******************************************************************************************************************************************************/
    public function datetime($var=FALSE)
    {
        return date("F, d Y H:i:s", strtotime($var));
    }
	public function dateformat($var=FALSE)
    {
        return date("d F Y", strtotime($var));
    }
	
		
	public function shortmonth($bulan=FALSE,$lang=FALSE){
		if($lang=='in'):
		 $bln = array ("13"=>'',"01"=>'Jan',"02"=>'Feb',"03"=>'Mar',"04"=>'Apr',"05"=>'Mei',"06"=>'Jun',"07"=>'Jul',"08"=>'Agu',"09"=>'Sep',"10"=>'Oktober',"11"=>'Nov',"12"=>'Des');
		 elseif($lang=='en'):
		  $bln = array ("1"=>'JAN',"2"=>'FEB',"3"=>'MAR',"4"=>'APR',"5"=>'MAY',"06"=>'JUN',"7"=>'JUL',"8"=>'AUG',"9"=>'SEP',"10"=>'OCT',"11"=>'NOV',"12"=>'DES');
		 endif;
		 
		return $bln[$bulan];
	}
	// ***************************************************************************/
	
 	public function engdate($date=FALSE)
		{
			$temp = explode('-', $date);
			if (!checkdate($temp[1], $temp[2], $temp[0])):
				echo '-';
			else:
				echo date("F d, Y", strtotime($date));
			endif;
		}
	public function msg_txt($var=false, $msg_type=false){
		if($msg_type=='hijau'){
			$alert = '<font style="color:#33CC00;">'.$var.'</font>';
		}
		if($msg_type=='biru'){
			$alert = '<font style="color:#0033CC;">'.$var.'</font>';
		}
		if($msg_type=='merah'){
			$alert = '<font style="color:#FF0000;">'.$var.'</font>';
		}
		return $alert;
		
	}	
	public function msg_html($msg_type=false, $var=false){		
		
			$template = '<div class="alert alert-'.$msg_type.' alert-dismissable">';
            $template .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
            $template .= $var;
			$template .= '</div>';
		
		$value = $this->ci->session->set_flashdata('notify_msg', $template);
		return $value;
	}
	public function dtPicker($output=false,$val=FALSE)
	{		
		
		$bulan = array ('Jan'=>"01",'Feb' =>"02",'Mar'=>"03",'Apr'=>"04",'May'=>"05",'Jun'=>"06",
						'Jul'=>"07",'Aug'=>"08",'Sept'=>"09",'Oct'=>"10",'Nov'=>"11",'Dec'=>"12");
			$bln = date("m",strtotime($val));         
            $tgl = date("d",strtotime($val));
            $yr = date("Y",strtotime($val));
			//echo $bulan." == ".$tgl." == ".$yr.'<br>';
			
			if($val=='0000-00-00' || $val == NULL ){
				$result_date='';
			}else{
				$format=$yr."-".$bln."-".$tgl;
				$result_date=date($output,strtotime($format));
			}
		 	return $result_date;
		
	 }
	
	public function convdate($date=FALSE)
    {  	
		//$cleanup = array('/','.'); 
		//$replace = str_replace($cleanup,'-',$date);    
		// $tempfirst = explode('-', $arrcek);
		 // return $tempfirst[2]."-".$tempfirst[0]."-".$tempfirst[1];
		 $reformat = date("Y-m-d", strtotime($date));
		 //date("Y-m-d", strtotime($date));
		 return $reformat;
    }

	public function insdate($date=FALSE)
    {  	
		 $arr_search = array('/' , '.' );
		 $replace 	 = '-';
		 $date = str_replace($arr_search, $replace, $date);
		 $reformat = date("Y-m-d", strtotime($date));
		 //date("Y-m-d", strtotime($date));
		 return $reformat;
    }

	public function gettime($date=FALSE)
    {
       
		$tempfirst = explode(' ', $date);
		
        $getdate = explode('-', $tempfirst[0]);
		$gettime= explode(':', $tempfirst[1]);
		
	        $bulan = date("m",strtotime($date));         
            $tgl = date("d",strtotime($date));
            $yr = date("Y",strtotime($date));
			$hour=$gettime[0]; $minute=$gettime[1];
			//echo $tgl." ".$bln[$bulan]." ".$yr;
           return $hour.":".$minute.":"."00";
        
    }
	
	public function indodate($date=FALSE)
    {
        $bulan = array ("13"=>'',"01"=>'Januari',"02"=>'Februari',"03"=>'Maret',"04"=>'April',"05"=>'Mei',"06"=>'Juni',"07"=>'Juli',"08"=>'Agustus',"09"=>'September',"10"=>'Oktober',"11"=>'November',"12"=>'Desember');
        //print_r($bln);
		$tempfirst = explode(' ', $date);
		
        $getdate = explode('-', $tempfirst[0]);
		
		
		$bln = date("m",strtotime($date));         
		$tgl = date("d",strtotime($date));
		$yr = date("Y",strtotime($date));
	
	   return $tgl." ".$bulan[$bln]." ".$yr;
	
    }
	
    public function stddate($date=FALSE)
    {       
       // $temp = explode('-', $date);
		$bulan = date("m",strtotime($date));         
		$tgl = date("d",strtotime($date));
		$yr = date("Y",strtotime($date));
        if (!checkdate($bulan, $tgl, $yr)):
            return '-';
        else:
            return date("Y-m-d", strtotime($date));
        endif;
    }
	
	public function clearData($str=FALSE) { // escape tab characters 
	$str = preg_replace("/\t/", "\\t", $str); 
	// escape new lines 
	$str = preg_replace("/\r?\n/", "\\n", $str); 
	// convert 't' and 'f' to boolean values 
	if($str == 't') $str = 'TRUE'; 
	if($str == 'f') $str = 'FALSE'; 
	// force certain number/date formats to be imported as strings 
	if(preg_match("/^0/", $str) || preg_match("/^\+?\d{8,}$/", $str) || preg_match("/^\d{4}.\d{1,2}.\d{1,2}/", $str)) {
		$str = "$str"; 
	} 
	// escape fields that include double quotes 
	//if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
	
		return $str;
	}
	  
} 
?>