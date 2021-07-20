@section('scripts')
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="addform">
                @csrf
                <div class="modal-body">
                    @include('partials.create-sampah')
                </div>
                <div class="modal-footer">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="sumbit" class="btn btn-primary btn-submit">Save Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#sumber_sampahs').change(function () {
            addOption()
            var opval = $(this).val();
            if (opval.includes('lainnya')) {
                $('#myModal').modal("show");
            }
        });
        $("#myModal").on("hidden.bs.modal", function () {
            $("#sumber_sampahs option[value='lainnya']").remove()
            setTimeout(() => {
                addOption()
            }, 1000);
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".btn-submit").click(function (e) {
            e.preventDefault();
            var keterangan = $("input[name=keterangan]").val();
            var sumber_sampah = $("input[name=sumber_sampah]").val();
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.sumber-sampah.storeAjax') }}",
                data: { sumber_sampah: sumber_sampah, keterangan: keterangan },
                success: function (data) {
                    console.log(data)
                    var myselect2 = $('<select>');
                    var items = data.sampah
                    for (var i = 0; i < items.length; i++) {
                        myselect2.append($('<option selected="selected"></option>').val(items[i]['id']).html(items[i]['sumber_sampah']));
                    }
                    $('#sumber_sampahs').append(myselect2.html());
                    $('#myModal').modal("toggle");
                },
                error: function (error) {
                    console.log(error)
                    alert("Data not saved");
                }
            });

        });

        // end ready
    });
    function addOption() {
        if ($("#sumber_sampahs option[value='lainnya']").length === 0) {
            $("#sumber_sampahs").append("<option value='lainnya'>Lainnya Sebutkan</option>")
        }
    }


</script>
@endsection