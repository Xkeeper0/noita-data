

-- GameGetFrameNum
-- GameGetFrameNum() -> int
-- returns an int of the current game frame
function GameGetFrameNum()
	return 0
end


-- Random( [optional]a, [optional]b ) -> number|int.
-- [This is kinda messy. If given 0 arguments, returns number between 0.0 and 1.0.
-- If given 1 arguments, returns int between 0 and 'a'.
-- If given 2 arguments returns int between 'a' and 'b'.]
function Random(a, b)
	-- If the arguments are in the wrong order, swap them
	-- otherwise this causes an error
	-- (this happens @ data/scripts/gun/gun_actions.lua:6961: in field 'action')
	if a and b and (b < a) then
		a, b = b, a
	end
	return math.random(a, b)
end


-- SetRandomSeed(x,y)
-- Sets the current random seed used for PRNG
function SetRandomSeed(x, y)
	return 0
end


