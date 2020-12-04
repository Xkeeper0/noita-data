
-- Text and other associated stuff
local function add_strings(strings, csv_reader, report_dupes)
	for fields in csv_reader:lines() do
		if report_dupes and strings[fields[1]] and fields[1] ~= "" then
			if strings[fields[1]] == fields[2] then
				print(fields[1] .." -- redefined (text matches)")
			else
				print(fields[1] .." -- redefined")
				print("OLD: ".. strings[fields[1]])
				print("NEW: ".. fields[2])
			end
			print()
		end
		strings[fields[1]] = fields[2]
	end
end

function read_translations(report_dupes)
	local common = csv.open("data/translations/common.csv", { separator = "," })
	local common_dev = csv.open("data/translations/common_dev.csv", { separator = "," })

	local strings = {}
	add_strings(strings, common, report_dupes)
	add_strings(strings, common_dev, report_dupes)

	return strings

end

NoitaData.translations = read_translations()


-- GamePrintImportant( title:string, description:string = "", ui_custom_decoration_file:string = "" )
-- Prints out some fancy information
function GamePrintImportant(title, description, ui_custom_decoration_file)
	print(title, ui_custom_decoration_file)
	print(description)
end


-- GameTextGet( key, [optional] param0, [optional] param1, [optional] param2 ) -> string
-- Presumably returns text with some parameters placed in as $0, $1, and $2
function GameTextGet(key, param0, param1, param2)

	if not key or key == "" then
		-- Just return nothing if there's nothing to look up
		return ""
	end

	-- Keys seem to generally always start with $
	local first_char = string.sub(key, 1, 1)
	if first_char == "$" then
		key = string.sub(key, 2)
	end

	-- Get translated string
	local msg = nil
	if NoitaData.translations[key] then
		msg = NoitaData.translations[key]
	else
		msg = key
	end

	-- Replace parameters (if any)
	msg:gsub("%$0", param0 or "")
	msg:gsub("%$1", param1 or "")
	msg:gsub("%$2", param2 or "")

	return msg
end


-- GameTextGetTranslatedOrNot( text_or_key ) -> string
-- this function has basically no documentation
-- my assumption is that it tries to find a key and if that fails
-- or the key's text is nothing, it just returns the text
-- or possibly the english version, idk
function GameTextGetTranslatedOrNot(text_or_key)
	local first_char = string.sub(text_or_key, 1, 1)
	if first_char == "$" then
		-- Remove the $ from the start, and use that
		text_or_key = string.sub(text_or_key, 2)
		if NoitaData.translations[text_or_key] then
			return NoitaData.translations[text_or_key]
		else
			return text_or_key
		end
	end
	return text_or_key
end
