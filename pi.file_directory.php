<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ExpressionEngine File Directory Plugin
 *
 * @package		File Directory Plugin
 * @subpackage		Plugins
 * @category		Plugins
 * @author		Brad Morse
 * @link			http://www.bkmorse.com
 */

$plugin_info = array(
	'pi_name'			=> 'File Directory',
	'pi_version'		=> '1.0.0',
	'pi_author'		=> 'Brad Morse',
	'pi_author_url'	=> 'http://bkmorse.com',
	'pi_description'	=> 'Displays all files from within a folder/directory on your server',
	'pi_usage'		=> File_directory::usage()
);


class File_directory {

	var $return_data;

	/**
	*  Constructor
	*/
	function File_directory()
	{
		// make a local reference to the ExpressionEngine super object
		$this->EE =& get_instance();
		$this->EE->load->helper('file');
		$this->EE->load->helper('url');
		
		$directory = ($this->EE->TMPL->fetch_param('directory') !== false) ? $this->EE->TMPL->fetch_param('directory') : "";
		$wrap = ($this->EE->TMPL->fetch_param('wrap') !== false) ? $this->EE->TMPL->fetch_param('wrap') : "";
    
    $return_data = '';

    if($directory) {
  		//get all files within directory
      $files = glob($directory . "*.*");
      $file_names = get_filenames($directory);
      
      foreach($file_names as $file):
        if($wrap != '') {
          $return_data .= '<'.$wrap.'>'.anchor($directory.$file, $file).'</'.$wrap.'>';
        } else {
          $return_data .= anchor($directory.$file, $file);
        }
      endforeach; 

  		$this->return_data = $return_data;
    }
	}
	/* END */
	
	
// ----------------------------------------
//  Plugin Usage
// ----------------------------------------

// This function describes how the plugin is used.
//  Make sure and use output buffering

function usage()
{
ob_start(); 
?>
Use as follows:

{exp:file_directory directory="/path/to/folder" wrap=""}

directory (required) - absolute or relative path to folder of files you want to display

wrap (optional) - put within paragraph, div or span tags, see below

wrap="p" would put it within <p></p>
wrap="div" would put it within <div></div>
wrap="span" would put it within <span></span>

* if you get an error or nothing displays, be sure to check the path you passed to the directory parameter

<?php
$buffer = ob_get_contents();
	
ob_end_clean(); 

return $buffer;
}
/* END */


}
// END CLASS

/* End of file pi.pdf_icon.php */
/* Location: ./system/expressionengine/third_party/file_directory/pi.file_directory.php */
?>