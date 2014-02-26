<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Youtube Links Hook - Load All Events
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author	   Ushahidi Team <team@ushahidi.com>
 * @author     Jamie Pistone <jpistonedev@gmail.com>
 * @package	   Ushahidi - http://source.ushahididev.com
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license	   http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL)
 */

class youtube {

	// Default video dimensions
	var $embed_height = 360;
	var $embed_width = 540;
	
	/**
	 * Registers the main event add method
	 */
	public function __construct()
	{		
		// Hook into routing
		Event::add('system.pre_controller', array($this, 'add'));
	}
	
	/**
	 * Adds all the events to the main Ushahidi application
	 */
	public function add()
	{
		// Only add the events if we are on that controller
		if (Router::$controller == 'reports')
		{
		    if (Router::$method == 'view')
			{   
				// Add to report submissions
				Event::add('ushahidi_filter.report_description', array($this, '_embed_youtube'));
				
				// Add resizing script
				Event::add('ushahidi_action.header_scripts', array($this, '_add_resizing_scipt'));
			}
			
			elseif (Router::$method == 'submit')
			{
				// Add to admin report message
			    Event::add('system.post_controller', array($this, '_embed_youtube_report_message'));
			}
		}
		
		elseif (Router::$controller == 'page')
		{
			if (Router::$method == 'index')
			{
				// Add to content on any custom pages
				Event::add('ushahidi_filter.page_description', array($this, '_embed_youtube'));
				
                // Add resizing script
				Event::add('ushahidi_action.header_scripts', array($this, '_add_resizing_scipt'));
			}
		}
	}
	
	public function _embed_youtube()
	{
		// Access the report description
		$report_description = Event::$data;
		
		$report_description = $this->_auto_embed($report_description);
		
		// Return new description
		Event::$data = $report_description;
	}
	
	public function _embed_youtube_report_message()
	{
	    // Unfortunately there are no ushahidi filters to use - need to grab data manually
	    $site_submit_report_message = Kohana::instance()->template->content->site_submit_report_message;
		
		$site_submit_report_message = $this->_auto_embed($site_submit_report_message);
		
		// Return new message
		Kohana::instance()->template->content->site_submit_report_message = $site_submit_report_message;
	}
	
	public function _add_resizing_scipt() 
	{
		$view = new View('resize_embed_js');
		$view->render(true);
	}
	
	/**
	 * Convert the youtube text anchors into links.
	 *
	 * @param   string   text to autoembed
	 * @return  string
	 */
	private function _auto_embed($text)
	{
		// Finds all http/https/ftp/ftps links that are not part of an existing html anchor
		if (preg_match_all('~\b(?<!href="|">)(?:ht|f)tps?://\S+(?:/|\b)~i', $text, $matches))
		{
			foreach ($matches[0] as $match)
			{
				// Find All YouTube links
				if(preg_match('/youtube\.com\/(v\/|watch\?v=)([\w\-]+)/', $match, $matches2))
				{
					$embed_code = $this->_embed_code($matches2[2]);
					$text = str_replace($match, $embed_code, $text);
				}
			}
		}
		
		return $text;
	}
	
	private function _embed_code($id = NULL)
	{
		if ($id)
		{
			return '<div style="margin:15px 0 15px 0"><object width="'.$this->embed_width.'" height="'.$this->embed_height.'"><param name="movie" value="//www.youtube.com/v/'.$id.'&hl=en&fs=1&"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="//www.youtube.com/v/'.$id.'&hl=en&fs=1&" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="'.$this->embed_width.'" height="'.$this->embed_height.'"></embed></object></div>';
		}
		else
		{
			return "";
		}
	}
}

new youtube;