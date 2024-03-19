// 更新ボタンが押下されたら
$('#customer_tag_update_enter').on("click",function(){
    // 処理を実行するか確認
    const result = window.confirm("荷主タグを更新しますか？");
    // 「はい」が押下されたらsubmit、「いいえ」が押下されたら処理キャンセル
    if(result == true) {
        $("#customer_tag_update_form").submit();
    }
});

// タグの削除が押下されたら
$('.tag_delete').on("click",function(){
    $(this).remove();
});

// タグ追加ボタンが押下されたら
$('#tag_add').on("click",function(){
    // 選択しているタグの情報を取得
    const tag_id = $('#select_tag').val();
    const tag_name = $("#select_tag option:selected").html();
    try {
        // 追加しようとしているタグが既に存在していないか確認
        if($('#setting_tag_div').find(`[id=${tag_id}]`).length !== 0){
            throw new Error('既に存在するタグです。');
        }
        // 要素を追加
        $("#setting_tag_div").append(`<input type='text' id=${tag_id} name='tag_id[${tag_id}]' class='tag_delete text-xs bg-theme-main text-white border-none col-span-4 text-center rounded-md cursor-pointer' data-tag_id=${tag_id} value=${tag_name} readonly >`);
    } catch (e) {
        alert(e.message);
    }
});