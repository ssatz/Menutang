$(document).ready(function() {
    $(".chzn-select").chosen();
    $(function () {
        $(".table-responsive").find("[type='checkbox']").bootstrapSwitch({
            'onColor': 'success',
            'offColor': 'danger',
            'size': 'small'
        });
        $(".chzn-select").change(function () {
            $("table").find('.menu-category').val($(this).val());
        });
        $(".table-responsive").on('switchChange.bootstrapSwitch', '.veg,.non-veg,.egg', function (event, state) {

            if (state) {
                if ($(this).hasClass('veg')) {
                    $(this).closest('tr').find('.non-veg,.egg').bootstrapSwitch('state', false, false);
                }
                else if ($(this).hasClass('non-veg')) {
                    $(this).closest('tr').find('.veg,.egg').bootstrapSwitch('state', false, false);
                }
                else if ($(this).hasClass('egg')) {
                    $(this).closest('tr').find('.non-veg,.veg').bootstrapSwitch('state', false, false);
                }
            }
        });

        $("body").on("click", ".accordion-toggle", function () {
            if ($(this).find('span').hasClass('glyphicon-minus')) {
                $(this).find('span').removeClass('glyphicon-minus').addClass('glyphicon-plus');
                $(this).closest("tr").next("tr.addon").hide('slow');
            }
            else {
                $(this).find('span').removeClass('glyphicon-plus').addClass('glyphicon-minus');
                $(this).closest("tr").next("tr.addon").show('slow');
            }
        });

        $("body").on("click", ".add-addon", function () {
            var $clone = $('#items').find('.innerTable tbody>tr:first').clone();
            var $count = $(this).parents('.innerTable').find('tbody>tr:last');
            var $menuCount = $(this).closest('tr.addon').prev('tr.menu').find('td input').prop('id');
            $menuCount = $menuCount.split('_')[1];
            if ($count == '' || $count.length == 0) {
                $(this).parents('.innerTable').find('tbody').append($clone);
                $(this).parents('.innerTable').find('tbody>tr:last>td').each(function () {
                    $name = $(this).find('input').prop('name');
                    $name = $name != undefined ? $name.replace('item[0][0]', 'item[' + $menuCount + '][0]') : $name;
                    $(this).find('input').prop('name', $name);
                    $id = $(this).find('input').prop('id');
                    $id = $id != undefined ? $id.replace('item_0_0', 'item_' + $menuCount + '_0') : $id;
                    $(this).find('input').prop('id', $id);
                });
            } else {
                var $arrayCount = $(this).parents('.innerTable').find('tbody>tr:last>td input').prop('id');
                $arrayCount = $arrayCount.split('_')[2];
                $count = parseInt($arrayCount) + 1;
                $(this).parents('.innerTable').find('tbody>tr:last').after($clone);
                $(this).parents('.innerTable').find('tbody>tr:last>td').each(function () {
                    $name = $(this).find('input').prop('name');
                    $name = $name != undefined ? $name.replace('item[0][0]', 'item[' + $menuCount + '][' + $count + ']') : $name;
                    $(this).find('input').prop('name', $name);
                    $id = $(this).find('input').prop('id');
                    $id = $id != undefined ? $id.replace('item_0_0', 'item_' + $menuCount + '_' + $count) : $id;
                    $(this).find('input').prop('id', $id);
                });
                var $addonCount = $(this).parents('.innerTable').find('tbody>tr:last>td input').prop('id');
                $addonCount = parseInt($addonCount.split('_')[2]) + 1;
                $("input[name='item[" + $menuCount + "][total_addon]']").val($addonCount);
            }
            $(this).parents('.innerTable').find('tbody>tr:last').find("[type='checkbox']").bootstrapSwitch({
                'onColor': 'success',
                'offColor': 'danger',
                'size': 'small'
            });
        });

        $("body").on("click", ".table-responsive .delete", function () {
            if ($(this).closest('table').hasClass('innerTable')) {
                var $addon = $(this).parents('table').find('.addon-delete').val();
                var $id = $(this).closest('tr').find('.addon-id').val();
                $(this).parents('table').find('.addon-delete').val($addon + ',' + $id);

                $(this).closest('tr').remove();
            }
            else {
                debugger;
                var $menu = $(this).parents('table').find('.menu-delete').val();
                var $id = $(this).closest('tr').find('.menu-id').val();
                $(this).parents('table').find('.menu-delete').val($menu + ',' + $id);
                $(this).closest('tr').next('tr.addon').remove();
                $(this).closest('tr').remove();
            }
        });
        $(".add-menu-item").click(function () {
            var $html = $("#items").find('table>tbody').html();
            var $count = $(this).parents('.table-responsive').find("table>tbody>tr.addon:last");
            debugger;
            if ($count == '' || $count.length == 0) {
                $(this).parents('.table-responsive').find("table>tbody").append($html);
            }
            else {
                var $prev = $(this).parents('.table-responsive').find("table>tbody>tr.menu:last>td input").prop('id');
                $prev = $prev.split('_')[1];
                $(this).parents('.table-responsive').find("table>tbody>tr.addon:last").after($html);

                var $count = parseInt($prev) + 1;
                inputnameFormat($count, 'table>tbody>tr.menu:last>td:input', this, '.table-responsive');
                inputnameFormat($count, '.innerTable>tbody>tr>td:input', this, '.table-responsive');
            }
            $(this).parents('.table-responsive').find("table>tbody>tr.menu:last").find("[type='checkbox']").bootstrapSwitch({
                'onColor': 'success',
                'offColor': 'danger',
                'size': 'small'
            });
            $(this).parents('.table-responsive').find("table>tbody>tr.addon:last").find("[type='checkbox']").bootstrapSwitch({
                'onColor': 'success',
                'offColor': 'danger',
                'size': 'small'
            });
        });


        function inputnameFormat($count, $selector, $currentObject, $parentsSelector) {
            $($currentObject).parents($parentsSelector).find($selector).each(function () {
                $name = $(this).find('input').prop('name');
                if ($name != undefined) {
                    $name = $name.replace('item[0]', 'item[' + $count + ']');
                    $(this).find('input').prop('name', $name);
                }
                $id = $(this).find('input').prop('id');
                if ($id != undefined) {
                    $id = $id.replace('_0_', '_' + $count + '_');
                    $(this).find('input').prop('id', $id);
                }
            });
        }
    });
});