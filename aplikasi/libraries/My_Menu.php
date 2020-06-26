<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Mymenu {

function menuit($datax,$parentx,$menuid,$active){ 
		  
		  $str="";
		  $hassub="";
		  $linkurl ="";
		 //echo $parentx;
		  if(isset($datax[$parentx])){ 	
			/* setiap menu ditampilkan dengan tag <ul> dan apabila nilai $parent bukan 0 maka sembunyikan element 
			 * karena bukan merupakan menu utama melainkan sub menu */		
			//print_r($datax[$parentx]);
			foreach($datax[$parentx] as $val){ 
				//echo 	$val->id; 
			//echo $menuid;
			  $selected=($val->id==$menuid)?' class="selected"':'';	
			  $child = $this->menuit($datax,$val->id,$menuid,$selected); 
			  				
				
			  $str .= "<li$selected>";
			  /* beri tanda sebuah folder dengan warna yang mencolok apabila terdapat sub menu di bawah menu utama 	  	   
			   * dan beri juga event javascript untuk membuka sub menu di dalamnya */
			 // $menu=$DB->getrecord("tmenu","id",$val->ttype); 
			  if($val->ttype==1):
		  	  	$linkurl = 'href="'.base_url().'"';
			  else:
			  		$urlname=(!empty($val->url))?"/".trim($val->url):"";
					$linkurl ='href="'.base_url().'index.php/'.trim($val->tipename).$urlname.'"'; //.'index.php/'
			  endif;			  
			 
			  if($child)$hassub = ' class="has_submenu"';		
			  
			  $str .="<a $linkurl $hassub>".$val->judul." </a>";
			  if($child)$str .= "<ul>".$child."</ul>";	
			 // $str .= ($child)?$anak:$anak;
			 
			  //if($child) $str .= $child;
			  $str .= '</li>';
			}
			//$str .= '</ul>';		
			return $str;
		  }else return false;	  
		}	
	
function maketreesitemap( $rootcatid, $level ) {
   global $lang,$pids,$datae; 
   
   if( !is_numeric($rootcatid) || !is_numeric($level) ) {
      return;
   }
	   
   $sql = 'SELECT id, parentid, iname, ename, tipe FROM menu WHERE parentid = ' . $rootcatid . ' AND publish = "Y" ORDER BY id,parentid';
	
   $result = @mssql_query($sql);

   if( !$result || @mssql_num_rows($result) < 1 ) {
   	  
      return;
   }

   $level++;
	
   while( $sql_data = @mssql_fetch_assoc($result) ){
							 	
      $db_catid = $sql_data['id'];
	  if($lang=="ina"):									
	  	$db_catname = $sql_data['iname'];
	  else:
	  	$db_catname = $sql_data['ename'];
	  endif;      
	  $db_parent = $sql_data['parentid'];
      $display = '';
	  
      for( $i=0;$i<($level*2);$i++ ) {
		if($db_parent==0):
         	$display .= '';
		else:
			$display .= '&nbsp;';
		endif;
      }
		$path = "";
		if (trim($menu [ $i ] [ 'linksite' ]) != "") {
			$path = " href='".trim($menu [ $i ] [ 'linksite' ])."'";
			$target = " target='_blank'";
		} else {
			if ($menu[$i]['tipe']!=0) {
				if ($menu[$i]['tipe'] == 6) {
					$tick = "&amp;id=".$menu[$i]['tick']."&amp;f=".$menu[$i]['ticktype'];
				}
				$name = ($_SESSION['lang'] == "EN") ? $menu [ $i ] [ 'ename' ] : $menu [ $i ] [ 'iname' ];
				$rep  = str_replace("&","@",$name);
				$rep  = str_replace(" ", "-", $rep);
				$path = " href='".PATH_HTTP."index.php?page=menu&p=".$menu[$i]['id']."&t=".$menu[$i]['tipe']."&n=".$rep."".$tick."'";
			}
		}
  	  //   http://localhost/depkeu-new/index.php?page=menu&p=3&t=3&n=Analyst-Coverage
	  		$display .= "<li>".$display ." - <a href=\"".PATH_HTTP."index.php?\">".$db_catname."</a>";
      echo "$display\n";
      maketreesitemap($db_catid,$level);
	  $display .= "</li>";
   }
   @mssql_free_result($result);
}	  
} 
?>
