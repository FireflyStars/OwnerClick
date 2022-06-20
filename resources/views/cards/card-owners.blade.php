<div class="card">
    <div class="card-header card-header-info card-header-icon">
        <div class="card-icon">
            <i class="material-icons">assignment</i>
        </div>
        <h4 class="card-title">{{__('dashboard.owner_screen')}}</h4>
    </div>
    <div class="card-body">
       @include('unit-person.owner')
    </div><!-- /.modal-content -->
    <div class="card-footer py-0 py-sm-2 justify-content-end">
        <button type="submit" class="btn btn-info" onclick="$('#editOwner').trigger('submit')">{{__('dashboard.update')}}</button>
    </div>
</div><!-- /.modal-content -->

<script>
    if ($('#unitOwnerModal').length != 0) {
        $('#unitOwnerModal').remove();
    }
</script>
