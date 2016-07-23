<?php
defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );

interface I_ECE_Shortcodes {

}

class ECE_Shortcodes {
/**
* Enqueue scripts
*/
/*
Welcome to Custom CSS!

CSS (Cascading Style Sheets) is a kind of code that tells the browser how
to render a web page. You may delete these comments and get started with
your customizations.

By default, your stylesheet will be loaded after the theme stylesheets,
which means that your rules can take precedence and override the theme CSS
rules. Just write here what you want to change, you don't need to copy all
your theme's stylesheet content.
*/

	private $tag = '';

	private $tag_id = '';

	private $tag_class = '';

	private $tag_str = '';

	private $effect_arr = array();

	private $tag_arr = array();

	private $param_arr = array(); 

	private $shortcodes = array();

	private $params = array();

	private $elements = array();

	private $obj_arr = array();

	private $elem_arr = array(
						'a','area','article','aside','body','blockquote',
						'button','caption','code','div','dl','dt','embed',
						'fieldset','figure','form','frame','framset','head',
						'header','iframe','img','input','label','optgroup',
						'option','p','pre','section','span','strong','sub',
						'sup','table','tbody','td','th','tr','textare','ul','li');

	private $class_arr = array(
				'spin90-right', 'spin180-right', 
				'spin540-right' , 'spin900-right' , 
				'spin360-right' ,'spin90-left' , 
				'spin180-left' , 'spin540-left' , 
				'spin900-left' , 'spin360-left' ,
				  'shimmy' , 'slide-right' , 
				  'slide-up' , 'slide-down' , 
				  'slide-left' , 'skew');
	


	public function __construct() {

		add_shortcode( 'css_effect', array( $this, 'ece_params_shortcode' ) );
	}

	public function ece_params_shortcode( $atts, $content = null ) {

		$content = 'HTML elements you want effect applied to.';
		$sp = ' ';
		$ds = '-';
	    $this->tag_id = esc_attr( 'ece_'.date("YmdHis") );


	    $this->params = shortcode_atts( array(
	        'element' => 'div',
	        'class' => 'spin360',
	        'direction' => 'right',
	        'href' => '#',
	        'title' => $this->tag_id,
	        'src' => 'http://placehold.it/350x150',
	        'value' =>  $this->tag_id,
	        'name' =>  $this->tag_id,
	        'id' =>  $this->tag_id,
	        'alt' =>  $this->tag_id,
	        'type' => 'text',
	        'height' => '150',
	        'action' => 'POST',
	        'width' => '150',
	        'style' => 'margin:0 auto;'//,
	        //'wrap' => 'true'
	        				//'class="spin360"'.$sp;
	    ), $atts );


	    $style_attr = esc_attr( $params['style'] );
	    $style_url = esc_url( $style_attr );
	    $style_html = esc_html( $style_url );
	    $this->params['style'] = $style_html;



	    if ( $this->params['element'] !== null &&
	    	 $this->params['element'] !== false && $this->params['element'] !== false ) {
	    	$str = $this->ece_parse_shortcode( $this->params['element'], $this->params );
		}

		//var_dump($this->params);
		//var_dump($str);

		$shortcode = $this->str;
		return $shortcode;
}

	public function ece_parse_shortcode( $tag, $params ) {

		if ( $tag !== null && $tag !== false && $tag !== false ) {

			$sp = ' ';
			$ds = '-';
		//if ( $params['wrap'] === true || $tag == 'true' && $tag == true ) {
		//	$wrap = 'wrap-';
		//} else {
			$wrap = '';
		//}

			if ( $tag === 'img' ) {

		    	$img_raw = esc_attr( $params['src'] );
		    	$img_url = esc_url( $img_raw );

		    	$this->str = '<'. $tag.$sp.
		    				'id="'. esc_attr( $params['id'] ). '"'.$sp.
		    				'name="'. esc_attr( $params['id'] ). '"'.$sp.
		    				'class="'.$wrap.esc_attr( $params['class'] ).$ds.esc_attr( $params['direction'] ).'"'.$sp.
		    				'src="'.esc_attr( $params['src'] ).'"'.$sp.
					    	'alt="'.esc_attr( $params['alt'] ).'"'.$sp.
					    	'value="'.esc_attr( $params['value'] ).'"'.$sp.
					    	'height="'.esc_attr( $params['height'] ).'"'.$sp.
					    	'width="'.esc_attr( $params['width'] ).'"'.$sp.
					    	'href="'.esc_attr( $params['href'] ).'"'.$sp.
					    	'style="'.$style_html.'"'.$sp.'>'.
					    	$content.
					    	'</'. $tag .'>';

		    } elseif ( $tag === 'a' ) {

		    	$href_attr = esc_attr( $params['href'] );
		    	$href_url = esc_url( $href_attr );

		    	$this->str = '<'. $this->tag.$sp.
		    				'id="'. esc_attr( $params['id'] ). '"'.$sp.
		    				'name="'. esc_attr( $params['id'] ). '"'.$sp.
		    				'class="'.$wrap.esc_attr( $params['class'] ).$ds.esc_attr( $params['direction'] ).'"'.$sp.
					    	'value="'.esc_attr( $params['value'] ).'"'.$sp.
					    	'href="'.$href_url.'"'.$sp.
					    	'style="'.$style_html.'"'.$sp.'>'.
					    	$content.
					    	'</'. $tag .'>';
		    
		    } elseif ( $tag === 'form' ) {
		    	$this->str = '<'. $this->tag.$sp.
		    				'id="'. esc_attr( $params['id'] ). '"'.$sp.
		    				'name="'. esc_attr( $params['id'] ). '"'.$sp.
		    				'class="'.$wrap.esc_attr( $params['class'] ).$ds.esc_attr( $params['direction'] ).'"'.$sp.
					    	'value="'.esc_attr( $params['value'] ).'"'.$sp.
					    	'action="'.esc_attr( $params['action'] ).'"'.$sp.
					    	'style="'.$style_html.'"'.$sp.'>'.
					    	$content.
					    	'</'. $tag .'>';
		    
		    } elseif ( $tag === 'input' ) {

	    		$this->str = '<'. $this->tag.$sp.
		    				'id="'. esc_attr( $params['id'] ). '"'.$sp.
		    				'name="'. esc_attr( $params['id'] ). '"'.$sp.
		    				'class="'.$wrap.esc_attr( $params['class'] ).$ds.esc_attr( $params['direction'] ).'"'.$sp.
					    	'value="'.esc_attr( $params['value'] ).'"'.$sp.
					    	'type="'.esc_attr( $params['type'] ).'"'.$sp.
					    	'style="'.$style_html.'"'.$sp.
					    	 '/>';
		    } else {

	    		$this->str = '<'. $this->tag.$sp.
		    				'id="'. esc_attr( $params['id'] ). '"'.$sp.
		    				'name="'. esc_attr( $params['id'] ). '"'.$sp.
		    				'class="'.$wrap.esc_attr( $params['class'] ).$ds.esc_attr( $params['direction'] ).'"'.$sp.
					    	'value="'.esc_attr( $params['value'] ).'"'.$sp.
					    	'style="'.$style_html.'"'.$sp.'>'.
					    	$content.
					    	'</'. $tag .'>';
			}


		return $this->str;
	}
}

}


$esh = new ECE_Shortcodes();