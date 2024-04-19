<?php

if( ! class_exists( 'DualToneTheme' ) ) {

    class DualToneTheme {

        public $textdomain;
        public $theme_supports;
        public $custom_block_styles_folder;
        public $style;
        public $editor_style;
        public $scripts;
        public $variations;
        public $areas;
        public $pattern_categories;
        public $excerpt_more;
        public $load_text_domain;
        public $options;

        public function __construct(
            array $theme_params
        ) {
            if(
                isset($theme_params['textdomain']) && 
                $theme_params['textdomain'] != ''
            ) {
                $this->textdomain = sanitize_title( $theme_params['textdomain'] );
            }
            if(
                isset($theme_params['theme_supports']) && 
                !empty($theme_params['theme_supports'])
            ) {
                $this->theme_supports = $theme_params['theme_supports'];
            }
            if(
                isset($theme_params['style']) && 
                $theme_params['style'] != ''
            ) {
                $this->style = $theme_params['style'];
            } else {
                $this->style = '';
            }
            if(
                isset($theme_params['editor_style']) && 
                $theme_params['editor_style'] != ''
            ) {
                $this->editor_style = $theme_params['editor_style'];
            }
            if(
                isset($theme_params['scripts']) && 
                !empty($theme_params['scripts'])
            ) {
                $this->scripts = $theme_params['scripts'];
            } else {
                $this->scripts  = [];
            }
            if(
                isset($theme_params['variations']) && 
                !empty($theme_params['variations'])
            ) {
                $this->variations = $theme_params['variations'];
            } else {
                $this->variations = [];
            }
            if(
                isset($theme_params['custom_block_styles_folder']) && 
                $theme_params['custom_block_styles_folder'] != ''
            ) {
                $this->custom_block_styles_folder = $theme_params['custom_block_styles_folder'];
            }
            if(
                isset($theme_params['pattern_categories']) && 
                !empty($theme_params['pattern_categories'])
            ) {
                $this->pattern_categories = $theme_params['pattern_categories'];
            } else {
                $this->pattern_categories = [];
            }
            if( isset($theme_params['areas'])) {
                $this->areas = $theme_params['areas'];
            } else {
                $this->areas = [];
            }

            if(
                isset($theme_params['excerpt_more'])
            ) {
                $this->excerpt_more = $theme_params['excerpt_more'];
            }
            if(
                isset($theme_params['load_text_domain']) 
            ) {
                $this->load_text_domain = $theme_params['load_text_domain'] ? true : false;
            }
            $this->options = get_option($this->textdomain.'_theme_options');
            if(!true) {
                echo '<pre>';
                var_dump($this);
                echo '</pre>';
                die();
            }
            if(!$this->options) {
                $this->options['unregister_theme_patterns'] = '0';
                $this->options['remote_patterns'] = 'none';
            }
            $this->addThemeSupports($this->theme_supports);
            $this->addCustomBlockStyles($this->custom_block_styles_folder);
            $this->addStyle($this->textdomain, $this->style);
            $this->addEditorStyle($this->editor_style);
            $this->addScripts($this->textdomain, $this->scripts);
            $this->addBlockStyleVariations($this->variations);
            $this->addPatternCategories($this->pattern_categories);
            if($this->options['unregister_theme_patterns'] == '1') {
                $this->removeThemePatterns();
            }
            $this->modifyExcerptMore($this->excerpt_more);
            $this->loadTextDomain($this->textdomain);
            if($this->options['remote_patterns']=='none') {
                // remote block patterns are not loaded
                // add_filter( 'should_load_remote_block_patterns', false, 10 );
                $this->actionAfterSetup( function() {
                    remove_theme_support( 'core-block-patterns' );
                });
                
            } elseif($this->options['remote_patterns']=='curated') {
                // filter theme.json with the list of curated patterns
                $this->actionAfterSetup( function() {
                    remove_theme_support( 'core-block-patterns' );
                });
                add_filter( 'wp_theme_json_data_theme', [$this, 'filterThemeJsonPatterns'], 10, 1 );
            }
            add_filter( 'default_wp_template_part_areas', [$this, 'addCustomAreas'], 10, 1 );
        }

        /**
         * Adds theme supports except the 'editor-styles' which is added when adding css to the editor
         * see the addEditorStyle functions
         */
        public function addThemeSupports($theme_supports) {
            if (!empty($theme_supports)) {
                $this->actionAfterSetup( function() use ($theme_supports) {
                    foreach($theme_supports as $feature) {
                        if($feature != 'editor-styles') {
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
        public function addCustomBlockStyles($custom_block_styles_folder) {
            if($custom_block_styles_folder != '') {
                $this->addAction('init', function() use ($custom_block_styles_folder) {
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
        public function addStyle($textdomain, $style) {
            if($style != '') {
                $this->actionEnqueueScripts( function() use ($textdomain, $style) {
                    wp_enqueue_style(
                        sanitize_title($textdomain),
                        get_template_directory_uri() . $style,
                        array(),
                        wp_get_theme()->get( 'Version' )
                    );
                });
            }
        }

        /**
         * Adds support for editor styles and then adds a css in the editor
         */
        public function addEditorStyle($editor_style) {
            if($editor_style != '') {
                $this->actionAfterSetup( function() use ($editor_style) {
                    add_theme_support('editor-styles');
                    add_editor_style($editor_style);
                });
            }
        }

        /**
         * Enqueues scripts in the footer
         */
        public function addScripts($textdomain, $scripts) {
            if(!empty($scripts)) {
                foreach($scripts as $script) {
                    $this->actionEnqueueScripts( function() use ($textdomain, $script) {
                        wp_enqueue_script(
                            sanitize_title($textdomain),
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
            if(!empty($variations)) {
                foreach($variations as $block => $block_variations) {
                    foreach($block_variations as $name => $label) {
                        register_block_style( 
                            $block,
                            [
                                'name' => $name,
                                'label' => $label
                            ]
                        );
                    }
                }
            }
        }

        /**
         * Adds all new pattern categories used by the theme
         * Ideally, themes should use most of the predefined core categories and should
         * register the minimum number of new categories possible
         */
        public function addPatternCategories(array $pattern_categories) {
            if(isset($pattern_categories)) {
                $filtered_pattern_categories = apply_filters(
                    'theme_pattern_categories', 
                    $pattern_categories,
                    10, 1
                );
                //var_dump($filtered_pattern_categories); die();
                $this->addAction('init', function() use ($filtered_pattern_categories) {
                    foreach($filtered_pattern_categories as $category) {
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
            $this->addAction('init', function() {
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
        public function filterThemeJsonPatterns($theme_json) {
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
        public function addCustomAreas($areas) {
            if($this->areas) {
                foreach($this->areas as $area) {
                    $areas[] = $area;
                }
            }
            return $areas;
        }

        /**
         * Modifies the excerpt_more text
         */
        public function modifyExcerptMore($excerpt_more) {
            add_filter(
                'excerpt_more',
                function() use ($excerpt_more) {
                    return $excerpt_more;
                }
            );
        }

        /**
         * Load the texdomain
         */
        public function loadTextDomain($textdomain) {
            if($this->load_text_domain) {
                $this->actionAfterSetup(function() use ($textdomain){
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
        private function actionAfterSetup($function) {
            add_action('after_setup_theme', function() use ($function) {
                $function();
            });
        }

        /**
         * Attaches a function to the wp_enqueue_scripts hook
         */
        private function actionEnqueueScripts($function) {
            add_action('wp_enqueue_scripts', function() use ($function) {
                $function();
            });
        }

        /**
         * Attaches a function to a hook passed as parameter
         */
        private function addAction($action, $function) {
            add_action($action, function() use ($function){
                $function();
            });
        }

    } // endclass

} // endif ! class_exists
