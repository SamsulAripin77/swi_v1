<label class="required mr-3" for="user_id">Filter By Date</label>
<div class="row">
    <div class="col-lg-4">
        <input type="text" value="{{ old('start_date') }}" onfocus="(this.type='date')" class="form-control mr-2 "
            name="start_date" placeholder="Tanggal Mulai">
    </div>
    <div class="col-lg-4">
        <input type="text" value="{{ old('end_date') }}" onfocus="(this.type='date')" class="form-control "
            name="end_date" placeholder="Tanggal selesai">
    </div>
    <div class="col-lg-4">
        <input type="submit" class="ml-1 btn py-1 btn-primary" value="Filter">
    </div>
</div>