// 追加ボタンが押下されたら
$('#tag_create_enter').on("click",function(){
    // 処理を実行するか確認
    const result = window.confirm("タグを追加しますか？");
    // 「はい」が押下されたらsubmit、「いいえ」が押下されたら処理キャンセル
    if(result == true) {
        $("#tag_create_form").submit();
    }
});

// 更新ボタンが押下されたら
$('#tag_update_enter').on("click",function(){
    // 処理を実行するか確認
    const result = window.confirm("タグを更新しますか？");
    // 「はい」が押下されたらsubmit、「いいえ」が押下されたら処理キャンセル
    if(result == true) {
        $("#tag_update_form").submit();
    }
});

// 削除ボタンが押下されたら
$('#tag_delete_enter').on("click",function(){
    // 処理を実行するか確認
    const result = window.confirm("タグを削除しますか？");
    // 「はい」が押下されたらsubmit、「いいえ」が押下されたら処理キャンセル
    if(result == true) {
        $("#tag_delete_form").submit();
    }
});