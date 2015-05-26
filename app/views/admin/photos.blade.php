@extends('admin.business_layout')

@section('content')
<div id="photo">
<div class="panel panel-default">
<table class="table table-hover table-striped">
    <thead>
    <tr>
        <th><a class="btn btn-primary btn-success" href="#add" data-bind="click:addPhotos" title="Add"><i class="icon-plus"></i> Add Photos</a></th>
    </tr>
    </thead>
   <tbody>
    <tr>
        <td>

        </td>
    </tr>
   </tbody>
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
                        <p class="validationMessage" data-bind="validationMessage: fileData().dataURL"></p>
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
    var update = '{{\Services\ActionEnum::UPDATE}}';
    var deleteHoliday = '{{\Services\ActionEnum::DELETE}}';
</script>
<script src="{{asset('assets/common/js/knockout.min-3.3.0.js')}}"></script>
<script src="{{asset('assets/common/js/knockout.validation.min.js')}}"></script>
<script src="{{asset('assets/common/js/knockout.mapping.min.js')}}"></script>
<script src="{{asset('assets/common/js/jquery.gritter.min.js')}}"></script>
<script src="{{asset('assets/common/js/app/knockout.bindings.js')}}"></script>
<script src="{{asset('assets/common/js/app/photosVM.js')}}"></script>
@endsection