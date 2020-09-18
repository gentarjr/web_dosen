<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter PDF Library
 *
 * Generate PDF's in your CodeIgniter applications.
 *
 * @package			CodeIgniter
 * @subpackage		Libraries
 * @category		Libraries
 * @author			Yudha Pratama
 * @license			None
 * @link			https://github.com/shinryu99/ci-mpdf
 */

require_once(dirname(__FILE__) . '/mpdf60/mpdf.php');

class Pdf extends MPDF
{
	/**
	 * Get an instance of CodeIgniter
	 *
	 * @access	protected
	 * @return	void
	 */
	protected function ci()
	{
		return get_instance();
	}

	/**
	 * Load a CodeIgniter view into domPDF
	 *
	 * @access	public
	 * @param	string	$view The view to load
	 * @param	array	$data The view data
	 * @return	void
	 */
	public function load_view($view, $data = array())
	{
		$html = $this->ci()->load->view($view, $data, TRUE);
		$this->allow_charset_conversion=true;  // Set by default to TRUE
		$this->charset_in='UTF-8';
		$this->autoScriptToLang = true;
		$this->autoLangToFont = true;
		$this->format = 'A4';
		$html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
		$this->WriteHtml($html);
	}
}
