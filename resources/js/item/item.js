// 追加ボタンが押下されたら
$('#item_create_enter').on("click",function(){
    // 処理を実行するか確認
    const result = window.confirm("項目を追加しますか？");
    // 「はい」が押下されたらsubmit、「いいえ」が押下されたら処理キャンセル
    if(result == true) {
        $("#item_create_form").submit();
    }
});

// 更新ボタンが押下されたら
$('#item_update_enter').on("click",function(){
    // 処理を実行するか確認
    const result = window.confirm("項目を更新しますか？");
    // 「はい」が押下されたらsubmit、「いいえ」が押下されたら処理キャンセル
    if(result == true) {
        $("#item_update_form").submit();
    }
});

// 削除ボタンが押下されたら
$('#item_delete_enter').on("click",function(){
    // 処理を実行するか確認
    const result = window.confirm("項目を削除しますか？");
    // 「はい」が押下されたらsubmit、「いいえ」が押下されたら処理キャンセル
    if(result == true) {
        $("#item_delete_form").submit();
    }
});