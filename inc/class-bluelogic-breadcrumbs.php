<?php
defined( 'ABSPATH' ) || die();

class Bluelogic_breadcrumbs{

    var $args = [] ;
    var $crumbs = [];

    function __construct( $args ){

        $this->args = wp_parse_args(
            $args,
            array(
                'delimiter'   => '<span>/</span>',
                'wrap_before' => '<ul>',
                'wrap_after'  => '</ul>',
                'before'      => '<li>',
                'after'       => '</li>',
                'home'        => _x( 'Home', 'breadcrumb', 'the_waker' ),
				'append_crumbs'	=> []
            )
        );

        $this->add_crumb( __( 'Home', 'aramed_wp' ), home_url() );

        $conditionals = array(
			'is_home',
			'is_404',
			'is_attachment',
			'is_single',
			'is_archive',
			'is_product_category',
			'is_product_tag',
			'is_shop',
			'is_page',
			'is_post_type_archive',
			'is_category',
			'is_tag',
			'is_author',
			'is_date',
			'is_tax',
			'is_search'
		);

		if( is_single() &&  ! in_array( get_post_type(), [ 'page', 'post' ] ) ){
			$archive_link = apply_filters( "bluelogic_bc_archive_link", "/".get_post_type(), get_post_type() );
			$this->add_crumb( __( get_post_type() ), $archive_link );
		}

		if (  ! is_front_page()  ) {
			foreach ( $conditionals as $conditional ) {
                $function_name = 'add_crumbs_' . substr( $conditional, 3 );
				if ( function_exists( $conditional ) && call_user_func( $conditional ) &&  method_exists( $this, $function_name ) ) {
					call_user_func( [ $this, $function_name ] );
					break;
				}
			}

		}

		foreach( $this->args[ "append_crumbs" ] as $key => $append_crumb ){
			$this->add_crumb( $append_crumb, $key );
		}

		echo $this->args [ 'wrap_before' ];
		$_crumb_array = [];
		foreach( $this->crumbs as $crumb ) {
			$href = empty( $crumb['link'] ) ? "" : "href='{$crumb['link']}'";
			$_crumb_array[] = $this->args [ 'before' ] . "<a " . $href . "'>{$crumb['title']} </a>" . $this->args [ 'after' ];
		}

		$delimiter = "";
		if( ! empty(  $this->args [ 'delimiter' ] ) ){
			$delimiter =   $this->args [ 'before' ] . $this->args [ 'delimiter' ] .  $this->args [ 'after' ];
		}
		
		echo implode($delimiter , $_crumb_array );
		echo $this->args [ 'wrap_after' ];
    }

	protected function add_crumbs_search(){
		global $wp_query;
		$this->add_crumb( 'search', "" ); // removed get_permalink()
		
		if( empty( $this->search_result_text ) ){
			$result_text = sprintf( esc_html(
				/* translators: %d: The number of search results. */
				_n(
					'We found %d result for your search.',
					'We found %d results for your search.',
					(int) $wp_query->found_posts,
					'the_owker'
				) 
			),
			(int) $wp_query->found_posts );
		}else{
			$result_text = $this->search_result_text;
		}

		$this->add_crumb( $result_text, "" );
		
		
	}

    protected function add_crumbs_page(){
        global $post;

		if ( $post->post_parent ) {
			$parent_crumbs = array();
			$parent_id     = $post->post_parent;

			while ( $parent_id ) {
				$page            = get_post( $parent_id );
				$parent_id       = $page->post_parent;
				$parent_crumbs[] = array( get_the_title( $page->ID ), get_permalink( $page->ID ) );
			}

			$parent_crumbs = array_reverse( $parent_crumbs );

			foreach ( $parent_crumbs as $crumb ) {
				$this->add_crumb( $crumb[0], $crumb[1] );
			}
		}

		$this->add_crumb( get_the_title(), "" ); // removed get_permalink()
		$this->endpoint_trail();
    }

