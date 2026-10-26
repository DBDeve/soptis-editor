<?php

    if ( ! defined( 'ABSPATH' ) ) exit;

    /**
     * 1. Abilita l'interfaccia di spaziatura a livello di tema usando l'API ufficiale di WordPress
    */
    function soptis_editor_impostazioni_spaziatura( $theme_json ) {
        
        // Configurazione valida secondo le specifiche del file theme.json
        $nuove_impostazioni = array(
            'version'  => 3,
            'settings' => array(
                'spacing' => array(
                    'margin'        => true,
                    'padding'       => true,
                    'customMargin'  => true,
                    'customPadding' => true,
                ),
                'border' => array(
                    'color'  => true,
                    'radius' => true,
                    'style'  => true,
                    'width'  => true,
                ),
            ),
        );

        // Usa il metodo nativo corretto 'update_with' per fondere i dati
        return $theme_json->update_with( $nuove_impostazioni );
    }
    add_filter( 'wp_theme_json_data_theme', 'soptis_editor_impostazioni_spaziatura' );

    function soptis_editor_aggiungi_supporto_spaziature( $settings, $metadata ) {
    
        // I blocchi nativi a cui vuoi assegnare i controlli
        $blocchi_da_modificare = array(
            // --- Layout e Contenitori ---
            'core/group',
            'core/columns',
            'core/column',
            'core/cover',
            'core/media-text',

            // --- Elementi di Testo e Tipografia ---
            'core/paragraph',
            'core/heading',
            'core/list',
            'core/table',
            'core/quote',
            'core/pullquote',
            'core/code',
            'core/preformatted',
            'core/verse',
            'core/details',

            // --- Pulsanti e Navigazione ---
            'core/buttons',
            'core/button',
            'core/navigation',

            // --- Elementi Media ---
            'core/image',
            'core/gallery',
            'core/avatar',

            // --- Blocchi del Tema e Query Loop ---
            'core/site-title',
            'core/site-logo',
            'core/site-tagline',
            'core/query',
            'core/post-title',
            'core/post-content',
            'core/post-excerpt',
            'core/post-featured-image',
            'core/post-date',
            'core/post-author',
            'core/post-terms',
            'core/comments'
        );


        if ( in_array( $metadata['name'], $blocchi_da_modificare, true ) ) {
            if ( ! isset( $settings['supports'] ) ) {
                $settings['supports'] = array();
            }
            if ( ! isset( $settings['supports']['spacing'] ) ) {
                $settings['supports']['spacing'] = array();
            }

            $settings['supports']['spacing']['margin']  = true;
            $settings['supports']['spacing']['padding'] = true;

            // 3. AGGIUNGI QUESTO: Attiva il supporto ai bordi per il blocco
            $settings['supports']['border'] = array(
                'color'  => true,
                'radius' => true,
                'style'  => true,
                'width'  => true,
            );

        }

        return $settings;
    }
    add_filter( 'block_type_metadata_settings', 'soptis_editor_aggiungi_supporto_spaziature', 10, 2 );


?>