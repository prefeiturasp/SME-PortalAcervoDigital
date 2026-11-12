<?php

/**
 * Read query parameters without changing WordPress's request globals.
 * Checkbox filters accept both ?idioma=43 and ?idioma[]=43.
 */
function acervo_query_params(array $multiple = array()) {
    $keys = array(
        's', 'avanc', 'chave', 'categoria_acervo', 'palavra', 'area', 'areab',
        'alvo', 'alvob', 'desp', 'despb', 'modalidade', 'componente', 'idioma',
        'ano', 'formab', 'autor', 'setor', 'categ', 'modal', 'comp', 'tano',
        'forma', 'aut', 'idi', 'set', 'ano_da_publicacao_acervo_digital',
    );
    $params = array();
    foreach ($keys as $key) {
        $value = $_GET[$key] ?? '';
        if (in_array($key, $multiple, true)) {
            $values = is_array($value) ? $value : array($value);
            $params[$key] = array_values(array_filter($values, static function ($item) {
                return is_scalar($item) && (string) $item !== '';
            }));
        } else {
            $params[$key] = is_scalar($value) ? (string) $value : '';
        }
    }
    return $params;
}

/** ACF file fields can be empty; keep that distinction for partitioned files. */
function acervo_file_field($value) {
    return is_array($value) ? $value : array();
}

/** Extract the extension independently of dots in filenames and host names. */
function acervo_file_extension($value) {
    if (!is_string($value) || $value === '') {
        return '';
    }
    $path = parse_url($value, PHP_URL_PATH);
    return is_string($path) ? strtolower(pathinfo($path, PATHINFO_EXTENSION)) : '';
}

/** WordPress term queries return false or WP_Error when no list is available. */
function acervo_term_list($value) {
    return is_array($value) ? $value : array();
}
