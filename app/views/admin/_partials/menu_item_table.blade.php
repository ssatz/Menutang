<table class="table table-striped" id="dataTable">
    <thead>
    <tr>
        <th></th>
        <th>Item Name</th>
        <th>Item Description</th>
        <th>Price</th>
        <th>Veg</th>
        <th>Non-Veg</th>
        <th>Egg</th>
        <th>Spicy</th>
        <th>Popular</th>
        <th>Status</th>
        <th><span class="btn btn-primary pull-right add-menu-item">Add Item</span></th>
    </tr>
    </thead>
    <tbody>
    <input type="hidden" name="menu_category" class="menu-category" value="{{$categoryid}}"/>
    <input type="hidden" name="menu_delete" class="menu-delete" value=""/>
    <input type="hidden" name="addon_delete" class="addon-delete" value=""/>
    @foreach($menus as $item)
    <tr class="menu">
        <td><a class="accordion-toggle"><span class="glyphicon gi-2x glyphicon-plus"></span></a></td>
        <td><input type="text" class="form-control input-sm" id="item_{{$item['id']}}_name"
                   name="item[{{$item['id']}}][item_name]" value="{{$item['item_name']}}" style="width: 140px;"></td>
        <td><input type="text" class="form-control input-sm" id="item_{{$item['id']}}_description"
                   name="item[{{$item['id']}}][item_description]" value="{{$item['item_description']}}"></td>
        <td><input type="text" class="form-control input-sm" style="width: 80px;"
                   id="item_{{$item['id']}}_price" name="item[{{$item['id']}}][item_price]" value="{{$item['item_price']}}"></td>
        <td><input type="checkbox" data-on-text="Yes" data-off-text="No" id="item_{{$item['id']}}_veg"
                   class="veg" name="item[{{$item['id']}}][is_veg]" @if($item['is_veg']) checked @endif></td>
        <td><input type="checkbox" data-on-text="Yes" data-off-text="No" id="item_{{$item['id']}}_non_veg"
                   class="non-veg" name="item[{{$item['id']}}][is_non_veg]" @if($item['is_non_veg']=='Yes') checked @endif></td>
        <td><input type="checkbox" data-on-text="Yes" data-off-text="No" id="item_{{$item['id']}}_is_egg"
                   class="egg" name="item[{{$item['id']}}][is_egg]" @if($item['is_egg']) checked @endif></td>
        <td><input type="checkbox" data-on-text="Yes" data-off-text="No"
                   id="item_{{$item['id']}}_is_spicy" name="item[{{$item['id']}}][is_spicy]" @if($item['is_spicy']) checked @endif></td>
        <td><input type="checkbox" data-on-text="Yes" data-off-text="No"
                   id="item_{{$item['id']}}_is_popular" name="item[{{$item['id']}}][is_popular]" @if($item['is_popular']) checked @endif></td>
        <td><input type="checkbox" data-on-text="Active" data-off-text="InActive"
                   id="item_{{$item['id']}}_status" name="item[{{$item['id']}}][item_status]" @if($item['item_status']) checked @endif></td>
        <td><span class="btn btn-xs btn-info delete">Delete</span>
            <input type="hidden" name="item[{{$item['id']}}][id]" class="menu-id" value="{{$item['id']}}"/>
        </td>

    </tr>
    <tr class="addon displayNone">
        <td colspan="10">
            <table class="table innerTable">
                <thead>
                <th>Addon Description</th>
                <th>Price</th>
                <th>Status</th>
                <th>
                    <button type="button" class="btn btn-success btn-sm pull-right add-addon">Add Addon
                    </button>
                </th>
                </thead>
                <tbody>
                @foreach($item['itemAddon'] as $addon)
                <tr>
                    <td><input type="text" class="form-control input-sm" id="item_{{$item['id']}}_{{$addon['id']}}_addon_description"
                               name="item[{{$item['id']}}][{{$addon['id']}}][addon_description]" value="{{$addon['addon_description']}}" style="width: 140px;"></td>
                    <td><input type="text" class="form-control input-sm" id="item_{{$item['id']}}_{{$addon['id']}}_addon_price"
                               name="item[{{$item['id']}}][{{$addon['id']}}][addon_price]" value="{{$addon['addon_price']}}" style="width: 140px;"></td>
                    <td><input type="checkbox" data-on-text="Active" data-off-text="InActive"
                               id="item_{{$item['id']}}_{{$addon['id']}}_addon_price" name="item[{{$item['id']}}][{{$addon['id']}}][addon_status]" @if($addon['addon_status']) checked @endif></td>
                    <td><span class="btn btn-xs btn-info delete">Delete</span>
                        <input type="hidden" name="item[{{$item['id']}}][{{$addon['id']}}][id]" class="addon-id" value="{{$addon['id']}}"/>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>