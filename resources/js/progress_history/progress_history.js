$(document).ready(function() {
    // selectタグが変更された時のイベント処理
    $('.search_enter').change(function() {
        $('#search_form').submit();
    });
});