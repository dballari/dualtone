<?php

/**
 * DualTone WordPress theme class
 *
 * @package	DualTone Theme
 * @author	David Ballarin Prunera
 * @license	GNU General Public License v3
 * @link	https://ballarinconsulting.com/themes
 */

if ( ! class_exists( 'DualTone_Theme' ) )
{
    class DualTone_Theme
    {

        /**
         * Default arguments
         */
        public $defaults = [
            'theme_supports' => [],
            'custom_block_styles_folder' => '/assets/css',
            'styles' => [],
            'editor_styles' => [],
            'scripts' => [],
            'variations' => [],
            'areas' => [],
            'pattern_categories' => [],
            'load_text_domain' => false
        ];

        /**
         * Default theme options
         */
        private $default_theme_options = [
            'remote_patterns' => 'none',
            'curated_patterns' => '',
            'unregister_theme_patterns' => '0'
        ];
        
        
        /**
         * $textdomain
         * used for theme options, style and scripts naming
         * and also for loading the text domain if desired
         */
        public $textdomain;


        /**
         * array of theme supports for instance ['wp-block-styles']
         * do not include the feature 'editor-style' here
         * see editor-style parameter
         */
        public $theme_supports;


        /**
         * folder for custom block styles
         */
        public $custom_block_styles_folder;


        /**
         * theme styles files to enqueue
         * array
         */
        public $styles;


        /**
         * editor styles
         * if not empty then the feature 'editor-style' is added
         * array
         */
        public $editor_styles;


        /**
         * array $src $deps
         */
        public $scripts;


        /**
         * array of block style variations
         */
        public $variations;


        /**
         * Additional custom template areas to register
         */
        public $areas;


        /**
         * array of pattern categories to register
         */
        public $pattern_categories;


        /**
         * modifies excerpt more or removes it if left empty
         */
        public $excerpt_more;


        /**
         * wheather or not should load textdomain
         */
        public $load_text_domain;


        /**
         * Theme options as chhosen in the theme settings page
         */
        private $options;


        /**
         * Initializes parameters and calls all the functions to set up the theme
         */
        public function __construct(
            array $theme_params
        ) {
            if ( $theme_params['textdomain'] != '' ) {
                $this->textdomain = sanitize_title( $theme_params['textdomain'] );
                $this->initialize_params( $theme_params );
            } else {
                die( 'texdomain must be a non empty string' );
            }
            

            /**
             * Setting up the theme by calling action hooks or setting filters
             */
            $this->addThemeSupports( $this->theme_supports );
            $this->addCustomBlockStyles( $this->custom_block_styles_folder );
            $this->addStyles( $this->textdomain, $this->styles );
            $this->addEditorStyles( $this->editor_styles );
            $this->addScripts( $this->textdomain, $this->scripts );
            $this->addBlockStyleVariations( $this->variations );
            $this->addPatternCategories( $this->pattern_categories );
            $this->modifyExcerptMore( $this->excerpt_more );
            $this->loadTextDomain( $this->textdomain );
            add_filter( 'default_wp_template_part_areas', 
                [$this, 'addCustomAreas'], 10, 1 );


            /**
             * Show or hide certain patterns according to the theme settings
             */
            if ( $this->options['unregister_theme_patterns'] == '1' ) {
                $this->removeThemePatterns();
            }
            if ($this->options['remote_patterns']=='none' ) {
                // remote block patterns are not loaded
                $this->actionAfterSetup( function() {
                    remove_theme_support( 'core-block-patterns' );
                });
                
            } elseif ( $this->options['remote_patterns']=='curated' ) {
                $this->actionAfterSetup( function() {
                    remove_theme_support( 'core-block-patterns' );
                });
                // filter theme.json with the list of curated patterns
                add_filter( 'wp_theme_json_data_theme', 
                    [$this, 'filterThemeJsonPatterns'], 10, 1 );
            }

        }


        /**
         * Initialize theme params
         */
        private function initialize_params( $theme_params ) {

            $theme_params = wp_parse_args( $theme_params, $this->defaults );

            $this->theme_supports = $theme_params['theme_supports'];
            $this->styles = $theme_params['styles'];
            $this->editor_styles = $theme_params['editor_styles'];
            $this->scripts = $theme_params['scripts'];
            $this->variations = $theme_params['variations'];
            $this->custom_block_styles_folder = $theme_params['custom_block_styles_folder'];
            $this->pattern_categories = $theme_params['pattern_categories'];
            $this->areas = $theme_params['areas'];
            if ( isset( $theme_params['excerpt_more'] ) ) {
                $this->excerpt_more = $theme_params['excerpt_more'];
            }
            $this->load_text_domain = $theme_params['load_text_domain'] ? true : false;
            
            $this->options = wp_parse_args(
                get_option( $this->textdomain.'_theme_options' ),
                $this->default_theme_options
            );
        }


        /**
         * Adds theme supports except the 'editor-styles'
         * which is added when adding css to the editor
         * see the addEditorStyle functions
         */
        public function addThemeSupports( $theme_supports ) {
            if ( ! empty( $theme_supports ) ) {
                $this->actionAfterSetup( function() use ( $theme_supports ) {
                    foreach ( $theme_supports as $feature ) {
                        if ($feature != 'editor-styles' ) {
                            add_theme_support($feature);
                        }
                    }
                });
            }
        }


        /**
         * Add all custom block styles found in the custom styles folder
         * These styles are only included in a page that use the blocks with custom styles
         */
        public function addCustomBlockStyles( $custom_block_styles_folder ) {
            if ( $custom_block_styles_folder != '' ) {
                $this->addAction( 'init', function() use ( $custom_block_styles_folder ) {
                    // Scan our styles folder to locate block styles.
                    $files = glob( get_template_directory() . $custom_block_styles_folder . '/*.css' );
                    foreach ( $files as $file ) {
                        // Get the filename and core block name.
                        $filename   = basename( $file, '.css' );
                        $block_name = str_replace( 'core-', 'core/', $filename );
                        wp_enqueue_block_style(
                            $block_name,
                            array(
                                'handle' => $this->textdomain . "-block-{$filename}",
                                'src'    => get_theme_file_uri( $custom_block_styles_folder . "/{$filename}.css" ),
                                'path'   => get_theme_file_path( $custom_block_styles_folder . "/{$filename}.css" ),
                            )
                        );
                    }
                });
            }
        }


        /**
         * Enqueues css files
         */
        public function addStyles( $textdomain, $styles ) {
            if ( ! empty( $styles ) ) {
                foreach ( $styles as $style ) {
                    $this->actionEnqueueScripts( function() use ( $textdomain, $style ) {
                        wp_enqueue_style(
                            sanitize_title($textdomain) . '-' . basename( $style, '.css' ),
                            get_template_directory_uri() . '/' . $style,
                            array(),
                            wp_get_theme()->get( 'Version' )
                        );
                    });
                }
            }
        }


        /**
         * Adds support for editor styles and then adds a css in the editor
         * https://developer.wordpress.org/reference/functions/add_editor_style/
         */
        public function addEditorStyles( $editor_styles ) {
            if ( ! empty( $editor_styles ) ) {
                add_theme_support( 'editor-styles' );
                foreach ( $editor_styles as $editor_style ) {
                    $this->actionAfterSetup( function() use ( $editor_style ) {
                        add_editor_style( $editor_style );
                    });
                }
            }
        }


        /**
         * Enqueues scripts in the footer
         */
        public function addScripts( $textdomain, $scripts ) {
            if ( !empty($scripts) ) {
                foreach ( $scripts as $script ) {
                    $this->actionEnqueueScripts( function() use ( $textdomain, $script ) {
                        wp_enqueue_script(
                            sanitize_title( $textdomain ) . '-' . basename( $script['src'], '.js' ),
                            get_template_directory_uri() . $script['src'],
                            $script['deps'],
                            wp_get_theme()->get( 'Version' ),
                            true
                        );
                    });
                }
            }
        }


        /**
         * Adds all the block style variations used by the theme
         */
        public function addBlockStyleVariations(array $variations) {
            if ( !empty($variations) ) {
                $this->addAction('init', function() use ( $variations ) {
                    foreach ( $variations as $block => $block_variations ) {
                        foreach ( $block_variations as $name => $label ) {
                            register_block_style( 
                                $block,
                                [
                                    'name' => $name,
                                    'label' => $label
                                ]
                            );
                        }
                    }
                }, 30);
            }
        }


        /**
         * Adds all new pattern categories used by the theme
         * Ideally, themes should use most of the predefined core categories and should
         * register the minimum number of new categories possible
         */
        public function addPatternCategories( array $pattern_categories ) {
            if ( isset($pattern_categories) ) {
                $filtered_pattern_categories = apply_filters(
                    'theme_pattern_categories', 
                    $pattern_categories,
                    10, 1
                );
                $this->addAction('init', function() use ( $filtered_pattern_categories ) {
                    foreach ( $filtered_pattern_categories as $category ) {
                        register_block_pattern_category(
                            $category['category_name'],
                            $category['category_properties']
                        );
                    }
                });
            }
        }


        /**
         * Removes patterns previously registered by the theme
         * This function is used if the theme option 'unregister_theme_patterns' is checked
         */
        public function removeThemePatterns() {
            $this->addAction( 'init', function() {
                $files = glob( get_template_directory(). '/patterns/*.php' );
                foreach ( $files as $file ) {
                    $basename = basename( $file, '.php' );
                    $pattern_slug = 'dualtone/'.$basename;
                    unregister_block_pattern( $pattern_slug );
                }
            });
        }


        /**
         * Filters the theme.json file to modify the patterns property
         * according to the theme option 'curated_patterns_slugs'
         */
        public function filterThemeJsonPatterns( $theme_json ) {
            $curated = $this->options['curated_patterns_slugs'];
            $new_data = [
                'version' => 2,
                'patterns' => explode(',', $curated)
            ];
            return $theme_json->update_with($new_data);
        }


        /** 
         * Register custom areas
         * https://developer.wordpress.org/themes/templates/template-parts/#registering-custom-areas
         */
        public function addCustomAreas( $areas ) {
            if ( $this->areas ) {
                foreach ( $this->areas as $area ) {
                    $areas[] = $area;
                }
            }
            return $areas;
        }


        /**
         * Modifies the excerpt_more text
         */
        public function modifyExcerptMore( $excerpt_more ) {
            add_filter(
                'excerpt_more',
                function() use ( $excerpt_more ) {
                    return $excerpt_more;
                }
            );
        }


        /**
         * Load the texdomain
         */
        public function loadTextDomain( $textdomain ) {
            if ( $this->load_text_domain ) {
                $this->actionAfterSetup(function() use ( $textdomain ){
                    load_theme_textdomain(
                        $textdomain,
                        get_parent_theme_file_path( 'assets/lang' )
                    );
                });
            }
        }


        /**
         * Attaches a function to the after_setup_theme hook
         */
        private function actionAfterSetup( $function ) {
            add_action('after_setup_theme', function() use ( $function ) {
                $function();
            });
        }


        /**
         * Attaches a function to the wp_enqueue_scripts hook
         */
        private function actionEnqueueScripts( $function ) {
            add_action('wp_enqueue_scripts', function() use ( $function ) {
                $function();
            });
        }


        /**
         * Attaches a function to a hook passed as parameter
         */
        private function addAction( $action, $function ) {
            add_action( $action, function() use ( $function ){
                $function();
            });
        }


    } // endclass


} // endif ! class_exists
