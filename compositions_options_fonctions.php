<?php
/**
 * Fonctions utiles au plugin Compositions Options
 *
 * @plugin     Compositions Options
 * @copyright  2015
 * @author     Michel @ Vertige ASBL
 * @licence    GNU/GPL
 */

if (!defined('_ECRIRE_INC_VERSION')) return;

/**
 * Retrouver ou éditer les options d'une composition
 *
 * Si on ne donne pas de $valeurs, on retourne les options existantes,
 * sinon on modifie les options
 *
 * @param String $composition : L'identifiant de la composition
 * @param array $valeurs : Un tableau clé => valeur de la forme
 *                         nom_option => valeur_option.
 *
 * @return mixed : Un tableau nom_option => valeur_option, ou un
 *                 message d'erreur si quelque chose s'est mal passé.
 */
function options_composition ($composition, $valeurs=NULL) {

    include_spip('base/abstract_sql');

    if (is_null($valeurs)) {
        $options = sql_allfetsel('parametre, valeur', 'spip_compositions_options',
                                 "composition='$composition'");

        $resultat = array();
        foreach ($options ?: array() as $option) {
            $resultat[$option['parametre']] = $option['valeur'];
        }

        return $resultat;
    }

    if ( ! is_array($valeurs)) {
        return "options_composition : Le paramètre $valeur doit être un tableau !";
    }

    foreach ($valeurs as $parametre => $valeur) {

        if (sql_countsel('spip_compositions_options',
                         array("composition='$composition'", "parametre='$parametre'"))) {

            sql_updateq('spip_compositions_options',
                        array('valeur' => $valeur),
                        array("composition='$composition'", "parametre='$parametre'"));

        } else {

            sql_insertq('spip_compositions_options',
                        array(
                            "composition" => $composition,
                            "parametre" => $parametre,
                            'valeur' => $valeur,
                        ));
        }
    }
}