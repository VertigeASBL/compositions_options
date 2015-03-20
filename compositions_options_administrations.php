<?php
/**
 * Fichier gérant l'installation et désinstallation du plugin Options des compositions
 *
 * @plugin     Options des compositions
 * @copyright  2015
 * @author     Michel @ Vertige ASBL
 * @licence    GNU/GPL
 * @package    SPIP\Compositions_options\Installation
 */

if (!defined('_ECRIRE_INC_VERSION')) return;


/**
 * Fonction d'installation et de mise à jour du plugin Options des compositions.
 *
 * @param string $nom_meta_base_version
 *     Nom de la meta informant de la version du schéma de données du plugin installé dans SPIP
 * @param string $version_cible
 *     Version du schéma de données dans ce plugin (déclaré dans paquet.xml)
 * @return void
**/
function compositions_options_upgrade($nom_meta_base_version, $version_cible) {
    $maj = array();

    $maj['create'] = array(
        array('maj_tables', array('spip_compositions_options'))
    );

    include_spip('base/upgrade');
    maj_plugin($nom_meta_base_version, $version_cible, $maj);
}


/**
 * Fonction de désinstallation du plugin Options des compositions.
 *
 * @param string $nom_meta_base_version
 *     Nom de la meta informant de la version du schéma de données du plugin installé dans SPIP
 * @return void
**/
function compositions_options_vider_tables($nom_meta_base_version) {

    sql_drop_table('spip_compositions_options');

    effacer_meta($nom_meta_base_version);
}