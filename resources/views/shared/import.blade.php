<div>
    <form role="form" id="import-form" name="import-form" method="post" action="#" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <label for="import" class="col-sm-3 col-form-label text-right">{{ __('Import') . __('File') }}</label>
            <div class="col-md-9">
                <input type="file" name="import" id="import" class="form-control @error('import') is-invalid @enderror" placeholder="{{ __('import') }}" accept=".csv,.xls,.xlsx" required>
                @error('import')
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('import') }}</strong>
                    </div>
                @enderror
                <small class="form-text text-light">只允许xls, xlsx, csv格式文件</small>
            </div>
        </div>
    </form>
</div>
