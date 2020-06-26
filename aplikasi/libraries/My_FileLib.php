<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class My_FileLib {
var $ci;
	
	public function __construct() {
	//utk constructor ci library
		$this->ci = &get_instance();
	}
	
	
	public function upload_img($inputname=FALSE, $filename=FALSE,$abspath=FALSE,$allowed=FALSE,$width=0,$height=0,$pict_type=0,$thumb_width=0,$thumb_height=0){
		
		//$pic_name = ""; $thumb_name="";
		
		$fileNameParts   = explode( '.', $filename ); // explode file name to two part
		$fileExtension   = end( $fileNameParts ); // give extension
		$fileExtension   = strtolower($fileExtension); // convert to lower case
		list($usec, $sec) = explode(" ", microtime());
		$time_start = (float)$usec + (float)$sec;	
		$microname 	= str_replace(".", "",time()+$time_start);
		$renamed 	= $microname.'.'.$fileExtension;
		
		$pic_name=""; $thumb_name="";

		$config = array(  'file_name' => $filename, 
						  'orig_name' => $filename, 
						  'upload_path' => './'.$abspath, 
						  'allowed_types' => $allowed,
						  'overwrite' => TRUE,
						  'remove_spaces' => TRUE,
						  'max_size' => '2000');
		$this->ci->load->library('upload', $config);
		//$this->ci->upload->initialize($config);
		
		$img_data = $this->ci->upload->data();

		if(!$this->ci->upload->do_upload($inputname)){
			
			$file_upload =  $src_data['full_path'];		
				
			$msg = array('error' => $this->ci->upload->display_errors());
			exit;
			
		}else{ $msg = array('error' => false);	}
		
			//Create Original Pict
			if($pict_type=='1'):
				$this->ci->load->library('image_lib');
				
				$confpict = array( 'image_library' 	=> 'gd2',
								   'source_image' 	=> $img_data['full_path'],
								   'new_image'	 	=> $img_data['file_path'].$renamed,
								   'maintain_ratio' => TRUE,
								   'overwrite' 		=> TRUE,
								   'width' 			=> ($width)?$width:'800',
								   'height'			=> ($height)?$height:'600'
								 );
				$this->ci->image_lib->clear();				 
				$this->ci->image_lib->initialize($confpict);	
				
				if ( ! $this->ci->image_lib->resize())
				{
					$this->ci->image_lib->display_errors('<p>', '</p>');
					exit;
				}
				
				$pic_name   = $abspath.$microname.'.'.$fileExtension; 
			endif;
		
			//Create Thumbnail
			if($pict_type=='2'):
			
				$this->ci->load->library('image_lib');
				
				$confthumb['image_library'] = 'gd2';
				$confthumb['source_image'] 	= $img_data['full_path'];
				$confthumb['new_image']		= $img_data['file_path'].$renamed;
				$confthumb['maintain_ratio'] = TRUE;
				$confthumb['create_thumb'] 	= TRUE;
				$confthumb['thumb_marker'] 	= '_thumb';
				$confthumb['width'] 		= ($thumb_width)?$thumb_width:150;
				$confthumb['height'] 		= ($thumb_height)?$thumb_height:100;	//$thumb_height;
								
				$this->ci->image_lib->clear();
				$this->ci->image_lib->initialize($confthumb);	
			//$this->ci->load->library('image_lib',$confthumb);
				
				if ( ! $this->ci->image_lib->resize())
				{
					$this->ci->image_lib->display_errors('<p>', '</p>');
					exit;
				}
				
				$thumb_name   = $abspath.$microname.'_thumb.'.$fileExtension; 
			endif;
			
			// Create Thumb & Picture
			if($pict_type=='3'):
				$this->ci->load->library('image_lib');
				
				//Create Big Pict
				$confpict = array( 'image_library' 	=> 'gd2',
								   'source_image' 	=> $img_data['full_path'],
								   'new_image'	 	=> $img_data['file_path'].$renamed,
								   'maintain_ratio' => TRUE,
								   'overwrite' 		=> TRUE,
								   'width' 			=> ($width)?$width:'800',
								   'height'			=> ($height)?$height:'600'
								 );
							 
				$this->ci->image_lib->initialize($confpict);	
				
				if ( ! $this->ci->image_lib->resize())
				{
					$this->ci->image_lib->display_errors('<p>', '</p>');
					exit;
				}
				
				$confthumb = array( 'image_library' 	=> 'gd2',
								    'source_image' 	=> $img_data['full_path'],
								    'new_image'	 	=> $img_data['file_path'].$renamed,
								    'maintain_ratio' => TRUE,
								    'create_thumb'	=> TRUE,
								    'thumb_marker'	=> '_thumb',
								    'width' 			=> ($thumb_width)?$thumb_width:'150',
								    'height'			=> ($thumb_height)?$thumb_height:'100'
								 );
								
				$this->ci->image_lib->clear();
				$this->ci->image_lib->initialize($confthumb);	
			//$this->ci->load->library('image_lib',$confthumb);
				
				if ( ! $this->ci->image_lib->resize())
				{
					$this->ci->image_lib->display_errors('<p>', '</p>');
					exit;
				}
				
				$thumb_name   = $abspath.$microname.'_thumb.'.$fileExtension; 				
				$pic_name   = $abspath.$microname.'.'.$fileExtension; 
			endif;
		@unlink($img_data['full_path']);					
		//print_r($img_data);	
		unset($config);
			
	
		return array($thumb_name,$pic_name);
	}
	
	
	public function upload_file($filename=FALSE,$abspath=FALSE,$allowed=FALSE,$maxsize=0){
		$fileNameParts   = explode( '.', $filename ); // explode file name to two part
		$fileExtension   = end( $fileNameParts ); // give extension
		$fileExtension   = strtolower($fileExtension); // convert to lower case
		//date("Y-m-d H:i:s", mktime(0, 0, 0));
		$srcfile_name   = strtotime(date("Y-m-d H:i:s"),time()).'.'.$fileExtension;  // new file name
		
		$config['file_name'] = $srcfile_name; //set file name		
		$config['upload_path'] = './'.$abspath;
		$config['allowed_types'] = $allowed;  	//$config['allowed_types'] = '*';
		$config['overwrite'] = false;
		$config['remove_spaces'] = true;
		$config['max_size'] = $maxsize;

					 
		$this->ci->load->library('upload', $config);
		$this->ci->upload->initialize($config);
		$src_data = $this->ci->upload->data();
		if(!$this->ci->upload->do_upload('f_file')){
			
			$file_upload =  $src_data['full_path'];		
			//echo $file_upload;	exit;			
			$msg = array('error' => $this->ci->upload->display_errors());
			echo $msg['error'];
			exit;
			
		}else{ $msg = array('error' => false); }
		
		unset($config);
		//exit;
		return $srcfile_name;
	}
	
	public function file_del($filenpath=FALSE){
		@unlink($filenpath);
		//exit;
		return 1;
	}
	  
} 
?>