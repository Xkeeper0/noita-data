<!doctype html>
<html>
<head>
	<title>Noita spell list</title>
	<style type="text/css">
		body {
			background-color: #000;
			color: #eee;
			font-family: Verdana, sans-serif;
			font-size: 80%;
			}

		a:visited, a:link { color: #88f; text-decoration: none; }
		a:hover { color: #ccf; }

		.l { text-align: left; }
		.c { text-align: center; }
		.r { text-align: right; }
		.hidden { display: none; }

		.icon {
			width: 32px;
			height: 32px;
			image-rendering: pixelated;
			}

		.table {
			position: relative;
			border-collapse: collapse;
		}

		.table tr {
			background-color: #181820;
		}

		.table th {
			background-color: #223;
			box-shadow: 1px 0px black;
		}

		.table thead th {
			position: sticky;
			top: 0;
			z-index: 9999;
			cursor: pointer;
		}

		.table tbody th {
			position: sticky;
			left: 0;
		}

		.table td, .table th {
			padding: 0.25em 0.75em;
			border: 1px solid black;
		}

		.unchanged {
			color: #666;
			background-color: #0a0a10;
			}

		.vert {
			writing-mode: vertical-rl;
			text-orientation: mixed;
			}

		.name { white-space: nowrap; }
		.desc {
			font-weight: normal;
			font-size: 80%;
			}

		.deg::after { content: '°'; }
		.time::after { content: 's'; }
		.mult::after { content: '×'; }
	</style>
</head>
<body>
<?php

	$spells_json	= file_get_contents("output/spells.json");
	$spells_data	= json_decode($spells_json, true);
	$spells			= [];

	function sort_noita_spells($a, $b) {
		return strcasecmp(NoitaTranslation::getText($a->action_name), NoitaTranslation::getText($b->action_name));
	}


	foreach ($spells_data as $spell_id => $spell) {
		$spells[$spell_id]	= new Spell($spell);
	}
	uasort($spells, 'sort_noita_spells');


	$cols = [
		// 'action_name' => ["action_name", "%s"],
		// 'action_description' => ["action_description", "%s"],
		// 'action_sprite_filename' => ["action_sprite_filename", "%s"],
		// 'action_unidentified_sprite_filename' => ["action_unidentified_sprite_filename", "%s"],
		'action_type' => ["action_type", "%s", "l", "action_type"],
		// 'action_spawn_level' => ["action_spawn_level", "%s"],
		// 'action_spawn_probability' => ["action_spawn_probability", "%s"],
		'action_spawn_requires_flag' => ["action_spawn_requires_flag", "%s", "l", "unlock_flag"],
		'action_spawn_manual_unlock' => ["action_spawn_manual_unlock", "%s", "c", "yes_no"],
		'action_max_uses' => ["action_max_uses", "%d", "r", "max_uses"],
		// 'custom_xml_file' => ["custom_xml_file", "%s"],
		'action_mana_drain' => ["action_mana_drain", "%d", "r"],
		// 'action_is_dangerous_blast' => ["action_is_dangerous_blast", "%s"],
		'action_draw_many_count' => ["action_draw_many_count", "%d", "r"],
		// 'action_ai_never_uses' => ["action_ai_never_uses", "%s"],
		'action_never_unlimited' => ["action_never_unlimited", "%s", "c", "yes_no"],
		// 'state_shuffled' => ["state_shuffled", "%s"],
		// 'state_cards_drawn' => ["state_cards_drawn", "%s"],
		// 'state_discarded_action' => ["state_discarded_action", "%s"],
		// 'state_destroyed_action' => ["state_destroyed_action", "%s"],
		'fire_rate_wait' => ["fire_rate_wait", "%.2f", "r time", "frac_100"],
		'reload_time' => ["reload_time", "%.2f", "r time", "frac_100"],
		'speed_multiplier' => ["speed_multiplier", "%.2f", "r mult"],
		'child_speed_multiplier' => ["child_speed_multiplier", "%.2f", "r mult"],
		'dampening' => ["dampening", "%s"],
		'spread_degrees' => ["spread_degrees", "%.1f", "r deg"],
		'pattern_degrees' => ["pattern_degrees", "%.1f", "r deg"],
		'screenshake' => ["screenshake", "%.1f", "r"],
		'recoil' => ["recoil", "%s", "r"],
		'damage_melee_add' => ["damage_melee_add", "%s", "r", "damage"],
		'damage_projectile_add' => ["damage_projectile_add", "%s", "r", "damage"],
		'damage_electricity_add' => ["damage_electricity_add", "%s", "r", "damage"],
		'damage_fire_add' => ["damage_fire_add", "%s", "r", "damage"],
		'damage_explosion_add' => ["damage_explosion_add", "%s", "r", "damage"],
		'explosion_radius' => ["explosion_radius", "%d", "r"],
		'damage_critical_chance' => ["damage_critical_chance", "%d%%", "r"],
		'damage_critical_multiplier' => ["damage_critical_multiplier", "%s", "r"],
		'explosion_damage_to_materials' => ["explosion_damage_to_materials", "%s", "r"],
		'knockback_force' => ["knockback_force", "%s", "r"],
		'lightning_count' => ["lightning_count", "%s", "r"],
		'material' => ["material", "%s", "l"],
		'material_amount' => ["material_amount", "%s", "r"],
		'trail_material' => ["trail_material", "%s", "l"],
		'trail_material_amount' => ["trail_material_amount", "%s", "r"],
		'bounces' => ["bounces", "%s", "r"],
		'gravity' => ["gravity", "%s", "r"],
		// 'light' => ["light", "%s", "r"],
		// 'blood_count_multiplier' => ["blood_count_multiplier", "%s", "r"],
		'gore_particles' => ["gore_particles", "%s", "r"],
		'ragdoll_fx' => ["ragdoll_fx", "%s", "r"],
		'friendly_fire' => ["friendly_fire", "%s", "c", "yes_no"],
		// 'physics_impulse_coeff' => ["physics_impulse_coeff", "%s", "r"],
		'lifetime_add' => ["lifetime_add", "%0.2f", "r time", "frac_100"],
		// 'sprite' => ["sprite", "%s", "r"],
		// 'sound_loop_tag' => ["sound_loop_tag", "%s", "l"],
		'extra_entities' => ["extra_entities", "%s", "l", "csv_links"],
		'game_effect_entities' => ["game_effect_entities", "%s", "l", "csv_links"],
		'projectile_file' => ["projectile_file", "%s", "l", "csv_links_array"],
	];

?>
<table class='table'>
	<thead>
		<tr>
			<th>unid</th>
			<th>icon</th>
			<th>ID</th>
<?php

	foreach ($cols as $col) {
		print "
			<th><div class='vert'>$col[0]</div></th>
		";
	}
?>
		</tr>
	</thead>
	<tbody>
<?php

	// var_dump(call_user_func(["SpellDataFormatter", "frac_100"], 1));
	// var_dump(call_user_func(["SpellDataFormatter", "frac_100"], 100));
	// var_dump(call_user_func(["SpellDataFormatter", "frac_100"], 2.50));
	// die();

	foreach ($spells as $id => $spell) {
		$changes = $spell->get_modified_values();

		print "
		<tr>
			<td><span class='hidden'>". $spell->action_unidentified_sprite_filename ."</span><img class='icon' title='". $spell->action_unidentified_sprite_filename ."' src='". $spell->action_unidentified_sprite_filename ."'></td>
			<td><span class='hidden'>". $spell->action_sprite_filename ."</span><img class='icon' title='". $spell->action_sprite_filename ."' src='". $spell->action_sprite_filename ."'></td>
			<th class='l'>
			<span class='name' title=\"". htmlspecialchars($spell->action_id) ."\">". NoitaTranslation::getText($spell->action_name) ."</span>
			<br><span class='desc'>". NoitaTranslation::getText($spell->action_description) ."</span></th>
		";

		foreach ($cols as $key => $col) {
			if (isset($col[3])) {
				$val	= call_user_func(array("SpellDataFormatter", $col[3]), $spell->$key);
			} else {
				$val	= sprintf($col[1], $spell->$key);
			}
			$classes = isset($col[2]) ? $col[2] : "";	// still rockin php 5.5 somewhere, rip
			if (!isset($changes[$key])) {
				$classes .= " unchanged";
			}
			print "
			<td class='$classes'>$val</td>
			";
		}


		print "
		</tr>
		";

	}
?>

	</tbody>
	</table>
<script>
	// Stolen and modified from stackoverflow to make it actually work
	// apparently nobody uses <thead> / <tbody>  :(
	// https://stackoverflow.com/questions/14267781/sorting-html-table-with-javascript/53880407

	const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;
	const comparer = (idx, asc) => (a, b) => ((v1, v2) =>
		v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
		)(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

	document.querySelectorAll('thead th').forEach(th => th.addEventListener('click', (() => {
		const table = th.closest('table');
		const tbody = table.querySelector('tbody');
		Array.from(tbody.querySelectorAll('tr'))
			.sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
			.forEach(tr => tbody.appendChild(tr) );
	})));

</script>
</body>
</html>
<?php
	// $spell = new Spell([]);
	// foreach (Spell::$defaults as $k => $v) {
	// 	print "$k => $v<br>";
	// }

	class NoitaTranslation {
		protected static $table = null;

		protected static function init() {
			static::$table = [];
			static::readCSV('data/translations/common.csv');
			static::readCSV('data/translations/common_dev.csv');
		}

		protected static function readCSV($csvFilename) {
			$csv = fopen($csvFilename, "r");
			if ($csv === false) {
				throw new \Exception("Failed to open file $csvFilename");
			}

			$n = 0;
			while (($data = fgetcsv($csv)) !== FALSE) {
				$n++;
				if ($n <= 1) continue;

				// Still plenty of these of course
				// if (isset(static::$table[$data[0]])) {
				// 	print "duplicate translation key: $data[0]\n";
				// }
				static::$table[$data[0]] = $data[1];
			}
			fclose($csv);
		}

		public static function getText($key) {
			if (static::$table === null) {
				static::init();
			}

			// Remove the $ from the start of translation keys
			if ($key[0] === '$') {
				$key = substr($key, 1);
			}

			if (isset(static::$table[$key])) {
				return static::$table[$key];
			}

			// If we don't have an actual string for this, just return
			// the "key" itself (in the case that it's raw text)
			return $key;
		}
	}


	class Spell {
		protected $_data = [];
		public static $defaults = null;

		const ACTION_TYPE_PROJECTILE	= 0;
		const ACTION_TYPE_STATIC_PROJECTILE = 1;
		const ACTION_TYPE_MODIFIER	= 2;
		const ACTION_TYPE_DRAW_MANY	= 3;
		const ACTION_TYPE_MATERIAL	= 4;
		const ACTION_TYPE_OTHER		= 5;
		const ACTION_TYPE_UTILITY		= 6;
		const ACTION_TYPE_PASSIVE		= 7;


		public function __construct($data) {
			if (static::$defaults === null) {
				static::init_defaults();
			}
			$this->_data = $data;
		}

		public function __get($key) {
			return $this->_data[$key];
		}

		public function is_modified($key) {
			// if ($key == "child_speed_multiplier" && $this->_data[$key] !== null) {
			// 	print "<pre>";
			// 	var_dump($this->_data[$key]);
			// 	var_dump(static::$defaults[$key]);
			// 	die();
			// }
			return ($this->_data[$key] != static::$defaults[$key]);
		}

		public function get_modified_values() {
			$changed	= [];
			foreach ($this->_data as $k => $v) {
				if ($this->is_modified($k)) {
					$changed[$k] = $v;
				}
			}

			return $changed;
		}

		public static function init_defaults() {

			$defaults = [];
			$defaults["action_ai_never_uses"] = false;
			$defaults["action_description"] = "";
			$defaults["action_draw_many_count"] = 0;
			$defaults["action_id"] = "";
			$defaults["action_is_dangerous_blast"] = false;
			$defaults["action_mana_drain"] = 10;
			$defaults["action_max_uses"] = -1;
			$defaults["action_name"] = "";
			$defaults["action_never_unlimited"] = false;
			$defaults["action_spawn_level"] = "";
			$defaults["action_spawn_manual_unlock"] = false;
			$defaults["action_spawn_probability"] = "";
			$defaults["action_spawn_requires_flag"] = "";
			$defaults["action_sprite_filename"] = "";
			$defaults["action_type"] = static::ACTION_TYPE_PROJECTILE;
			$defaults["action_unidentified_sprite_filename"] = "data/ui_gfx/gun_actions/unidentified.png";
			$defaults["blood_count_multiplier"] = 1;
			$defaults["bounces"] = 0;
			$defaults["child_speed_multiplier"] = 1;
			$defaults["custom_xml_file"] = "";
			$defaults["damage_critical_chance"] = 0;
			$defaults["damage_critical_multiplier"] = 0;
			$defaults["damage_electricity_add"] = 0;
			$defaults["damage_explosion_add"] = 0;
			$defaults["damage_fire_add"] = 0;
			$defaults["damage_melee_add"] = 0;
			$defaults["damage_projectile_add"] = 0;
			$defaults["dampening"] = 1;
			$defaults["explosion_damage_to_materials"] = 0;
			$defaults["explosion_radius"] = 0;
			$defaults["extra_entities"] = "";
			$defaults["fire_rate_wait"] = 0;
			$defaults["friendly_fire"] = false;
			$defaults["game_effect_entities"] = "";
			$defaults["gore_particles"] = 0;
			$defaults["gravity"] = 0;
			$defaults["knockback_force"] = 0;
			$defaults["lifetime_add"] = 0;
			$defaults["light"] = 0;
			$defaults["lightning_count"] = 0;
			$defaults["material_amount"] = 0;
			$defaults["material"] = "";
			$defaults["pattern_degrees"] = 0;
			$defaults["physics_impulse_coeff"] = 0;
			$defaults["projectile_file"] = "";
			$defaults["ragdoll_fx"] = 0;
			$defaults["recoil"] = 0;
			$defaults["reload_time"] = 0;
			$defaults["screenshake"] = 0;
			$defaults["sound_loop_tag"] = "";
			$defaults["speed_multiplier"] = 1;
			$defaults["spread_degrees"] = 0;
			$defaults["sprite"] = "";
			$defaults["state_cards_drawn"] = 0;
			$defaults["state_destroyed_action"] = false;
			$defaults["state_discarded_action"] = false;
			$defaults["state_shuffled"] = false;
			$defaults["trail_material_amount"] = 0;
			$defaults["trail_material"] = "";

			static::$defaults = $defaults;
		}
	}


	class SpellDataFormatter {

		public static function frac_100($v) {
			if ($v === "") return "&mdash;";
			return sprintf("%0.2f", $v / 100);
		}

		public static function yes_no($v) {
			return ($v ? "&check;" : "&cross;");
		}

		public static function action_type($v) {
			$r[0] = "PROJECTILE";
			$r[1] = "STATIC_PROJECTILE";
			$r[2] = "MODIFIER";
			$r[3] = "DRAW_MANY";
			$r[4] = "MATERIAL";
			$r[5] = "OTHER";
			$r[6] = "UTILITY";
			$r[7] = "PASSIVE";
			return $r[$v];
		}

		public static function unlock_flag($v) {
			return str_replace("card_unlocked_", "", $v);
		}

		public static function damage($v) {
			return $v * 25;
		}

		public static function max_uses($v) {
			return ($v == 0 ? "&infin;" : $v);
		}

		public static function csv_links($v) {
			$e = explode(",", $v);
			$out = [];
			foreach ($e as $link) {
				if (!trim($link)) continue;
				$bits = explode("/", $link);
				$end = array_pop($bits);
				$out[] = "<a href='$link'>$end</a>";
			}
			return implode(", ", $out);

		}

		public static function csv_links_array($v) {
			// this is actually terrible
			return static::csv_links(implode(",", $v));
		}

	}

?>

