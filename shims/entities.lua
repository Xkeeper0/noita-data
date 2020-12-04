

-- GetUpdatedEntityID() -> entity_id
-- ?? gets current entity id?
function GetUpdatedEntityID()
	return 1
end


-- EntityGetAllChildren( entity_id:int ) -> {entity_id:int}|nil
function EntityGetAllChildren(entity_id)
	return nil
end

-- EntityGetComponent( entity_id:int, component_type_name:string, tag:string = "" ) -> {component_id}|nil
-- returns a table of components or nil
-- will probably need to have some info re: type names, tags
function EntityGetComponent(entity_id, component_type_name, tag)
	return nil
end


-- EntityGetFirstComponent( entity_id:int, component_type_name:string, tag:string = "" ) -> component_id|nil
function EntityGetFirstComponent()
	return nil
end

-- EntityGetTransform( entity_id:int ) -> x:number,y:number,rotation:number,scale_x:number,scale_y:number
-- returns multiple values for an entity's position/transform
function EntityGetTransform(entity_id)
	--     x  y  r  sx sy
	return 0, 0, 0, 1, 1
end

-- EntityGetWithTag( tag:string ) -> {entity_id:int}
-- [Returns all entities with 'tag'.]
-- Gets a table of entity ids
function EntityGetWithTag(tag)
	return {}
end