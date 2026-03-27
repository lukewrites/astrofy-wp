<?php
/**
 * Custom Walker for Sidebar Navigation Menu
 */
class Astrofy_Sidebar_Walker extends Walker_Nav_Menu {

    /**
     * Starts the list before the elements are added.
     */
    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '<ul class="menu">';
    }

    /**
     * Ends the list after the elements are added.
     */
    public function end_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '</ul>';
    }

    /**
     * Starts the element output.
     */
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $active_class = '';
        if ( in_array( 'current-menu-item', $item->classes, true ) || in_array( 'current-menu-ancestor', $item->classes, true ) ) {
            $active_class = ' bg-base-300';
        }

        $output .= '<li>';

        $atts = array();
        $atts['class'] = 'py-3 text-base' . $active_class;
        $atts['href']  = ! empty( $item->url ) ? $item->url : '';

        if ( ! empty( $item->target ) ) {
            $atts['target'] = $item->target;
        }
        if ( ! empty( $item->attr_title ) ) {
            $atts['title'] = $item->attr_title;
        }
        if ( ! empty( $item->xfn ) ) {
            $atts['rel'] = $item->xfn;
        }

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $attributes .= ' ' . $attr . '="' . esc_attr( $value ) . '"';
            }
        }

        $output .= '<a' . $attributes . '>';
        $output .= esc_html( $item->title );
        $output .= '</a>';
    }

    /**
     * Ends the element output.
     */
    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        $output .= '</li>';
    }
}
