// 追加ボタンが押下されたら
$('#role_create_enter').on("click",function(){
    // 処理を実行するか確認
    const result = window.confirm("権限を追加しますか？");
    // 「はい」が押下されたらsubmit、「いいえ」が押下されたら処理キャンセル
    if(result == true) {
        $("#role_create_form").submit();
    }
});

// 更新ボタンが押下されたら
$('#role_update_enter').on("click",function(){
    // 処理を実行するか確認
    const result = window.confirm("権限を更新しますか？");
    // 「はい」が押下されたらsubmit、「いいえ」が押下されたら処理キャンセル
    if(result == true) {
        $("#role_update_form").submit();
    }
});

// 削除ボタンが押下されたら
$('#role_delete_enter').on("click",function(){
    // 処理を実行するか確認
    const result = window.confirm("権限を削除しますか？");
    // 「はい」が押下されたらsubmit、「いいえ」が押下されたら処理キャンセル
    if(result == true) {
        $("#role_delete_form").submit();
    }
});