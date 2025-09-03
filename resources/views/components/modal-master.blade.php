<div class="modal-body">
    <div class="row">
        <div class="col-md-12 mb-2">
            <div class="form-group">
                <label class="form-label">Syllabus Title:<sup><span
                            style="color: red;">*</span></sup></label>
                <input type="text" id="syllabus_title" class="form-control"
                    name="syllabus_title" placeholder="Syllabus Title" value="{{@$sysid['syllabus_title']}}"
                    required="required" maxlength="50">
                @if ($errors->has('syllabus_title'))
                    <span class="text-danger">{{ $errors->first('syllabus_title') }}</span>
                @endif
            </div>
        </div>
    </div>
</div>