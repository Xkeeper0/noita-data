
require("shims")

--[[
	Unlike the spells version, we aren't using the "reflect" script:
	data/scripts/perks/perk_reflect.lua

	The register function only copies some basic information;
	- ID
	- Name
	- Icon, UI icon
	- Description

	This means a lot of information is lost that we would prefer to keep
--]]

dofile("data/scripts/perks/perk.lua")

_shim_convert_perks(perk_list)
local clean_perks = _shim_remove_perk_funcs(NoitaData.perks)

function print_perk_info(perk)

	-- stackable can also be nil if not set
	-- somewhat silly: there's "STACKABLE_DEFAULT = true" ...
	-- ...but a lot of things set their stackable value to this directly,
	-- so that's not much of a default, huh
	local m_stackable = "(unset)"
	if perk.stackable == true then
		m_stackable = "Yes"
	elseif perk.stackable == false then
		m_stackable = "No"
	end

	-- Enemies can be given perks if usable_by_enemies is set
	-- Perks can also run a function for enemy perks with func_enemy
	-- (compare to the normal "func")
	local m_enemy = "No"
	if perk.usable_by_enemies then
		m_enemy = perk.func_enemy and "Yes (func)" or "Yes"
	elseif perk.func_enemy then
		m_enemy = "No (func) !?!"
		error(perk.id .." isn't usable but has a func defined")
	end

	local m_game_effect = perk.game_effect and perk.game_effect or "None"
	local m_func = perk.func and "Yes" or "No"

	local padding = 70 - string.len(perk.id)
	local padstr = string.sub("----------------------------------------------------------------------------------------------------", 1, padding)

	--                   Game effect: XXXXXXXXXXXXXXXXXXXX     Func:         XXX
	--                   Stackable: XXX                        Enemy usable: XXX
	print(string.format("\n-- %s %s", perk.id, padstr))
	print(string.format("Name:        %s", GameTextGet(perk.ui_name)))
	print(string.format("Description: %s", GameTextGet(perk.ui_description)))
	print(string.format("Func:         %-3s             Game effect: %s", m_func, m_game_effect))
	print(string.format("Enemy usable: %-15s Stackable:   %s", m_enemy, m_stackable))
	if (perk.not_in_default_perk_pool) then
		print("Not in default perk pool")
	end
end


for k, v in pairs(NoitaData.perks) do
	print_perk_info(v)
end

-- JSON encoding requires removing the function calls
-- print(json.encode(_shim_remove_perk_funcs(NoitaData.perks)))

-- debug_print_table(clean_perks)

