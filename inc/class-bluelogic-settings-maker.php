<?php
defined( 'ABSPATH' ) || die();

class Owker_settings_maker{

    var $config_json ;

    function __construct(){
        $this->config_json = (OBJECT)[];
        add_action( 'init', array( $this, 'owker_make_settings' ) );
    }

    function owker_make_settings(){

        if( is_customize_preview() ){
    
            if( file_exists( wp_get_theme()->get_stylesheet_directory() . "/settings.json" ) ) {
                $json_string = file_get_contents( wp_get_theme()->get_stylesheet_directory() . "/settings.json" );
                $json_obj = json_decode($json_string);
    
                if( !empty( $json_obj ) ) {
                    $this->config_json = $json_obj;
                    add_action( 'customize_register', array( $this, 'bluelogictc_customize_register' ) );
                }else{
                    
                }
               
            }else{

            }
        }
    }

    function bluelogictc_customize_register( $wp_customize ){
    
        if( !empty( $this->config_json->options ) && is_object( $this->config_json->options ) ){
    
           
    
            foreach(  $this->config_json->options as $panel => $panel_options ){
                $wp_customize->add_section( $panel, 
                    array(
                        'title'         => $panel_options->title ?? $panel,
                        'priority'      => 100,
                        'description' => $panel_options->description ?? "",
                        // 'panel'         => ''
                    ) 
                );
    
                if( ! empty( $panel_options->options ) && is_object( $panel_options->options ) ){
                    foreach( $panel_options->options as $section => $section_options ){
                        if( empty( $section ) ){
                            _de( "Options is empty or invalid of " . $panel ); 
                            continue;;
                        }

                        $options_prefix = empty ( $this->config_json->options_prefix ) ? "" : $this->config_json->options_prefix;

                        $wp_customize->add_setting( $options_prefix . $section ,
                        array(
                            'default'           =>  $section_options->default ?? "",
                            'sanitize_callback' => $section_options->sanitize_callback ?? 'sanitize_text_field',
                            
                            'transport'         => $section_options->transport ?? null,
                            )
                        );

                        $input_control_type = ! empty( $section_options->type ) ? $section_options->type : "text";

                        switch( $input_control_type ){
                            case "image":
                                
                                $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $options_prefix . $section,
                                    array(
                                    'label'       => ! empty( $section_options->label ) ? $section_options->label  : ucfirst( str_replace( '_', ' ', $section ) ),
                                    'description' => $section_options->description ?? "Add Your Image",
                                    'section'     => $panel,
                                    'priority'    => $section_options->priority ?? 10,
                                    'button_labels' => array( // Optional.
                                        'select' => __( 'Select Image' ),
                                        'change' => __( 'Change Image' ),
                                        'remove' => __( 'Remove' ),
                                        'default' => __( 'Default' ),
                                        'placeholder' => __( 'No image selected' ),
                                        'frame_title' => __( 'Select Image' ),
                                        'frame_button' => __( 'Choose Image' ),
                                    )
                                    )
                                ) );
                            break;
                            default:

                                $wp_customize->add_control( $options_prefix . $section, 
                                array(
                                    'type'        => $input_control_type,
                                    'priority'    => $section_options->priority ?? 10,
                                    'section'     => $panel,
                                    'label'       => ! empty( $section_options->label ) ? $section_options->label  : ucfirst( str_replace( '_', ' ', $section ) ),
                                    'placeholder' => $section_options->placeholder ?? "",
                                    'description' => $section_options->description ?? ""
                                ) 
                            );
                            
                        }
    


                        if( ! empty( $section_options->selector ) ){
                            $wp_customize->selective_refresh->add_partial( $section, array(
                                'selector' => $section_options->selector
                            ));
                        }
    
                    }
                }
            }
            
        }else{
            _de( "Options is empty or invalid" );
        }
    }    

}
new Owker_settings_maker();