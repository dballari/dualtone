<?php

/**
 * Settings for the DualTone WordPress theme.
 *
 * @package	DualTone Settings
 * @author	David Ballarin Prunera
 * @license	GNU General Public License v3
 * @link	https://ballarinconsulting.com/dualtone
 */

/**
 * https://codex.wordpress.org/Creating_Options_Pages#External_Resources
 */

class DualToneSettingsPage
{
    public $textdomain;
    public $theme_options_name;

    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct($textdomain)
    {
        $this->textdomain = sanitize_title($textdomain);
        $this->theme_options_name = $this->textdomain . '_theme_options';
        $this->options = get_option( $this->theme_options_name );
        add_action( 'admin_menu', array( $this, 'add_theme_settings_page' ) );
        add_action( 'admin_init', array( $this, 'theme_settings_page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_theme_settings_page()
    {
        // This page will be under "Apperance"
        add_theme_page(
            'DualTone Settings Page',
            'DualTone settings', 
            'edit_theme_options',
            $this->textdomain,
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        ?>
        <style>
            .dualtone-settings p {
                font-size: 1rem;
                font-weight: 300;
                line-height: 1.6;
                max-width: 38rem;
            }
            .dualtone-settings label {
                font-weight: 600;
            }
            .dualtone-settings .section {
                max-width: 40rem;
            }
        </style>
        <div class="wrap dualtone-settings">
            <h1><?php _e( 'DualTone Theme Settings', 'dualtone' ); ?></h1>
            <p><?php _e( 'Thank\'s for using this theme. If you are and advanced site editor user, you may want to take a look at the following theme options.', 'dualtone' ); ?></p>

            <form method="post" action="options.php">
            <input type="hidden" 
                name="dualtone_theme_options[curated_patterns_slugs]" 
                value="<?php isset( $this->options['curated_patterns_slugs'] )  ? print($this->options['curated_patterns_slugs']) : ''; ?>">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'dualtone_group' );
                do_settings_sections( 'dualtone' );
                submit_button();
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function theme_settings_page_init()
    {        
        register_setting(
            'dualtone_group', // Option group
            'dualtone_theme_options', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'dualtone_inserter_options', // ID
            'Choose which patterns to show in the block inserter', // Title
            array( $this, 'print_section_info_inserter' ), // Callback
            $this->textdomain // Page
        );  

        add_settings_field(
            'remote_patterns', 
            'Remote patterns to include', 
            array( $this, 'remote_patterns' ), 
            $this->textdomain, 
            'dualtone_inserter_options'
        );

        add_settings_field(
            'pattern_slug', 
            'Add pattern slug to list', 
            array( $this, 'pattern_slug_add' ), 
            $this->textdomain, 
            'dualtone_inserter_options'
        );

        add_settings_field(
            'pattern_slug_remove', 
            'Remove pattern slug from list', 
            array( $this, 'pattern_slug_remove' ), 
            $this->textdomain, 
            'dualtone_inserter_options'
        );

        add_settings_field(
            'curated_patterns_slugs', 
            'Curated list of patterns', 
            array( $this, 'curated_patterns_slugs' ), 
            $this->textdomain, 
            'dualtone_inserter_options'
        );
        
        add_settings_section(
            'dualtone_unregister_section', // ID
            'Unregister theme patterns', // Title
            array( $this, 'print_section_info_unregister' ), // Callback
            $this->textdomain // Page
        );

        add_settings_field(
            'unregister_theme_patterns', 
            'Unregister theme patterns', 
            array( $this, 'unregister_theme_patterns' ), 
            $this->textdomain, 
            'dualtone_unregister_section'
        );

        
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();

        // Remote patterns
        if( isset( $input['remote_patterns'] ) ) {
            switch($input['remote_patterns'] ) {
                case 'all':
                    $new_input['remote_patterns'] = 'all';
                    break;
                case 'curated':
                    $new_input['remote_patterns'] = 'curated';
                    break;
                default:
                    $new_input['remote_patterns'] = 'none';
            }
        } else {
            $new_input['remote_patterns'] = '';
        }

        // Pattern slug to add
        if( isset( $input['pattern_slug'] ) && $input['pattern_slug']!= '' ) {
            $new_input['pattern_slug'] = sanitize_title( $input['pattern_slug'] );
            $new_input['curated_patterns_slugs'] = $this->addPattern($new_input['pattern_slug'], 
                $input['curated_patterns_slugs']);
            $new_input['pattern_slug'] = '';
        } else {
            $new_input['pattern_slug'] = '';
            $new_input['curated_patterns_slugs'] = $input['curated_patterns_slugs'];
        }

        // Pattern slug to remove
        if( isset( $input['pattern_slug_remove'] ) && $input['pattern_slug_remove'] != '' ) {
            $new_input['pattern_slug_remove'] = sanitize_title( $input['pattern_slug_remove'] );
            $new_input['curated_patterns_slugs'] = $this->removePattern($new_input['pattern_slug_remove'],
                $input['curated_patterns_slugs']);
            $new_input['pattern_slug_remove'] = '';
        } else {
            $new_input['pattern_slug_remove'] = '';
            $new_input['curated_patterns_slugs'] = $new_input['curated_patterns_slugs'];
        }

        // Unregister theme patterns
        if( isset( $input['unregister_theme_patterns'] ) ) {
            $new_input['unregister_theme_patterns'] = $input['unregister_theme_patterns'] === '1' ? '1' : '0';
        } else {
            $new_input['unregister_theme_patterns'] = '0';
        }

        return $new_input;
    }

    /**
     * Add pattern from list
     * 
     * @param string slug of the pattern to add
     */
    public function addPattern($pattern, $list) {
        if(isset($list) && $pattern != '') {
            // check if pattern to add does not already exist in the list
            // @TODO better in_array($pattern, explode(',', $list))
            if( strpos( $list, $pattern, 0) === FALSE ) {
                if($list == '') {
                    $list = $pattern;
                } else {
                    $list = $list . "," . $pattern;
                }
            }
        }
        return $list;
    }

    /**
     * Remove pattern from list
     * 
     * @param string slug of the pattern to remove
     */
    public function removePattern($pattern, $list) {
        if(isset($list) && $pattern != '') {
            $pos = strpos($list, $pattern, 0);
            // check if the pattern to remove exists in the list and is the first element of the list or not
            if( $pos === 0 ) {
                // first element
                $list = str_replace($pattern, '', $list);
                if(strpos($list, ',') === 0) {
                    // if more elements in the list remove first character which is a colon
                    $list = substr($list, 1);
                }
            } else {
                if($pos > 0) {
                    $list = str_replace(','.$pattern, '', $list);
                }
            }
        }
        return $list;
    }

    /** 
     * Print the Sections text
     */
    public function print_section_info_inserter()
    {
        print '<p>Choose \'none\' to see nothing but the theme patterns. This is the easiest choice.</p>';
        print '<p>Choose \'all\' if you want to see all remote patterns.</p>';
        print '<p>Choose \'only a list\' if you have a list of remote patterns you do want to see because you know they are compatible with your theme. If you want to start building your list, go to <a target="patterns" href="https://wordpress.org/patterns/">WordPress patterns</a> and look for the ones you like, then click on them, copy the title & paste it in the \'Add pattern slug to list\' field and finally, click on the `Add pattern\' button.</p>';
    }

    public function print_section_info_unregister()
    {
        print '<p>The theme patterns live inside the theme folder and you can see them in the site editor but cannot modify them. They are created for you to see examples of how blocks have to be put together in order to generate good results and follow the DualTone design. This patterns are for you to customize, so feel free to duplicate them and start making your own ones. Once you have completed your customizations, you may choose to hide the original ones and rely on your own patterns by clicking on the unregister theme patterns check box:</p>';
    }

    /** 
     * Print remote patterns section
     */
    public function remote_patterns()
    {
        ?>
            <select name="dualtone_theme_options[remote_patterns]" id="remote_patterns">
                <option <?php if (isset($this->options['remote_patterns'])) { echo $this->options['remote_patterns'] == 'none' ? 'selected': ''; } ?> value="none">None</option>
                <option <?php if (isset($this->options['remote_patterns'])) { echo $this->options['remote_patterns'] == 'all' ? 'selected': ''; } ?> value="all">All</option>
                <option <?php if (isset($this->options['remote_patterns'])) { echo $this->options['remote_patterns'] == 'curated' ? 'selected': ''; } ?> value="curated">Only a list of curated patterns</option>
            </select>
        <?php
    }
    public function pattern_slug_add()
    {
        printf(
            '<input type="text" id="pattern_slug" name="dualtone_theme_options[pattern_slug]" value="%s" />',
            isset( $this->options['pattern_slug'] ) ? esc_attr( $this->options['pattern_slug']) : ''
        );
        echo '<button>Add pattern</button>';
    }
    public function pattern_slug_remove()
    {
        printf(
            '<input type="text" id="pattern_slug_remove" name="dualtone_theme_options[pattern_slug_remove]" value="%s" />',
            isset( $this->options['pattern_slug_remove'] ) ? esc_attr( $this->options['pattern_slug_remove']) : ''
        );
        echo '<button>Remove pattern</button>';
    }
    public function curated_patterns_slugs()
    {
        ?>
        <textarea disabled name="slugs" id="" cols="60" rows="10"><?php isset( $this->options['curated_patterns_slugs'] )  ? print($this->options['curated_patterns_slugs']) : ''; ?></textarea>
        <?php
    }

    /** 
     * Print unregister theme patterns section
     */
    public function unregister_theme_patterns() {
        ?>
        <input style="margin-top: 2px;" type="checkbox" name="dualtone_theme_options[unregister_theme_patterns]" value="1" <?php isset($this->options['unregister_theme_patterns']) ? checked(1, $this->options['unregister_theme_patterns'], true) : ''; ?>/>
        <?php
    }
}
