<?php
if ( !class_exists( 'DMAC_Plugin_Tools_1_0_00' ) ) :
/**
 * DMAC Plugin Tools
 * 
 * @version 1.0.00
 * @author Donal MacArthur
 * @copyright Copyright (c) 2011, Donal MacArthur
 * @link http://donalmacarthur.com/
 */
class DMAC_Plugin_Tools_1_0_00 {

	/**
	 * PHP4 constructor method. This provides backwards compatibility for users with setups
	 * on older versions of PHP. Once WordPress no longer supports PHP4, this method will be removed.
	 *
	 * @since 1.0.00
	 * @param string $prefix The theme or plugin prefix
	 */
	function DMAC_Plugin_Tools_1_0_00( $prefix = 'dmac' ) {
		$this->__construct( $prefix );
	}

	/**
	 * Constructor method for the DMAC_Plugin_Tools class.  
	 * 
	 * @since 1.0.00
	 * @param string $prefix The theme or plugin prefix
	 */
	function __construct( $prefix = 'dmac' ) {
		$this->prefix = $prefix;
	}
		
	/**
	 * Extract the default option settings from an options array in standard 
	 * Atlas/DMAC options format.
	 *
	 * @since 1.0.00
	 * @param array $options the options array
	 * @param bool $arrayLevel indicates whether the input array consists of 'tabs', 'optionboxes', or 'options'
	 * @return array $defaults the default settings array
	 */
	function get_default_settings( $input = array(), $arrayLevel = 'optionboxes' ) {

		$defaults = array();
		
		/* If we have an array of tabs... */
		if ( $arrayLevel == 'tabs' ) {
			foreach( $input as $tab ) {
				foreach( $tab as $optionbox ) {
					foreach( $optionbox as $option ) {
						if ( isset( $option['id'] ) && isset( $option['std'] ) )
							$defaults[$option['id']] = $option['std'];
					}
				}
			}
		}
		
		/* Else, if we have an array of optionboxes... */
		elseif ( $arrayLevel == 'optionboxes' ) {
			foreach ( $input as $optionbox ) {
				foreach ( $optionbox as $option ) {
					if ( isset( $option['id'] ) && isset( $option['std'] ) )
						$defaults[$option['id']] = $option['std'];
				}
			}
		}
		
		/* Else, if we have an array of option elements... */
		elseif ( $arrayLevel == 'options' ) {
			foreach ( $input as $option ) {
				if ( isset( $option['id'] ) && isset( $option['std'] ) )
					$defaults[$option['id']] = $option['std'];
			}
		}
		
		return $defaults;
	}
	
	/**
	 * A fix for the exclude_tree bug in the wp_list_pages() function. 
	 * 
	 * Given a string of comma-separated page IDs, this function returns a string 
	 * containing the original IDs plus the IDs of all their descendant pages.
	 *
	 * @since 1.0.00
	 * @param string $parents a list of page IDs in the format '1,2,3'
	 * @return string $exclude a list of page IDs in the format '1,2,3'
	 */
	function exclude_page_trees( $parents = '' ) {

		$parents = explode( ',', trim( $parents ) );
		$exclude = '';
		
		foreach ( $parents as $parent ) {
		
			if ( $exclude )
				$exclude .= ',' . $parent;
			else
				$exclude = $parent;
				
			$descendants = get_pages( array( 'child_of' => $parent ) );
			
			foreach ( $descendants as $descendant )
				$exclude .= ',' . $descendant->ID;
		}
		
		return $exclude;
	}
}
endif;