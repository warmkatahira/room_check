// 追加ボタンが押下されたら
$('#customer_create_enter').on("click",function(){
    // 処理を実行するか確認
    const result = window.confirm("荷主を追加しますか？");
    // 「はい」が押下されたらsubmit、「いいえ」が押下されたら処理キャンセル
    if(result == true) {
        $("#customer_create_form").submit();
    }
});

// 更新ボタンが押下されたら
$('#customer_update_enter').on("click",function(){
    // 処理を実行するか確認
    const result = window.confirm("荷主を更新しますか？");
    // 「はい」が押下されたらsubmit、「いいえ」が押下されたら処理キャンセル
    if(result == true) {
        $("#customer_update_form").submit();
    }
});

// 削除ボタンが押下されたら
$('#customer_delete_enter').on("click",function(){
    // 処理を実行するか確認
    const result = window.confirm("荷主を削除しますか？\n※進捗データも同時に削除されるのでご注意下さい。");
    // 「はい」が押下されたらsubmit、「いいえ」が押下されたら処理キャンセル
    if(result == true) {
        $("#customer_delete_form").submit();
    }
});

$(document).ready(function() {
    // selectタグが変更された時のイベント処理
    $('.search_enter').change(function() {
        $('#search_form').submit();
    });
});