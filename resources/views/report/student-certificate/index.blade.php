@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-lg-5 mx-auto">
        <h3 class="mb-4">Laporan Arsip Ijazah Mahasiswa</h3>
        <h5 class="mb-3">Filter laporan</h5>
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form id="filter-form" target="_blank" action="{{ route('report.student-certificate.print') }}" method="get">
                        <div class="mb-3">
                            <label for="report_priods" class="form-label">Periode</label>
                            <input placeholder="Klik untuk pilih tanggal" readonly type="text" id='report_priods' class="form-control cs-rounded-1 text-muted">
                            <input type="hidden" name="filterFromDate">
                            <input type="hidden" name="filterToDate">
                        </div>
                        <div class="text-end">
                            <button class="btn btn-sm btn-light-primary" type="reset">Reset
                                Filter</button>
                            <button type="submit" class="btn btn-sm btn-primary">Buat
                                Laporan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(function() {
        $('input#report_priods').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        })

        $('input#report_priods').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format(
                'MM/DD/YYYY'))
            $('input[name="filterFromDate"]').val(picker.startDate.format('YYYY-MM-DD'))
            $('input[name="filterToDate"]').val(picker.endDate.format('YYYY-MM-DD'))
        })

        $('input#report_priods').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('')
            $('input[name="filterFromDate"]').val('')
            $('input[name="filterToDate"]').val('')
        })

        $('#filter-form').on('reset', () => {
            $('input[name="filterFromDate"]').val('')
            $('input[name="filterToDate"]').val('')
        })
    })
</script>
@endsection