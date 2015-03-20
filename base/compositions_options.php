<?php
/**
 * Gestion des tables du plugin Compositions Options
 *
 * @plugin     Compositions Options
 * @copyright  2015
 * @author     Michel @ Vertige ASBL
 * @licence    GNU/GPL
 */

if (!defined('_ECRIRE_INC_VERSION')) return;


function compositions_options_declarer_tables_interfaces ($interface) {

    $interface['table_des_tables']['compositions_options'] = 'compositions_options';

    return $interface;
}

function compositions_options_declarer_tables_principales ($tables_principales) {

    $tables_principales['spip_compositions_options'] = array(
        'field' => array(
            'composition' => "varchar(255) DEFAULT '' NOT NULL",
            'parametre'   => "tinytext DEFAULT '' NOT NULL",
            'valeur'      => "text DEFAULT '' NOT NULL",
        ),
        'key' => array(
            "KEY composition" => "composition",
        ),
    );

    return $tables_principales;
}