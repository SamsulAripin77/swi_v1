@extends('layouts.admin')
@section('content')
<style>
    .vertical-align-top {
        vertical-align: top !important;
    }

    .big-col {
        width: 180px !important;
    }

    .mid-col {
        width: 120px !important;
    }

    .small-col {
        width: 60px !important;
    }

    table.datatable-BaselineTarget {
        table-layout: fixed;
        width: 100%;
    }

    .th-small {
        font-size: 10px !important;
    }
</style>
<div class="card">
    <div class="card-header">
        Monitoring Baseline target
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover  datatable datatable-BaselineTarget"
                id="fixed-table">
                <thead>
                    <tr>
                        <th class="mid-col">
                            <small class="th-small">
                                User
                            </small>
                        </th>
                        <th class="big-col">
                            <small>
                                Jenis Plastik
                            </small>
                        </th>
                        <th class="small-col">
                            <small class="th-small">
                                Baseline
                            </small>
                        </th>
                        <th class="small-col">
                            <small class="th-small">
                                Target Incremental
                            </small>
                        </th>
                        <th class="small-col">
                            <small class="th-small">
                                Insentif/kg (Rp)
                            </small>
                        </th>
                        <th class="small-col">
                            <small class="th-small">
                                Progress Incremental
                            </small>
                        </th>
                        <th class="small-col">
                            <small class="th-small">
                                Progress Collection
                            </small>
                        </th>
                        <th class="mid-col">
                            <small class="th-small">
                                Insentif
                            </small>
                        </th>
                        <th class="small-col">
                            <small class="th-small">
                                Kelebihan Incremental
                            </small>
                        </th>
                        <th class="small-col">
                            <small class="th-small">
                                Pengumpulan Kemitraan
                            </small>
                        </th>
                    </tr>
                </thead>
                <tbody id="tbody">

                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    let berat = {!! json_encode($berat)!!}
    console.log(berat)
    let datas = Object.entries(berat)
    for (let i = 0; i < datas.length; i++) {
        let user = datas[i][0]
        $('#tbody').append(
            `<tr id='row-${i}'>
                <td id="user-${i}">${user}</td>
                '<td>
                    <table class='table table-bordered table-striped'><tbody id="plastiks-${i}"></tbody></table>
                </td>` +
            `<td class='vertical-align-top'>
                    <table class='table table-bordered table-striped '><tbody id="baseline-${i}"></tbody></table>
                </td>` +
            `<td class='vertical-align-top'>
                    <table class='table table-bordered table-striped'><tbody id="target-${i}"></tbody></table>
                </td>` +
            `<td class='vertical-align-top'>
                    <table class='table table-bordered table-striped'><tbody id="insentif_kg-${i}"></tbody></table>
                </td>` +
            `<td class='vertical-align-top'>
                    <table class='table table-bordered table-striped'><tbody id="incremental-${i}"></tbody></table>
                </td>` +
            `<td class='vertical-align-top'>
                    <table class='table table-bordered table-striped'><tbody id="collection-${i}"></tbody></table>
                </td>` +
            `<td class='vertical-align-top'>
                <table class='table table-bordered table-striped'><tbody id="insentif-${i}"></tbody></table>
            </td>` + `<td class='vertical-align-top'>
                <table class='table table-bordered table-striped'><tbody id="kelebihan_incremental-${i}"></tbody></table>
            </td>` + `<td class='vertical-align-top'>
                <table class='table table-bordered table-striped'><tbody id="pengumpulan_kemitraan-${i}"></tbody></table>
            </td>` +
            ` </tr>
            `)
        let plastiks = Object.entries(datas[i][1])
        for (let j = 0; j < plastiks.length; j++) {
            let {nama_plastik, baseline, target, insentif_kg, pengumpulan } = plastiks[j][1][0]
            let t_nama_plastik = parseFloat(nama_plastik)
            let t_baseline = parseFloat(baseline)
            let t_target = parseFloat(target)
            let t_insentif_kg = parseFloat(insentif_kg)
            let t_pengumpulan = parseFloat(pengumpulan)

            let progress_incremental = function (){
            let progress=  t_pengumpulan - t_baseline
            if (progress<=0){
                return 0
            }
            return progress
            } 

            let progress_collection = t_pengumpulan

            let insentif = function(){
                return t_insentif_kg * progress_incremental()
            }

            let  kelebihan =  function () {
                let lebih = progress_incremental() - t_target;
                if (lebih <= 0){
                    return 0;
                }
                return lebih;
            }

            // console.log(`${nama_plastik} ?  ${t_pengumpulan} - ${t_baseline}= ${progress_incremental}`)
            // console.log(progress_incremental())
            $(`#plastiks-${i}`).append(`<tr><td><small class="th-small">${nama_plastik}&nbsp;</small><br></td></tr>`)
            $(`#baseline-${i}`).append(`<tr><td>${t_baseline.toLocaleString('id')}&nbsp;</td></tr>`)
            $(`#target-${i}`).append(`<tr><td>${t_target.toLocaleString('id')}&nbsp;</td></tr>`)
            $(`#insentif_kg-${i}`).append(`<tr><td>${t_insentif_kg.toLocaleString('id')}&nbsp;</td></tr>`)
            $(`#incremental-${i}`).append(`<tr><td>${progress_incremental() < 1 ? 0 : progress_incremental().toLocaleString('id')}&nbsp;</td></tr>`)
            $(`#collection-${i}`).append(`<tr><td>${progress_collection.toLocaleString('id')}&nbsp;</td></tr>`)
            $(`#insentif-${i}`).append(`<tr><td>${insentif()  < 1 ? 0 : insentif().toLocaleString('id')}&nbsp;</td></tr>`)

            $(`#kelebihan_incremental-${i}`).append(`<tr><td>${kelebihan().toLocaleString('id')}&nbsp;</td></tr>`)
            $(`#pengumpulan_kemitraan-${i}`).append(`<tr><td>0</td></tr>`)
        }
    } 

</script>

<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('baseline_target_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.baseline-targets.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let options = {
    "sScrollX": "100%",
    "sScrollXInner": "110%",
    "bScrollCollapse": true,
    "colReorder": true,
    dom: 'Bfrtip',
    buttons: [  {
                extend: 'excel',
                text: 'Excel',
                exportOptions: {
                format: {
                    body: function ( data, column, row ) {
                        tags = data.replace(/<.*?>/g, "")
                        trim =  tags.replaceAll("&nbsp;","\r\n")
                        return $.trim(trim);
                    }
                }
	  	},
          customize: function( xlsx ) {
		   		var sheet = xlsx.xl.worksheets['sheet1.xml'];
		      $('row c', sheet).attr( 's', '55' );
		   }
    },  {
        extend: 'pdfHtml5',
        title: 'LAPORAN MONITORING',
        orientation: 'landscape',
        pageSize: 'LEGAL',
        exportOptions: {
                format: {
                    body: function ( data, column, row ) {
                        tags = data.replace(/<.*?>/g, "")
                        trim =  tags.replaceAll("&nbsp;","\r\n")
                        return $.trim(trim);
                    }
                }
	  	},
          customize : function(doc) {
            doc.styles['td:nth-child(2)'] = { 
            width: '10px',
            'max-width': '10px'
        }
  }
    }], scrollY: '70vh',
    
    scrollCollapse: true,
    paging:         false,
};
  let table = $('.datatable-BaselineTarget:not(.ajaxTable)').DataTable(options)

  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection