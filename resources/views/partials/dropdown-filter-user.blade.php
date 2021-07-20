<div class="form-inline">
    <label class="required mr-3" for="user_id">Filter by User</label>
    <form action="{{route('admin.pembelians.index')}}">
        @csrf
        <select class="form-control select2" name="user_id" id="user_id" required>
            @foreach($nama_users as $id => $nama_user)
            <option value="{{$id}}" {{ old('user_id') == $id ? 'selected' : '' }}>
                {{ $nama_user }}
            </option>
            @endforeach
        </select>
        <input type="submit" class="ml-1 btn py-1 btn-primary" value="Filter">
    </form>
</div>