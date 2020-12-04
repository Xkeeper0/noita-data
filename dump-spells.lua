
json = require("libs.json")
require("shims")

dofile("data/scripts/gun/gun_collect_metadata.lua")


print(json.encode(NoitaData.spells))
--[[
for k, v in pairs(NoitaData.spells) do
	-- action_id
	-- fire_rate_wait
	-- reload_time
	-- lifetime_add
	print(string.format("%-30s   CD %6.2f   RC %6.2f", v.action_id, v.fire_rate_wait * 0.01, v.reload_time * 0.01))

end
--]]
