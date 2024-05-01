<div class="tab-pane fade show active" id="general-setting" role="tabpanel" aria-labelledby="home-tab4">
    <div class="card">
        <div class="card-body border">
            <form action="{{ route('admin.general-setting.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="">Site Name</label>
                    <input type="text" name="site_name" class="form-control"
                        value="{{ config('settings.site_name') }}">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Site Email</label>
                            <input type="text" name="site_email" class="form-control"
                                value="{{ config('settings.site_email') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Site Phone</label>
                            <input type="text" name="site_phone" class="form-control"
                                value="{{ config('settings.site_phone') }}">
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
