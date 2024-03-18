<x-app-layout>
    <x-page-header content="タグマスタ" />
    <div class="grid grid-cols-12 my-5">
        <a href="{{ route('tag.create') }}" class="col-span-12 xl:col-span-1 py-3 text-center text-white text-sm bg-blue-600"><i class="las la-plus-square la-lg mr-1"></i>タグ追加</a>
    </div>
    <div class="">
        <table class="text-sm block whitespace-nowrap">
            <thead>
                <tr class="text-center text-white bg-gray-600 sticky top-0">
                    <th class="font-thin py-3 px-2">タグID</th>
                    <th class="font-thin py-3 px-2">タグ名</th>
                    <th class="font-thin py-3 px-2">タグ並び順</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($tags as $tag)
                    <tr class="text-left hover:bg-theme-sub cursor-default">
                        <td class="py-1 px-2 border">
                            <a href="{{ route('tag.update_index', ['tag_id' => $tag->tag_id]) }}" class="text-blue-600">{{ $tag->tag_id }}</a>
                        </td>
                        <td class="py-1 px-2 border">{{ $tag->tag_name }}</td>
                        <td class="py-1 px-2 border text-right">{{ $tag->tag_sort_order }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>