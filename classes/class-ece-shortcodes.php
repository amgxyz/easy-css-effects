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
	private $tag_class = ';'
	private $tag_str = '';
	private $effect_arr = array();
	private $tag_arr = array();
	private $param_arr = array(); 
	private $shortcodes = array();
	private $elem_arr = array('a','area','article','aside','body','blockquote','button','caption','code','div','dl','dt','embed','fieldset','figure','form','frame','framset','head','header','iframe','img','input','label','optgroup','option','p','pre','section','span','strong','sub','sup','table','tbody','td','th','tr','textare','ul','li')
	private $class_arr = array(
				'spin90-right', 'spin180-right', 'spin540-right' , 'spin900-right' , 'spin360-right' ,
				 'spin90-left' , 'spin180-left' , 'spin540-left' , 'spin900-left' , 'spin360-left' ,
				  'shimmy' , 'slide-right' , 'slide-up' , 'slide-down' , 'slide-left' , 'skew');
	


	public function __construct() {

	
	}
	public function ece_params_shortcode( $atts, $content = null ) {

		$content = 'HTML elements you want effect applied to.';
		$sp = ' ';
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
	        'height' => 150,
	        'action' => 'POST'
	        'width' => 150,
	        'style' => 'margin:0 auto;'
	        'attr_arr' => ' title="'.$this->tag_id.$sp.
	        				'id="'.$this->tag_id.'"'.$sp.
	        				'name="'.$this->tag_id.'"'.$sp.
	        				'class="' .$effect.'"'.$sp;
	    ), $atts );

	    $this->tag = esc_attr( $params['element'] );
	    $this->tag_class = esc_attr( $params['class'] );


	    

	    if ( $tag === 'img' ) {
	    	$img_raw = esc_attr( $params['src'] );
	    	$img_url = esc_url( $img_raw );

	    	$this->str = '<'. $this->tag.$sp.
    					'id="'. $this->tag_id .'"'.$sp.
				    	'class="' . $this->tag_class . '"'.$sp.
				    	'src="'.$img_url.'"'.$sp.
				    	'height="'.esc_attr( $params['height'] ).'"'.$sp
				    	'height="'.esc_attr( $params['width'] ).'"'.$sp
				    	'alt="'.esc_attr( $params['alt'] ).'"'.$sp.
				    	'height="'.esc_attr( $params['alt'] ).'"'.$sp.
				    	'height="'.esc_attr( $params['alt'] ).'"'.$sp.
				    	'height="'.esc_attr( $params['alt'] ).'"'.$sp.
				    	'height="'.esc_attr( $params['alt'] ).'"'.$sp.
				    	'height="'.esc_attr( $params['alt'] ).'"'.$sp.
				    	'height="'.esc_attr( $params['alt'] ).'"'.$sp.
				    	'height="'.esc_attr( $params['alt'] ).'"'.$sp.
				    	'height="'.esc_attr( $params['alt'] ).'"'.$sp.
				    	'height="'.esc_attr( $params['alt'] ).'"'.$sp.
				    	'height="'.esc_attr( $params['alt'] ).'"'.$sp.
				    	'height="'.esc_attr( $params['height'] ).'"'.$sp
				    	'height="'.esc_attr( $params['height'] ).'"'.$sp
				    	'height="'.esc_attr( $params['height'] ).'"'.$sp
				    	 ' />'.

	    } elseif ( $tag === 'a' ) {

	    }
	    } elseif ( $tag === 'a' ) {

	    }
	    } elseif ( $tag === 'a' ) {

	    }
	    } elseif ( $tag === 'a' ) {

	    }
	    } elseif ( $tag === 'a' ) {

	    }
	    } elseif ( $tag === 'a' ) {

	    }
	    } elseif ( $tag === 'a' ) {

	    }
	    } elseif ( $tag === 'a' ) {

	    }
	    } elseif ( $tag === 'a' ) {

	    }
	    } elseif ( $tag === 'a' ) {

	    }

    	$this->str = '<'. $this->tag . ' 
    					id="'. $this->tag_id .'" 
				    	class="' . $this->tag_class . '" >'.
				    	$content
				    	.'</'. $this->tag .'>';

		$shortcode = $this->str;

		return $shortcode;
	
	}

	public function ece_class_shortcodes() {

	    $content = 'HTML elements you want effect applied to.';
	    $tag = esc_attr( $params['element'] );
	    $tag_id = esc_attr( 'ece_'.date("YmdHis") );
	    $tag_class = esc_attr( $params['class'] );

    	$this->str = '<'. $tag . ' 
    					id="'. $tag_id .'" 
				    	class="' . $tag_class . '" >'.
				    	$content
				    	.'</'. $tag .'>';

		if ( is_array($this->class_arr) &&
			 $this->class_arr !== null && $this->class_arr !== '') {

			foreach ($this->class_arr as $class ) {

				$this->effect_arr = explode( '-', $class );

				if ((! is_empty( $this->effect_arr )) &&
					 ( is_array( $this->effect_arr ) ) && 
					 ( $this->effect_arr !== '' ) && ( $this->effect_arr !== false ) ) {

					$effect = $this->effect_arr[0];
					$direction = $this->effect_arr[1];

				} else {
					$effect = $class;
					$direction = false;
				}
				
				array_push( $this->tag_arr, array( $effect, $direction ) );


			}
			
		}
	}
}
$esh = new ECE_Shortcodes();