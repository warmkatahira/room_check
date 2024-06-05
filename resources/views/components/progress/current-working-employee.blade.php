<p class="text-xl mb-0.5"><i class="las la-user la-lg"></i>出勤中人数</p>
<div class="grid grid-cols-12 gap-4 mb-3">
    @foreach($employeeCount as $employee)
        <div class="col-span-3 xl:col-span-1 text-center">
            <p class="bg-black text-white">{{ $employee->shortened_base_name }}</p>
            <p class="bg-white py-1">{{ $employee->working_count }}<span class="text-xs ml-1">人</span></p>
        </div>
    @endforeach
</div>