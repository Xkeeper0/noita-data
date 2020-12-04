
-- Shims are mostly (mock) reimplementations of functions here:
-- Noita\tools_modding\lua_api_documentation.txt
-- Obviously since we aren't Noita we can't provide the real ones,
-- so we have to provide enough fakes to make things work

-- Based vaguely off of the reload_dofile func in
-- data\entities\_debug\debug_menu.lua
-- Global table of dofile_once'd files
__loaded = {}
function dofile_once(filename)
	__loaded[filename] = true
	dofile(filename)
end


-- Stuff that will eventually need to be split out
-- for organizational reasons
NoitaData = {}


-- Load other shims
require("shims.game-logic")
require("shims.entities")
require("shims.spells")
