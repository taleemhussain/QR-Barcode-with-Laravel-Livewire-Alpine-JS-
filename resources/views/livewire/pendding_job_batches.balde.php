<div style="width: 60%;" class="mb-4 grid grid-cols-1 rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
    <h2 class="text-title-md2 font-bold text-black dark:text-white mb-1">Batches in progress</h2>
    <div class="max-w-full overflow-x-auto mb-4">
        @foreach ($pendding_job_batches as $batche)
            @php 
                $progress_per = round(($batche->total_added / $batche->total_records) * 100);
            @endphp
            Products: ({{$batche->total_records}}/{{$batche->total_added}})
            <div class="rounded-full dark-bg-gray mt-2">
                <div id="progressBar" class="bg-primary bg-blue-600 text-xs font-medium text-white text-center p-0.5 leading-none rounded-full" style="width:{{$progress_per}}%">{{$progress_per}}%</div>
            </div>
        @endforeach
    </div>               
</div>