    protected function add_crumbs_single( $post_id = 0, $permalink = '' ) {
		if ( ! $post_id ) {
			global $post;
		} else {
			$post = get_post( $post_id ); // WPCS: override ok.
		}

		if ( 'product' === get_post_type( $post ) ) {
			$this->prepend_shop_page();

			$terms = wc_get_product_terms(
				$post->ID,
				'product_cat',
				apply_filters(
					'woocommerce_breadcrumb_product_terms_args',
					array(
						'orderby' => 'parent',
						'order'   => 'DESC',
					)
				)
			);

			if ( $terms ) {
				$main_term = apply_filters( 'woocommerce_breadcrumb_main_term', $terms[0], $terms );
				$this->term_ancestors( $main_term->term_id, 'product_cat' );
				$this->add_crumb( $main_term->name, get_term_link( $main_term ) );
			}
		} elseif ( 'post' !== get_post_type( $post ) ) {
			// $post_type = get_post_type_object( get_post_type( $post ) );

			// if ( ! empty( $post_type->has_archive ) ) {
			// 	$this->add_crumb( $post_type->labels->singular_name, get_post_type_archive_link( get_post_type( $post ) ) );
			// }
		} else {
			$cat = current( get_the_category( $post ) );
			if ( $cat ) {
				$this->term_ancestors( $cat->term_id, 'category' );
				$this->add_crumb( $cat->name, get_term_link( $cat ) );
			}
		}

		$this->add_crumb( get_the_title( $post ), $permalink );
	}

    public function add_crumb( $name, $link = '' ) {
		$this->crumbs[] = array(
			"title" => ucfirst( wp_strip_all_tags( $name ) ),
			"link" => $link,
		);
	}

	protected function term_ancestors( $term_id, $taxonomy ) {
		$ancestors = get_ancestors( $term_id, $taxonomy );
		$ancestors = array_reverse( $ancestors );

		foreach ( $ancestors as $ancestor ) {
			$ancestor = get_term( $ancestor, $taxonomy );

			if ( ! is_wp_error( $ancestor ) && $ancestor ) {
				$this->add_crumb( $ancestor->name, get_term_link( $ancestor ) );
			}
		}
	}

    protected function prepend_shop_page() {
		$permalinks   = wc_get_permalink_structure();
		$shop_page_id = wc_get_page_id( 'shop' );
		$shop_page    = get_post( $shop_page_id );

		// If permalinks contain the shop page in the URI prepend the breadcrumb with shop.
		if ( $shop_page_id && $shop_page && isset( $permalinks['product_base'] ) && strstr( $permalinks['product_base'], '/' . $shop_page->post_name ) && intval( get_option( 'page_on_front' ) ) !== $shop_page_id ) {
			$this->add_crumb( __( get_the_title( $shop_page ) ), get_permalink( $shop_page ) );
		}
	}

	protected function endpoint_trail() {
		if( ! function_exists( 'is_wc_endpoint_url' ) ){
			return;
		}
		$action         = isset( $_GET['action'] ) ? sanitize_text_field( wp_unslash( $_GET['action'] ) ) : '';
		$endpoint       = is_wc_endpoint_url() ? WC()->query->get_current_endpoint() : '';
		$endpoint_title = $endpoint ? WC()->query->get_endpoint_title( $endpoint, $action ) : '';

		if ( $endpoint_title ) {
			$this->add_crumb( $endpoint_title );
		}
	}

	/**
	 * Shop breadcrumb.
	 */
	protected function add_crumbs_shop() {
		if ( intval( get_option( 'page_on_front' ) ) === wc_get_page_id( 'shop' ) ) {
			return;
		}

		$_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';

		if ( ! $_name ) {
			$product_post_type = get_post_type_object( 'product' );
			$_name             = $product_post_type->labels->name;
		}

		$this->add_crumb( $_name, get_post_type_archive_link( 'product' ) );
	}

	/**
	 * Product category trail.
	 */
	protected function add_crumbs_product_category() {
		
		$current_term = $GLOBALS[ 'wp_query' ]->get_queried_object();

		$this->prepend_shop_page();
		$this->term_ancestors( $current_term->term_id, 'product_cat' );
		$this->add_crumb( $current_term->name, get_term_link( $current_term, 'product_cat' ) );

	}

	/**
	 * Product category trail.
	 */
	protected function add_crumbs_archive() {

		$this->add_crumb( get_post_type(),  home_url() . "/". get_post_type() );

	}

}