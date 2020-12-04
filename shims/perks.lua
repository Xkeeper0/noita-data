
NoitaData.perks = {}

function RegisterPerk(
	id,
	ui_name,
	ui_description,
	ui_icon,
	perk_icon
)
	--[[

	-- Copy passed ata into the perk table
	NoitaData.perks[id] = {
		id = id,
		ui_name = ui_name,
		ui_description = ui_description,
		ui_icon = ui_icon,
		perk_icon = perk_icon
	}

	--]]
end


-- Convert the perk list into an associative table
function _shim_convert_perks(perk_list)
	for k, v in pairs(perk_list) do
		assert(not NoitaData.perks[v.id], "duplicate perk: ".. v.id)
		NoitaData.perks[v.id] = v
	end
end

function _shim_remove_perk_funcs(perks)
	local clean_perks = table.clone(perks)
	for k, v in pairs(clean_perks) do
		clean_perks[k].func = nil
		clean_perks[k].func_enemy = nil
	end

	return clean_perks
end
