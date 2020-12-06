
NoitaData.spells = {}

local __registered_projectiles = {}

-- Used when the game is getting spell information
-- This func is called to register a projectile created from a spell
-- This appears to be some weird global thing, RegisterGunAction
-- will clear the table it uses when called
function Reflection_RegisterProjectile(filename)
	table.insert(__registered_projectiles, filename)
end

function ConfigGunActionInfo_PassToGame()
	error("Something called this! Oh no!")
end

-- The Lua engine ordinarily passes this information back
-- to the game using this function, but in this case we
-- actually want the projectile information
-- see data\scripts\gun\gunaction_generated.lua
-- function ConfigGunActionInfo_PassToGame( value )
-- Yes it really has 500 arguments.
function RegisterGunAction(
	action_id,
	action_name,
	action_description,
	action_sprite_filename,
	action_unidentified_sprite_filename,
	action_type,
	action_spawn_level,
	action_spawn_probability,
	action_spawn_requires_flag,
	action_spawn_manual_unlock,
	action_max_uses,
	custom_xml_file,
	action_mana_drain,
	action_is_dangerous_blast,
	action_draw_many_count,
	action_ai_never_uses,
	action_never_unlimited,
	state_shuffled,
	state_cards_drawn,
	state_discarded_action,
	state_destroyed_action,
	fire_rate_wait,
	speed_multiplier,
	child_speed_multiplier,
	dampening,
	explosion_radius,
	spread_degrees,
	pattern_degrees,
	screenshake,
	recoil,
	damage_melee_add,
	damage_projectile_add,
	damage_electricity_add,
	damage_fire_add,
	damage_explosion_add,
	damage_critical_chance,
	damage_critical_multiplier,
	explosion_damage_to_materials,
	knockback_force,
	reload_time,
	lightning_count,
	material,
	material_amount,
	trail_material,
	trail_material_amount,
	bounces,
	gravity,
	light,
	blood_count_multiplier,
	gore_particles,
	ragdoll_fx,
	friendly_fire,
	physics_impulse_coeff,
	lifetime_add,
	sprite,
	extra_entities,
	game_effect_entities,
	sound_loop_tag,
	projectile_file
)

	local spell = {}
	if projectile_file == "" then
		projectile_file = __registered_projectiles
	end
	__registered_projectiles = {}

	spell.action_id = action_id
	spell.action_name = action_name
	spell.action_description = action_description
	spell.action_sprite_filename = action_sprite_filename
	spell.action_unidentified_sprite_filename = action_unidentified_sprite_filename
	spell.action_type = action_type
	spell.action_spawn_level = action_spawn_level
	spell.action_spawn_probability = action_spawn_probability
	spell.action_spawn_requires_flag = action_spawn_requires_flag
	spell.action_spawn_manual_unlock = action_spawn_manual_unlock
	spell.action_max_uses = action_max_uses
	spell.custom_xml_file = custom_xml_file
	spell.action_mana_drain = action_mana_drain
	spell.action_is_dangerous_blast = action_is_dangerous_blast
	spell.action_draw_many_count = action_draw_many_count
	spell.action_ai_never_uses = action_ai_never_uses
	spell.action_never_unlimited = action_never_unlimited
	spell.state_shuffled = state_shuffled
	spell.state_cards_drawn = state_cards_drawn
	spell.state_discarded_action = state_discarded_action
	spell.state_destroyed_action = state_destroyed_action
	spell.fire_rate_wait = fire_rate_wait
	spell.speed_multiplier = speed_multiplier
	spell.child_speed_multiplier = child_speed_multiplier
	spell.dampening = dampening
	spell.explosion_radius = explosion_radius
	spell.spread_degrees = spread_degrees
	spell.pattern_degrees = pattern_degrees
	spell.screenshake = screenshake
	spell.recoil = recoil
	spell.damage_melee_add = damage_melee_add
	spell.damage_projectile_add = damage_projectile_add
	spell.damage_electricity_add = damage_electricity_add
	spell.damage_fire_add = damage_fire_add
	spell.damage_explosion_add = damage_explosion_add
	spell.damage_critical_chance = damage_critical_chance
	spell.damage_critical_multiplier = damage_critical_multiplier
	spell.explosion_damage_to_materials = explosion_damage_to_materials
	spell.knockback_force = knockback_force
	spell.reload_time = reload_time
	spell.lightning_count = lightning_count
	spell.material = material
	spell.material_amount = material_amount
	spell.trail_material = trail_material
	spell.trail_material_amount = trail_material_amount
	spell.bounces = bounces
	spell.gravity = gravity
	spell.light = light
	spell.blood_count_multiplier = blood_count_multiplier
	spell.gore_particles = gore_particles
	spell.ragdoll_fx = ragdoll_fx
	spell.friendly_fire = friendly_fire
	spell.physics_impulse_coeff = physics_impulse_coeff
	spell.lifetime_add = lifetime_add
	spell.sprite = sprite
	spell.extra_entities = extra_entities
	spell.game_effect_entities = game_effect_entities
	spell.sound_loop_tag = sound_loop_tag
	spell.projectile_file = projectile_file

	-- for k, v in pairs(spell) do
	-- 	print(k, v)
	-- end
	assert(not NoitaData.spells[spell.action_id], "duplicate spell: ".. spell.action_id)

	NoitaData.spells[action_id] = spell
end
