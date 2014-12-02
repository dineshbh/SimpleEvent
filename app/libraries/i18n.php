<?php namespace Helpers;

class I18nHelper {
	/**
	 * [$lang description]
	 * @var [type]
	 */
	public static $lang = [
		'en' => [
			'index' => 'index',
			'historico' => 'history',
			'eixos' => 'thematic-axes',
			'atividades' => 'activities',
			'presencas' => 'confirmed-presence',
			'inscricoes' => 'registration',
			'prog_geral' => 'general-programme',
			'prog_cientifica' => 'scientific-programme',
			'prog_detalhada' => 'detailed-programme',
			'resumos' => 'abstract',
			'recomendacoes' => 'presentation-recomendation',
			'comissoes' => 'committee-consulants',
			'congressista' => 'congressist-profile',
			'pacotes' => 'travel-accommodation',
			'pos' => 'graduate-programme',
			'parceiras' => 'partner-institutions',
			'conheca' => 'about-teresina',
		],
		'fr' => [
			'index' => 'index',
			'historico' => 'historique',
			'eixos' => 'axes-tematiques',
			'atividades' => 'activites',
			'presencas' => 'presences-confirmees',
			'inscricoes' => 'inscriptions',
			'prog_geral' => 'programme-general',
			'prog_cientifica' => 'programme-cientifique',
			'prog_detalhada' => 'detaille-programme',
			'resumos' => 'consignes-auteurs',
			'recomendacoes' => 'recomendations-presentation-communications',
			'comissoes' => 'comissions',
			'congressista' => 'page-personalle',
			'pacotes' => 'voyage-hebergement',
			'pos' => 'graduate-programme',
			'parceiras' => 'institutions-partenaires',
			'conheca' => 'teresina',
		],
		'pt' => [
			'index' => 'index',
			'historico' => 'historico',
			'eixos' => 'eixos-tematicos',
			'atividades' => 'atividades',
			'presencas' => 'presencas-confirmadas',
			'inscricoes' => 'inscricoes',
			'prog_geral' => 'programacao-geral',
			'prog_cientifica' => 'programacao-cientifica',
			'prog_detalhada' => 'programacao-detalhada',
			'resumos' => 'resumos',
			'recomendacoes' => 'recomendacoes-apresentacao-trabalhos',
			'comissoes' => 'comissoes-consultores',
			'congressista' => 'pagina-congressista',
			'pacotes' => 'pacotes-Hospedagem',
			'pos' => 'programas-de-pos-graduacao',
			'parceiras' => 'instituicoes-parceiras',
			'conheca' => 'conheca-teresina',
		]
	];

	/**
	 * [$names description]
	 * @var [type]
	 */
	public static $names = [
		'index' => 'Página Inicial',
		'historico' => 'Histórico',
		'eixos' => 'Eixos Temáticos',
		'atividades' => 'Atividades',
		'presencas' => 'Presenças Confirmadas',
		'inscricoes' => 'Inscrições',
		'prog_geral' => 'Programação Geral',
		'prog_cientifica' => 'Programação Científica',
		'prog_detalhada' => 'Programação Detalhada',
		'resumos' => 'Resumos',
		'recomendacoes' => 'Recomendações para Apresentação de Trabalhos',
		'comissoes' => 'Comissões e Consultores',
		'congressista' => 'Página do Congressista',
		'pacotes' => 'Pacotes e Hospedagem',
		'pos' => 'Programas de Pós-Graduação',
		'parceiras' => 'Instituições Parceiras',
		'conheca' => 'Conheça e Teresina',
	];

	/**
	 * [$slugs description]
	 * @var [type]
	 */
	public static $slugs = ['index', 'historico', 'eixos', 'atividades', 'presencas', 'prog_geral', 'prog_cientifica', 'prog_detalhada', 'resumos', 'recomendacoes', 'comissoes', 'congressista', 'pacotes', 'pos', 'parceiras','conheca',];

	/**
	 * [trans description]
	 * @param  [type] $from [description]
	 * @param  [type] $to   [description]
	 * @param  [type] $slug [description]
	 * @param  [type] $last [description]
	 * @return [type]       [description]
	 */
	public static function trans($from, $to, $slug, $last)
	{
		if (($from == $to) ||
			($slug == 'index') ||
			(is_null($slug))) {

			if ($last) {
				$slug = $slug . '/' . $last;
			}

			return $slug;
		}

		foreach (self::$lang[$from] as $key => $value) {
			if ($value == $slug) {
				$slug = $key;
			}
		}

		foreach (self::$lang[$to] as $key => $value) {
			if ($key == $slug) {
				$slug = $value;
			}
		}

		if ($last) {
			$slug = $slug . '/' . $last;
		}

		return $slug;
	}

	/**
	 * [getPageFileNameFromSlug description]
	 * @param  [type] $lang [description]
	 * @param  [type] $slug [description]
	 * @return [type]       [description]
	 */
	public static function getPageFileNameFromSlug($lang, $slug)
	{
		$key = array_search($slug, self::$lang[$lang]);
		return $key ? $key : 'index';
	}

	/**
	 * [getPageNameFromSlug description]
	 * @param  [type] $slug [description]
	 * @return [type]       [description]
	 */
	public static function getPageNameFromSlug($slug)
	{
		return array_key_exists($slug, self::$names)
						? self::$names[$slug]
						: 'index';
	}
}