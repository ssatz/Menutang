@extends('admin.business_layout')

@section('content')
<div id="photo">
<div class="panel panel-default">
<table class="table table-hover table-striped">
    <thead>
    <tr>
        <th><a class="btn btn-primary btn-success" href="#add" data-bind="click:addPhotos" title="Add"><i class="icon-plus"></i> Add Photos</a></th>
        <th>FileName</th>
        <th>Size</th>
        <th></th>
    </tr>
    </thead>
   <tbody data-bind="foreach:pagedList">
    <tr>
        <td>
            <img data-bind="attr:{src: dataURI}" height="96px" width="96px"/>
        </td>
        <td data-bind="text:fileName"></td>
        <td data-bind="text:size"></td>
        <td>
            <a class="btn btn-danger" data-bind="click: $root.delete" href="#" title="Delete">Delete</a>
        </td>
    </tr>
   </tbody>
    <tfoot>
    <tr>
        <td>
            <div>
                <ul class="pagination"><li data-bind="css: { disabled: pageIndex() === 0 }"><a href="#" data-bind="click: previousPage">Previous</a></li></ul>
                <ul class="pagination" data-bind="foreach: allPages">
                    <li data-bind="css: { active: $data.pageNumber === ($root.pageIndex() + 1) }"><a href="#" data-bind="text: $data.pageNumber, click: function() { $root.moveToPage($data.pageNumber-1); }"></a></li>
                </ul>
                <ul class="pagination"><li data-bind="css: { disabled: pageIndex() === maxPageIndex() }"><a href="#" data-bind="click: nextPage">Next</a></li></ul>
            </div>
            <a class="btn btn-primary btn-success" href="#add" data-bind="click:addPhotos" title="Add"><i class="icon-plus"></i> Add Photos</a></th>
        </td>
    </tr>
    </tfoot>
</table>
</div>
<!-- /Modal -->
<div class="modal fade" id="photoModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" data-bind="click:onClear" aria-hidden="true">&times;</button>
                <h4>Upload Photos</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group" style="margin: 20px">
                        <p class="validationMessage" data-bind="validationMessage: fileData().file"></p>
                        <div data-bind="fileDrag: fileData">
                            <div class="image-upload-preview">
                                <img data-bind="attr: { src: fileData().dataURL }, visible: fileData().dataURL">
                            </div>
                            <div class="image-upload-input">
                                <input type="file" data-bind="fileInput: fileData,customFileInput: {
                                                                                  buttonClass: 'btn btn-success',
                                                                                  fileNameClass: 'disabled form-control'
                                                                        }">
                            </div>
                        </div>
                        <a class="btn btn-primary btn-success" href="#add" data-bind="click:submit" title="Add"><i class="icon-plus"></i> Upload</a>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>
@endsection
@section('css')
<link href="{{asset('assets/common/css/knockout-file-bindings.css')}}" rel="stylesheet">
<link href="{{asset('assets/common/css/gritter/jquery.gritter.css')}}" rel="stylesheet">
@endsection
@section('scripts')
<script>
    var addPhotos = '{{\Services\ActionEnum::ADD}}';
    var deletePhotos = '{{\Services\ActionEnum::DELETE}}';
</script>
<script src="{{asset('assets/common/js/jquery.blockUI.min.js')}}"></script>
<script src="{{asset('assets/common/js/knockout.min-3.3.0.js')}}"></script>
<script src="{{asset('assets/common/js/knockout.validation.min.js')}}"></script>
<script src="{{asset('assets/common/js/knockout.mapping.min.js')}}"></script>
<script src="{{asset('assets/common/js/jquery.gritter.min.js')}}"></script>
<script src="{{asset('assets/common/js/app/knockout.bindings.js')}}"></script>
<script src="{{asset('assets/common/js/app/photosVM.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $.blockUI({ css: {
            border: 'none',
            padding: '15px',
            backgroundColor: '#000',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: .5,
            color: '#fff'
        } });
        $.getJSON("{{action('ManageBusinessController@addOrUpdatePhotos',[$slug])}}", null, function (data) {
            photosVM.image(data);
        });
        $(document).ajaxStart(function() {
            $.blockUI({ css: {
                border: 'none',
                padding: '15px',
                backgroundColor: '#000',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px',
                opacity: .5,
                color: '#fff'
            } });
        });
        $(document).ajaxComplete(function() {
            $.unblockUI();
        });
    });
    function postAjax(data,action){
        $.post('{{action('ManageBusinessController@addOrUpdatePhotos',[$slug])}}',{data:data,action:action,_token: '{{Session::get('_token')}}'}, function( data ) {
            photosVM.image(data);
            if(action ==addPhotos) {
                notification('Success', 'Hurray!Photo added Successfully', 'gritter-success');
            }
            else{
                notification('Success', 'Hurray!Photo Deleted Successfully', 'gritter-success');
            }
        }, 'json');
    }

</script>
@endsection