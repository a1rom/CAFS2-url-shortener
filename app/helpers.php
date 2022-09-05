<?php
if (!function_exists('asset')) {
	function asset($asset) {
		$manifestPath = ConfigRoutes::ROOT . '/public/mix-manifest.json';

		if (!is_file($manifestPath)) {
			throw new Exception('Manifest file not found', 500);
		}

		$manifest = file_get_contents($manifestPath);
		$manifest = json_decode($manifest, TRUE);

		if (is_array($manifest) && array_key_exists($asset, $manifest)) {
			return $manifest[$asset];
		}

		throw new Exception('Asset in manifest file not found', 500);
	}
}

if (!function_exists('dd')) {
	function dd() {
		array_map(function($x) {
            echo "<pre>";
			var_dump($x);
            echo "</pre>";
		}, func_get_args());

		die(0);
	}
}

if (!function_exists('d')) {
	function d() {
		array_map(function($x) {
            echo "<pre>";
			var_dump($x);
            echo "</pre>";
		}, func_get_args());
	}
}
?>