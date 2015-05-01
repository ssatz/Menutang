<table class="table table-striped table-menu" id="dataTable">
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
        <th>EggLess</th>
        <th>Popular</th>
        <th>Pickup</th>
        <th>Delivery</th>
        <th>Time Availability</th>
        <th>Weekdays(Not Available)</th>
        <th>Status</th>
        <th><span class="btn btn-primary pull-right add-menu-item">Add Item</span></th>
    </tr>
    </thead>
    <tbody>
    <input type="hidden" name="menu_category" class="menu-category" value="{{$categoryid}}">
    <input type="hidden" name="menu_delete" class="menu-delete" value=""/>
    <input type="hidden" name="addon_delete" class="addon-delete" value=""/>
    @foreach($menus as $item)
    <tr class="menu">
        <td><a class="accordion-toggle"><span class="glyphicon gi-2x glyphicon-plus"></span></a></td>
        <td><input type="text" class="form-control input-sm" id="item_{{$item['id']}}_name"
                   name="item[{{$item['id']}}][item_name]" value="{{$item['item_name']}}"  data-required="true" style="width: 140px;"></td>
        <td><input type="text" class="form-control input-sm" id="item_{{$item['id']}}_description" data-required="false"
                   name="item[{{$item['id']}}][item_description]" value="{{$item['item_description']}}"></td>
        <td><input type="text" class="form-control input-sm" style="width: 80px;"
                   id="item_{{$item['id']}}_price"  data-required="true" name="item[{{$item['id']}}][item_price]" data-type="number" value="{{$item['item_price']}}"></td>
        <td><input type="checkbox" data-on-text="Yes" data-off-text="No" id="item_{{$item['id']}}_veg"
                   class="veg" name="item[{{$item['id']}}][is_veg]" @if($item['is_veg']) checked @endif></td>
        <td><input type="checkbox" data-on-text="Yes" data-off-text="No" id="item_{{$item['id']}}_non_veg"
                   class="non-veg" name="item[{{$item['id']}}][is_non_veg]" @if($item['is_non_veg']) checked @endif></td>
        <td><input type="checkbox" data-on-text="Yes" data-off-text="No" id="item_{{$item['id']}}_is_egg"
                   class="egg" name="item[{{$item['id']}}][is_egg]" @if($item['is_egg']) checked @endif></td>
        <td><input type="checkbox" data-on-text="Yes" data-off-text="No"
                   id="item_{{$item['id']}}_is_spicy" name="item[{{$item['id']}}][is_spicy]" @if($item['is_spicy']) checked @endif></td>
        <td><input type="checkbox" data-on-text="Yes" data-off-text="No"
                   id="item_{{$item['id']}}_is_eggless" name="item[{{$item['id']}}][is_eggless]" @if($item['is_eggless']) checked @endif></td>
        <td><input type="checkbox" data-on-text="Yes" data-off-text="No"
                   id="item_{{$item['id']}}_is_popular" name="item[{{$item['id']}}][is_popular]" @if($item['is_popular']) checked @endif></td>
        <td><input type="checkbox" data-on-text="Yes" data-off-text="No"
                   id="item_{{$item['id']}}_is_pickup" name="item[{{$item['id']}}][is_pickup]" @if($item['is_pickup']) checked @endif></td>
        <td><input type="checkbox" data-on-text="Yes" data-off-text="No"
                   id="item_{{$item['id']}}_is_delivery" name="item[{{$item['id']}}][is_delivery]" @if($item['is_delivery']) checked @endif></td>
        <td><select class="form-control chzn-select" id="item_{{$item['id']}}_time_category"  name="item[{{$item['id']}}][time_category][]" multiple data-required="true">
                @foreach($timecategory as $bu)
                <option value="{{$bu->id}}" @if(!is_null($item->businessHours)) @foreach($item->businessHours as $timehr)
                    @if($timehr->id==$bu->id)
                    selected @endif @endforeach @endif>{{$bu->timeCategory->category_description}}</option>
                @endforeach
            </select>
        <td><select class="form-control chzn-select" name="item[{{$item['id']}}][weekdays][]" id="item_{{$item['id']}}_weekdays" multiple data-required="true">
                @foreach($weekdays as $key=> $day)
                <option value="{{$day}}" @if(!is_null($item->weekDays)) @foreach($item->weekDays as $weekDays)
                    @if($day==$weekDays->id)
                    selected @endif @endforeach @endif>{{$key}}</option>
                @endforeach
            </select></td>
        <td><input type="checkbox" data-on-text="Active" data-off-text="InActive"
                   id="item_{{$item['id']}}_status" name="item[{{$item['id']}}][item_status]" @if($item['item_status']) checked @endif></td>
        <td><span class="btn btn-xs btn-info delete">Delete</span>
            <input type="hidden" name="item[{{$item['id']}}][menu_id]" class="menu-id" value="{{$item['id']}}"/>
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
                    <td><input type="text" class="form-control input-sm" id="item_{{$item['id']}}_{{$addon['id']}}_addon_description" data-required="true"
                               name="item[{{$item['id']}}][{{$addon['id']}}][addon_description]" value="{{$addon['addon_description']}}" style="width: 140px;"></td>
                    <td><input type="text" class="form-control input-sm" id="item_{{$item['id']}}_{{$addon['id']}}_addon_price"  data-required="true" data-type="number"
                               name="item[{{$item['id']}}][{{$addon['id']}}][addon_price]" value="{{$addon['addon_price']}}" style="width: 140px;"></td>
                    <td><input type="checkbox" data-on-text="Active" data-off-text="InActive"
                               id="item_{{$item['id']}}_{{$addon['id']}}_addon_price" name="item[{{$item['id']}}][{{$addon['id']}}][addon_status]" @if($addon['addon_status']) checked @endif></td>
                    <td><span class="btn btn-xs btn-info delete">Delete</span>
                        <input type="hidden" name="item[{{$item['id']}}][{{$addon['id']}}][addon_id]" class="addon-id" value="{{$addon['id']}}"/>
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