<div class="row">
    <div class="col-lg-2 col-md-4">

    </div>
    <div class="col-lg-3 col-md-6">
        @can('admin-only')
        <div class="form-group">
            <label class="required mr-3" for="user_id">Filter by User</label>
            <select class="form-control select2" name="user_id" id="user_id" required>
                @foreach($nama_users as $id => $nama_user)
                <option value="{{$id}}" {{ old('user_id') == $id ? 'selected' : '' }}>
                    {{ $nama_user }}
                </option>
                @endforeach
            </select>
        </div>
        @endcan
    </div>
    <div class="col-lg-7 col-md-6">
        <label class="required mr-3" for="user_id">Filter By Date</label>
        <div class="row">
            <div class="col-lg-4">
                <input type="text" value="{{ old('start_date') }}" onfocus="(this.type='date')"
                    class="form-control mr-2 " name="start_date" placeholder="Tanggal Mulai">
            </div>
            <div class="col-lg-4">
                <input type="text" value="{{ old('end_date') }}" onfocus="(this.type='date')" class="form-control "
                    name="end_date" placeholder="Tanggal selesai">
            </div>
            <div class="col-lg-4">
                <input type="submit" class="ml-1 btn py-1 btn-primary" value="Filter">
            </div>
        </div>
    </div>
</div>